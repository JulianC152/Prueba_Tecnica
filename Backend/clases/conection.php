<?php

class Conection extends PDO{
    private $hostBD = "localhost";
    private $nombreBD = "tienda";
    private $usuarioBD = "root";
    private $paswordBD = "";

    public function __construct()
    {
        try {
            parent:: __construct('mysql:host=' . $this->hostBD . '; dbname=' . $this->nombreBD . '; charset=utf8',
             $this->usuarioBD, $this->paswordBD, array(PDO:: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
        } catch (PDOException $e) {
            echo "Error " . $e->getMessage();
            exit;
        }   
    }
}



?>