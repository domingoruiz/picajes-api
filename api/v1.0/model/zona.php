<?php
namespace PICAJES\models;

/**
 * Modelo zona
 *
 * Este modelo es el encargado de realizar todas las operaciones en BD relacionadas con las zonas
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Model
 */


class zonaModel {

    /**
     * Constructor del modelo zona
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
                  TABLE_zonas, 
                  $where
                );
    }
    
    /**
     * Guardamos un nueva zona en la BD
     *  
     * @access public
     * @param string $nombre Nombre des zona
     * @param int $empresa ID de la empresa
     * @return boolean
    */
    function guardar(string $nombre, int $empresa) {
        return $this->model->insert(
                TABLE_zonas, 
                array(
                    TABLE_zonas_COLUMNA_nombre => $nombre, 
                    TABLE_zonas_COLUMNA_empresa => $empresa
                    )
                );
    }

    /**
     * Funcion para actualizar un zona en la BD
     *
     * @access public
     * @param int $zona_id
     * @param string $zonaname
     * @param int $empresa
     * @return boolean
     */
    function update(int $zona_id, string $nombre, int $empresa) {
        return $this->model->update(
                TABLE_zonas, 
                array(
                    TABLE_zonas_COLUMNA_nombre => $nombre, 
                    TABLE_zonas_COLUMNA_empresa => $empresa
                     ),
                array(
                    TABLE_zonas_COLUMNA_id => $zona_id
                     )
                );
    }
    
    /**
     * Eliminamos un zona de la BD
     * 
     * @access public
     * @param int $zona_id Código del zona
     * @return boolean
    */
    function eliminar_zona(int $zona_id) {
        $ok[] = $this->model->eliminar(
                TABLE_zonas,
                array(
                    TABLE_zonas_COLUMNA_id => $zona_id
                     )
                );
        
        if(\PICAJES\helpers\arrays::array_equal($ok)) {
           return TRUE; 
        }else{
           return FALSE; 
        }
    }

     /**
     * Obtenemos un query de todos los zonas
     *
     * @access public
     * @return object
     */
    function get_todos() {
        return $this->model->only_query(TABLE_zonas);
    }

    /**
     * Destructor del modelo zona
     *
     * @access public
     * @return boolean
     */
    function __destruct() {
        return TRUE;
    }
}