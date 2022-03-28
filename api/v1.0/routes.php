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

$routes['GET.equipos'] =                                             array("equipoController", "obtener_datos");
$routes['POST.equipos'] =                                            array("equipoController", "crear_equipo");
$routes['PUT.equipos'] =                                             array("equipoController", "actualizar_equipo");
$routes['DELETE.equipos'] =                                          array("equipoController", "eliminar_equipo");

$routes['GET.zonas'] =                                               array("zonaController", "obtener_datos");
$routes['POST.zonas'] =                                              array("zonaController", "crear_zona");
$routes['PUT.zonas'] =                                               array("zonaController", "actualizar_zona");
$routes['DELETE.zonas'] =                                            array("zonaController", "eliminar_zona");

define("routes", $routes);