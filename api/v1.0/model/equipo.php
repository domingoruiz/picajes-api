<?php
namespace PICAJES\models;

/**
 * Modelo equipo
 *
 * Este modelo es el encargado de realizar todas las operaciones en BD relacionadas con las equipos
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Model
 */


class equipoModel {

    /**
     * Constructor del modelo equipo
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
                  TABLE_equipos, 
                  $where
                );
    }
    
    /**
     * Guardamos un nueva equipo en la BD
     *  
     * @access public
     * @param string $nombre Nombre des equipo
     * @param int $empresa ID de la empresa
     * @return boolean
    */
    function guardar(string $nombre, int $empresa) {
        return $this->model->insert(
                TABLE_equipos, 
                array(
                    TABLE_equipos_COLUMNA_nombre => $nombre, 
                    TABLE_equipos_COLUMNA_empresa => $empresa
                    )
                );
    }

    /**
     * Funcion para actualizar un equipo en la BD
     *
     * @access public
     * @param int $equipo_id
     * @param string $equiponame
     * @param int $empresa
     * @return boolean
     */
    function update(int $equipo_id, string $nombre, int $empresa) {
        return $this->model->update(
                TABLE_equipos, 
                array(
                    TABLE_equipos_COLUMNA_nombre => $nombre, 
                    TABLE_equipos_COLUMNA_empresa => $empresa
                     ),
                array(
                    TABLE_equipos_COLUMNA_id => $equipo_id
                     )
                );
    }
    
    /**
     * Eliminamos un equipo de la BD
     * 
     * @access public
     * @param int $equipo_id Código del equipo
     * @return boolean
    */
    function eliminar_equipo(int $equipo_id) {
        $ok[] = $this->model->eliminar(
                TABLE_equipos,
                array(
                    TABLE_equipos_COLUMNA_id => $equipo_id
                     )
                );
        
        if(\PICAJES\helpers\arrays::array_equal($ok)) {
           return TRUE; 
        }else{
           return FALSE; 
        }
    }

     /**
     * Obtenemos un query de todos los equipos
     *
     * @access public
     * @return object
     */
    function get_todos() {
        return $this->model->only_query(TABLE_equipos);
    }

    /**
     * Destructor del modelo equipo
     *
     * @access public
     * @return boolean
     */
    function __destruct() {
        return TRUE;
    }
}