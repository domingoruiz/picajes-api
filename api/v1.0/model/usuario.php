<?php
namespace PICAJES\models;

/**
 * Modelo User
 *
 * Este modelo es el encargado de realizar todas las operaciones en BD relacionadas con los users
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Model
 */


class userModel {

    /**
     * Constructor del modelo user
     *
     * @access public
     * @return boolean
     */
    function  __construct() {
        $this->model = $GLOBALS["model"];
        return TRUE;
    }
    
    /**
     * Obtener un array de un registro a partir de un where
     * 
     * @access public
     * @param array $where 
     * @return object
    */
    function get(array $where) {
        return $this->model->get_array(
                  TABLE_usuario, 
                  $where
                );
    }
    
    /**
     * Guardamos un nuevo usuario en la BD
     *  
     * @access public
     * @param string $username Usuario
     * @param string $password Contraseña (en MD5)
     * @param string $nombre Nombre del usuario
     * @param string $email Email del usuario
     * @return boolean
    */
    function guardar(string $username, string $password, string $nombre, string $email) {
        return $this->model->insert(
                TABLE_usuario, 
                array(
                    TABLE_usuario_COLUMNA_usuario => $username, 
                    TABLE_usuario_COLUMNA_contrasenia => $password, 
                    TABLE_usuario_COLUMNA_nombre => $nombre,
                    TABLE_usuario_COLUMNA_email => $email
                    )
                );
    }

    /**
     * Funcion para actualizar un usuario en la BD
     *
     * @access public
     * @param int $user_id
     * @param string $username
     * @param string $password
     * @param string $nombre
     * @param string $email
     * @return boolean
     */
    function update(int $user_id, string $username, string $password, string $nombre, string $email) {
        return $this->model->update(
                TABLE_usuario, 
                array(
                    TABLE_usuario_COLUMNA_usuario => $username, 
                    TABLE_usuario_COLUMNA_contrasenia => $password, 
                    TABLE_usuario_COLUMNA_nombre => $nombre,
                    TABLE_usuario_COLUMNA_email => $email
                     ),
                array(
                    TABLE_usuario_COLUMNA_id => $user_id
                     )
                );
    }
    
    /**
     * Eliminamos un usuario de la BD
     * 
     * @access public
     * @param int $usuario_id Código del usuario
     * @return boolean
    */
    function eliminar_user(int $usuario_id) {
        $ok[] = $this->model->eliminar(
                TABLE_usuario,
                array(
                    TABLE_usuario_COLUMNA_id => $usuario_id
                     )
                );
        
        if(\PICAJES\helpers\arrays::array_equal($ok)) {
           return TRUE; 
        }else{
           return FALSE; 
        }
    }

    /**
     * Destructor del modelo user
     *
     * @access public
     * @return boolean
     */
    function __destruct() {
        return TRUE;
    }
}