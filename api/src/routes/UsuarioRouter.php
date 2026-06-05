<?php
    use src\controllers\UsuarioController;

    header("Content-Type: application/json");
    
    $controller = new UsuarioController();

    $method = $_SERVER['REQUEST_METHOD'];
    $uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

    $id = end($uri);
    
    switch ($method) {
        case "GET":
            if (is_numeric($id)) {
                $controller->getUsuarioById($id);
            } else {
                $controller->getAllUsuarios();
            }
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
            if (!is_numeric($id)) {
                http_response_code(400);
                echo json_encode(["message" => "Error, id no encontrado"]);
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
            if (!is_numeric($id)) {
                http_response_code(400);
                echo json_encode(["error" => "Error, id no encontrado"]);
            }
            $controller->deleteUsuario($id);
            break;
        default:
            http_response_code(405);
            echo json_encode(["error" => "Metodo no permitido"]);
            break;
    }

?>