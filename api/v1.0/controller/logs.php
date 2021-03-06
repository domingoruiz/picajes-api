<?php
namespace PICAJES\controllers;

use PICAJES\helpers\salida;

/**
 * Controlador logs
 *
 * Este controlador almacena todas las operaciones relacionadas con los logs
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Controller
 */

class logController extends controller {

    /**
     * Constructor del controlador log
     *
     * @access public
     */
    public function  __construct() {
        return parent::__construct();
    }
    
    /**
     * Operación de la api que devuelve los datos de un log
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y GET
     * @return salida
     */
    function obtener_datos($parametros) {
        $id = \PICAJES\helpers\cifrar::descifrar($parametros["URL"]["3"]);
        $fch_ini = $parametros["GET"]["fch_ini"] != '' ? $parametros["GET"]["fch_ini"] : date_format(date_create(), "Y-m-d");
        $fch_fin = $parametros["GET"]["fch_fin"] != '' ? $parametros["GET"]["fch_fin"] : date_format(date_create(), "Y-m-d");
        $zona = \PICAJES\helpers\cifrar::descifrar($parametros["GET"]["zona"]);
        $usuario = \PICAJES\helpers\cifrar::descifrar($parametros["GET"]["usuario"]);

        if(empty($id)) {
            if($fch_ini && $fch_fin) {
                $todos_logs = \PICAJES\objects\log::todos_logs(null, $fch_ini, $fch_fin, $zona, $usuario);
                foreach ($todos_logs as $log) {
                    $usuario = new \PICAJES\objects\user($log->get_usuario());
                    $puesto_fichaje = new \PICAJES\objects\puestofichaje($log->get_puestofichaje());

                    $array[] = array(
                        "id" => \PICAJES\helpers\cifrar::cifrar($log->get_id()),
                        "alt_date" => date_format(date_create($log->get_altdate()), "d-m-Y H:i:s"),
                        "usuario" => $usuario->get_nombre(),
                        "puesto_fichaje" => $puesto_fichaje->get_nombre(),
                        "tipo_movimiento" => $log->get_tipomovimiento()
                    );
                }

                $salida = new salida();
                $salida->set_id_error(200);
                $salida->set_salida($array);
                return $salida;
            }else{
                $salida = new salida();
                $salida->set_id_error(400);
                $salida->set_error("Fechas invalidas");
                return $salida;
            }
        }else{
            $log = new \PICAJES\objects\log($id);

            $log->establish();

            if(!empty($log->get_altdate())) {
                $usuario = new \PICAJES\objects\user($log->get_usuario());
                $puesto_fichaje = new \PICAJES\objects\puestofichaje($log->get_puestofichaje());

                $array = array(
                    "id" => \PICAJES\helpers\cifrar::cifrar($log->get_id()),
                    "alt_date" => $log->get_altdate(),
                    "usuario" => $usuario->get_nombre(),
                    "puesto_fichaje" => $puesto_fichaje->get_nombre(),
                    "tipo_movimiento" => $log->get_tipomovimiento()
                );

                $salida = new salida();
                $salida->set_id_error(200);
                $salida->set_salida($array);
                return $salida;
            }else{
                $salida = new salida();
                $salida->set_id_error(400);
                $salida->set_error("log no existente");
                return $salida;
            }
        }
    }

