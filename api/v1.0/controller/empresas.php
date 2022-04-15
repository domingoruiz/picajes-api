<?php
namespace PICAJES\controllers;

use PICAJES\helpers\salida;

/**
 * Controlador empresas
 *
 * Este controlador almacena todas las operaciones relacionadas con los empresas
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Controller
 */

class empresaController extends controller {

    /**
     * Constructor del controlador empresa
     *
     * @access public
     */
    public function  __construct() {
        return parent::__construct();
    }
    
    /**
     * Operación de la api que devuelve los datos de un empresa
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y GET
     * @return salida
     */
    function obtener_datos($parametros) {
        $id = \PICAJES\helpers\cifrar::descifrar($parametros["URL"]["3"]);

        if(empty($id)) {
            $todos_empresas = \PICAJES\objects\empresa::todos_empresas();
            foreach ($todos_empresas as $empresa) {
                $array[] = array(
                    "id" => \PICAJES\helpers\cifrar::cifrar($empresa->get_id()),
                    "nombre" => $empresa->get_nombre(),
                    "nif" => $empresa->get_nif(),
                    "direccion" => $empresa->get_direccion(),
                    "telefono" => $empresa->get_telefono(),
                    "email" => $empresa->get_email()
                );
            }

            $salida = new salida();
            $salida->set_id_error(200);
            $salida->set_salida($array);
            return $salida;
        }else{
            $empresa = new \PICAJES\objects\empresa($id);

            $empresa->establish();

            if(!empty($empresa->get_nombre())) {
                $array = array(
                    "id" => \PICAJES\helpers\cifrar::cifrar($empresa->get_id()),
                    "nombre" => $empresa->get_nombre(),
                    "nif" => $empresa->get_nif(),
                    "direccion" => $empresa->get_direccion(),
                    "telefono" => $empresa->get_telefono(),
                    "email" => $empresa->get_email()
                );

                $salida = new salida();
                $salida->set_id_error(200);
                $salida->set_salida($array);
                return $salida;
            }else{
                $salida = new salida();
                $salida->set_id_error(400);
                $salida->set_error("Empresa no existente");
                return $salida;
            }
        }
    }

    /**
     * Operación de la api que crea una empresa
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y POST
     * @return salida
     */
    function crear_empresa($parametros) {
        $nombre = $parametros["POST"]["nombre"];
        $nif = $parametros["POST"]["nif"];
        $direccion = $parametros["POST"]["direccion"];
        $telefono = $parametros["POST"]["telefono"];
        $email = $parametros["POST"]["email"];

        if(!empty($nombre) && $email && !empty($nif) && !empty($direccion) && !empty($telefono) && !empty($email)) {
            $empresa = new \PICAJES\objects\empresa;
            $empresa->set_nif($nif);
            $empresa->establish("nif");

            if(empty($empresa->get_id())) {
                $empresa = new \PICAJES\objects\empresa();
                $empresa->set_nombre($nombre);
                $empresa->set_nif($nif);
                $empresa->set_direccion($direccion);
                $empresa->set_telefono($telefono);
                $empresa->set_email($email);

                if($empresa->create()) {
                    $empresa->establish("nif");

                    $salida = new salida();
                    $salida->set_id_error(201);
                    $salida->set_salida(HOST_COMPLETO.VERSION_API."/empresas/".\PICAJES\helpers\cifrar::cifrar($empresa->get_id())."/");
                    return $salida;
                }else{
                    $salida = new salida();
                    $salida->set_id_error(500);
                    $salida->set_error("Error creando el empresa");
                    return $salida;
                }
            }else{
                $salida = new salida();
                $salida->set_id_error(400);
                $salida->set_error("Ya existe un empresa con ese nif");
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
     * Operación de la api que actualiza una empresa
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y GET
     * @return salida
     */
    function actualizar_empresa($parametros) {
        $id = \PICAJES\helpers\cifrar::descifrar($parametros["URL"]["3"]);
        $nombre = $parametros["GET"]["nombre"];
        $nif = $parametros["GET"]["nif"];
        $direccion = $parametros["GET"]["direccion"];
        $telefono = $parametros["GET"]["telefono"];
        $email = $parametros["GET"]["email"];

        if(!empty($nombre) && $email && !empty($nif) && !empty($direccion) && !empty($telefono) && !empty($email)) {
            if(!empty($id)) {
                $empresa = new \PICAJES\objects\empresa($id);
                if(!empty($empresa->get_id())) {
                    $empresa->set_nombre($nombre);
                    $empresa->set_nif($nif);
                    $empresa->set_direccion($direccion);
                    $empresa->set_telefono($telefono);
                    $empresa->set_email($email);

                    if($empresa->update()) {
                        $salida = new salida();
                        $salida->set_id_error(200);
                        return $salida;
                    }else{
                        $salida = new salida();
                        $salida->set_id_error(400);
                        $salida->set_error("Error modificando el empresa");
                        return $salida;
                    }
                }else{
                    $salida = new salida();
                    $salida->set_id_error(400);
                    $salida->set_error("ID de empresa no existente");
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
     * Operación de la api que elimina un empresa
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y GET
     * @return salida
     */
    function eliminar_empresa($parametros) {
        $id = \PICAJES\helpers\cifrar::descifrar($parametros["URL"]["3"]);

        if(!empty($id)) {
            $empresa = new \PICAJES\objects\empresa($id);
            if(!empty($empresa->get_id())) {
                if($empresa->eliminar()) {
                    $salida = new salida();
                    $salida->set_id_error(200);
                    return $salida;
                }else{
                    $salida = new salida();
                    $salida->set_id_error(500);
                    $salida->set_error("Error eliminando el empresa");
                    return $salida;
                }
            }else{
                $salida = new salida();
                $salida->set_id_error(400);
                $salida->set_error("ID de empresa no existente");
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