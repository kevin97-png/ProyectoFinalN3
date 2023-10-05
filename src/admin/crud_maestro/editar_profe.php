<?php
include('../../accions/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {

        $id = $_POST['editId'];

        $correo = $_POST['editCorreo'];
        $nombre = $_POST['editNombre'];
        $apellidos = $_POST['editApellidos'];
        $direccion = $_POST['editDireccion'];
        $fecha_nacimiento = $_POST['editfecha_nacimiento'];


        $mysqli->query("UPDATE usuarios SET `nombre`='$nombre', `apellido`='$apellidos', `direccion`='$direccion', `fecha_nacimiento`=$fecha_nacimiento WHERE `id_user`=$id");

        $queryCheck = "SELECT COUNT('email') AS count FROM `login_user` WHERE `id_users` = $id";
        $resultCheck = $mysqli->query($queryCheck);
        
        if ($resultCheck->num_rows > 0) {
            $rowCheck = $resultCheck->fetch_assoc();
            $count = $rowCheck['count'];
        
            if ($count == 0) {
                $mysqli->query("INSERT INTO `login_user` (`id_users`, `email`) VALUES ($id, '$correo')");
            } else {
                $mysqli->query("UPDATE login_user SET `email`= '$correo' WHERE `id_users` = $id");
            }
        } else {
            echo "Error al verificar la existencia del registro.";
        }

        header('location: ./admin_views_profe.php');
    } catch (mysqli_sql_exception $e) {
        echo $e->getMessage();
    }
}

