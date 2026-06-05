<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header("Content-type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit();
    }

    require_once "./autoload.php";
    
    $uri = explode("/", trim($_SERVER['REQUEST_URI'], "/"));
    $resourceIndex = array_search("index.php", $uri);
    $resource = $uri[$resourceIndex + 1];

    switch ($resource) {
        case "usuarios":
            require_once "./src/routes/UsuarioRouter.php";
            break;
        case "pacientes":
            require_once "./src/routes/PacienteRouter.php";
            break;
        case "citas":
            require_once "./src/routes/CitaRouter.php";
            break;
        default:
            http_response_code(404);
            echo json_encode(["message" => "Ruta no encontrada"]);
            break;
    }
?>