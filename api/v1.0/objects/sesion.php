<?php
namespace PICAJES\objects;

/**
 * Objeto Sesión
 *
 * Este objeto representa una sesión y permite realizar operaciones sobre esta
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Object
 */

class sesion {

    /**
     * ID de la sesión
     * @var int
     * @access public
     */
    public $sesion_id;

    /**
     * Usuario de la sesión
     * @var int
     * @access public
     */
    public $user;

    /**
     * Empresa de la sesión
     * @var int
     * @access public
     */
    public $empresa;

    /**
     * Token de la sesión
     * @var string
     * @access public
     */
    public $token_sesion;

    /**
     * Fecha de expiración de la sesión
     * @var datetime
     * @access public
     */
    public $fecha_expiracion;

    /**
     * Iniciamos el objeto sesion con la posibilidad de aportar un codigó para que se establezcan todas las variables
     * 
     * @access public
     * @param int $sesion_id
     * @return boolean
    */
    function  __construct($sesion_id=NULL) {
        $this->model = new \PICAJES\models\sesionModel;
        $this->establish = 0;
        $this->puesto = null;
        $this->user = null;

        if(!empty($sesion_id)) {
           $this->set_id($sesion_id);
           $this->establish();
        }

        return TRUE;
    }
    
    /**
     * Establecemos el código
     * 
     * @access public
     * @param int $sesion_id
     * @return boolean
    */
    public function set_id($sesion_id) {
        if($this->sesion_id = (int) $sesion_id) {
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
        return $this->sesion_id;
    }
    
    /**
     * Establecemos el id de usuario
     * 
     * @access public
     * @param int $user
     * @return boolean
    */
    public function set_user($user) {
        if($this->user = (int) $user) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos el id de usuario
     * 
     * @access public
     * @return int
    */
    public function get_user() {
        return $this->user;
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
     * Establecemos el token de la sesión
     * 
     * @access public
     * @param string $token_sesion
     * @return boolean
    */
    public function set_token_sesion($token_sesion) {
        if($this->token_sesion = (string) $token_sesion) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos el token de la sesión
     * 
     * @access public
     * @return string
    */
    public function get_token_sesion() {
        return $this->token_sesion;
    }
    
    /**
     * Establecemos la fecha de expiración
     * 
     * @access public
     * @param string $fecha_expiracion
     * @return boolean
    */
    public function set_fecha_expiracion($fecha_expiracion) {
        if($this->fecha_expiracion = (string) $fecha_expiracion) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * Obtenemos la fecha de expiración
     * 
     * @access public
     * @return string
    */
    public function get_fecha_expiracion() {
        return $this->fecha_expiracion;
    }
    
    /**
     * Con esta función configuramos todas las variables del objeto
     * 
     * @access public
     * @param string $forma Forma de la que se van a obtener los registros (a partir de id o token_sesion)
     * @return boolean
    */
    public function establish($forma="id") {
        if($forma=="id" && !empty($this->get_id())) {
           $where=array(TABLE_sesion_COLUMNA_id => $this->get_id());
        }elseif($forma=="token_sesion" && !empty($this->get_token_sesion())) {
           $where=array(TABLE_sesion_COLUMNA_tokensesion => $this->get_token_sesion());
        }
        
        if(!empty($where)) {
            $data = $this->model->get($where);

            if($data) {
              $usuario = new user($data[TABLE_sesion_COLUMNA_usuario]);

              $this->set_id($data[TABLE_sesion_COLUMNA_id]);
              $this->set_user($data[TABLE_sesion_COLUMNA_usuario]);
              $this->set_token_sesion($data[TABLE_sesion_COLUMNA_tokensesion]);
              $this->set_fecha_expiracion($data[TABLE_sesion_COLUMNA_fechaexpiracion]);
              $this->set_empresa($usuario->get_empresa());

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
     * Función para guardar una nueva sesion
     * 
     * @access public
     * @return boolean
    */
    public function create() {
        if(!empty($this->get_user()) &&
           !empty($this->get_token_sesion()) &&
           !empty($this->get_fecha_expiracion())) {
            //Guardamos la sesión en la BD
            $ok[] = $this->model->guardar(
                        $this->get_user(),
                        $this->get_token_sesion(),
                        $this->get_fecha_expiracion()
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
     * Función para actualizar una sesion
     *
     * @access public
     * @return boolean
     */
    public function update() {
        if(!empty($this->get_token_sesion()) && !empty($this->get_fecha_expiracion())) {
            //Guardamos la sesión en la BD
            $ok[] = $this->model->update(
                $this->get_token_sesion(),
                $this->get_fecha_expiracion()
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
     * Función para eliminar una sesión
     * 
     * @access public
     * @return boolean
    */
    public function eliminar() {
        if(!empty($this->get_id())) {
           return $this->model->eliminar_sesion($this->get_id());
        }else{
           return FALSE;
        }
    }

    /**
     * Función para generar un array con toda la información de una sesión a partir del token
     * 
     * @static
     * @access public
     * @param string $token_sesion Token de la sesión
     * @return sesion|FALSE
    */
    static function get_sesion($token_sesion) {
        if(!empty($token_sesion)) {
            $sesion = new \PICAJES\objects\sesion();
            $sesion->set_token_sesion($token_sesion);
            if($sesion->establish()) {
                return $sesion;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    /**
     * Elimina las sesione existentes de un usuario
     *
     * @param int $id_usuario
     * @return bool
     */
    static function eliminar_sesiones_usuario(int $id_usuario) {
        $model = new \PICAJES\models\sesionModel();
        $sesiones_usuario = $model->get_query(array(TABLE_sesion_COLUMNA_usuario => $id_usuario));

        while($sesion = $sesiones_usuario->fetch_array()) {
            (new \PICAJES\objects\sesion($sesion[TABLE_sesion_COLUMNA_id]))->eliminar();
        }

        return TRUE;
    }
}