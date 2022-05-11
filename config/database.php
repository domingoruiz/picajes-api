<?php
namespace PICAJES;

/**
 * Constantes relacionadas con la base de datos
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 */

define("PREFIJO_BD", "pic_");

define('TABLE_usuario',                          PREFIJO_BD.'usuarios');
      define('TABLE_usuario_COLUMNA_id',                    'id');
      define('TABLE_usuario_COLUMNA_usuario',               'usuario');
      define('TABLE_usuario_COLUMNA_contrasenia',           'contrasenia');
      define('TABLE_usuario_COLUMNA_nombre',                'nombre');
      define('TABLE_usuario_COLUMNA_email',                 'email');
      define('TABLE_usuario_COLUMNA_telefono',              'telefono');
      define('TABLE_usuario_COLUMNA_empresa',               'empresa');
      define('TABLE_usuario_COLUMNA_equipo',                'equipo');
      define('TABLE_usuario_COLUMNA_barcode',               'barcode');

define('TABLE_sesion',                           PREFIJO_BD.'sesiones');
      define('TABLE_sesion_COLUMNA_id',                     'id');
      define('TABLE_sesion_COLUMNA_usuario',                'usuario');
      define('TABLE_sesion_COLUMNA_fechaexpiracion',        'expiracion');
      define('TABLE_sesion_COLUMNA_tokensesion',            'token_sesion');

define('TABLE_empresas',                         PREFIJO_BD.'empresas');
      define('TABLE_empresas_COLUMNA_id',                   'id');
      define('TABLE_empresas_COLUMNA_nombre',               'nombre');
      define('TABLE_empresas_COLUMNA_nif',                  'nif');
      define('TABLE_empresas_COLUMNA_direccion',            'direccion');
      define('TABLE_empresas_COLUMNA_telefono',             'telefono');
      define('TABLE_empresas_COLUMNA_email',                'email');

define('TABLE_equipos',                          PREFIJO_BD.'equipos');
      define('TABLE_equipos_COLUMNA_id',                    'id');
      define('TABLE_equipos_COLUMNA_nombre',                'nombre');
      define('TABLE_equipos_COLUMNA_empresa',               'empresa');

define('TABLE_zonas',                            PREFIJO_BD.'zonas');
      define('TABLE_zonas_COLUMNA_id',                      'id');
      define('TABLE_zonas_COLUMNA_nombre',                  'nombre');
      define('TABLE_zonas_COLUMNA_empresa',                 'empresa');

define('TABLE_puestofichajes',                   PREFIJO_BD.'puestofichaje');
      define('TABLE_puestofichajes_COLUMNA_id',             'id');
      define('TABLE_puestofichajes_COLUMNA_nombre',         'nombre');
      define('TABLE_puestofichajes_COLUMNA_zona',           'zona');
      define('TABLE_puestofichajes_COLUMNA_empresa',        'empresa');

define('TABLE_logs',                             PREFIJO_BD.'log');
      define('TABLE_logs_COLUMNA_id',                       'id');
      define('TABLE_logs_COLUMNA_altdate',                  'alt_date');
      define('TABLE_logs_COLUMNA_usuario',                  'usuario');
      define('TABLE_logs_COLUMNA_puestofichaje',            'puestofichaje');
      define('TABLE_logs_COLUMNA_tipomovimiento',           'tipo_movimiento');
      define('TABLE_logs_COLUMNA_empresa',                  'empresa');
      define('TABLE_logs_COLUMNA_fichaje',                  'fichajes');
      define('TABLE_logs_COLUMNA_fch',                      'fch');

define('TABLE_fichajes',                         PREFIJO_BD.'fichajes');
      define('TABLE_fichajes_COLUMNA_id',                   'id');
      define('TABLE_fichajes_COLUMNA_altdate',              'alt_date');
      define('TABLE_fichajes_COLUMNA_usuario',              'usuario');
      define('TABLE_fichajes_COLUMNA_equipo',               'equipo');
      define('TABLE_fichajes_COLUMNA_empresa',              'empresa');
      define('TABLE_fichajes_COLUMNA_hor_ini',              'hor_ini');
      define('TABLE_fichajes_COLUMNA_hor_fin',              'hor_fin');
      define('TABLE_fichajes_COLUMNA_tim_trb',              'tim_trb');
      define('TABLE_fichajes_COLUMNA_tim_dsc',              'tim_dsc');
      define('TABLE_fichajes_COLUMNA_tim_tot',              'tim_tot');
      define('TABLE_fichajes_COLUMNA_min_trb',              'min_trb');
      define('TABLE_fichajes_COLUMNA_min_dsc',              'min_dsc');
      define('TABLE_fichajes_COLUMNA_min_tot',              'min_tot');
      define('TABLE_fichajes_COLUMNA_estado',               'estado');
      define('TABLE_fichajes_COLUMNA_fch',                  'fch');
      define('TABLE_fichajes_COLUMNA_mod_date',             'mod_date');