<?php
    namespace src\controllers;
    use src\models\UsuarioModel;
    use PDOException;

    class UsuarioController {
        private $model;

        function __construct() {
            $this->model = new UsuarioModel();
        }

        function getAllUsuarios() {
            try {
                $result = $this->model->getAllUsuarios();
                echo json_encode($result);
            } catch (PDOException $e) {
                echo json_encode(["message" => "Error al obtener usuarios "]);
            }
        }

        function getUsuarioById($idUsuario) {
            if ($idUsuario) {
                try {
                    $result = $this->model->getUsuariosById($idUsuario);
                    http_response_code(201);
                    echo json_encode($result);
                } catch (PDOException $e) {
                    http_response_code(400);
                    echo json_encode(["message" => "Error al obtener usuario "]);
                }
            } else {
                http_response_code(400);
                echo json_encode(["message" => "Id no valido"]);
            }
        }

        function insertUsuario($usuario, $password, $estado) {
            if (empty($usuario) || empty($password) || empty($estado)) {
                http_response_code(400);
                echo json_encode(["message" => "Campos obligatorios vacios"]);
            }

            $passwordEncripted = password_hash($password, PASSWORD_DEFAULT);

            try {
                $this->model->insertUsuario($usuario, $passwordEncripted, $estado);
                http_response_code(201);
                echo json_encode(["message" => "Usuario insertado correctamente"]);
            } catch (PDOException $e) {
                http_response_code(400);
                echo json_encode(["message" => "Error al insertar usuario"]);
            }
        }

        function updateUsuario($idUsuario, $usuario, $password, $estado) {
            if (empty($idUsuario) || empty($usuario) || empty($password) || empty($estado)) {
                http_response_code(400);
                echo json_encode(["message" => "Campos obligatorios vacios"]);
            }

            try {
                $this->model->updateUsuario($idUsuario, $usuario, $password, $estado);
                http_response_code(201);
                echo json_encode(["message" => "Usuario actualizado correctamente"]);
            } catch (PDOException $e) {
                http_response_code(400);
                echo json_encode(["message" => "Error al actualizar usuario "]);
            }
        }

        function deleteUsuario($idUsuario) {
            if (empty($idUsuario)) {
                http_response_code(400);
                echo json_encode(["message" => "Id no valido"]);
            }    
        
        try {
            $this->model->deleteUsuario($idUsuario);
            http_response_code(201);
            echo json_encode(["message" => "Usuario eliminado"]);
            } catch (PDOException $e) {
                http_response_code(400);
                echo json_encode(["message" => "Error al eliminar usuario"]);
            }
        }
    }
?>