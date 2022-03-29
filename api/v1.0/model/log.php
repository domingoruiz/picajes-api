<?php
namespace PICAJES\models;

/**
 * Modelo log
 *
 * Este modelo es el encargado de realizar todas las operaciones en BD relacionadas con las logs
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Model
 */


class logModel {

    /**
     * Constructor del modelo log
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
                  TABLE_logs, 
                  $where
                );
    }
    
    /**
     * Guardamos un nueva log en la BD
     *  
     * @access public
     * @param int $usuario Usuario
     * @param int $puesto_fichaje Puesto de fichaje
     * @param int $tipo_movimiento Tipo de movimiento
     * @return boolean
    */
    function guardar(int $usuario, int $puesto_fichaje, int $tipo_movimiento) {
        return $this->model->insert(
                TABLE_logs, 
                array(
                    TABLE_logs_COLUMNA_usuario => $usuario, 
                    TABLE_logs_COLUMNA_puestofichaje => $puesto_fichaje,
                    TABLE_logs_COLUMNA_tipomovimiento => $tipo_movimiento
                    )
                );
    }

    /**
     * Funcion para actualizar un log en la BD
     *
     * @access public
     * @param int $log_id
     * @param int $usuario Usuario
     * @param int $puesto_fichaje Puesto de fichaje
     * @param int $tipo_movimiento Tipo de movimiento
     * @return boolean
     */
    function update(int $log_id, int $usuario, int $puesto_fichaje, int $tipo_movimiento) {
        return $this->model->update(
                TABLE_logs, 
                array(
                    TABLE_logs_COLUMNA_usuario => $usuario, 
                    TABLE_logs_COLUMNA_puestofichaje => $puesto_fichaje,
                    TABLE_logs_COLUMNA_tipomovimiento => $tipo_movimiento
                     ),
                array(
                    TABLE_logs_COLUMNA_id => $log_id
                     )
                );
    }
    
    /**
     * Eliminamos un log de la BD
     * 
     * @access public
     * @param int $log_id Código del log
     * @return boolean
    */
    function eliminar_log(int $log_id) {
        $ok[] = $this->model->eliminar(
                TABLE_logs,
                array(
                    TABLE_logs_COLUMNA_id => $log_id
                     )
                );
        
        if(\PICAJES\helpers\arrays::array_equal($ok)) {
           return TRUE; 
        }else{
           return FALSE; 
        }
    }

     /**
     * Obtenemos un query de todos los logs
     *
     * @access public
     * @return object
     */
    function get_todos() {
        return $this->model->only_query(TABLE_logs);
    }

    /**
     * Destructor del modelo log
     *
     * @access public
     * @return boolean
     */
    function __destruct() {
        return TRUE;
    }
}