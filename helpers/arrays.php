<?php
namespace PICAJES\helpers;

/**
 * Helper para trabajar con arrays
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 */
class arrays {

    /**
    * Montar una lista a partir de los elementos de un array
    *
    * @return string (E.G. uno, dos)
    * @param array $array (parameters)
    */
    static function arraylist(array $array=array()) {
		for($i=0; $i<count($array); $i++)
		{
                    if(!$return) {
                            $return = $array[$i];
                    }else{
                            $return .= ",$array[$i]";
                    }
		}
		return $return; //$array[0], $array[1]...
	}

    /**
    * Montar una lista a partir de los keys de un array
    *
    * @return string (E.G. uno, dos)
    * @param array $array (parameters)
    */
    static function arraykeylist(array $array=array()) {
            $return = "";
            foreach($array as $key=>$value) {
                $return .= $key.',';
            }
            return substr($return, 0, -1); //KEY($array[0]), KEY($array[1])...
    }
    
    /**
    * Comprueba que todos los elementos de un array son seguros para mysql
    *
    * @return array 
    * @param array $array
    */
    static function clean_array($array=array()) {
        $new_array = array();
        
        foreach($array as $key=>$value) {
            $new_array[$key] = text::cleantext($value);
        }
        
        return $new_array;
    }
    
    /**
    * Valida que todos los elementos de un array son iguales
    *
    * @return boolean 
    * @param array $array
    * @param string|boolean $value
    */
    static function array_equal(array $array=array(), $value=TRUE) {
        if(in_array($value, $array)) {
            if(count(array_unique($array)) == 1) {
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    /**
     * Convertimos un String (QM list) en un array
     *
     * @param $string
     * @param string $fila
     * @param string $espacio
     * @return array
     */
    static function str_array($string=NULL, $fila="\n", $espacio=" ") {
        $string_sinespacios = preg_replace('/[ ]+/', ' ', $string); 
        $array_filas = explode($fila, $string_sinespacios);
                
        foreach($array_filas as $row) {
            $array_final[] = array_filter(explode($espacio, $row));
        }
        return $array_final;
    }

    /**
     * Eliminamos los valores que sean números de un array
     *
     * @return array
     * @param array $array
     */
    static function eliminar_numeros(array $array=array()) {
        $array = array_values($array);

        for($i=-1;$i<count($array);$i++) {
            if(is_numeric($array[$i])) {
                $array[$i] = "";
            }
        }

        return array_values(array_filter($array));
    }
}
