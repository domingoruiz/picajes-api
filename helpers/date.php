<?php
namespace PICAJES\helpers;
require_once ROUTECONFIG.'date.php';

/**
 * Helper para procesar fechas
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 */
class date {
    
    /**
    * Compara dos fechas distintas
    *
    * @return boolean
    * @param date $date1 
    * @param date $date2
    * @param boolean
    */
    static function datecompare($date1, $date2, $comparation) {
        $date1 = strtotime($date1);
        $date2 = strtotime($date2);
        if($comparation == "<") {
            if($date1<$date2 || $date1==$date2) {
                $true = "1";
            }
        }elseif($comparation == ">") {
            if($date1>$date2 || $date1==$date2) {
                $true = "1";
            }
        }
        if($true) {
                return true;
        }else{
                return false;
        }
    }

    /**
    * Compara dos horas distintas
    *
    * @return boolean
    * @param string $time1
    * @param string $time2
    * @param boolean
    */
    static function timecompare($time1, $time2, $comparation) {
        $time1 = explode("-", $time1);
        $time2 = explode("-", $time2);
        if($comparation == "<") {
           if($time1[0] < $time2[0]) {
               return true;
           }else{
               if($time1[1] < $time2[1]) {
                   return true;
               }
           }
        }
        if($comparation == ">") {
            if($time1[0] > $time2[0]) {
                return true;
            }else{
                if($time1[1] > $time2[1]) {
                    return true;
                }
            }
        }

        return FALSE;
    }

    /**
    * Comprobar si fecha es valida
    *
    * @return boolean
    * @param date $date
    */
    static function checkdate($date) {
         $date = explode("-", $date);
         if(checkdate($date[1], $date[2], $date[0])) {
             return true;
         }else{
             return false;
         }
    }

    /**
    * Comprobar si hora es valida
    *
    * @return boolean
    * @param string $time
    */
    static function checktime($time /*HH:MM*/) {
        $time = explode(":", $time);
        if($time[0] >= "00" && $time[0] <= "24") {
            if($time[1] >= "00" && $time[1] <= "59") {
                return true;
            }
        }

        return FALSE;
    }

    /**
    * Dar formato correcto a una fecha
    *
    * @return date|FALSE
    * @param string|FALSE $date
    */
    static function dateformate($date) {
        if($date != "" || $date != NULL) {
            return date_format(date_create($date), 'd-m-Y');
        }else{
            return FALSE;
        }
    }

    /**
    * Nombre de un día de la semana
    *
    * @return string
    * @param int $number 
    */
    static function nameday($number) {
        $array = array(1 => name1day, 2 => name2day, 3 => name3day, 4 => name4day, 5 => name5day, 6 => name6day, 7 => name7day);
        return $array[$number];
    }

    /**
    * Nombre de un mes del año
    *
    * @return string
    * @param int $number 
    */
    static function namemonth($number) {
        $array = array(1 => name1month, 2 => name2month, 3 => name3month, 4 => name4month, 5 => name5month, 6 => name6month, 7 => name7month, 8 => name8month, 9 => name9month, 10 => name10month, 11 => name11month, 12 => name12month);
        return $array[$number];
    }

    /**
    * Sumar o restar un mes
    *
    * @return array
    * @param string $mode 
    * @param int $month
    * @param int $year
    */
    static function monthlater($mode, $month, $year) {
        if($mode == "-") {
            if($month == "12") {
                return array(1, $year+1);
            }else{
                return array($month+1, $year);
            }
        }else{
            if($month == "1") {
                return array(12, $year-1);
            }else{
                return array($month-1, $year);
            }
        }
    }

    function separar_hora($tiempo) {
        $arr_tiempo = explode(':', $tiempo);
        $segundos = $arr_tiempo[0] * 3600 + $arr_tiempo[1] * 60 + $arr_tiempo[2];
        return $segundos;
    }
    
    // Transformar los segundos en hora formato HH:mm:ss
    function unir_hora($seg) {
        $horas = floor($seg / 3600);
        $minutos = floor($seg / 60 % 60);
        $segundos = floor($seg % 60);
    
        return sprintf('%02d:%02d:%02d', $horas, $minutos, $segundos);
    }
        
}