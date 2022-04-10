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
        $id = $parametros["URL"]["3"];

        if(empty($id)) {
            $todos_logs = \PICAJES\objects\log::todos_logs();
            foreach ($todos_logs as $log) {
                $array[] = array(
                    "id" => $log->get_id(),
                    "alt_date" => $log->get_altdate(),
                    "usuario" => $log->get_usuario(),
                    "puesto_fichaje" => $log->get_puestofichaje(),
                    "tipo_movimiento" => $log->get_tipomovimiento()
                );
            }

            $salida = new salida();
            $salida->set_id_error(200);
            $salida->set_salida($array);
            return $salida;
        }else{
            $log = new \PICAJES\objects\log($id);

            $log->establish();

            if(!empty($log->get_altdate())) {
                $array = array(
                    "id" => $log->get_id(),
                    "alt_date" => $log->get_altdate(),
                    "usuario" => $log->get_usuario(),
                    "puesto_fichaje" => $log->get_puestofichaje(),
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
        $usuario = $parametros["POST"]["usuario"];
        $puesto_fichaje = $parametros["POST"]["puesto_fichaje"];
        $tipo_movimiento = $parametros["POST"]["tipo_movimiento"];

        if(!empty($usuario) && !empty($puesto_fichaje) && !empty($tipo_movimiento)) {
            if(1) {
                $log = new \PICAJES\objects\log();
                $log->set_usuario($usuario);
                $log->set_puestofichaje($puesto_fichaje);
                $log->set_tipomovimiento($tipo_movimiento);

                if($log->create()) {
                    $salida = new salida();
                    $salida->set_id_error(201);
                    $salida->set_salida(HOST_COMPLETO.VERSION_API."/logs/".$log->get_id()."/");
                    return $salida;
                }else{
                    $salida = new salida();
                    $salida->set_id_error(500);
                    $salida->set_error("Error creando el log");
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
        $id = $parametros["URL"]["3"];
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
        $id = $parametros["URL"]["3"];

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