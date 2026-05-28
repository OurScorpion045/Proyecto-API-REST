<?php
    class UsuarioModel {
        private $usuarioId;
        private $usuario;
        private $password;
        private $estado;

        function __construct($usuarioId = null, $usuario = "", $password = "", $estado = "") {
            $this->usuarioId = $usuarioId;
            $this->usuario = $usuario;
            $this->password = $password;
            $this->estado = $estado;
        }

        public function getUsuarioId() {
            return $this->usuarioId;
        }

        public function getUsuario() {
            return $this->usuario;
        }

        public function getPassword() {
            return $this->password;
        }

        public function getEstado() {
            return $this->estado;
        }

        public function setUsuarioId($nuevoUsuarioId) {
            $this->usuarioId = $nuevoUsuarioId;
        }

        public function setUsuario($nuevoUsuario) {
            $this->usuario = $nuevoUsuario;
        }

        public function setPassword($nuevoPassword) {
            $this->password = $nuevoPassword;
        }

        public function setEstado($nuevoEstado) {
            $this->estado = $nuevoEstado;
        }
    }
?>