<?php
namespace PICAJES\controllers;

use PICAJES\helpers\salida;

/**
 * Controlador zonas
 *
 * Este controlador almacena todas las operaciones relacionadas con los zonas
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Controller
 */

class zonaController extends controller {

    /**
     * Constructor del controlador zona
     *
     * @access public
     */
    public function  __construct() {
        return parent::__construct();
    }
    
    /**
     * Operación de la api que devuelve los datos de un zona
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y GET
     * @return salida
     */
    function obtener_datos($parametros) {
        $id = \PICAJES\helpers\cifrar::descifrar($parametros["URL"]["3"]);
        
        if(empty($id)) {
            $todos_zonas = \PICAJES\objects\zona::todos_zonas($GLOBALS["empresa_id"]);
            foreach ($todos_zonas as $zona) {
                $array[] = array(
                    "id" => \PICAJES\helpers\cifrar::cifrar($zona->get_id()),
                    "nombre" => $zona->get_nombre()
                );
            }

            $salida = new salida();
            $salida->set_id_error(200);
            $salida->set_salida($array);
            return $salida;
        }else{
            $zona = new \PICAJES\objects\zona($id);

            $zona->establish();

            if(!empty($zona->get_nombre())) {
                $array = array(
                    "id" => \PICAJES\helpers\cifrar::cifrar($zona->get_id()),
                    "nombre" => $zona->get_nombre(),
                    "empresa" => $zona->get_empresa()
                );

                $salida = new salida();
                $salida->set_id_error(200);
                $salida->set_salida($array);
                return $salida;
            }else{
                $salida = new salida();
                $salida->set_id_error(400);
                $salida->set_error("zona no existente");
                return $salida;
            }
        }
    }

    /**
     * Operación de la api que crea una zona
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y POST
     * @return salida
     */
    function crear_zona($parametros) {
        $nombre = $parametros["POST"]["nombre"];

        if(!empty($nombre)) {
            if(1) {
                $zona = new \PICAJES\objects\zona();
                $zona->set_nombre($nombre);
                $zona->set_empresa($GLOBALS["empresa_id"]);

                if($zona->create()) {
                    $salida = new salida();
                    $salida->set_id_error(201);
                    $salida->set_salida(HOST_COMPLETO.VERSION_API."/zonas/".\PICAJES\helpers\cifrar::cifrar($zona->get_id())."/");
                    return $salida;
                }else{
                    $salida = new salida();
                    $salida->set_id_error(500);
                    $salida->set_error("Error creando el zona");
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
     * Operación de la api que actualiza una zona
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y GET
     * @return salida
     */
    function actualizar_zona($parametros) {
        $id = \PICAJES\helpers\cifrar::descifrar($parametros["URL"]["3"]);
        $nombre = $parametros["POST"]["nombre"];

        if(!empty($nombre)) {
            if(!empty($id)) {
                $zona = new \PICAJES\objects\zona($id);
                if(!empty($zona->get_id())) {
                    $zona->set_nombre($nombre);
                    $zona->set_empresa($GLOBALS["empresa_id"]);

                    if($zona->update()) {
                        $salida = new salida();
                        $salida->set_id_error(200);
                        $salida->set_error("Modificado correctamente");
                        return $salida;
                    }else{
                        $salida = new salida();
                        $salida->set_id_error(400);
                        $salida->set_error("Error modificando el zona");
                        return $salida;
                    }
                }else{
                    $salida = new salida();
                    $salida->set_id_error(400);
                    $salida->set_error("ID de zona no existente");
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
     * Operación de la api que elimina un zona
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y GET
     * @return salida
     */
    function eliminar_zona($parametros) {
        $id = \PICAJES\helpers\cifrar::descifrar($parametros["URL"]["3"]);

        if(!empty($id)) {
            $zona = new \PICAJES\objects\zona($id);
            if(!empty($zona->get_id())) {
                if($zona->eliminar()) {
                    $salida = new salida();
                    $salida->set_id_error(200);
                    return $salida;
                }else{
                    $salida = new salida();
                    $salida->set_id_error(500);
                    $salida->set_error("Error eliminando el zona");
                    return $salida;
                }
            }else{
                $salida = new salida();
                $salida->set_id_error(400);
                $salida->set_error("ID de zona no existente");
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