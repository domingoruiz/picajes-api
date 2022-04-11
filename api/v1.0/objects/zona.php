<?php
namespace PICAJES\objects;

/**
 * Objeto zona
 *
 * Este objeto representa una zona y permite realizar operaciones sobre este
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Object
 */

class zona {

    /**
     * ID del zona
     * @var int
     * @access public
     */
    public $zona_id;

    /**
     * Nombre del zona
     * @var string
     * @access public
     */
    public $nombre;

    /**
     * Empresa del zona
     * @var int
     * @access public
     */
    public $empresa;

    /**
     * Iniciamos el objeto zona con la posibilidad de aportar un codigó para que se establezcan todas las variables
     * 
     * @access public
     * @param int $zona_id
     * @return boolean
    */
    function  __construct($zona_id=NULL) {
        $this->model = new \PICAJES\models\zonaModel;
        $this->establish = 0;
        
        if(!empty($zona_id)) {
           $this->set_id($zona_id);
           $this->establish();
        }

        return TRUE;
    }
    
    /**
     * Establecemos el código
     * 
     * @access public
     * @param int $zona_id
     * @return boolean
    */
    public function set_id($zona_id) {
        if($this->zona_id = (int) $zona_id) {
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
        return $this->zona_id;
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
     * Con esta función configuramos todas las variables del objeto
     * 
     * @access public
     * @param string $forma Forma de la que se van a obtener los registros (a partir de id o zona)
     * @return boolean
    */
    public function establish($forma="id") {
        if($forma=="id" && !empty($this->get_id())) {
           $where=array("id" => $this->get_id());
        }
        
        if(!empty($where)) {
            $data = $this->model->get($where);
            
            if($data) {
              $this->set_id($data[TABLE_zonas_COLUMNA_id]);
              $this->set_nombre($data[TABLE_zonas_COLUMNA_nombre]);
              $this->set_empresa($data[TABLE_zonas_COLUMNA_empresa]);
              
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
     * Función para guardar un nuevo zona
     * 
     * @access public
     * @return boolean
    */
    public function create() {
        if(!empty($this->get_nombre()) &&
           !empty($this->get_empresa())) {
            //Guardamos el zona en la BD
            $ok[] = $this->model->guardar(
                        $this->get_nombre(), 
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
     * Función para eliminar un zona
     * 
     * @access public
     * @return boolean
    */
    public function eliminar() {
        if(!empty($this->get_id())) {
           return $this->model->eliminar_zona($this->get_id());
        }else{
           return FALSE;
        }
    }
    
    /**
     * Función para actualizar un zona
     * 
     * (Imprescindible que se haya definido en el objeto id)
     * 
     * @access public
     * @return boolean
    */
    public function update() {
        if(!empty($this->get_id())) {
           return $this->model->update($this->get_id(), $this->get_nombre(), $this->get_empresa());
        }else{
            return FALSE;
        }
    }
    
    /**
     * Función para generar un array con toda la información de un zona
     * 
     * @static
     * @access public
     * @param int $zona_id Código del zona
     * @return zona|FALSE
    */
    static function get_zona($zona_id) {
        if(!empty($zona_id)) {
            $model = new \PICAJES\models\zonaModel();

            $zona = new \PICAJES\objects\zona();
            $zona->set_id($zona_id);
            if($zona->establish()) {
                return $zona;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    /**
     * Función para generar un array de objetos de todos los zonas de PICAJES
     *
     * @static
     * @access public
     * @return array
     */
    static function todos_zonas() {
        $model = new \PICAJES\models\zonaModel();

        $return = array();
        $zonas_todos = $model->get_todos($GLOBALS['empresa_id']);

        while ($zona = $zonas_todos->fetch_array()) {
            $return[] = new \PICAJES\objects\zona($zona[TABLE_zonas_COLUMNA_id]);
        }

        return $return;
    }
}