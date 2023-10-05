<?php
require_once('../../accions/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST["editId"];
    var_dump($id);

    $deleteProfemate = "DELETE FROM profesor_materias WHERE id_profemate = $id";
    if ($mysqli->query($deleteProfemate)) {

        $deleteAlumate = "DELETE FROM alumnos_materias WHERE id_alumate = $id";
        if ($mysqli->query($deleteAlumate)) {

            $deleteMate = "DELETE FROM materias WHERE id_materia = $id";
            if ($mysqli->query($deleteMate)) {
                $selctUser = "DELETE FROM usuarios WHERE id_user = $id";
                $mysqli->query($selctUser);
                header('location: ./admin_views_profe.php');
            }
        }
    }
}