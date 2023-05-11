<?php
    //Recibimos las peticiones de Usuario
    header("Content-Type: application/json");
    include ("../clases/Class_Usuario.php");
    $pdo = new conection(); 
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST': //Guardar
            $usuario = new Usuario($_POST["Nombre"], $_POST["Apellido"], 
                                    $_POST["Edad"], $_POST["Foto"], $_POST["Tipo_Documento"], $_POST["id_rol"]);
            $usuario ->guardarUsuario();
        break;
        case 'GET': //Mostrar
            if(isset($_GET['id'])){
                Usuario::obtenerUsuario($_GET['id']);
            }else{
                Usuario::obtenerUsuarios();
            }
        break;
        case 'PUT': //Actualizar
            $usuario = new Usuario($_GET["Nombre"], $_GET["Apellido"], 
                                    $_GET["Edad"], $_GET["Foto"], $_GET["Tipo_Documento"], $_GET["id_rol"]);
            $usuario->actualizarUsuario($_GET['id']);

            echo "Campo con id: ".$_GET['id']. " Se actualizo"; 
        break;
        case 'DELETE': //Eliminar
            $sql = "DELETE FROM usuario
            WHERE id =:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $_GET['id']);
            $stmt->execute();
            echo "Campo con id: ".$_GET['id']. " Se elimino"; 
        break;
    }
?>