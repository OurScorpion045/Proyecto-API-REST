<?php
    namespace src\controllers;

    use src\models\UsuarioModel;
    use src\config\Database;
    use PDO;
    use PDOException;

    class UsuarioController {
        private $database;
        private $connection;

        function __construct() {
            $this->database = new Database();
            $this->connection = $this->database->getConnection();
        }

        public function getAllUsuarios() {
            $sql = "SELECT * FROM usuarios ORDER BY usuarioId DESC";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function getUsuariosById($id) {
            $sql = "SELECT * FROM usuarios WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        }
    }
?>