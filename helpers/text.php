<?php
namespace PICAJES\helpers;

/**
 * Helper relacionado con temas relacionados con los textos
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 */

class text {
    /**
     * Función para eliminar elementos indeseados de srting antes de enviarlo a un query
     *
     * @return string (html)
     * @param string $text
     */
    static function cleantext($text=NULL) {
        return html_entity_decode(mysqli_real_escape_string($GLOBALS["model"]->con, htmlentities($text)));
    }
    
    /**
     * String random
     *
     * @param $largo int Longitud de la cadena
     *
     * @return string
     */
    static function random($largo=20) {
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; 
        $cad = ""; 
        $longitud=strlen($str);
        for($i=0;$i<$largo;$i++) { 
          $cad .= substr($str,rand(0,$longitud-1),1); 
        } 

        return $cad;
    }
    
    /**
     * Validar si clave es segura
     * 
     * @param type $clave
     * @return boolean
     */
    static function validar_clave($clave){
       if(strlen($clave) < 6){
          return FALSE;
       }
       if(!preg_match('`[a-z]`',$clave)){
          return FALSE;
       }
       if(!preg_match('`[A-Z]`',$clave)){
          return FALSE;
       }
       if(!preg_match('`[0-9]`',$clave)){
          return FALSE;
       }
       
       return true;
    }
}