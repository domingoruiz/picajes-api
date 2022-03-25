<?php
namespace PICAJES\models;

/**
 * Modelo Empresa
 *
 * Este modelo es el encargado de realizar todas las operaciones en BD relacionadas con las empresas
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Model
 */


class empresaModel {

    /**
     * Constructor del modelo empresa
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
                  TABLE_empresas, 
                  $where
                );
    }
    
    /**
     * Guardamos un nueva empresa en la BD
     *  
     * @access public
     * @param string $nombre Nombre de la empresa
     * @param string $nif NIF de la empresa
     * @param string $direccion Dirección de la empresa
     * @param string $telefono Telefono
     * @param string $email Correo electrónico de la empresa
     * @return boolean
    */
    function guardar(string $nombre, string $nif, string $direccion, string $telefono, string $email) {
        return $this->model->insert(
                TABLE_empresas, 
                array(
                    TABLE_empresas_COLUMNA_nombre => $nombre, 
                    TABLE_empresas_COLUMNA_nif => $nif, 
                    TABLE_empresas_COLUMNA_direccion => $direccion,
                    TABLE_empresas_COLUMNA_telefono => $telefono,
                    TABLE_empresas_COLUMNA_email => $email
                    )
                );
    }

    /**
     * Funcion para actualizar un empresa en la BD
     *
     * @access public
     * @param int $empresa_id
     * @param string $empresaname
     * @param string $password
     * @param string $nombre
     * @param string $email
     * @param string $telefono
     * @param int $empresa
     * @param int $equipo
     * @return boolean
     */
    function update(int $empresa_id, string $nombre, string $nif, string $direccion, string $telefono, string $email) {
        return $this->model->update(
                TABLE_empresas, 
                array(
                    TABLE_empresas_COLUMNA_nombre => $nombre, 
                    TABLE_empresas_COLUMNA_nif => $nif, 
                    TABLE_empresas_COLUMNA_direccion => $direccion,
                    TABLE_empresas_COLUMNA_telefono => $telefono,
                    TABLE_empresas_COLUMNA_email => $email
                     ),
                array(
                    TABLE_empresas_COLUMNA_id => $empresa_id
                     )
                );
    }
    
    /**
     * Eliminamos un empresa de la BD
     * 
     * @access public
     * @param int $empresa_id Código del empresa
     * @return boolean
    */
    function eliminar_empresa(int $empresa_id) {
        $ok[] = $this->model->eliminar(
                TABLE_empresas,
                array(
                    TABLE_empresas_COLUMNA_id => $empresa_id
                     )
                );
        
        if(\PICAJES\helpers\arrays::array_equal($ok)) {
           return TRUE; 
        }else{
           return FALSE; 
        }
    }

     /**
     * Obtenemos un query de todos los empresas
     *
     * @access public
     * @return object
     */
    function get_todos() {
        return $this->model->only_query(TABLE_empresas);
    }

    /**
     * Destructor del modelo empresa
     *
     * @access public
     * @return boolean
     */
    function __destruct() {
        return TRUE;
    }
}