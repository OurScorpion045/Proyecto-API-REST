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
                json_encode($result);
            } catch (PDOException $e) {
                json_encode(["message" => "Error al obtener usuarios " . $e->getMessage()]);
            }
        }

        function getUsuarioById($idUsuario) {
            if ($idUsuario) {
                try {
                    $result = $this->model->getUsuariosById($idUsuario);
                    http_response_code(201);
                    json_encode($result);
                } catch (PDOException $e) {
                    http_response_code(400);
                    json_encode(["message" => "Error al obtener usuario " . $e->getMessage()]);
                }
            } else {
                http_response_code(400);
                json_encode(["message" => "Id no valido"]);
            }
        }

        function insertUsuario($usuario, $password, $estado) {
            if (empty($usuario) || empty($password) || empty($estado)) {
                http_response_code(400);
                json_encode(["message" => "Campos obligatorios vacios"]);
            }

            try {
                $this->model->insertUsuario($usuario, $password, $estado);
                http_response_code(201);
                json_encode(["message" => "Usuario insertado correctamente"]);
            } catch (PDOException $e) {
                http_response_code(400);
                json_encode(["message" => "Error al insertar usuario " . $e->getMessage()]);
            }
        }

        function updateUsuario($idUsuario, $usuario, $password, $estado) {
            if (empty($idUsuario) || empty($usuario) || empty($password) || empty($estado)) {
                http_response_code(400);
                json_encode(["message" => "Campos obligatorios vacios"]);
            }

            try {
                $this->model->updateUsuario($idUsuario, $usuario, $password, $estado);
                http_response_code(201);
                json_encode(["message" => "Usuario actualizado correctamente"]);
            } catch (PDOException $e) {
                http_response_code(400);
                json_encode(["message" => "Error al actualizar usuario " . $e->getMessage()]);
            }
        }

        function deleteUsuario($idUsuario) {
            if (empty($idUsuario)) {
                http_response_code(400);
                json_encode(["message" => "Id no valido"]);
            }    
        
        try {
            $this->model->deleteUsuario($idUsuario);
            http_response_code(201);
            json_encode(["message" => "Usuario eliminado"]);
            } catch (PDOException $e) {
                http_response_code(400);
                json_encode(["message" => "Error al eliminar usuario"]);
            }
        }
    }
?>