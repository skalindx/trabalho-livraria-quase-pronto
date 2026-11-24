<?php
    class BD {
        public static function getConexao() {
            $conn = new PDO(
                "mysql:host=localhost;dbname=livraria-main",
                "root",
                "root"
            );

            return $conn;
        }
    }