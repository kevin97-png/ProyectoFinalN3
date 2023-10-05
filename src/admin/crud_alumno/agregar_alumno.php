<?php
include('../../accions/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $correo = $_POST['correo'];
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $direccion = $_POST['direccion'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];

        $query = "INSERT INTO usuarios (`dni`, `nombre`, `apellido`, `direccion`, `fecha_nacimiento`, `rol_id`) VALUES ('$dni', '$nombre', '$apellidos', '$direccion', '$fecha_nacimiento', 3)";
        $resultado = $mysqli->query($query);

        $dato_id = $mysqli->insert_id;
        session_start();
        $user = $_SESSION["user"];
        $rol_id = $user["rol_id"]; 
        if($rol_id ==  1){
            $rol = "admins";
         }
         
         if($rol_id ==  2){
            $rol = "maestro";
         }
         
         if($rol_id ==  3){
            $rol = "alumno";
         }

         $passHashRol = password_hash($rol, PASSWORD_DEFAULT);

        $querycontra = "INSERT INTO login_user (`id_users`, `email`, `pass`) VALUES ('$dato_id', '$correo', '$passHashRol')";
        $mysqli->query($querycontra);

        header('location: ./admin_views_alum.php');
        exit();
    } catch (mysqli_sql_exception $e) {
        echo $e->getMessage();
    }
}
?>
