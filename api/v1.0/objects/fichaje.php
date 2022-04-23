<?php
namespace PICAJES\objects;

/**
 * Objeto fichaje
 *
 * Este objeto representa una fichaje y permite realizar operaciones sobre este
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Object
 */

class fichaje {

    /**
     * ID del fichaje
     * @var int
     * @access public
     */
    public $fichaje_id;

    /**
     * Usuario del fichaje
     * @var int
     * @access public
     */
    public $usuario;

    /**
     * Equipo del fichaje
     * @var int
     * @access public
     */
    public $equipo;

    /**
     * Empresa del fichaje
     * @var int
     * @access public
     */
    public $empresa;

    /**
     * Hora de inicio del fichaje
     * @var time
     * @access public
     */
    public $hor_ini;

    /**
     * Hora de fin del fichaje
     * @var time
     * @access public
     */
    public $hor_fin;

    /**
     * Tiempo trabajado
     * @var time
     * @access public
     */
    public $tim_trb;

    /**
     * Tiempo descanso
     * @var time
     * @access public
     */
    public $tim_dsc;

    /**
     * Tiempo total
     * @var time
     * @access public
     */
    public $tim_tot;

    /**
     * Minutos trabajados
     * @var int
     * @access public
     */
    public $min_trb;

    /**
     * Minutos descansados
     * @var int
     * @access public
     */
    public $min_dsc;

    /**
     * Minutos totales
     * @var int
     * @access public
     */
    public $min_tot;

    /**
     * Iniciamos el objeto fichaje con la posibilidad de aportar un codigó para que se establezcan todas las variables
     * 
     * @access public
     * @param int $fichaje_id
     * @return boolean
    */
    function  __construct($fichaje_id=NULL) {
        $this->model = new \PICAJES\models\fichajeModel;
        $this->establish = 0;
        
        if(!empty($fichaje_id)) {
           $this->set_id($fichaje_id);
           $this->establish();
        }

        return TRUE;
    }
    
