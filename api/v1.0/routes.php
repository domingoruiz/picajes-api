<?php
/**
 * Aqui tenemos todas las peticiones que se pueden hacer a la API
 *
 * @package PICAJES
 */

$routes['GET.'] =                                                    array("inicioController", "inicio");

$routes['GET.usuarios.login'] =                                      array("usuarioController", "login");
$routes['GET.usuarios'] =                                            array("usuarioController", "obtener_datos");
$routes['POST.usuarios'] =                                           array("usuarioController", "crear_usuario");
$routes['PUT.usuarios'] =                                            array("usuarioController", "actualizar_usuario");
$routes['DELETE.usuarios'] =                                         array("usuarioController", "eliminar_usuario");

$routes['GET.empresas'] =                                            array("empresaController", "obtener_datos");
$routes['POST.empresas'] =                                           array("empresaController", "crear_empresa");
$routes['PUT.empresas'] =                                            array("empresaController", "actualizar_empresa");
$routes['DELETE.empresas'] =                                         array("empresaController", "eliminar_empresa");

define("routes", $routes);