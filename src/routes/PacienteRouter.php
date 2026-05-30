<?php
    namespace src\routes;
    use src\controllers\PacienteController;

    header("Content-type: application/json");

    $controller = new PacienteController();

    $method = $_SERVER['REQUEST_METHOD'];
    $uri = explode("/", trim($_SERVER['REQUEST_URI'], "/"));
    $resourceIndex = array_search("pacientes", $uri);

    if ($resourceIndex === false) {
        http_response_code(404);
        echo json_encode(["error" => "Ruta no encontrada"]);
    }

    $id = $uri[$resourceIndex + 1] ?? null;
    $resource = $uri[$resourceIndex];

    if ($resource === "pacientes") {
        switch ($method) {
            case "GET":
                if ($id) {
                    $controller->getPacienteById($id);
                } else {
                    $controller->getAllPacientes();
                }
                break;
            case "POST":
                
        }
    }
?>