    /**
     * Establecemos el código
     * 
     * @access public
     * @param int $fichaje_id
     * @return boolean
    */
    public function set_id($fichaje_id) {
        if($this->fichaje_id = (int) $fichaje_id) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos el código
     * 
     * @access public
     * @return int
    */
    public function get_id() {
        return $this->fichaje_id;
    }

    /**
     * Establecemos el usuario
     * 
     * @access public
     * @param int $usuario 
     * @return boolean
    */
    public function set_usuario($usuario) {
        if($this->usuario = (int) $usuario) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos la usuario
     * 
     * @access public
     * @return int
    */
    public function get_usuario() {
        return $this->usuario;
    }

    /**
     * Establecemos el equipo
     * 
     * @access public
     * @param int $equipo 
     * @return boolean
    */
    public function set_equipo($equipo) {
        if($this->equipo = (int) $equipo) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos la equipo
     * 
     * @access public
     * @return int
    */
    public function get_equipo() {
        return $this->equipo;
    }
    
    /**
     * Establecemos la empresa
     * 
     * @access public
     * @param int $empresa 
     * @return boolean
    */
    public function set_empresa($empresa) {
        if($this->empresa = (string) $empresa) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos la empresa
     * 
     * @access public
     * @return int
    */
    public function get_empresa() {
        return $this->empresa;
    }

    /**
     * Establecemos la hora de inicio
     * 
     * @access public
     * @param time $hor_ini 
     * @return boolean
    */
    public function set_hor_ini($hor_ini) {
        if($this->hor_ini = $hor_ini) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos la hora de inicio
     * 
     * @access public
     * @return time
    */
    public function get_hor_ini() {
        return $this->hor_ini;
    }

    /**
     * Establecemos la hora de fin
     * 
     * @access public
     * @param time $hor_fin
     * @return boolean
    */
    public function set_hor_fin($hor_fin) {
        if($this->hor_fin = $hor_fin) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos la hora de fin
     * 
     * @access public
     * @return time
    */
    public function get_hor_fin() {
        return $this->hor_fin;
    }

    /**
     * Establecemos el tiempo trabajado
     * 
     * @access public
     * @param time $tim_trb
     * @return boolean
    */
    public function set_tim_trb($tim_trb) {
        if($this->tim_trb = $tim_trb) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos el tiempo trabajado
     * 
     * @access public
     * @return time
    */
    public function get_tim_trb() {
        return $this->tim_trb;
    }

    /**
     * Establecemos el tiempo descansando
     * 
     * @access public
     * @param time $tim_dsc
     * @return boolean
    */
    public function set_tim_dsc($tim_dsc) {
        if($this->tim_dsc = $tim_dsc) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos el tiempo descansando
     * 
     * @access public
     * @return time
    */
    public function get_tim_dsc() {
        return $this->tim_dsc;
    }

    /**
     * Establecemos el tiempo total
     * 
     * @access public
     * @param time $tim_tot
     * @return boolean
    */
    public function set_tim_tot($tim_tot) {
        if($this->tim_tot = $tim_tot) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos el tiempo total
     * 
     * @access public
     * @return time
    */
    public function get_tim_tot() {
        return $this->tim_tot;
    }

    /**
     * Establecemos los minutos trabajados
     * 
     * @access public
     * @param int $min_trb
     * @return boolean
    */
    public function set_min_trb($min_trb) {
        if($this->min_trb = $min_trb) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos los minutos trabajados
     * 
     * @access public
     * @return int
    */
    public function get_min_trb() {
        return $this->min_trb;
    }

    /**
     * Establecemos los minutos descansados
     * 
     * @access public
     * @param int $min_dsc
     * @return boolean
    */
    public function set_min_dsc($min_dsc) {
        if($this->min_dsc = $min_dsc) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos los minutos descansados
     * 
     * @access public
     * @return int
    */
    public function get_min_dsc() {
        return $this->min_dsc;
    }

    /**
     * Establecemos los minutos totales
     * 
     * @access public
     * @param int $min_tot
     * @return boolean
    */
    public function set_min_tot($min_tot) {
        if($this->min_tot = $min_tot) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos los minutos totales
     * 
     * @access public
     * @return int
    */
    public function get_min_tot() {
        return $this->min_tot;
    }

    /**
     * Establecemos el estado
     * 
     * @access public
     * @param int $estado
     * @return boolean
    */
    public function set_estado($estado) {
        if($this->estado = $estado) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos el estado
     * 
     * @access public
     * @return int
    */
    public function get_estado() {
        return $this->estado;
    }

    /**
     * Con esta función configuramos todas las variables del objeto
     * 
     * @access public
     * @param string $forma Forma de la que se van a obtener los registros (a partir de id o fichaje)
     * @return boolean
    */
    public function establish($forma="id") {
        if($forma=="id" && !empty($this->get_id())) {
           $where=array("id" => $this->get_id());
        }elseif($forma=="usr_fch" && !empty($this->get_usuario())) {
            $where=array("usuario" => $this->get_usuario(), "fecha" => date_create("Y-m-d"));
        }
        
        if(!empty($where)) {
            $data = $this->model->get($where);
            
            if($data) {
                $this->set_id($data[TABLE_fichajes_COLUMNA_id]);
                $this->set_usuario($data[TABLE_fichajes_COLUMNA_usuario]);
                $this->set_equipo($data[TABLE_fichajes_COLUMNA_equipo]);
                $this->set_empresa($data[TABLE_fichajes_COLUMNA_empresa]);
                $this->set_hor_ini($data[TABLE_fichajes_COLUMNA_hor_ini]);
                $this->set_hor_fin($data[TABLE_fichajes_COLUMNA_hor_fin]);
                $this->set_tim_trb($data[TABLE_fichajes_COLUMNA_tim_trb]);
                $this->set_tim_dsc($data[TABLE_fichajes_COLUMNA_tim_dsc]);
                $this->set_tim_tot($data[TABLE_fichajes_COLUMNA_tim_tot]);
                $this->set_min_trb($data[TABLE_fichajes_COLUMNA_min_trb]);
                $this->set_min_dsc($data[TABLE_fichajes_COLUMNA_min_dsc]);
                $this->set_min_tot($data[TABLE_fichajes_COLUMNA_min_tot]);
                $this->set_estado($data[TABLE_fichajes_COLUMNA_estado]);
              
                $this->establish = 1;
                return TRUE;
            }else{
              $this->establish = 0;
              return FALSE;  
            }
        }else{
            return FALSE;
        }
    }
    
    /**
     * Función para guardar un nuevo fichaje
     * 
     * @access public
     * @return boolean
    */
    public function create() {
        if(!empty($this->get_usuario()) &&
           !empty($this->get_equipo()) &&
           !empty($this->get_empresa())) {
            //Guardamos el fichaje en la BD
            $ok[] = $this->model->guardar(
                        $this->get_usuario(),
                        $this->get_equipo(),
                        $this->get_empresa(),
                        $this->get_hor_ini(),
                        $this->get_hor_fin(),
                        $this->get_tim_trb(),
                        $this->get_tim_dsc(),
                        $this->get_tim_tot(),
                        $this->get_min_trb(),
                        $this->get_min_dsc(),
                        $this->get_min_tot(),
                        $this->get_estado()
                      );

            if(\PICAJES\helpers\arrays::array_equal($ok)) {
                $this->set_id($this->model->model->insert_id());
                $this->establish();

                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }
    
    /**
     * Función para eliminar un fichaje
     * 
     * @access public
     * @return boolean
    */
    public function eliminar() {
        if(!empty($this->get_id())) {
           return $this->model->eliminar_fichaje($this->get_id());
        }else{
           return FALSE;
        }
    }
    
    /**
     * Función para actualizar un fichaje
     * 
     * (Imprescindible que se haya definido en el objeto id)
     * 
     * @access public
     * @return boolean
    */
    public function update() {
        if(!empty($this->get_id())) {
           return $this->model->update(
                $this->get_id(), 
                $this->get_usuario(),
                $this->get_equipo(),
                $this->get_empresa(),
                $this->get_hor_ini(),
                $this->get_hor_fin(),
                $this->get_tim_trb(),
                $this->get_tim_dsc(),
                $this->get_tim_tot(),
                $this->get_min_trb(),
                $this->get_min_dsc(),
                $this->get_min_tot(),
                $this->get_estado()
            );
        }else{
            return FALSE;
        }
    }

    /**
     * Esta función completa todos los tiempos a partir de los logs
     * 
     * (Imprescindible que se haya definido en el objeto id)
     * 
     * @access public
     * @return boolean
    */
    public function actualizar_tiempos() {
        if(!empty($this->get_id())) {
            $logs = \PICAJES\objects\log::todos_logs($this->get_id());
            $hor_ini = 0;
            $hor_fin = 0;
            $tim_trb = 0;
            $tim_dsc = 0;

            $logs_array = array();
            foreach($logs as $log) {
                if($log->get_tipomovimiento() == 1) {
                    $hor_ini = date_format(date_create($log->get_altdate()), "H:i:s");
                    if($hor_fin!=0) {
                        $tim_dsc = $tim_dsc + \PICAJES\helpers\date::separar_hora($hor_ini)-\PICAJES\helpers\date::separar_hora($hor_fin);
                    }
                }elseif($log->get_tipomovimiento() == 2) {
                    $hor_fin = date_format(date_create($log->get_altdate()), "H:i:s");
                    
                    $tim_trb = $tim_trb + \PICAJES\helpers\date::separar_hora($hor_fin)-\PICAJES\helpers\date::separar_hora($hor_ini);
                }
            }

            $this->set_tim_trb(\PICAJES\helpers\date::unir_hora($tim_trb));
            $this->set_tim_dsc(\PICAJES\helpers\date::unir_hora($tim_dsc));
            $this->set_tim_tot(\PICAJES\helpers\date::unir_hora($tim_dsc+$tim_trb));
            $this->set_min_trb($tim_trb/60);
            $this->set_min_dsc($tim_dsc/60);
            $this->set_min_tot(($tim_dsc+$tim_trb)/60);
            $this->update();
        }else{
            return FALSE;
        }
    }
    
    /**
     * Función para generar un array con toda la información de un fichaje
     * 
     * @static
     * @access public
     * @param int $fichaje_id Código del fichaje
     * @return fichaje|FALSE
    */
    static function get_fichaje($fichaje_id) {
        if(!empty($fichaje_id)) {
            $model = new \PICAJES\models\fichajeModel();

            $fichaje = new \PICAJES\objects\fichaje();
            $fichaje->set_id($fichaje_id);
            if($fichaje->establish()) {
                return $fichaje;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    /**
     * Función para generar un array de objetos de todos los fichajes de PICAJES
     *
     * @static
     * @access public
     * @return array
     */
    static function todos_fichajes() {
        $model = new \PICAJES\models\fichajeModel();

        $return = array();
        $fichajes_todos = $model->get_todos($GLOBALS['empresa_id']);

        while ($fichaje = $fichajes_todos->fetch_array()) {
            $return[] = new \PICAJES\objects\fichaje($fichaje[TABLE_fichajes_COLUMNA_id]);
        }

        return $return;
    }
}