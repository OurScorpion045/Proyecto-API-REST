<?php

    namespace src\models;
    use src\config\Database;
    use PDO;

    class CitaModel {
        private $database;
        private $connection;

        public function __construct() {
            $this->database = new Database();
            $this->connection = $this->database->getConnection();
        }

        public function getAllCitas() {
            $sql = "SELECT * FROM citas ORDER BY CitaId DESC";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function getCitaById($id) {
            $sql = "SELECT * FROM citas WHERE CitaId = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function insertCita($pacienteId, $fecha, $horaInicio, $horaFin, $estado, $motivo) {
            $sql = "INSERT INTO citas(PacienteId, Fecha, HoraInicio, HoraFin, Estado, Motivo) VALUES (:pacienteId, :fecha, :horaInicio, :horaFin, :estado, :motivo)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":pacienteId", $pacienteId, PDO::PARAM_INT);
            $stmt->bindParam(":fecha", $fecha);
            $stmt->bindParam(":horaInicio", $horaInicio);
            $stmt->bindParam(":horaFin", $horaFin);
            $stmt->bindParam(":estado", $estado);
            $stmt->bindParam(":motivo", $motivo);
            return $stmt->execute();
        }

        public function updateCita($id, $pacienteId, $fecha, $horaInicio, $horaFin, $estado, $motivo) {
            $sql = "UPDATE citas SET PacienteId = :pacienteId, Fecha = :fecha, HoraInicio = :horaInicio, HoraFin = :horaFin, Estado = :estado, Motivo = :motivo WHERE CitaId = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":pacienteId", $pacienteId, PDO::PARAM_INT);
            $stmt->bindParam(":fecha", $fecha);
            $stmt->bindParam(":horaInicio", $horaInicio);
            $stmt->bindParam(":horaFin", $horaFin);
            $stmt->bindParam(":estado", $estado);
            $stmt->bindParam(":motivo", $motivo);
            return $stmt->execute();
        }

        public function deleteCita($id) {
            $sql = "DELETE FROM citas WHERE PacienteId = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            return $stmt->execute();
        }
    }
?>