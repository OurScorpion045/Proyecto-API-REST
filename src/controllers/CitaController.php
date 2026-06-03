<?php
    namespace src\controllers;

use PDOException;
use src\models\CitaModel;

    class CitaController {
        private $model;

        public function __construct() {
            $this->model = new CitaModel();
        }

        public function getAllCitas() {
            try {
                http_response_code(200);
                $result = $this->model->getAllCitas();
                echo json_encode($result);
            } catch (PDOException $e) {
                http_response_code(400);
                echo json_encode(["message" => "Error al obtener citas"]);
            }
        }

        public function getCitaById($id) {
            if ($id) {
                try {
                    http_response_code(200);
                    $result = $this->model->getCitaById($id);
                    echo json_encode($result);
                } catch (PDOException $e) {
                    http_response_code(400);
                    echo json_encode(["message" => "Error al obtener cita"]);
                }
            } else {
                http_response_code(404);
                echo json_encode(["message" => "Id no encontrado"]);
            }
        }

        public function insertCita($pacienteId, $fecha, $horaInicio, $horaFin, $estado, $motivo) {
            if (empty($pacienteId) || empty($fecha) || empty($horaInicio) || empty($horaFin) || empty($estado) || empty($motivo)) {
                http_response_code(400);
                echo json_encode(["message" => "Campos obligatorios vacios"]);
                exit;
            } 

            try {

            } catch (PDOException $e) {
                http_response_code(400);
                echo json_encode(["message" => "Error al insertar cita"]);
            }
        }

        public function updateCita($id, $pacienteId, $fecha, $horaInicio, $horaFin, $estado, $motivo) {
            if (empty($pacienteId) || empty($fecha) || empty($horaInicio) || empty($horaFin) || empty($estado) || empty($motivo)) {
                http_response_code(400);
                echo json_encode(["message" => "Campos obligatorios vacios"]);
                exit;
            }
            
            if ($id) {
                try {
                    http_response_code(200);
                    $this->model->updateCita($id, $pacienteId, $fecha, $horaInicio, $horaFin, $estado, $motivo);
                    echo json_encode(["message" => "Informacion de cita actualizada"]);
                } catch (PDOException $e) {
                    http_response_code(400);
                    echo json_encode(["message" => "Error al actualizar informacion de cita"]);
                }
            }
        }

        public function deleteCita($id) {
            if ($id) {
                try {
                    http_response_code(200);
                    $this->model->deleteCita($id);
                    echo json_encode(["message" => "Cita eliminada correctamente"]);
                } catch (PDOException $e) {
                    http_response_code(400);
                    echo json_encode(["message" => "Error al eliminar cita"]);
                }
            } else {
                http_response_code(400);
                echo json_encode(["message" => "Id no encontrado"]);
            }
        }
    }
?>