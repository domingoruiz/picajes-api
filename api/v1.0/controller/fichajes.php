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
        
        if(empty($id)) {
            $todos_fichajes = \PICAJES\objects\fichaje::todos_fichajes($GLOBALS["empresa_id"]);
            foreach ($todos_fichajes as $fichaje) {
                $array[] = array(
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
            }

            $salida = new salida();
            $salida->set_id_error(200);
            $salida->set_salida($array);
            return $salida;
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