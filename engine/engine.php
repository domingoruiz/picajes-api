<?php
namespace PICAJES;

/**
 * API
 *
 * Esta clase es la encargada de cargar todos los elementos necesarios para hacer
 * funcionar a la API
 *
 * @package PICAJES
 * @author Domingo Ruiz Arroyo <ordenadordomi@gmail.com>
 */

class api {

    /**
     * Función encargada de cargar todos los elementos y generar una salida en JSON
     *
     * @return string
     */
    function json() {
        // Error reporting a 0. Más adelante se pondra a 1 si es necesario.
        //error_reporting(0);

        // Cargamos la configuración necesaria
        require_once __DIR__.'/../config.php';

        // Leemos la URL de la petición
        $cadena_url = "/".explode(HOST_COMPLETO, HOST.substr($_SERVER["REQUEST_URI"], 1))[1];
        $cadena_url = parse_url(substr(HOST, 0,-1).$cadena_url, PHP_URL_PATH);
        $cadena_url = array_filter(explode("/", $cadena_url));

        // Definimos el metodo de la petición
        $metodo_peticion = $_SERVER['REQUEST_METHOD'];

        // Definimos la versión de la API a usar
        $version_api = $cadena_url[1];
        define("VERSION_API", $version_api);
        define("ROUTEAPI", ROOTDIRECTORY.'api/v'.VERSION_API.'/');

        if($version_api != "1.0") {
            echo '{"salida": null,"error": "No se ha especificado una versión de API a usar valida."}';
            exit();
        }

        // Cargamos el resto de archivos de configuración
        foreach(glob(__DIR__ . '/../config/*.php') as $file){
            require_once $file;
        }

        // Iniciamos las globales
        global $model;

        // Configuración inicial
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: PUT, GET, DELETE');
        header("Access-Control-Allow-Headers: X-Requested-With");
        header('Content-Type: application/json; charset='.CHARSET);
        header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');
        putenv('TZ='.TIMEZONE);
        date_default_timezone_set(TIMEZONE);
        set_time_limit(300);

        // Desarrollo
        if(!DESARROLLO) {
            error_reporting(0);
        }else{
            error_reporting(E_ERROR);
            ini_set("display_errors", 1);
        }

        // Cargamos más archivos
        require_once ROUTEHELPERS.'helpers.php';
        require_once ROUTECONTROLLER.'controller.php';
        require_once ROUTEMODEL.'model.php';


        foreach(glob(ROUTECONTROLLER.'/*.php') as $file){
            require_once $file;
        }
        foreach(glob(ROUTEMODEL.'/*.php') as $file){
            require_once $file;
        }
        foreach(glob(ROUTEOBJECTS.'/*.php') as $file){
            require_once $file;
        }

        // Comprobamos si estan disponibles todos los modulos de PHP
        if(!DESARROLLO && (!extension_loaded("mysqlnd") || !extension_loaded("mbstring")
            || !extension_loaded("intl") || !extension_loaded("xml")
            || !extension_loaded("zip") || !extension_loaded("curl")
            || !extension_loaded("gd") || !extension_loaded("json")))
        {
            $salida = new \PICAJES\helpers\salida();
            $salida->set_id_error(500);
            $salida->set_error("Faltan módulos de PHP por instalar necesarios para el funcionamiento del sistema. La lista de modulos son mysqlnd, mbstring, intl, xml, zip, curl, gd y json.");
            return $salida->generar_salida();
        }

        // Iniciamos el modelo
        $model = new \PICAJES\models\model;

        // Averiguamos que controlador y accion nos esta pidiendo el cliente
        $cadena_url_sin_id = \PICAJES\helpers\arrays::eliminar_numeros($cadena_url);

        for ($i=0;$i<=(count($cadena_url_sin_id));$i++) {
            $peticion = $peticion.$cadena_url_sin_id[$i].".";
        }
        $peticion = substr($peticion, 0, -2);

        require_once ROUTEAPI.'routes.php';
        $controller = "\PICAJES\controllers\\".$routes[$metodo_peticion.'.'.$peticion][0];
        $action =     $routes[$metodo_peticion.'.'.$peticion][1];

        // Cargamos el controlador y acción
        if(!empty($controller) && !empty($action)) {
            $parametros["GET"] = \PICAJES\helpers\arrays::clean_array($_GET);
            $parametros["POST"] = \PICAJES\helpers\arrays::clean_array($_POST);
            $parametros["URL"] = $cadena_url;

            // Validamos que este logueado
            if(!($metodo_peticion == "GET" && $peticion == "cron") && !($metodo_peticion == "GET" && $peticion == "") && !($metodo_peticion == "GET" && $peticion == "usuarios.login")) {
                $sesion = new \PICAJES\objects\sesion;
                $sesion->set_token_sesion($parametros["GET"]["token_sesion"]);
                $sesion->establish("token_sesion");

                if(!empty($sesion->get_id())) {
                    $controller = new $controller();
                    $json = $controller->$action($parametros)->generar_salida();
                }else{
                    $salida = new \PICAJES\helpers\salida();
                    $salida->set_id_error(401);
                    $salida->set_error("Sesión no iniciada");
                    $json = $salida->generar_salida();
                }
            }else{
                $controller = new $controller();
                $json = $controller->$action($parametros)->generar_salida();
            }
        }else{
            $salida = new \PICAJES\helpers\salida();
            $salida->set_id_error(404);
            $salida->set_error("Operación no encontrada");
            $json = $salida->generar_salida();
        }
        
        //Ejecutamos todos lo necesario para cerrar la aplicación, y en caso de que
        //todos sea correcto mandamos al navegador la respuesta en forma de HTML
        if($GLOBALS["model"]->__destruct()) {
            if($json) {
                return $json;
            }else{
                $salida = new \PICAJES\helpers\salida();
                $salida->set_id_error(500);
                $salida->set_error("No se ha devuelto respuesta.");
                return $salida->generar_salida();
            }
        }else{
            $salida = new \PICAJES\helpers\salida();
            $salida->set_id_error(500);
            $salida->set_error("ERROR con la base de datos. Consultar LOG errores.");
            return $salida->generar_salida();
        }
    }
}
