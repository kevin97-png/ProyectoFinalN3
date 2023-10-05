
<?php
require_once('../../accions/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST["editId"];

    $deleteprofem = "DELETE FROM profesor_materias WHERE id_profesor = $id";
    if ($mysqli->query($deleteprofemate )) {
    } else {
        echo "Error al eliminar alumnos relacionados: " . $mysqli->error;
    }
    $deleteAlumate = "DELETE FROM alumnos_materias WHERE id_alumate = $id";
    if ($mysqli->query($deleteAlumate)) {
        $deleteMate = "DELETE FROM materias WHERE id_materia = $id";
        if ($mysqli->query($deleteMate)) {
            header('location: ./admin_views_profe.php');
        } else {
            echo "Error al eliminar usuarios relacionadas: " . $mysqli->error;
        }
    } else {
        echo "Error al eliminar profesores relacionados: " . $mysqli->error;
    }
} else {
    echo "Error en la solicitud de eliminación.";
}

$mysqli->close();
