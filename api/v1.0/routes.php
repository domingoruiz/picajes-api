<?php
/**
 * Aqui tenemos todas las peticiones que se pueden hacer a la API
 *
 * @package PICAJES
 */

$routes['GET.'] =                                                    array("inicioController", "inicio");

$routes['GET.login'] =                                               array("usuarioController", "login");
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

$routes['GET.puestofichajes'] =                                      array("puestofichajeController", "obtener_datos");
$routes['POST.puestofichajes'] =                                     array("puestofichajeController", "crear_puestofichaje");
$routes['PUT.puestofichajes'] =                                      array("puestofichajeController", "actualizar_puestofichaje");
$routes['DELETE.puestofichajes'] =                                   array("puestofichajeController", "eliminar_puestofichaje");

$routes['GET.logs'] =                                                array("logController", "obtener_datos");
$routes['POST.logs'] =                                               array("logController", "crear_log");
$routes['PUT.logs'] =                                                array("logController", "actualizar_log");
$routes['DELETE.logs'] =                                             array("logController", "eliminar_log");

define("routes", $routes);