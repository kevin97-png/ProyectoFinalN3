<?php

include('../../accions/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST);
    try {
        $materia =  $_POST['newMateria'];
        $profesor =  $_POST['newProfe'];

        $verificarMateria = "SELECT id_materia FROM `materias` WHERE `materia` = '$materia'";
        $result = $mysqli->query($verificarMateria);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id_materia = $row['id_materia'];
        } else {
            $queryInsertMateria = "INSERT INTO `materias`(`materia`) VALUES ('$materia')";
            $mysqli->query($queryInsertMateria);
            $id_materia = $mysqli->insert_id;
        }

        $updateQuery = "UPDATE `profesor_materias` SET `id_profemate`='$id_materia' WHERE `id_profesor`='$profesor'";
        $mysqli->query($updateQuery);

        header('location: ./admin_views_clases.php');
        exit();
    } catch (mysqli_sql_exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
