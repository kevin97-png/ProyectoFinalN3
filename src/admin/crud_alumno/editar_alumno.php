<?php
require_once('../../accions/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['editId'];
    $email = $_POST['editEmail'];
    $nombre = $_POST['editNombre'];
    $apellidos = $_POST['editApellidos'];
    $direccion = $_POST['editDireccion'];
    $fecha_nacimiento = $_POST['editFechaNacimiento'];

    $mysqli->query("UPDATE usuarios SET `nombre`='$nombre', `apellido`='$apellidos', `direccion`='$direccion', `fecha_nacimiento`='$fecha_nacimiento' WHERE `id_user` = $id");

    header('location: ./admin_views_alum.php');
} else {
    echo "fallo";
}
