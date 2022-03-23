<?php
namespace PICAJES\controllers;

use PICAJES\helpers\salida;

/**
 * Controlador Inicio
 *
 * Este controlador almacena todas las operaciones que no pertenecen a ningún otro controlador
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 * @category Controller
 */

class inicioController extends controller {

    /**
     * Constructor del controlador inicio
     *
     * @access public
     */
    public function  __construct() {
        return parent::__construct();
    }

    /**
     * Operación de la api que devuelve la operación inicial de la API
     *
     * @access public
     * @return salida
     */
    public function inicio() {
        return (new salida("API de PICAJES. Para más información leer la documentación correspondiente."));
    }

    /**
     * Operación de la api que ejecuta el cron
     *
     * @access public
     * @return salida
     */
    public function cron() {
        return (new salida());
    }

    /**
     * Destructor
     *
     * @access public
     * @return boolean
     */
    public function __destruct() {
        return TRUE;
    }
    
}