<?php
/**
 * Aqui tenemos todas las peticiones que se pueden hacer a la API
 *
 * @package PICAJES
 */

$routes['GET.'] =                                                    array("inicioController", "inicio");

$routes['GET.usuarios.login'] =                                      array("usuarioController", "login");
$routes['GET.usuarios'] =                                            array("usuarioController", "obtener_datos");
$routes['PUT.usuarios'] =                                            array("usuarioController", "crear_actualizar_usuario");
$routes['DELETE.usuarios'] =                                         array("usuarioController", "eliminar_usuario");

$routes['GET.empresas'] =                                            array("empresaController", "obtener_datos");
$routes['PUT.empresas'] =                                            array("empresaController", "crear_actualizar_empresa");
$routes['DELETE.empresas'] =                                         array("empresaController", "eliminar_empresa");

define("routes", $routes);