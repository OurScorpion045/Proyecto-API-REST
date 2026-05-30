<?php

    namespace src\models;
    use src\config\Database;
    use PDO;

    class UsuarioModel {
        private $database;
        private $connection;

        function __construct() {
            $this->database = new Database();
            $this->connection = $this->database->getConnection();
        }

        public function getAllUsuarios() {
            $sql = "SELECT * FROM usuarios ORDER BY UsuarioId";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function getUsuariosById($idUsuario) {
            $sql = "SELECT * FROM usuarios WHERE UsuarioId = :idUsuario";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function insertUsuario($usuario, $password, $estado) {
            $sql = "INSERT INTO usuarios(Usuario, Password, Estado) VALUES (:usuario, :password, :estado)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":usuario", $usuario);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":estado", $estado);
            return $stmt->execute();
        }

        public function updateUsuario($idUsuario, $usuario, $password, $estado) {
            $sql = "UPDATE usuarios SET Usuario = :usuario, Password = :password, Estado = :estado WHERE UsuarioId = :idUsuario";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
            $stmt->bindParam(":usuario", $usuario);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":estado", $estado);
            return $stmt->execute();
        }

        public function deleteUsuario($idUsuario) {
            $sql = "DELETE FROM usuarios WHERE UsuarioId = :idUsuario";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
            return $stmt->execute();
        }
    }
?>