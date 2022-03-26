<?php
namespace PICAJES\controllers;

use PICAJES\helpers\salida;

/**
 * Controlador equipos
 *
 * Este controlador almacena todas las operaciones relacionadas con los equipos
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Controller
 */

class equipoController extends controller {

    /**
     * Constructor del controlador equipo
     *
     * @access public
     */
    public function  __construct() {
        return parent::__construct();
    }
    
    /**
     * Operación de la api que devuelve los datos de un equipo
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y GET
     * @return salida
     */
    function obtener_datos($parametros) {
        $id = $parametros["URL"]["3"];

        if(empty($id)) {
            $todos_equipos = \PICAJES\objects\equipo::todos_equipos();
            foreach ($todos_equipos as $equipo) {
                $array[] = HOST_COMPLETO.VERSION_API."/equipos/".$equipo->get_id()."/";
            }

            $salida = new salida();
            $salida->set_id_error(200);
            $salida->set_salida($array);
            return $salida;
        }else{
            $equipo = new \PICAJES\objects\equipo($id);

            $equipo->establish();

            if(!empty($equipo->get_nombre())) {
                $array = array(
                    "id" => $equipo->get_id(),
                    "nombre" => $equipo->get_nombre(),
                    "empresa" => $equipo->get_empresa()
                );

                $salida = new salida();
                $salida->set_id_error(200);
                $salida->set_salida($array);
                return $salida;
            }else{
                $salida = new salida();
                $salida->set_id_error(400);
                $salida->set_error("equipo no existente");
                return $salida;
            }
        }
    }

    /**
     * Operación de la api que crea una equipo
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y POST
     * @return salida
     */
    function crear_equipo($parametros) {
        $nombre = $parametros["POST"]["nombre"];
        $empresa = $parametros["POST"]["empresa"];

        if(!empty($nombre) && !empty($empresa)) {
            if(1) {
                $equipo = new \PICAJES\objects\equipo();
                $equipo->set_nombre($nombre);
                $equipo->set_empresa($empresa);

                if($equipo->create()) {
                    $salida = new salida();
                    $salida->set_id_error(201);
                    $salida->set_salida(HOST_COMPLETO.VERSION_API."/equipos/".$equipo->get_id()."/");
                    return $salida;
                }else{
                    $salida = new salida();
                    $salida->set_id_error(500);
                    $salida->set_error("Error creando el equipo");
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
     * Operación de la api que actualiza una equipo
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y GET
     * @return salida
     */
    function actualizar_equipo($parametros) {
        $id = $parametros["URL"]["3"];
        $nombre = $parametros["GET"]["nombre"];
        $empresa = $parametros["GET"]["empresa"];

        if(!empty($nombre) && !empty($empresa)) {
            if(!empty($id)) {
                $equipo = new \PICAJES\objects\equipo($id);
                if(!empty($equipo->get_id())) {
                    $equipo->set_nombre($nombre);
                    $equipo->set_empresa($empresa);

                    if($equipo->update()) {
                        $salida = new salida();
                        $salida->set_id_error(200);
                        return $salida;
                    }else{
                        $salida = new salida();
                        $salida->set_id_error(400);
                        $salida->set_error("Error modificando el equipo");
                        return $salida;
                    }
                }else{
                    $salida = new salida();
                    $salida->set_id_error(400);
                    $salida->set_error("ID de equipo no existente");
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
     * Operación de la api que elimina un equipo
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y GET
     * @return salida
     */
    function eliminar_equipo($parametros) {
        $id = $parametros["URL"]["3"];

        if(!empty($id)) {
            $equipo = new \PICAJES\objects\equipo($id);
            if(!empty($equipo->get_id())) {
                if($equipo->eliminar()) {
                    $salida = new salida();
                    $salida->set_id_error(200);
                    return $salida;
                }else{
                    $salida = new salida();
                    $salida->set_id_error(500);
                    $salida->set_error("Error eliminando el equipo");
                    return $salida;
                }
            }else{
                $salida = new salida();
                $salida->set_id_error(400);
                $salida->set_error("ID de equipo no existente");
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