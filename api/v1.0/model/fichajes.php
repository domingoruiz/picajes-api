<?php
namespace PICAJES\models;

/**
 * Modelo fichajes
 *
 * Este modelo es el encargado de realizar todas las operaciones en BD relacionadas con las fichajes
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Model
 */


class fichajeModel {

    /**
     * Constructor del modelo fichaje
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
                  TABLE_fichajes, 
                  $where
                );
    }
    
    /**
     * Guardamos un nueva fichaje en la BD
     *  
     * @access public
     * @param int $usuario ID del usuario
     * @param int $equipo ID del equipo
     * @param int $empresa ID de la empresa
     * @param time $hor_ini Hora de inicio de la jornada
     * @param time $hor_fin Hora de fin de la jornada
     * @param time $tim_trb Tiempo trabajado
     * @param time $tim_dsc Tiempo descanso
     * @param time $tim_tot Tiempo total
     * @param int $min_trb Minutos trabajado
     * @param int $min_dsc Minutos descanso
     * @param int $min_tot Minutos total
     * @param int $estado Estado
     * @return boolean
    */
    function guardar(int $usuario, int $equipo, int $empresa, $hor_ini, $hor_fin, $tim_trb, $tim_dsc, $tim_tot, $min_trb, $min_dsc, $min_tot, $estado) {
        return $this->model->insert(
                TABLE_fichajes, 
                array(
                    TABLE_fichajes_COLUMNA_usuario => $usuario,
                    TABLE_fichajes_COLUMNA_equipo => $equipo,
                    TABLE_fichajes_COLUMNA_empresa => $empresa,
                    TABLE_fichajes_COLUMNA_hor_ini => $hor_ini,
                    TABLE_fichajes_COLUMNA_hor_fin => $hor_fin,
                    TABLE_fichajes_COLUMNA_tim_trb => $tim_trb,
                    TABLE_fichajes_COLUMNA_tim_dsc => $tim_dsc,
                    TABLE_fichajes_COLUMNA_tim_tot => $tim_tot,
                    TABLE_fichajes_COLUMNA_min_trb => $min_trb,
                    TABLE_fichajes_COLUMNA_min_dsc => $min_dsc,
                    TABLE_fichajes_COLUMNA_min_tot => $min_tot,
                    TABLE_fichajes_COLUMNA_estado => $estado
                    )
                );
    }

    /**
     * Funcion para actualizar un fichaje en la BD
     *
     * @access public
     * @param int $fichaje_id
     * @param int $usuario ID del usuario
     * @param int $equipo ID del equipo
     * @param int $empresa ID de la empresa
     * @param time $hor_ini Hora de inicio de la jornada
     * @param time $hor_fin Hora de fin de la jornada
     * @param time $tim_trb Tiempo trabajado
     * @param time $tim_dsc Tiempo descanso
     * @param time $tim_tot Tiempo total
     * @param int $min_trb Minutos trabajado
     * @param int $min_dsc Minutos descanso
     * @param int $min_tot Minutos total
     * @param int $estado Estado
     * @return boolean
     */
    function update(int $fichaje_id, int $usuario, int $equipo, int $empresa, $hor_ini, $hor_fin, $tim_trb, $tim_dsc, $tim_tot, $min_trb, $min_dsc, $min_tot, $estado) {
        return $this->model->update(
                TABLE_fichajes, 
                array(
                    TABLE_fichajes_COLUMNA_usuario => $usuario,
                    TABLE_fichajes_COLUMNA_equipo => $equipo,
                    TABLE_fichajes_COLUMNA_empresa => $empresa,
                    TABLE_fichajes_COLUMNA_hor_ini => $hor_ini,
                    TABLE_fichajes_COLUMNA_hor_fin => $hor_fin,
                    TABLE_fichajes_COLUMNA_tim_trb => $tim_trb,
                    TABLE_fichajes_COLUMNA_tim_dsc => $tim_dsc,
                    TABLE_fichajes_COLUMNA_tim_tot => $tim_tot,
                    TABLE_fichajes_COLUMNA_min_trb => $min_trb,
                    TABLE_fichajes_COLUMNA_min_dsc => $min_dsc,
                    TABLE_fichajes_COLUMNA_min_tot => $min_tot,
                    TABLE_fichajes_COLUMNA_estado => $estado
                     ),
                array(
                    TABLE_fichajes_COLUMNA_id => $fichaje_id
                     )
                );
    }
    
    /**
     * Eliminamos un fichaje de la BD
     * 
     * @access public
     * @param int $fichaje_id Código del fichaje
     * @return boolean
    */
    function eliminar_fichaje(int $fichaje_id) {
        $ok[] = $this->model->eliminar(
                TABLE_fichajes,
                array(
                    TABLE_fichajes_COLUMNA_id => $fichaje_id
                     )
                );
        
        if(\PICAJES\helpers\arrays::array_equal($ok)) {
           return TRUE; 
        }else{
           return FALSE; 
        }
    }

     /**
     * Obtenemos un query de todos los fichajes
     *
     * @access public
     * @return object
     */
    function get_todos($empresa, $fch_ini, $fch_fin, $equipo, $usuario, $estado) {
        $equipo = ($equipo > 0) ? " AND  ".TABLE_fichajes_COLUMNA_equipo." = '".$equipo."'" : '';
        $usuario = ($usuario > 0) ? " AND  ".TABLE_fichajes_COLUMNA_usuario." = '".$usuario."'" : '';
        $estado = ($estado > 0) ? " AND  ".TABLE_fichajes_COLUMNA_estado." = '".$estado."'" : '';

        $query = "
            SELECT * 
            FROM ".TABLE_fichajes." 
            WHERE ".TABLE_fichajes_COLUMNA_empresa." = '".$empresa."' 
            AND ".TABLE_fichajes_COLUMNA_fch." >= '".$fch_ini."' 
            AND ".TABLE_fichajes_COLUMNA_fch." <= '".$fch_fin."'
            ".$equipo."
            ".$usuario."
            ".$estado."
        ";
        return $this->model->query($query);
    }

    /**
     * Destructor del modelo fichaje
     *
     * @access public
     * @return boolean
     */
    function __destruct() {
        return TRUE;
    }
}