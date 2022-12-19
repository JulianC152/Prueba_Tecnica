<?php
    include '../clases/conection.php';   
    class Usuario{
        private $nombre;
        private $apellido;
        private $edad;
        private $foto;
        private $tipo_documento;
 

        public function __construct($nombre, $apellido, $edad, $foto, $tipo_documento){
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->edad = $edad;
            $this->foto = $foto;
            $this->tipo_documento = $tipo_documento;
        }

        /**
         * Get the value of nombre
         */ 
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */ 
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        /**
         * Get the value of apellido
         */ 
        public function getApellido()
        {
                return $this->apellido;
        }

        /**
         * Set the value of apellido
         *
         * @return  self
         */ 
        public function setApellido($apellido)
        {
                $this->apellido = $apellido;

                return $this;
        }

        /**
         * Get the value of edad
         */ 
        public function getEdad()
        {
                return $this->edad;
        }

        /**
         * Set the value of edad
         *
         * @return  self
         */ 
        public function setEdad($edad)
        {
                $this->edad = $edad;

                return $this;
        }

        /**
         * Get the value of foto
         */ 
        public function getFoto()
        {
                return $this->foto;
        }

        /**
         * Set the value of foto
         *
         * @return  self
         */ 
        public function setFoto($foto)
        {
                $this->foto = $foto;

                return $this;
        }

        /**
         * Get the value of tipo_documento
         */ 
        public function getTipo_documento()
        {
                return $this->tipo_documento;
        }

        /**
         * Set the value of tipo_documento
         *
         * @return  self
         */ 
        public function setTipo_documento($tipo_documento)
        {
                $this->tipo_documento = $tipo_documento;

                return $this;
        }

        public static function guardarUsuario()
        {
                $pdo = new conection();
                $sql = "INSERT INTO usuario (Nombre, Apellido, Edad, Foto, Tipo_Documento) 
                VALUES (:Nombre, :Apellido, :Edad, :Foto, :Tipo_Documento)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':Nombre', $_POST['Nombre']);
                $stmt->bindValue(':Apellido', $_POST['Apellido']);
                $stmt->bindValue(':Edad', $_POST['Edad']);
                $stmt->bindValue(':Foto', $_POST['Foto']);
                $stmt->bindValue(':Tipo_Documento', $_POST['Tipo_Documento']);
                //$stmt->bindValue(':rol', $_POST['rol']);
                $stmt->execute();
        }
        
        public static function obtenerUsuario($id){
                $pdo = new conection();
                $sql = $pdo->prepare("SELECT * FROM usuario WHERE id = $id");
                $sql->execute();
                $sql->setFetchMode(PDO::FETCH_ASSOC);
                echo json_encode($sql->fetchAll());
        }
        public static function obtenerUsuarios(){
                $pdo = new conection();
                $sql = $pdo->prepare("SELECT * FROM usuario");
                $sql->execute();
                $sql->setFetchMode(PDO::FETCH_ASSOC);
                echo json_encode($sql->fetchAll());
        }

        public function actualizarUsuario($id)
        {
                $pdo = new conection();
                $sql = "UPDATE usuario SET Nombre=:Nombre, Apellido=:Apellido, Edad=:Edad, Foto=:Foto, Tipo_Documento=:Tipo_Documento 
                WHERE $id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':Nombre', $_GET['Nombre']);
                $stmt->bindValue(':Apellido', $_GET['Apellido']);
                $stmt->bindValue(':Edad', $_GET['Edad']);
                $stmt->bindValue(':Foto', $_GET['Foto']);
                $stmt->bindValue(':Tipo_Documento', $_GET['Tipo_Documento']);
                $stmt->bindValue(':id', $_GET['id']);
                //$stmt->bindValue(':rol', $_POST['rol']);
                $stmt->execute();
        }

        public static function eliminarUsuario()
        {
            # code...
        }

    }
    


?>