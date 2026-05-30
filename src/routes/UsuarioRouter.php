<?php
    use src\controllers\UsuarioController;

    header("Content-Type: application/json");
    
    $controller = new UsuarioController();

    $method = $_SERVER['REQUEST_METHOD'];
    $uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

    $resourceIndex = array_search("usuarios", $uri);

    if ($resourceIndex == false) {
        http_response_code(400);
        json_encode(["message" => "Ruta no encontrada"]);
        exit;
    }

    $resource = $uri[$resourceIndex];
    $id = $uri[$resourceIndex + 1] ?? null;
    
    if ($resource === "usuarios") {
        switch ($method) {
            case "GET":
                if ($id) {
                    $controller->getUsuarioById($id);
                }
                $controller->getAllUsuarios();
                break;
            case "POST":
                $data = json_decode(file_get_contents("php://input"), true);
                $controller->insertUsuario(
                    $data["usuario"],
                    $data["password"],
                    $data["estado"]
                );
                break;
            case "PUT":
                $data = json_decode(file_get_contents("php://input"), true);
                if (!$id) {
                    http_response_code(400);
                    json_encode(["message" => "Error, id no encontrado"]);
                    exit;
                }

                $controller->updateUsuario(
                    $id,
                    $data["usuario"],
                    $data["password"],
                    $data["estado"]
                );
                break;
            case "DELETE":
                if (!$id) {
                    http_response_code(400);
                    json_encode(["error" => "Error, id no encontrado"]);
                }
                $controller->deleteUsuario($id);
                break;
            default:
                http_response_code(405);
                json_encode(["error" => "Metodo no permitido"]);
                break;
        }
    } else {
        http_response_code(404);
        json_encode(["error" => "Ruta no encontrada"]);
    }
?>