<?php

    namespace src\models;
    use src\config\Database;

    class PacienteModel {
        private $database;
        private $connection;

        public function __construct() {
            $this->database = new Database();
            $this->connection = $this->database->getConnection();
        }

        public function getAllPacientes() {
            $sql = "SELECT * FROM pacientes ORDER BY PacienteId";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function getPacienteById($id) {
            $sql = "SELECT * FROM pacientes WHERE PacienteId = :PacienteId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":PacienteId", $id);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function insertPaciente($dni, $nombre, $direccion, $codigoPostal, $telefono, $genero, $fechaNacimiento, $correo) {
            $sql = "INSERT INTO pacientes(DNI, Nombre, Direccion, CodigoPostal, Telefono, Genero, FechaNacimiento, Correo) VALUES (:DNI, :Nombre, :Direccion, :CodigoPostal, :Telefono, :Genero, :FechaNacimiento, :Correo)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":DNI", $dni);
            $stmt->bindParam(":Nombre", $nombre);
            $stmt->bindParam(":Direccion", $direccion);
            $stmt->bindParam(":CodigoPostal", $codigoPostal);
            $stmt->bindParam(":Telefono", $telefono);
            $stmt->bindParam(":Genero", $genero);
            $stmt->bindParam(":FechaNacimiento", $fechaNacimiento);
            $stmt->bindParam(":Correo", $correo);
            return $stmt->execute();
        }

        public function updatePaciente($id, $dni, $nombre, $direccion, $codigoPostal, $telefono, $genero, $fechaNacimiento, $correo) {
            $sql = "UPDATE pacientes SET DNI = :DNI, Nombre = :Nombre, Direccion = :Direccion, CodigoPostal = :CodigoPostal, Telefono = :Telefono, Genero = :Genero, FechaNacimiento = :FechaNacimiento, Correo = :Correo WHERE PacienteId = :PacienteId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":PacienteId", $id);
            $stmt->bindParam(":DNI", $dni);
            $stmt->bindParam(":Nombre", $nombre);
            $stmt->bindParam(":Direccion", $direccion);
            $stmt->bindParam(":CodigoPostal", $codigoPostal);
            $stmt->bindParam(":Telefono", $telefono);
            $stmt->bindParam(":Genero", $genero);
            $stmt->bindParam(":FechaNacimiento", $fechaNacimiento);
            $stmt->bindParam(":Correo", $correo);
            return $stmt->execute();
        }

        public function deletePaciente($id) {
            $sql = "DELETE FROM pacientes WHERE PacienteId = :PacienteId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":PacienteId", $id);
            return $stmt->execute();
        }
    }
?>