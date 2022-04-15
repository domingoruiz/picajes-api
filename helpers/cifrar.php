<?php
namespace PICAJES\helpers;

/**
 * Helper relacionado con temas relacionados con cifrado
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 */

class cifrar {
   static function claves() {
      return array(
         "method" => aes128,
         "pass" => 'That golden key that opens the palace of eternity.'
      );
   }

   /**
   * Función para cifrar una cadena
   *
   * @return string
   * @param string $text
   */
   static function cifrar($text=NULL) {
      $claves = self::claves();
      return base64_encode(openssl_encrypt($text, $claves["method"], $claves["pass"]));
   }

   /**
   * Función para descifrar una cadena
   *
   * @return string (html)
   * @param string $text
   */
   static function descifrar($text=NULL) {
      if($text==null) {
         return 0;
      }else{
         $claves = self::claves();
         $descifrado = openssl_decrypt(base64_decode($text), $claves["method"], $claves["pass"]);
         if($descifrado == "") {
            return -1;
         }else{
            return $descifrado;
         }
      }
   }
}