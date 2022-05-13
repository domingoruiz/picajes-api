<?php
namespace PICAJES\helpers;

/**
 * Objeto que genera las salidas de datos de la aplicación
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 */

class salida {
    /**
     * Constructor de la clase salida
     *
     * @param null $salida
     * @return TRUE
     */
    function __construct($salida=NULL) {
        $this->id_error = 200;
        $this->descripcion_error = NULL;
        $this->salida = $salida;
        $this->error = NULL;

        return TRUE;
    }


    /**
     * Funcion para establecer el código de error HTTP
     *
     * @param int $id_error
     * @return bool
     */
    function set_id_error(int $id_error=NULL) {
        $this->id_error = $id_error;
        return TRUE;
    }

    /**
     * Función para establecer el resultado de la salica
     *
     * @param array|string $salida
     * @return bool
     */
    function set_salida($salida=NULL) {
        $this->salida = $salida;
        return TRUE;
    }

    /**
     * Función para establecer el error de la salica
     *
     * @param string $error
     * @return bool
     */
    function set_error($error=NULL) {
        $this->error = $error;
        return TRUE;
    }

    /**
     * Función que genera la salida en formato JSON
     *
     * @return false|string
     */
    function generar_salida() {
        switch($this->id_error){
            case "200":
                header('HTTP/1.1 200 OK');
                $this->descripcion_error = "OK";
                break;
            case "201":
                header('HTTP/1.1 201 Created');
                $this->descripcion_error = "Created";
                break;
            case "400":
                header('HTTP/1.1 400 Bad Request');
                $this->descripcion_error = "Bad Request";
                break;
            case "401":
                header('HTTP/1.1 401 Unauthorized');
                $this->descripcion_error = "Unauthorized";
                break;
            case "404":
                header('HTTP/1.1 404 Not Found');
                $this->descripcion_error = "Not Found";
                break;
            case "500":
                header('HTTP/1.1 500 Internal Server Error');
                $this->descripcion_error = "Internal Server Error";
                break;
            default:
                break;
        }


        return json_encode(
            array(
                "salida" => $this->salida,
                "error" => $this->error
            )
        );
    }
}