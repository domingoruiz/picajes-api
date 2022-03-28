<?php
namespace PICAJES\controllers;

use PICAJES\helpers\salida;

/**
 * Controlador puestofichajes
 *
 * Este controlador almacena todas las operaciones relacionadas con los puestofichajes
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Controller
 */

class puestofichajeController extends controller {

    /**
     * Constructor del controlador puestofichaje
     *
     * @access public
     */
    public function  __construct() {
        return parent::__construct();
    }
    
    /**
     * Operación de la api que devuelve los datos de un puestofichaje
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y GET
     * @return salida
     */
    function obtener_datos($parametros) {
        $id = $parametros["URL"]["3"];

        if(empty($id)) {
            $todos_puestofichajes = \PICAJES\objects\puestofichaje::todos_puestofichajes();
            foreach ($todos_puestofichajes as $puestofichaje) {
                $array[] = HOST_COMPLETO.VERSION_API."/puestofichajes/".$puestofichaje->get_id()."/";
            }

            $salida = new salida();
            $salida->set_id_error(200);
            $salida->set_salida($array);
            return $salida;
        }else{
            $puestofichaje = new \PICAJES\objects\puestofichaje($id);

            $puestofichaje->establish();

            if(!empty($puestofichaje->get_nombre())) {
                $array = array(
                    "id" => $puestofichaje->get_id(),
                    "nombre" => $puestofichaje->get_nombre(),
                    "zona" => $puestofichaje->get_zona()
                );

                $salida = new salida();
                $salida->set_id_error(200);
                $salida->set_salida($array);
                return $salida;
            }else{
                $salida = new salida();
                $salida->set_id_error(400);
                $salida->set_error("puestofichaje no existente");
                return $salida;
            }
        }
    }

    /**
     * Operación de la api que crea una puestofichaje
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y POST
     * @return salida
     */
    function crear_puestofichaje($parametros) {
        $nombre = $parametros["POST"]["nombre"];
        $zona = $parametros["POST"]["zona"];

        if(!empty($nombre) && !empty($zona)) {
            if(1) {
                $puestofichaje = new \PICAJES\objects\puestofichaje();
                $puestofichaje->set_nombre($nombre);
                $puestofichaje->set_zona($zona);

                if($puestofichaje->create()) {
                    $salida = new salida();
                    $salida->set_id_error(201);
                    $salida->set_salida(HOST_COMPLETO.VERSION_API."/puestofichajes/".$puestofichaje->get_id()."/");
                    return $salida;
                }else{
                    $salida = new salida();
                    $salida->set_id_error(500);
                    $salida->set_error("Error creando el puestofichaje");
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
     * Operación de la api que actualiza una puestofichaje
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y GET
     * @return salida
     */
    function actualizar_puestofichaje($parametros) {
        $id = $parametros["URL"]["3"];
        $nombre = $parametros["GET"]["nombre"];
        $zona = $parametros["GET"]["zona"];

        if(!empty($nombre) && !empty($zona)) {
            if(!empty($id)) {
                $puestofichaje = new \PICAJES\objects\puestofichaje($id);
                if(!empty($puestofichaje->get_id())) {
                    $puestofichaje->set_nombre($nombre);
                    $puestofichaje->set_zona($zona);

                    if($puestofichaje->update()) {
                        $salida = new salida();
                        $salida->set_id_error(200);
                        return $salida;
                    }else{
                        $salida = new salida();
                        $salida->set_id_error(400);
                        $salida->set_error("Error modificando el puestofichaje");
                        return $salida;
                    }
                }else{
                    $salida = new salida();
                    $salida->set_id_error(400);
                    $salida->set_error("ID de puestofichaje no existente");
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
     * Operación de la api que elimina un puestofichaje
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y GET
     * @return salida
     */
    function eliminar_puestofichaje($parametros) {
        $id = $parametros["URL"]["3"];

        if(!empty($id)) {
            $puestofichaje = new \PICAJES\objects\puestofichaje($id);
            if(!empty($puestofichaje->get_id())) {
                if($puestofichaje->eliminar()) {
                    $salida = new salida();
                    $salida->set_id_error(200);
                    return $salida;
                }else{
                    $salida = new salida();
                    $salida->set_id_error(500);
                    $salida->set_error("Error eliminando el puestofichaje");
                    return $salida;
                }
            }else{
                $salida = new salida();
                $salida->set_id_error(400);
                $salida->set_error("ID de puestofichaje no existente");
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