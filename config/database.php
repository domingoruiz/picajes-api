<?php
namespace PICAJES;

/**
 * Constantes relacionadas con la base de datos
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 */

define("PREFIJO_BD", "pic_");

define('TABLE_usuario',                       PREFIJO_BD.'usuarios');
      define('TABLE_usuario_COLUMNA_id',                    'id');
      define('TABLE_usuario_COLUMNA_usuario',               'usuario');
      define('TABLE_usuario_COLUMNA_contrasenia',           'contrasenia');
      define('TABLE_usuario_COLUMNA_nombre',                'nombre');
      define('TABLE_usuario_COLUMNA_email',                 'email');
      define('TABLE_usuario_COLUMNA_telefono',              'telefono');
      define('TABLE_usuario_COLUMNA_empresa',               'empresa');
      define('TABLE_usuario_COLUMNA_equipo',                'equipo');

define('TABLE_sesion',                       PREFIJO_BD.'sesiones');
      define('TABLE_sesion_COLUMNA_id',                    'id');
      define('TABLE_sesion_COLUMNA_usuario',               'usuario');
      define('TABLE_sesion_COLUMNA_fechaexpiracion',       'expiracion');
      define('TABLE_sesion_COLUMNA_tokensesion',           'token_sesion');