    /**
     * Operación de la api que crea una log
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y POST
     * @return salida
     */
    function crear_log($parametros) {
        $barcode = $parametros["POST"]["barcode"];
        $puesto_fichaje = \PICAJES\helpers\cifrar::descifrar($parametros["POST"]["puesto_fichaje"]);
        $empresa = \PICAJES\helpers\cifrar::descifrar($parametros["POST"]["empresa"]);
        
        if(!empty($barcode) && !empty($puesto_fichaje) && !empty($empresa)) {
            if(1) {
                $usuario = new \PICAJES\objects\user();
                $usuario->set_barcode($barcode);
                $usuario->establish("barcode");

                if($usuario->get_id() && ($usuario->get_empresa() == $empresa)) {
                    $log = new \PICAJES\objects\log();

                    // Antes de crear el log vemos si existe el fichaje
                    $fichaje = new \PICAJES\objects\fichaje();
                    $fichaje->set_usuario($usuario->get_id());
                    $fichaje->establish("usr_fch");
                    
                    if($fichaje->get_id()!=0) {
                        if($fichaje->get_estado() == 2) {
                            $log->set_tipomovimiento(1);
                            $fichaje->set_estado(1);
                            $fichaje->update();
                        }else{
                            $fichaje->set_hor_fin(date_format(date_create(),"Y-m-d H:i:s"));
                            $fichaje->set_estado(2);
                            $fichaje->update();

                            $log->set_tipomovimiento(2);
                        }
                    }else{
                        $fichaje->set_equipo($usuario->get_equipo());
                        $fichaje->set_empresa($usuario->get_empresa());
                        $fichaje->set_hor_ini(date_format(date_create(),"Y-m-d H:i:s"));
                        $fichaje->set_estado(1);
                        $fichaje->create();

                        $log->set_tipomovimiento(1);
                    }

                    // Una vez creado el fichaje creamos el log
                    $log->set_usuario($usuario->get_id());
                    $log->set_puestofichaje($puesto_fichaje);
                    $log->set_empresa($empresa);
                    $log->set_fichaje($fichaje->get_id());
                    
                    if($log->create()) {
                        $fichaje->actualizar_tiempos();

                        $salida = new salida();
                        $salida->set_id_error(201);
                        
                        if($log->get_tipomovimiento()==1) {
                            $salida->set_error("Entrada de ".$usuario->get_nombre());
                        }elseif($log->get_tipomovimiento()==2) {
                            $salida->set_error("Salida de ".$usuario->get_nombre());
                        }
                        return $salida;
                    }else{
                        $salida = new salida();
                        $salida->set_id_error(500);
                        $salida->set_error("Error creando el log");
                        return $salida;
                    }
                }else{
                    $salida = new salida();
                    $salida->set_id_error(500);
                    $salida->set_error("Tarjeta no registrada en el sistema");
                    return $salida;
                }
            }
        }else{
            $salida = new salida();
            $salida->set_id_error(400);
            $salida->set_error("Faltan parametros requeridos");
            return $salida;
        }
    }

    /**
     * Operación de la api que actualiza una log
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y GET
     * @return salida
     */
    function actualizar_log($parametros) {
        $id = \PICAJES\helpers\cifrar::descifrar($parametros["URL"]["3"]);
        $usuario = $parametros["GET"]["usuario"];
        $puesto_fichaje = $parametros["GET"]["puesto_fichaje"];
        $tipo_movimiento = $parametros["GET"]["tipo_movimiento"];

        if(!empty($usuario) && !empty($puesto_fichaje) && !empty($tipo_movimiento)) {
            if(!empty($id)) {
                $log = new \PICAJES\objects\log($id);
                if(!empty($log->get_id())) {
                    $log->set_usuario($usuario);
                    $log->set_puestofichaje($puesto_fichaje);
                    $log->set_tipomovimiento($tipo_movimiento);

                    if($log->update()) {
                        $salida = new salida();
                        $salida->set_id_error(200);
                        return $salida;
                    }else{
                        $salida = new salida();
                        $salida->set_id_error(400);
                        $salida->set_error("Error modificando el log");
                        return $salida;
                    }
                }else{
                    $salida = new salida();
                    $salida->set_id_error(400);
                    $salida->set_error("ID de log no existente");
                    return $salida;
                }
            }else{
                $salida = new salida();
                $salida->set_id_error(400);
                $salida->set_error("ID no definido");
                return $salida;
            }
        }else{
            $salida = new salida();
            $salida->set_id_error(400);
            $salida->set_error("Faltan parametros requeridos");
            return $salida;
        }
    }


    /**
     * Operación de la api que elimina un log
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y GET
     * @return salida
     */
    function eliminar_log($parametros) {
        $id = \PICAJES\helpers\cifrar::descifrar($parametros["URL"]["3"]);

        if(!empty($id)) {
            $log = new \PICAJES\objects\log($id);
            if(!empty($log->get_id())) {
                if($log->eliminar()) {
                    $salida = new salida();
                    $salida->set_id_error(200);
                    return $salida;
                }else{
                    $salida = new salida();
                    $salida->set_id_error(500);
                    $salida->set_error("Error eliminando el log");
                    return $salida;
                }
            }else{
                $salida = new salida();
                $salida->set_id_error(400);
                $salida->set_error("ID de log no existente");
                return $salida;
            }
        }else{
            $salida = new salida();
            $salida->set_id_error(400);
            $salida->set_error("Faltan parametros");
            return $salida;
        }
    }

    /**
     * Destructor
     *
     * @access public
     * @return boolean
     */
    public function __destruct() {
        return TRUE;
    }
    
}