<?php
    namespace src\routes;
    use src\controllers\CitaController;

    $controller = new CitaController();

    $method = $_SERVER['REQUEST_METHOD'];
    $uri = explode("/", trim($_SERVER['REQUEST_URI'], "/"));
    $id = end($uri);

    switch ($method) {
        case "GET":
            if (is_numeric($id)) {
                $controller->getCitaById($id);
            } else {
                $controller->getAllCitas();
            }
            break;
        case "POST":
            $data = json_decode(file_get_contents("php://input"), true);
            $controller->insertCita(
                $data["CitaId"],
                $data["PacienteId"],
                $data["Fecha"],
                $data["HoraInicio"],
                $data["HoraFin"],
                $data["Estado"],
                $data["Motivo"]
            );
            break;
        case "PUT":
            if (is_numeric($id)) {
                $data = json_decode(file_get_contents("php://input"), true);
                $controller->updateCita(
                    $id,
                    $data["CitaId"],
                    $data["PacienteId"],
                    $data["Fecha"],
                    $data["HoraInicio"],
                    $data["HoraFin"],
                    $data["Estado"],
                    $data["Motivo"]
                );
            break;
            } else {
                http_response_code(400);
                json_encode(["error" => "Id no valido"]);
            }
    }
?>