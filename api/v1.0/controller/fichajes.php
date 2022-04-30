<?php
namespace PICAJES\controllers;

use PICAJES\helpers\salida;

/**
 * Controlador fichajes
 *
 * Este controlador almacena todas las operaciones relacionadas con los fichajes
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Controller
 */

class fichajeController extends controller {

    /**
     * Constructor del controlador fichaje
     *
     * @access public
     */
    public function  __construct() {
        return parent::__construct();
    }
    
    /**
     * Operación de la api que devuelve los datos de un fichaje
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y GET
     * @return salida
     */
    function obtener_datos($parametros) {
        $id = \PICAJES\helpers\cifrar::descifrar($parametros["URL"]["3"]);
        $fch_ini = $parametros["GET"]["fch_ini"] ? $parametros["GET"]["fch_ini"] : date_format(date_create(), "Y-m-d");
        $fch_fin = $parametros["GET"]["fch_fin"] ? $parametros["GET"]["fch_fin"] : date_format(date_create(), "Y-m-d");
        $equipo = \PICAJES\helpers\cifrar::descifrar($parametros["GET"]["equipo"]);
        $usuario = \PICAJES\helpers\cifrar::descifrar($parametros["GET"]["usuario"]);
        $estado = $parametros["GET"]["estado"];

        if(empty($id)) {
            if($fch_ini && $fch_fin) {
                $todos_fichajes = \PICAJES\objects\fichaje::todos_fichajes($GLOBALS["empresa_id"], $fch_ini, $fch_fin, $equipo, $usuario, $estado);
                foreach ($todos_fichajes as $fichaje) {
                    $usuario = new \PICAJES\objects\user($fichaje->get_usuario());
                    $equipo = new \PICAJES\objects\equipo($fichaje->get_equipo());
    
                    // Calculamos el tiempo trabajado en caso de que no este cerrado
                    if($fichaje->get_estado()==1) {
                        $tim_trb = \PICAJES\helpers\date::separar_hora(date_format(date_create($fichaje->get_tim_trb()), "H:i:s")) +\PICAJES\helpers\date::separar_hora(date_format(date_create(), "H:i:s")) - \PICAJES\helpers\date::separar_hora(date_format(date_create($fichaje->get_moddate()), "H:i:s"));
                        $tim_trb = \PICAJES\helpers\date::unir_hora($tim_trb);
                        $min_trb = \PICAJES\helpers\date::separar_hora($tim_trb)/60;
    
                        $tim_tot = \PICAJES\helpers\date::separar_hora($tim_trb) + \PICAJES\helpers\date::separar_hora($fichaje->get_tim_dsc());
                        $tim_tot = \PICAJES\helpers\date::unir_hora($tim_tot);
                        $min_tot = \PICAJES\helpers\date::separar_hora($tim_tot)/60;
                    }else{
                        $tim_trb = $fichaje->get_tim_trb();
                        $min_trb = \PICAJES\helpers\date::separar_hora($tim_trb)/60;
                        $tim_tot = $fichaje->get_tim_tot();
                        $min_tot = $fichaje->get_min_tot();
                    }
    
                    $array[] = array(
                        "id" => \PICAJES\helpers\cifrar::cifrar($fichaje->get_id()),
                        "usuario" => $usuario->get_nombre(),
                        "equipo" => $equipo->get_nombre(),
                        "empresa" => $fichaje->get_empresa(),
                        "hor_ini" => $fichaje->get_hor_ini(),
                        "hor_fin" => $fichaje->get_hor_fin(),
                        "tim_trb" => $tim_trb,
                        "tim_dsc" => $fichaje->get_tim_dsc(),
                        "tim_tot" => $tim_tot,
                        "min_trb" => $min_trb,
                        "min_dsc" => $fichaje->get_min_dsc(),
                        "min_tot" => $min_tot,
                        "estado" => $fichaje->get_estado(),
                        "fch" => $fichaje->get_fch()
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
            $fichaje = new \PICAJES\objects\fichaje($id);

            $fichaje->establish();

            if(!empty($fichaje->get_nombre())) {
                $array = array(
                    "id" => \PICAJES\helpers\cifrar::cifrar($fichaje->get_id()),
                    "usuario" => $fichaje->get_usuario(),
                    "equipo" => $fichaje->get_equipo(),
                    "empresa" => $fichaje->get_empresa(),
                    "hor_ini" => $fichaje->get_hor_ini(),
                    "hor_fin" => $fichaje->get_hor_fin(),
                    "tim_trb" => $fichaje->get_tim_trb(),
                    "tim_dsc" => $fichaje->get_tim_dsc(),
                    "tim_tot" => $fichaje->get_tim_tot(),
                    "min_trb" => $fichaje->get_min_trb(),
                    "min_dsc" => $fichaje->get_min_dsc(),
                    "min_tot" => $fichaje->get_min_tot(),
                    "estado" => $fichaje->get_estado()
                );

                $salida = new salida();
                $salida->set_id_error(200);
                $salida->set_salida($array);
                return $salida;
            }else{
                $salida = new salida();
                $salida->set_id_error(400);
                $salida->set_error("fichaje no existente");
                return $salida;
            }
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