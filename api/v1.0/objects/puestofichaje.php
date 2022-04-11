<?php
namespace PICAJES\objects;

/**
 * Objeto puestofichaje
 *
 * Este objeto representa una puestofichaje y permite realizar operaciones sobre este
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Object
 */

class puestofichaje {

    /**
     * ID del puestofichaje
     * @var int
     * @access public
     */
    public $puestofichaje_id;

    /**
     * Nombre del puestofichaje
     * @var string
     * @access public
     */
    public $nombre;

    /**
     * Zona del puestofichaje
     * @var int
     * @access public
     */
    public $zona;

    /**
     * Empresa de la sesión
     * @var int
     * @access public
     */
    public $empresa;

    /**
     * Iniciamos el objeto puestofichaje con la posibilidad de aportar un codigó para que se establezcan todas las variables
     * 
     * @access public
     * @param int $puestofichaje_id
     * @return boolean
    */
    function  __construct($puestofichaje_id=NULL) {
        $this->model = new \PICAJES\models\puestofichajeModel;
        $this->establish = 0;
        
        if(!empty($puestofichaje_id)) {
           $this->set_id($puestofichaje_id);
           $this->establish();
        }

        return TRUE;
    }
    
    /**
     * Establecemos el código
     * 
     * @access public
     * @param int $puestofichaje_id
     * @return boolean
    */
    public function set_id($puestofichaje_id) {
        if($this->puestofichaje_id = (int) $puestofichaje_id) {
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
        return $this->puestofichaje_id;
    }
    
    /**
     * Establecemos el nombre
     * 
     * @access public
     * @param string $nombre 
     * @return boolean
    */
    public function set_nombre($nombre) {
        if($this->nombre = (string) $nombre) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos el nombre
     * 
     * @access public
     * @return string
    */
    public function get_nombre() {
        return $this->nombre;
    }
    
    /**
     * Establecemos la zona
     * 
     * @access public
     * @param int $zona 
     * @return boolean
    */
    public function set_zona($zona) {
        if($this->zona = (int) $zona) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos la zona
     * 
     * @access public
     * @return int
    */
    public function get_zona() {
        return $this->zona;
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
     * Con esta función configuramos todas las variables del objeto
     * 
     * @access public
     * @param string $forma Forma de la que se van a obtener los registros (a partir de id o puestofichaje)
     * @return boolean
    */
    public function establish($forma="id") {
        if($forma=="id" && !empty($this->get_id())) {
           $where=array("id" => $this->get_id());
        }
        
        if(!empty($where)) {
            $data = $this->model->get($where);
            
            if($data) {
              $this->set_id($data[TABLE_puestofichajes_COLUMNA_id]);
              $this->set_nombre($data[TABLE_puestofichajes_COLUMNA_nombre]);
              $this->set_zona($data[TABLE_puestofichajes_COLUMNA_zona]);
              $this->set_empresa($data[TABLE_puestofichajes_COLUMNA_empresa]);
              
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
     * Función para guardar un nuevo puestofichaje
     * 
     * @access public
     * @return boolean
    */
    public function create() {
        if(!empty($this->get_nombre()) &&
           !empty($this->get_zona()) &&
           !empty($this->get_empresa())) {
            //Guardamos el puestofichaje en la BD
            $ok[] = $this->model->guardar(
                        $this->get_nombre(), 
                        $this->get_zona(), 
                        $this->get_empresa()
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
     * Función para eliminar un puestofichaje
     * 
     * @access public
     * @return boolean
    */
    public function eliminar() {
        if(!empty($this->get_id())) {
           return $this->model->eliminar_puestofichaje($this->get_id());
        }else{
           return FALSE;
        }
    }
    
    /**
     * Función para actualizar un puestofichaje
     * 
     * (Imprescindible que se haya definido en el objeto id)
     * 
     * @access public
     * @return boolean
    */
    public function update() {
        if(!empty($this->get_id())) {
           return $this->model->update($this->get_id(), $this->get_nombre(), $this->get_zona());
        }else{
            return FALSE;
        }
    }
    
    /**
     * Función para generar un array con toda la información de un puestofichaje
     * 
     * @static
     * @access public
     * @param int $puestofichaje_id Código del puestofichaje
     * @return puestofichaje|FALSE
    */
    static function get_puestofichaje($puestofichaje_id) {
        if(!empty($puestofichaje_id)) {
            $model = new \PICAJES\models\puestofichajeModel();

            $puestofichaje = new \PICAJES\objects\puestofichaje();
            $puestofichaje->set_id($puestofichaje_id);
            if($puestofichaje->establish()) {
                return $puestofichaje;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    /**
     * Función para generar un array de objetos de todos los puestofichajes de PICAJES
     *
     * @static
     * @access public
     * @return array
     */
    static function todos_puestofichajes() {
        $model = new \PICAJES\models\puestofichajeModel();

        $return = array();
        $puestofichajes_todos = $model->get_todos($GLOBALS['empresa_id']);

        while ($puestofichaje = $puestofichajes_todos->fetch_array()) {
            $return[] = new \PICAJES\objects\puestofichaje($puestofichaje[TABLE_puestofichajes_COLUMNA_id]);
        }

        return $return;
    }
}