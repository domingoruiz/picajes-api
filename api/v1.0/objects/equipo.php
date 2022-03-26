<?php
namespace PICAJES\objects;

/**
 * Objeto equipo
 *
 * Este objeto representa una equipo y permite realizar operaciones sobre este
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Object
 */

class equipo {

    /**
     * ID del equipo
     * @var int
     * @access public
     */
    public $equipo_id;

    /**
     * Nombre del equipo
     * @var string
     * @access public
     */
    public $nombre;

    /**
     * Empresa del equipo
     * @var int
     * @access public
     */
    public $empresa;

    /**
     * Iniciamos el objeto equipo con la posibilidad de aportar un codigó para que se establezcan todas las variables
     * 
     * @access public
     * @param int $equipo_id
     * @return boolean
    */
    function  __construct($equipo_id=NULL) {
        $this->model = new \PICAJES\models\equipoModel;
        $this->establish = 0;
        
        if(!empty($equipo_id)) {
           $this->set_id($equipo_id);
           $this->establish();
        }

        return TRUE;
    }
    
    /**
     * Establecemos el código
     * 
     * @access public
     * @param int $equipo_id
     * @return boolean
    */
    public function set_id($equipo_id) {
        if($this->equipo_id = (int) $equipo_id) {
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
        return $this->equipo_id;
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
     * @param string $forma Forma de la que se van a obtener los registros (a partir de id o equipo)
     * @return boolean
    */
    public function establish($forma="id") {
        if($forma=="id" && !empty($this->get_id())) {
           $where=array("id" => $this->get_id());
        }
        
        if(!empty($where)) {
            $data = $this->model->get($where);
            
            if($data) {
              $this->set_id($data[TABLE_equipos_COLUMNA_id]);
              $this->set_nombre($data[TABLE_equipos_COLUMNA_nombre]);
              $this->set_empresa($data[TABLE_equipos_COLUMNA_empresa]);
              
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
     * Función para guardar un nuevo equipo
     * 
     * @access public
     * @return boolean
    */
    public function create() {
        if(!empty($this->get_nombre()) &&
           !empty($this->get_empresa())) {
            //Guardamos el equipo en la BD
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
     * Función para eliminar un equipo
     * 
     * @access public
     * @return boolean
    */
    public function eliminar() {
        if(!empty($this->get_id())) {
           return $this->model->eliminar_equipo($this->get_id());
        }else{
           return FALSE;
        }
    }
    
    /**
     * Función para actualizar un equipo
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
     * Función para generar un array con toda la información de un equipo
     * 
     * @static
     * @access public
     * @param int $equipo_id Código del equipo
     * @return equipo|FALSE
    */
    static function get_equipo($equipo_id) {
        if(!empty($equipo_id)) {
            $model = new \PICAJES\models\equipoModel();

            $equipo = new \PICAJES\objects\equipo();
            $equipo->set_id($equipo_id);
            if($equipo->establish()) {
                return $equipo;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    /**
     * Función para generar un array de objetos de todos los equipos de PICAJES
     *
     * @static
     * @access public
     * @return array
     */
    static function todos_equipos() {
        $model = new \PICAJES\models\equipoModel();

        $return = array();
        $equipos_todos = $model->get_todos();

        while ($equipo = $equipos_todos->fetch_array()) {
            $return[] = new \PICAJES\objects\equipo($equipo[TABLE_equipos_COLUMNA_id]);
        }

        return $return;
    }
}