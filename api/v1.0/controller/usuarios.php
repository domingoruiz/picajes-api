<?php
namespace PICAJES\controllers;

use PICAJES\helpers\salida;

/**
 * Controlador Usuarios
 *
 * Este controlador almacena todas las operaciones relacionadas con los usuarios
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Controller
 */

class usuarioController extends controller {

    /**
     * Constructor del controlador usuario
     *
     * @access public
     */
    public function  __construct() {
        return parent::__construct();
    }

    /**
     * Operación de la api que permite a un usuario obtener un token de sesión
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y GET
     * @return salida
     */
    function login($parametros) {
        $username = $parametros["GET"]["username"];
        $password = $parametros["GET"]["password"];

        if(!empty($username) && !empty($password)) {
            $user = new \PICAJES\objects\user();
            $user->set_usuario($username);
            $user->establish("usuario");

            if($user->get_contrasenia() == $password) {
                // Creamos la sesión
                $date = new \DateTime();
                $date->modify('+2 hours');

                \PICAJES\objects\sesion::eliminar_sesiones_usuario($user->get_id());

                $sesion = new \PICAJES\objects\sesion();
                $sesion->set_user($user->get_id());
                $sesion->set_token_sesion(\PICAJES\helpers\text::random(40));
                $sesion->set_fecha_expiracion($date->format('Y-m-d H:i:s'));
                $sesion->create();

                $salida = new salida();
                $salida->set_id_error(200);
                $salida->set_salida(
                    array(
                        "token_sesion" => $sesion->get_token_sesion(),
                        "fecha_expiracion" => $sesion->get_fecha_expiracion()
                    )
                );
                return $salida;
            }else{
                $salida = new salida();
                $salida->set_id_error(400);
                $salida->set_error("Usuario o contraseña incorrecto");
                return $salida;
            }
        }else{
            $salida = new salida();
            $salida->set_id_error(400);
            $salida->set_error("Falta el usuario o la contraseña");
            return $salida;
        }
    }

    /**
     * Operación de la api que devuelve los datos de un usuario
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y GET
     * @return salida
     */
    function obtener_datos($parametros) {
        $id = $parametros["URL"]["3"];

        if(empty($id)) {
            $todos_usuarios = \PICAJES\objects\user::todos_users();
            foreach ($todos_usuarios as $user) {
                $array[] = array(
                    "id" => $user->get_id(),
                    "nombre" => $user->get_nombre()
                );
            }

            $salida = new salida();
            $salida->set_id_error(200);
            $salida->set_salida($array);
            return $salida;
        }else{
            $user = new \PICAJES\objects\user($id);

            if(!empty($user->get_contrasenia())) {
                $array = array(
                    "id" => $user->get_id(),
                    "usuario" => $user->get_usuario(),
                    "password" => $user->get_contrasenia(),
                    "email" => $user->get_email(),
                    "telefono" => $user->get_telefono(),
                    "empresa" => $user->get_empresa(),
                    "equipo" => $user->get_equipo(),
                    "nombre" => $user->get_nombre()
                );

                $salida = new salida();
                $salida->set_id_error(200);
                $salida->set_salida($array);
                return $salida;
            }else{
                $salida = new salida();
                $salida->set_id_error(400);
                $salida->set_error("Usuario no existente");
                return $salida;
            }
        }
    }

    /**
     * Operación de la api que crea un usuario
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y POST
     * @return salida
     */
    function crear_usuario($parametros) {
        $nombre = $parametros["POST"]["nombre"];
        $email = $parametros["POST"]["email"];
        $usuario = $parametros["POST"]["usuario"];
        $password = $parametros["POST"]["password"];
        $telefono = $parametros["POST"]["telefono"];
        $empresa = $parametros["POST"]["empresa"];
        $equipo = $parametros["POST"]["equipo"];

        if(!empty($nombre) && $email && !empty($usuario) && !empty($password) && !empty($empresa) && !empty($equipo)) {
            $user = new \PICAJES\objects\user;
            $user->set_usuario($usuario);
            $user->establish("usuario");

            if(empty($user->get_id())) {
                $user = new \PICAJES\objects\user();
                $user->set_usuario($usuario);
                $user->set_contrasenia($password);
                $user->set_nombre($nombre);
                $user->set_email($email);
                $user->set_telefono($telefono);
                $user->set_empresa($empresa);
                $user->set_equipo($equipo);

                if($user->create()) {
                    $user->establish("usuario");

                    $salida = new salida();
                    $salida->set_id_error(201);
                    $salida->set_salida(HOST_COMPLETO.VERSION_API."/usuarios/".$user->get_id()."/");
                    return $salida;
                }else{
                    $salida = new salida();
                    $salida->set_id_error(500);
                    $salida->set_error("Error creando el usuario");
                    return $salida;
                }
            }else{
                $salida = new salida();
                $salida->set_id_error(400);
                $salida->set_error("Ya existe un usuario con ese usuario");
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
     * Operación de la api que actualiza un usuario
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y GET
     * @return salida
     */
    function actualizar_usuario($parametros) {
        $id = $parametros["URL"]["3"];
        $nombre = $parametros["GET"]["nombre"];
        $email = $parametros["GET"]["email"];
        $usuario = $parametros["GET"]["usuario"];
        $password = $parametros["GET"]["password"];
        $telefono = $parametros["GET"]["telefono"];
        $empresa = $parametros["GET"]["empresa"];
        $equipo = $parametros["GET"]["equipo"];

        if(!empty($nombre) && $email && !empty($usuario) && !empty($password) && !empty($empresa) && !empty($equipo)) {
            if(!empty($id)) {
                $user = new \PICAJES\objects\user($id);
                if(!empty($user->get_usuario())) {
                    $user->set_nombre($nombre);
                    $user->set_email($email);
                    $user->set_usuario($usuario);
                    $user->set_contrasenia($password);
                    $user->set_telefono($telefono);
                    $user->set_empresa($empresa);
                    $user->set_equipo($equipo);

                    if($user->update()) {
                        $salida = new salida();
                        $salida->set_id_error(200);
                        return $salida;
                    }else{
                        $salida = new salida();
                        $salida->set_id_error(400);
                        $salida->set_error("Error creando el usuario");
                        return $salida;
                    }
                }else{
                    $salida = new salida();
                    $salida->set_id_error(400);
                    $salida->set_error("ID de usuario no existente");
                    return $salida;
                }
            }else{
                $salida = new salida();
                $salida->set_id_error(400);
                $salida->set_error("No se ha definido id");
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
     * Operación de la api que elimina un usuario
     *
     * @access public
     * @param array $parametros Parametros obtenidos por la URI y GET
     * @return salida
     */
    function eliminar_usuario($parametros) {
        $id = $parametros["URL"]["3"];

        if(!empty($id)) {
            $user = new \PICAJES\objects\user($id);
            if(!empty($user->get_usuario())) {
                if($user->eliminar()) {
                    $salida = new salida();
                    $salida->set_id_error(200);
                    return $salida;
                }else{
                    $salida = new salida();
                    $salida->set_id_error(500);
                    $salida->set_error("Error eliminando el usuario");
                    return $salida;
                }
            }else{
                $salida = new salida();
                $salida->set_id_error(400);
                $salida->set_error("ID de usuario no existente");
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