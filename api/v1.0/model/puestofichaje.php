<?php
namespace PICAJES\models;

/**
 * Modelo puestofichaje
 *
 * Este modelo es el encargado de realizar todas las operaciones en BD relacionadas con las puestofichajes
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Model
 */


class puestofichajeModel {

    /**
     * Constructor del modelo puestofichaje
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
                  TABLE_puestofichajes, 
                  $where
                );
    }
    
    /**
     * Guardamos un nueva puestofichaje en la BD
     *  
     * @access public
     * @param string $nombre Nombre des puestofichaje
     * @param int $zona ID de la zona
     * @return boolean
    */
    function guardar(string $nombre, int $zona, int $empresa) {
        return $this->model->insert(
                TABLE_puestofichajes, 
                array(
                    TABLE_puestofichajes_COLUMNA_nombre => $nombre, 
                    TABLE_puestofichajes_COLUMNA_zona => $zona, 
                    TABLE_puestofichajes_COLUMNA_empresa => $empresa
                    )
                );
    }

    /**
     * Funcion para actualizar un puestofichaje en la BD
     *
     * @access public
     * @param int $puestofichaje_id
     * @param string $nombre
     * @param int $zona
     * @return boolean
     */
    function update(int $puestofichaje_id, string $nombre, int $zona) {
        return $this->model->update(
                TABLE_puestofichajes, 
                array(
                    TABLE_puestofichajes_COLUMNA_nombre => $nombre, 
                    TABLE_puestofichajes_COLUMNA_zona => $zona
                     ),
                array(
                    TABLE_puestofichajes_COLUMNA_id => $puestofichaje_id
                     )
                );
    }
    
    /**
     * Eliminamos un puestofichaje de la BD
     * 
     * @access public
     * @param int $puestofichaje_id Código del puestofichaje
     * @return boolean
    */
    function eliminar_puestofichaje(int $puestofichaje_id) {
        $ok[] = $this->model->eliminar(
                TABLE_puestofichajes,
                array(
                    TABLE_puestofichajes_COLUMNA_id => $puestofichaje_id
                     )
                );
        
        if(\PICAJES\helpers\arrays::array_equal($ok)) {
           return TRUE; 
        }else{
           return FALSE; 
        }
    }

     /**
     * Obtenemos un query de todos los puestofichajes
     *
     * @access public
     * @return object
     */
    function get_todos($empresa = null) {
        return $this->model->only_query(TABLE_puestofichajes, array("empresa" => $empresa));
    }

    /**
     * Destructor del modelo puestofichaje
     *
     * @access public
     * @return boolean
     */
    function __destruct() {
        return TRUE;
    }
}