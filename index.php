<?php
namespace PICAJES;

/**
 * PICAJES
 *
 * API para la gestión de picajes
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo Arroyo <ordenadordomi@gmail.com>
 * @copyright Todos los derechos reservados. 2022
 * @version 1.0
 */

// Definimos el directorio raiz de la aplicación
define("ROOTDIRECTORY", __DIR__."/");

// Cargamos el motor
require ROOTDIRECTORY.'/engine/engine.php';

// Cargamos el programa
$api = new api();
echo $api->json();

