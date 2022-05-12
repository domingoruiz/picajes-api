<?php
namespace PICAJES\objects;

/**
 * Objeto log
 *
 * Este objeto representa una log y permite realizar operaciones sobre este
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Object
 */

class log {

    /**
     * ID del log
     * @var int
     * @access public
     */
    public $log_id;

    /**
     * Usuario del log
     * @var int
     * @access public
     */
    public $usuario;

    /**
     * Puestofichaje del log
     * @var int
     * @access public
     */
    public $puesto_fichaje;

    /**
     * Tipo movimiento del log
     * @var int
     * @access public
     */
    public $tipo_movimiento;

    /**
     * Fecha de alta del log
     * @var int
     * @access public
     */
    public $alt_date;

    /**
     * Empresa de la sesión
     * @var int
     * @access public
     */
    public $empresa;

    /**
     * Iniciamos el objeto log con la posibilidad de aportar un codigó para que se establezcan todas las variables
     * 
     * @access public
     * @param int $log_id
     * @return boolean
    */
    function  __construct($log_id=NULL) {
        $this->model = new \PICAJES\models\logModel;
        $this->establish = 0;
        
        if(!empty($log_id)) {
           $this->set_id($log_id);
           $this->establish();
        }

        return TRUE;
    }
    
    /**
     * Establecemos el código
     * 
     * @access public
     * @param int $log_id
     * @return boolean
    */
    public function set_id($log_id) {
        if($this->log_id = (int) $log_id) {
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
        return $this->log_id;
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
     * Obtenemos el usuario
     * 
     * @access public
     * @return int
    */
    public function get_usuario() {
        return $this->usuario;
    }
    
    /**
     * Establecemos el puesto de fichaje
     * 
     * @access public
     * @param int $puesto_fichaje 
     * @return boolean
    */
    public function set_puestofichaje($puesto_fichaje) {
        if($this->puesto_fichaje = (int) $puesto_fichaje) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos la puesto_fichaje
     * 
     * @access public
     * @return int
    */
    public function get_puestofichaje() {
        return $this->puesto_fichaje;
    }

    /**
     * Establecemos el tipo movimiento
     * 
     * @access public
     * @param int $puesto_fichaje 
     * @return boolean
    */
    public function set_tipomovimiento($tipo_movimiento) {
        if($this->tipo_movimiento = (int) $tipo_movimiento) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos la tipo_movimiento
     * 
     * @access public
     * @return int
    */
    public function get_tipomovimiento() {
        return $this->tipo_movimiento;
    }

    /**
     * Establecemos la fecha de alta del log
     * 
     * @access public
     * @param date $puesto_fichaje 
     * @return boolean
    */
    public function set_altdate($altdate) {
        if($this->alt_date = $altdate) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos la fecha de alta del log
     * 
     * @access public
     * @return date
    */
    public function get_altdate() {
        return $this->alt_date;
    }

    /**
     * Establecemos el id de la empresa
     * 
     * @access public
     * @param int $empresa
     * @return boolean
    */
    public function set_empresa($empresa) {
        if($this->empresa = (int) $empresa) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos el id de la empresa
     * 
     * @access public
     * @return int
    */
    public function get_empresa() {
        return $this->empresa;
    }

    /**
     * Establecemos el id del fichaje
     * 
     * @access public
     * @param int $fichaje
     * @return boolean
    */
    public function set_fichaje($fichaje) {
        if($this->fichaje = (int) $fichaje) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos el id del fichaje
     * 
     * @access public
     * @return int
    */
    public function get_fichaje() {
        return $this->fichaje;
    }

    /**
     * Con esta función configuramos todas las variables del objeto
     * 
     * @access public
     * @param string $forma Forma de la que se van a obtener los registros (a partir de id o log)
     * @return boolean
    */
    public function establish($forma="id") {
        if($forma=="id" && !empty($this->get_id())) {
           $where=array("id" => $this->get_id());
        }
        
        if(!empty($where)) {
            $data = $this->model->get($where);
            
            if($data) {
              $this->set_id($data[TABLE_logs_COLUMNA_id]);
              $this->set_puestofichaje($data[TABLE_logs_COLUMNA_puestofichaje]);
              $this->set_usuario($data[TABLE_logs_COLUMNA_usuario]);
              $this->set_tipomovimiento($data[TABLE_logs_COLUMNA_tipomovimiento]);
              $this->set_altdate($data[TABLE_logs_COLUMNA_altdate]);
              $this->set_empresa($data[TABLE_logs_COLUMNA_empresa]);
              $this->set_fichaje($data[TABLE_logs_COLUMNA_fichaje]);
              
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
     * Función para guardar un nuevo log
     * 
     * @access public
     * @return boolean
    */
    public function create() {
        if(!empty($this->get_usuario()) &&
           !empty($this->get_puestofichaje()) &&
           !empty($this->get_tipomovimiento()) &&
           !empty($this->get_empresa())) {
            //Guardamos el log en la BD
            $ok[] = $this->model->guardar(
                        $this->get_usuario(), 
                        $this->get_puestofichaje(), 
                        $this->get_tipomovimiento(), 
                        $this->get_empresa(), 
                        $this->get_fichaje()
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
     * Función para eliminar un log
     * 
     * @access public
     * @return boolean
    */
    public function eliminar() {
        if(!empty($this->get_id())) {
           return $this->model->eliminar_log($this->get_id());
        }else{
           return FALSE;
        }
    }
    
    /**
     * Función para actualizar un log
     * 
     * (Imprescindible que se haya definido en el objeto id)
     * 
     * @access public
     * @return boolean
    */
    public function update() {
        if(!empty($this->get_id())) {
           return $this->model->update($this->get_id(), $this->get_usuario(), $this->get_puestofichaje(), $this->get_tipomovimiento(), $this->get_fichaje());
        }else{
            return FALSE;
        }
    }
    
    /**
     * Función para generar un array con toda la información de un log
     * 
     * @static
     * @access public
     * @param int $log_id Código del log
     * @return log|FALSE
    */
    static function get_log($log_id) {
        if(!empty($log_id)) {
            $model = new \PICAJES\models\logModel();

            $log = new \PICAJES\objects\log();
            $log->set_id($log_id);
            if($log->establish()) {
                return $log;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    /**
     * Función para generar un array de objetos de todos los logs de PICAJES
     *
     * @static
     * @access public
     * @return array
     */
    static function todos_logs($fichaje = null, $fch = null, $fch_fin = null, $zona = null, $usuario = null) {
        $model = new \PICAJES\models\logModel();

        $return = array();
        $logs_todos = $model->get_todos($GLOBALS['empresa_id'], $fichaje, $fch, $fch_fin, $zona, $usuario);

        while ($log = $logs_todos->fetch_array()) {
            $return[] = new \PICAJES\objects\log($log[TABLE_logs_COLUMNA_id]);
        }

        return $return;
    }
}