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
                $data = json_decode(file_get_contents("php://input"), true);
                $controller->insertPaciente(
                    $data["DNI"],
                    $data["Nombre"],
                    $data["Direccion"],
                    $data["CodigoPostal"],
                    $data["Telefono"],
                    $data["Genero"],
                    $data["FechaNacimiento"],
                    $data["Correo"]
                );
                break;
            case "PUT":
                $data = json_decode(file_get_contents("php://input"), true);

                if (!$id) {
                    http_response_code(404);
                    echo json_encode(["error" => "Id no encontrado"]);
                    exit;
                }

                $controller->updatePaciente(
                    $id,
                    $data["DNI"],
                    $data["Nombre"],
                    $data["Direccion"],
                    $data["CodigoPostal"],
                    $data["Telefono"],
                    $data["Genero"],
                    $data["FechaNacimiento"],
                    $data["Correo"]
                );
                break;
            case "DELETE":
                if (!$id) {
                    http_response_code(404);
                    echo json_encode(["error" => "Id no encontrado"]);
                    exit;
                }
                $controller->deletePaciente($id);
                break;
            default:
                http_response_code(400);
                echo json_encode(["error" => "Metodo no permitido"]);
        }
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Ruta no encontrada"]);
    }
?>