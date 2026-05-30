<?php
    namespace src\controllers;

    use PDOException;
    use src\models\PacienteModel;

    class PacienteController {
        private $model;

        public function __construct() {
            $this->model = new PacienteModel();
        }

        public function getAllPacientes() {
            try {
                http_response_code(200);
                $result = $this->model->getAllPacientes();
                echo json_encode($result);
            } catch (PDOException $e) {
                http_response_code(400);
                echo json_encode(["message" => "Error al obtener pacientes " . $e->getMessage()]);
            }
        }

        public function getPacienteById($id) {
            if ($id) {
                try {
                    http_response_code(200);
                    $result = $this->model->getPacienteById($id);
                    echo json_encode($result);
                } catch (PDOException $e) {
                    http_response_code(400);
                    echo json_encode(["message" => "Error al obtener paciente " . $e->getMessage()]);
                }
            } else {
                http_response_code(404);
                echo json_encode(["message" => "Id no valido"]);
            }

        }

        public function insertPaciente($dni, $nombre, $direccion, $codigoPostal, $telefono, $genero, $fechaNacimiento, $correo) {
            if (empty($dni) || empty($nombre) || empty($direccion) || empty($codigoPostal) || empty($telefono) || empty($genero) || empty($fechaNacimiento) || empty($correo)) {
                http_response_code(400);
                echo json_encode(["message" => "Campos obligatorios vacios"]);
                exit;
            }

            try {
                http_response_code(200);
                $this->model->insertPaciente($dni, $nombre, $direccion, $codigoPostal, $telefono, $genero, $fechaNacimiento, $correo);
                echo json_encode(["message" => "Paciente insertado correctamente"]);
            } catch (PDOException $e) {
                http_response_code(400);
                echo json_encode(["message" => "Error al insertar paciente " . $e->getMessage()]);
            }
        }

        public function updatePaciente($id, $dni, $nombre, $direccion, $codigoPostal, $telefono, $genero, $fechaNacimiento, $correo) {
            if (empty($dni) || empty($nombre) || empty($direccion) || empty($codigoPostal) || empty($telefono) || empty($genero) || empty($fechaNacimiento) || empty($correo)) {
                http_response_code(400);
                echo json_encode(["message" => "Campos obligatorios vacios"]);
                exit;
            }

            if ($id) {
                try {
                    http_response_code(200);
                    $this->model->updatePaciente($id, $dni, $nombre, $direccion, $codigoPostal, $telefono, $genero, $fechaNacimiento, $correo);
                    echo json_encode(["message" => "Informacion de paciente actualizada correctamente"]);
                } catch (PDOException $e) {
                    http_response_code(400);
                    echo json_encode(["message" => "Error al actualizar informacion de paciente " . $e->getMessage()]);
                }
            } else {
                http_response_code(404);
                echo json_encode(["message" => "Id no valido"]);
            }
        }
    }
?>