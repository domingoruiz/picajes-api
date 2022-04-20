<?php
namespace PICAJES\objects;

/**
 * Objeto User
 *
 * Este objeto representa un user y permite realizar operaciones sobre este
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Object
 */

class user {

    /**
     * ID del usuario
     * @var int
     * @access public
     */
    public $usuario_id;

    /**
     * Usuario del usuario
     * @var string
     * @access public
     */
    public $usuario;

    /**
     * Contraseña del usuario (en MD5)
     * @var string
     * @access public
     */
    public $contrasenia;

    /**
     * Nombre del usuario
     * @var string
     * @access public
     */
    public $nombre;

    /**
     * Email del usuario
     * @var string
     * @access public
     */
    public $email;

    /**
     * Teléfono del usuario
     * @var string
     * @access public
     */
    public $telefono;

    /**
     * Empresa del usuario
     * @var string
     * @access public
     */
    public $empresa;

    /**
     * Equipo del usuario
     * @var string
     * @access public
     */
    public $equipo;

    /**
     * Barcode del usuario
     * @var string
     * @access public
     */
    public $barcode;

    /**
     * Iniciamos el objeto user con la posibilidad de aportar un codigó para que se establezcan todas las variables
     * 
     * @access public
     * @param int $user_id
     * @return boolean
    */
    function  __construct($user_id=NULL) {
        $this->model = new \PICAJES\models\userModel;
        $this->establish = 0;
        
        if(!empty($user_id)) {
           $this->set_id($user_id);
           $this->establish();
        }

        return TRUE;
    }
    
    /**
     * Establecemos el código
     * 
     * @access public
     * @param int $usuario_id
     * @return boolean
    */
    public function set_id($usuario_id) {
        if($this->usuario_id = (int) $usuario_id) {
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
        return $this->usuario_id;
    }
    
    /**
     * Establecemos el usuario
     * 
     * @access public
     * @param string $usuario 
     * @return boolean
    */
    public function set_usuario($usuario) {
        if($this->usuario = (string) $usuario) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos el usuario
     * 
     * @access public
     * @return string
    */
    public function get_usuario() {
        return $this->usuario;
    }
    
    /**
     * Establecemos la contraseña
     * 
     * @access public
     * @param string $contrasenia 
     * @return boolean
    */
    public function set_contrasenia($contrasenia) {
        if($this->contrasenia = (string) $contrasenia) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos la contrasenia
     * 
     * @access public
     * @return string
    */
    public function get_contrasenia() {
        return $this->contrasenia;
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
     * Establecemos la empresa
     * 
     * @access public
     * @param string $empresa 
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
     * Obtenemos la empresa
     * 
     * @access public
     * @return string
    */
    public function get_empresa() {
        return $this->empresa;
    }

    /**
     * Establecemos el equipo
     * 
     * @access public
     * @param string $equipo 
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
     * Obtenemos el equipo
     * 
     * @access public
     * @return string
    */
    public function get_equipo() {
        return $this->equipo;
    }

    /**
     * Establecemos el barcode
     * 
     * @access public
     * @param string $barcode 
     * @return boolean
    */
    public function set_barcode($barcode) {
        if($this->barcode = (int) $barcode) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos el barcode
     * 
     * @access public
     * @return string
    */
    public function get_barcode() {
        return $this->barcode;
    }

    /**
     * Con esta función configuramos todas las variables del objeto
     * 
     * @access public
     * @param string $forma Forma de la que se van a obtener los registros (a partir de id o usuario)
     * @return boolean
    */
    public function establish($forma="id") {
        if($forma=="id" && !empty($this->get_id())) {
           $where=array("id" => $this->get_id());
        }elseif($forma=="usuario" && !empty($this->get_usuario())) {
           $where=array("usuario" => $this->get_usuario());
        }elseif($forma=="barcode" && !empty($this->get_barcode())) {
            $where=array("barcode" => $this->get_barcode());
         }
        
        if(!empty($where)) {
            $data = $this->model->get($where);
            
            if($data) {
              $this->set_id($data[TABLE_usuario_COLUMNA_id]);
              $this->set_usuario($data[TABLE_usuario_COLUMNA_usuario]);
              $this->set_contrasenia($data[TABLE_usuario_COLUMNA_contrasenia]);
              $this->set_nombre($data[TABLE_usuario_COLUMNA_nombre]);
              $this->set_email($data[TABLE_usuario_COLUMNA_email]);
              $this->set_telefono($data[TABLE_usuario_COLUMNA_telefono]);
              $this->set_empresa($data[TABLE_usuario_COLUMNA_empresa]);
              $this->set_equipo($data[TABLE_usuario_COLUMNA_equipo]);
              $this->set_barcode($data[TABLE_usuario_COLUMNA_barcode]);
              
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
     * Función para guardar un nuevo usuario
     * 
     * @access public
     * @return boolean
    */
    public function create() {
        if(!empty($this->get_usuario()) &&
           !empty($this->get_contrasenia()) &&
           !empty($this->get_nombre()) &&
           !empty($this->get_email())) {
            //Guardamos el usuario en la BD
            $ok[] = $this->model->guardar(
                        $this->get_usuario(), 
                        $this->get_contrasenia(), 
                        $this->get_nombre(),
                        $this->get_email(),
                        $this->get_telefono(),
                        $this->get_empresa(),
                        $this->get_equipo(),
                        $this->get_barcode()
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
     * Función para eliminar un usuario
     * 
     * @access public
     * @return boolean
    */
    public function eliminar() {
        if(!empty($this->get_id())) {
           return $this->model->eliminar_user($this->get_id());
        }else{
           return FALSE;
        }
    }
    
    /**
     * Función para actualizar un usuario
     * 
     * (Imprescindible que se haya definido en el objeto id)
     * 
     * @access public
     * @return boolean
    */
    public function update() {
        if(!empty($this->get_id())) {
           return $this->model->update($this->get_id(), $this->get_usuario(), $this->get_contrasenia(), $this->get_nombre(), $this->get_email(), $this->get_telefono(), $this->get_empresa(), $this->get_equipo(), $this->get_barcode());
        }else{
            return FALSE;
        }
    }
    
    /**
     * Función para generar un array con toda la información de un usuario
     * 
     * @static
     * @access public
     * @param int $usuario_id Código del usuario
     * @return user|FALSE
    */
    static function get_user($usuario_id) {
        if(!empty($usuario_id)) {
            $model = new \PICAJES\models\userModel();

            $user = new \PICAJES\objects\user();
            $user->set_id($usuario_id);
            if($user->establish()) {
                return $user;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    /**
     * Función para generar un array de objetos de todos los usuarios de PICAJES
     *
     * @static
     * @access public
     * @return array
     */
    static function todos_users() {
        $model = new \PICAJES\models\userModel();

        $return = array();
        $users_todos = $model->get_todos($GLOBALS['empresa_id']);

        while ($user = $users_todos->fetch_array()) {
            $return[] = new \PICAJES\objects\user($user[TABLE_usuario_COLUMNA_id]);
        }

        return $return;
    }
}