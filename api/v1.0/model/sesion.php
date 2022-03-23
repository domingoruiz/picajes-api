<?php
namespace PICAJES\models;

/**
 * Modelo Sesion
 *
 * Este modelo es el encargado de realizar todas las operaciones en BD relacionadas con las sesiones
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Model
 */

class sesionModel {

    /**
     * Constructor del modelo sesión
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
     * @return array
    */
    function get(array $where) {
        return $this->model->get_array(
                  TABLE_sesion,
                  $where
                );
    }

    /**
     * Obtener un query de las sesiones a partir de un where
     *
     * @access public
     * @param array $where
     * @return object
     */
    function get_query(array $where) {
        return $this->model->only_query(
            TABLE_sesion,
            $where
        );
    }
    
    /**
     * Guardamos una nueva sesión en la BD
     *  
     * @access public
     * @param string $user Usuario
     * @param string $puesto Puesto
     * @param string $token_sesion Token sesión
     * @param string $fecha_expiracion Fecha expiración sesión
     * @return boolean
    */
    function guardar($user, string $token_sesion, string $fecha_expiracion) {
        return $this->model->insert(
                TABLE_sesion,
                array(
                    TABLE_sesion_COLUMNA_usuario => $user,
                    TABLE_sesion_COLUMNA_tokensesion => $token_sesion,
                    TABLE_sesion_COLUMNA_fechaexpiracion => $fecha_expiracion
                    )
                );
    }

    /**
     * Actualizamos una sesión en la BD
     *
     * @access public
     * @param string $puesto Puesto
     * @param string $token_sesion Token sesión
     * @param string $fecha_expiracion Fecha expiración sesión
     * @return boolean
     */
    function update(string $token_sesion, string $fecha_expiracion) {
        return $this->model->update(
            TABLE_sesion,
            array(
                TABLE_sesion_COLUMNA_tokensesion => $token_sesion,
                TABLE_sesion_COLUMNA_fechaexpiracion => $fecha_expiracion
            ),
            array(
                TABLE_sesion_COLUMNA_puesto => $puesto
            )
        );
    }

    /**
     * Eliminamos un usuario de la BD
     * 
     * @access public
     * @param int $sesion_id Código de la sesión
     * @return boolean
    */
    function eliminar_sesion(int $sesion_id) {
        $ok[] = $this->model->eliminar(
                TABLE_sesion,
                array(
                    TABLE_sesion_COLUMNA_id => $sesion_id
                     )
                );
        
        if(\PICAJES\helpers\arrays::array_equal($ok)) {
           return TRUE; 
        }else{
           return FALSE; 
        }
    }

    /**
     * Query de todos los puestos que esten inactivos y marcalos como apagado
     *
     * @access public
     * @param $fechaexpiracion
     * @return object
     */
    function get_inactivo($fechaexpiracion) {
        $a = $this->model->query("SELECT * FROM ".TABLE_sesion." WHERE (".TABLE_sesion_COLUMNA_fechaexpiracion."<='".$fechaexpiracion."' AND ".TABLE_sesion_COLUMNA_usuario." = 0)");
        $b = $this->model->query("UPDATE ".TABLE_sesion." SET `".TABLE_sesion_COLUMNA_fechaexpiracion."` = NULL WHERE (`".TABLE_sesion_COLUMNA_fechaexpiracion."`<='".$fechaexpiracion."' AND ".TABLE_sesion_COLUMNA_usuario." = 0)");

        if($a && $b) {
            return $a;
        }else{
            return FALSE;
        }
    }

    /**
     * Destructor del modelo grupo
     *
     * @access public
     * @return boolean
     */
    function __destruct() {
        return TRUE;
    }
}