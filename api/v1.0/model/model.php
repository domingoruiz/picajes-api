<?php
namespace PICAJES\models;

use mysqli;
use mysqli_result;

/**
 * Model Principal
 *
 * Esta clase es la responsable de montar y enviar todas las peticiones a MYSQL
 *
 * @package PICAJES
 */
class model {

    /**
    * Host de la base de datos MYSQL
    * @var string
    * @access private
    */
    private $HOST = SQL_HOST;
    
    /**
    * Usuario de la base de datos MYSQL
    * @var string
    * @access private
    */
    private $USERNAME = SQL_USERNAME;
    
    /**
    * Contraseña de la base de datos MYSQL
    * @var string
    * @access private
    */
    private $PASSWORD = SQL_PASSWORD;
    
    /**
    * DATABASE de la base de datos MYSQL
    * @var string
    * @access private
    */
    private $DATABASE = SQL_DATABASE;
    
    /**
    * Charset de la base de datos MYSQL
    * @var string
    * @access private
    */
    private $CHARSET  = 'UTF8';

    /**
     * Constructor del modelo principal
     *
     * @access public
     * @return boolean
     */
    public function __construct(){
        $this->con = new mysqli($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DATABASE);
        $this->con->set_charset($this->CHARSET);
        $this->con->autocommit(FALSE);

        return TRUE;
    }
    
    /**
    * Función que ejecuta un query contra la BD
    *
    * @access public
    * @var string $query
    * @return mysqli_result|FALSE
    */
    public function query($query) {
        $result = $this->con->query($query);
        
        if($result) {
            return $result;
        }else{
            if(DESARROLLO) {
                $GLOBALS["error_sql"] .= "QUERY: ".$query." ERROR: ".$this->con->error;
            }
            return FALSE;
        }
    }

    /**
    * Función para insertar registro en base de datos
    *
    * @access public
    * @param string $table
    * @param array $data
    * @return boolean
    */
    public function insert($table, $data=array()) {
        $listcolumn = \PICAJES\helpers\arrays::arraykeylist($data);

        $values = "";
    	foreach($data as $key=>$value) {
    		$values .= '\''.$value.'\',';
    		next($data);
    	}
    	$values = substr($values, 0, -1);
        
    	$result = $this->query('INSERT INTO '.$table.' ('.$listcolumn.') VALUES ('.$values.')');
        if($result) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
    * Función para actualizar registro en base de datos.
    *
    * @access public
    * @param string $table
    * @param array $data
    * @param array $where
    * @return boolean
    */
    public function update($table, $data=array(), $where=array()) {
        $values = "";
        foreach($data as $key=>$value) {
            $values .= ''.$key.' = \''.$value.'\', ';
        }
        $values = substr($values, 0, -2);

        $wheres = "";
        foreach($where as $key=>$value) {
            $wheres .= '('.$key.'=\''.$value.'\')AND';
        }
        $wheres = substr($wheres, 0, -3);
        
        $result = $this->query('UPDATE '.$table.' SET '.$values.' WHERE '.$wheres);
        
        if($result) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
    * Función para eliminar registro de la base de datos
    *
    * @access public
    * @param string $table
    * @param array $where
    * @return boolean
    */
    public function eliminar($table, $where=array()) {
        $wheres = "";
        foreach($where as $key=>$value) {
            $wheres .= '('.$key.'=\''.$value.'\')AND';
    	}
        $wheres = substr($wheres, 0, -3);

        $return = $this->query('DELETE FROM '.$table.' WHERE '.$wheres.'');
        
        if($return) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
    * Función para enviar query a base de datos
    *
    * @access public
    * @param string $table
    * @param array $where
    * @param array $order
    * @return mysqli_result
    */
    public function only_query($table, $where=array(), $order=array()) {
        $wheres = "";
        foreach($where as $key=>$value) {
            if($value!=null) {
                if(!$wheres) {
                    $wheres = " WHERE ";
                }
                $wheres .= '('.$key.'=\''.$value.'\')AND';
            }
        }
        $wheres = substr($wheres, 0, -3);

        $orders = "";
        foreach($order as $key=>$value) {
            if(!$orders) {
                 $orders = " ORDER BY";
             }
             $orders .= ' `'.$key.'` '.$value.', ';
        }
        $orders = substr($orders, 0, -2);
        
        return $this->query('SELECT * FROM '.$table.' '.$wheres.' '.$orders);
    }

    /**
     * Función para obtener objeto de un registro de la base de datos
     *
     * @access public
     * @param string $table
     * @param array $where
     * @param array $order
     * @return object|FALSE
     */
    public function get_object($table, $where=array(), $order=array()) {
        $result = $this->only_query($table, $where, $order);

        $return = $result->fetch_object();
        
        if($return) {
            return $return;
        }else{
            return FALSE;
        }
    }

    /**
     * Función para obtener array de un registro de la base de datos
     *
     * @access public
     * @param string $table
     * @param array $where
     * @param array $order
     * @return array|FALSE
     */
    public function get_array($table, $where=array(), $order=array()) {
        $result = $this->only_query($table, $where, $order);
        
        $return = $result->fetch_array();
        
        if($return) {
            return $return;
        }else{
            return FALSE;
        }
    }

    /**
     * Función para obtener el id del último registro creado
     *
     * @access public
     * @return int|FALSE
     */
    public function insert_id() {
        $return = $this->con->insert_id;
        
        if($return) {
            return $return;
        }else{
            return FALSE;
        }
    }
    
    /**
    * Devuelve el número de registros de un where
    *
    * @access public
    * @param string $table
    * @param array $where
    * @return int
    */
    public function countrow($table, $where=array()) {
        $result = $this->only_query($table, $where);
        $return = $result->num_rows;
        
        if($return) {
            return $return;
        }else{
            return 0;
        }
    }

    /**
     * Destructor del modelo principal
     *
     * @access public
     * @return boolean
     */
    function __destruct() {
        $a = $this->con->commit();
        $b = $this->con->close();
        
        if($a && $b) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

}
