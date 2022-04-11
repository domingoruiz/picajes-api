<?php
namespace PICAJES\objects;

/**
 * Objeto empresa
 *
 * Este objeto representa una empresa y permite realizar operaciones sobre este
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Object
 */

class empresa {

    /**
     * ID del empresa
     * @var int
     * @access public
     */
    public $empresa_id;

    /**
     * Nombre de la empresa
     * @var string
     * @access public
     */
    public $nombre;

    /**
     * NIF de la empresa
     * @var string
     * @access public
     */
    public $nif;

    /**
     * Dirección de la empresa
     * @var string
     * @access public
     */
    public $direccion;

    /**
     * Teléfono de la empresa
     * @var string
     * @access public
     */
    public $telefono;

    /**
     * Correo electrónico de la empresa
     * @var string
     * @access public
     */
    public $email;

    /**
     * Iniciamos el objeto empresa con la posibilidad de aportar un codigó para que se establezcan todas las variables
     * 
     * @access public
     * @param int $empresa_id
     * @return boolean
    */
    function  __construct($empresa_id=NULL) {
        $this->model = new \PICAJES\models\empresaModel;
        $this->establish = 0;
        
        if(!empty($empresa_id)) {
           $this->set_id($empresa_id);
           $this->establish();
        }

        return TRUE;
    }
    
    /**
     * Establecemos el código
     * 
     * @access public
     * @param int $empresa_id
     * @return boolean
    */
    public function set_id($empresa_id) {
        if($this->empresa_id = (int) $empresa_id) {
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
        return $this->empresa_id;
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
     * Establecemos el nif
     * 
     * @access public
     * @param string $nif 
     * @return boolean
    */
    public function set_nif($nif) {
        if($this->nif = (string) $nif) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos el nif
     * 
     * @access public
     * @return string
    */
    public function get_nif() {
        return $this->nif;
    }
    
    /**
     * Establecemos la dirección
     * 
     * @access public
     * @param string $direccion
     * @return boolean
    */
    public function set_direccion($direccion) {
        if($this->direccion = (string) $direccion) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos la dirección
     * 
     * @access public
     * @return string
    */
    public function get_direccion() {
        return $this->direccion;
    }
    
    /**
     * Obtenemos el telefono
     * 
     * @access public
     * @return string
    */
    public function get_telefono() {
        return $this->telefono;
    }

    /**
     * Establecemos el telefono
     * 
     * @access public
     * @param string $telefono 
     * @return boolean
    */
    public function set_telefono($telefono) {
        if($this->telefono = (string) $telefono) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
     * Establecemos el email
     * 
     * @access public
     * @param string $email 
     * @return boolean
    */
    public function set_email($email) {
        if($this->email = (string) $email) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos el email
     * 
     * @access public
     * @return string
    */
    public function get_email() {
        return $this->email;
    }

    /**
     * Con esta función configuramos todas las variables del objeto
     * 
     * @access public
     * @param string $forma Forma de la que se van a obtener los registros (a partir de id o empresa)
     * @return boolean
    */
    public function establish($forma="id") {
        if($forma=="id" && !empty($this->get_id())) {
           $where=array("id" => $this->get_id());
        }elseif($forma=="nif" && !empty($this->get_nif())) {
           $where=array("nif" => $this->get_nif());
        }
        
        if(!empty($where)) {
            $data = $this->model->get($where);
            
            if($data) {
              $this->set_id($data[TABLE_empresas_COLUMNA_id]);
              $this->set_nombre($data[TABLE_empresas_COLUMNA_nombre]);
              $this->set_nif($data[TABLE_empresas_COLUMNA_nif]);
              $this->set_direccion($data[TABLE_empresas_COLUMNA_direccion]);
              $this->set_telefono($data[TABLE_empresas_COLUMNA_telefono]);
              $this->set_email($data[TABLE_empresas_COLUMNA_email]);
              
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
     * Función para guardar una nueva empresa
     * 
     * @access public
     * @return boolean
    */
    public function create() {
        if(!empty($this->get_nombre()) &&
           !empty($this->get_nif()) &&
           !empty($this->get_direccion()) &&
           !empty($this->get_telefono()) &&
           !empty($this->get_email())) {
            //Guardamos el empresa en la BD
            $ok[] = $this->model->guardar(
                        $this->get_nombre(), 
                        $this->get_nif(), 
                        $this->get_direccion(),
                        $this->get_telefono(),
                        $this->get_email()
                      );

            if(\PICAJES\helpers\arrays::array_equal($ok)) {
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }
    
    /**
     * Función para eliminar un empresa
     * 
     * @access public
     * @return boolean
    */
    public function eliminar() {
        if(!empty($this->get_id())) {
           return $this->model->eliminar_empresa($this->get_id());
        }else{
           return FALSE;
        }
    }
    
    /**
     * Función para actualizar un empresa
     * 
     * (Imprescindible que se haya definido en el objeto id)
     * 
     * @access public
     * @return boolean
    */
    public function update() {
        if(!empty($this->get_id())) {
           return $this->model->update($this->get_id(), $this->get_nombre(), $this->get_nif(), $this->get_direccion(), $this->get_telefono(), $this->get_email());
        }else{
            return FALSE;
        }
    }
    
    /**
     * Función para generar un array con toda la información de un empresa
     * 
     * @static
     * @access public
     * @param int $empresa_id Código del empresa
     * @return empresa|FALSE
    */
    static function get_empresa($empresa_id) {
        if(!empty($empresa_id)) {
            $model = new \PICAJES\models\empresaModel();

            $empresa = new \PICAJES\objects\empresa();
            $empresa->set_id($empresa_id);
            if($empresa->establish()) {
                return $empresa;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    /**
     * Función para generar un array de objetos de todos los empresas de PICAJES
     *
     * @static
     * @access public
     * @return array
     */
    static function todos_empresas() {
        $model = new \PICAJES\models\empresaModel();

        $return = array();
        $empresas_todos = $model->get_todos($GLOBALS['empresa_id']);

        while ($empresa = $empresas_todos->fetch_array()) {
            $return[] = new \PICAJES\objects\empresa($empresa[TABLE_empresas_COLUMNA_id]);
        }

        return $return;
    }
}