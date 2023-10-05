<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['rol_id'] != 1) {
    header('Location: login.php');
    exit();
}
include('../../accions/connection.php');

$data = "SELECT login_user.*, usuarios.*
         FROM login_user
         INNER JOIN usuarios ON login_user.id_users = usuarios.id_user";

$resulta = $mysqli->query($data);

$rolquery = "SELECT * FROM roles";
$resulrol = $mysqli->query($rolquery);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dist//output.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Script Kit Fontawesome -->
    <script src="https://kit.fontawesome.com/c852b10d16.js" crossorigin="anonymous"></script>
    <!-- Modal -->
    <script src="../../accions/modalPermisos.js" defer></script>
    <script src="../../accions/modal_salir.js" defer></script>
    <title>Administracion</title>
</head>

<body> 
    <div class="w-screen h-screen flex">
        <div class="flex h-full bg-gray-900 text-white w-60  py-6 flex-col justify-between">
            <div class="px-6">
                <div class="flex flex-row justify-center items-center width=50px pb-2">
                    <img src="../../assets/logo-university.png" alt="Logo" class="mx-auto max-w-full " width="50px" height="50px mb-">
                    <span class="block font-semibold text-gray-300">Universidad</span>
                </div>
                <div class="border-t border-gray-600 mb-2 pt-4 text-sm">Administrador</div>
                <div class="border-t border-gray-600  pt-4 text-sm uppercase flex items-center justify-center">Menu Administracion</div>
                <div class="mt-6 space-y-2">
                    <a href="./admin_views_permisos.php" class=" flex flex-row justify-center  group">
                       <i class="fa-solid fa-user-gear mr-3 text-lg "></i>
                        <p class="px-4"> Permisos </p>
                    </a>
                    <a href="../crud_maestro/admin_views_profe.php" class=" flex flex-row justify-center  group">
                    <i class="fa-solid fa-chalkboard-user mr-3 text-lg"></i>
                        <p class=" px-4"> Maestros </p>
                    </a>
                    <a href="../crud_alumno/admin_views_alum.php" class=" flex flex-row justify-center  group">
                    <i class="fa-solid fa-graduation-cap mr-3 text-lg"></i>
                        <p class="px-4"> Alumnos </p>
                        <a href="../crud_clases/admin_views_clases.php" class=" flex flex-row justify-center group">
                        <i class="fa-solid fa-tv  mr-3 text-lg"></i>
                            <p class="px-4"> Clases </p>
                        </a>
                </div>
            </div>
        </div>
        <div class="flex flex-col w-[calc(100%-15rem)] px-2">
            <nav class="flex h-10 w-full  flex-row justify-between items-center">
                <div class=" flex flex-row justify-items-stretch">
                    <a href="../admin_db.php" class="relative  flex flex-row items-center group">
                    <i class="fa-solid fa-house"></i>
                        <p class="px-4 text-gray-500"> Home </p>
                    </a>
                </div>
                <div class=" flex flex-row justify-between items-center">
                <button id="buttonToggle" class="relative flex justify-center items-center group">
                        <p class="px-4 text-gray-500"> Administrador </p>
                        <div id="toggleMenu" class=" absolute top-full min-w-full w-max bg-white mt-1 rounded hidden">
                            <ul class="text-left border none">
                            <a href="../perfil_admin.php">
                                    <li class="px-4 py-1 border-b flex flex-row gap-3"> <i class="fa-solid fa-user mr-3"></i>
                                        Perfil
                                    </li>
                                </a>
                                <a href="../../accions/logout.php">
                                    <li class="px-4 py-1 border-b flex flex-row gap-3"><i class="fa-solid fa-right-from-bracket  mr-3"></i>
                                        Salir
                                    </li>
                                </a>
                            </ul>
                        </div>
                        <i class="fa-sharp fa-solid fa-chevron-down  text-gray-300"></i>
                    </button>
                </div>
            </nav>
            <section class=" h-screen bg-blue-50">
                <div class="flex  w-full flex-row justify- items-center    ">
                    <div class="flex h-10 w-full  flex-row justify-between items-center">
                        <h1 class="text-2xl font-medium"> Lista de Permisos</h1>
                        <div>
                            <a href="../admin_db.php" class=" text-blue-500">Home</a>/
                            <span>permisos</span>
                        </div>
                    </div>
                </div>
                <div class="hidden fixed inset-0 flex justify-center items-center z-50" id="modal">
                    <div class="bg-white p-8 rounded-lg shadow-md w-96">
                        <h2 class="text-2xl font-semibold mb-4">Editar Permisos</h2>
                        <form action="./editar_permisos.php" method="post" class="text" id="permisosForm">
                            <input type="hidden" id="usuario_id" name="usuario_id" value="">
                            <label for="email" class="block mb-2">Email del Usuario:</label>
                            <input type="email" id="email" name="email" class="w-full p-2 border rounded mb-4" value="">

                            <label for="permiso" class="block mb-2">Permiso:</label>
                            <select id="permiso" name="permiso" class="w-full p-2 border rounded mb-4">
                                <option selected value="">Seleciona materia</option>
                                <?php
                                if ($resulrol->num_rows > 0) {
                                    while ($row = $resulrol->fetch_assoc()) {
                                ?>
                                        <option value="<?= $row['id_rol'] ?>"><?= $row['rol'] ?>
                                        </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                            <button type="button" id="cerrar" class="bg-gray-400 text-white px-4 py-2 rounded mr-2">Cerrar</button>
                            <button type="submit" id="guardarCambios" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar
                                Cambios</button>
                        </form>
                    </div>
                </div>
                <div class="container mx-auto p-8 bg-white">
                    <h2 class="text-2xl font-semibold mb-4">Informacion de Permisos</h2>
                    <table class="w-full border">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="py-2 px-4">Email/Usuario</th>
                                <th class="py-2 px-4">Permiso</th>
                                <th class="py-2 px-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="infoUser">

                            <?php
                            $style = 'bg-white';

                            if ($resulta->num_rows > 0) {
                                while ($row = $resulta->fetch_assoc()) {
                                    echo "<tr class='$style '>";
                                    echo "<td class='py-2 px-4 border-r'>" . $row['email'] . "</td>";
                                    echo '<td class="py-2 px-4 border-r">';
                                    if ($row['rol_id'] == 1) {
                                        echo 'Administrador';
                                    } elseif ($row['rol_id'] == 2) {
                                        echo 'Maestro';
                                    } elseif ($row['rol_id'] == 3) {
                                        echo 'Alumno';
                                    } else {
                                        echo 'Rol Desconocido';
                                    }
                                    echo '</td>';

                                    echo '<td class="py-2 px-4 border-r flex flex-row">';
                                    echo '<button class="flex items-center justify-center w-full px-2 py-1 rounded editar" onclick="editar(this)" ><img src="../../assets/edit.svg" alt=""</button>';
                                    echo '</td>';
                                    echo '</tr>';
                                    $style = ($style == 'bg-white') ? 'bg-gray-200' : 'bg-white';
                                }
                            } else {
                                echo "<tr class='$style '>";
                                echo '<td class="py-2 px-4 border-r" colspan="7">No se encontraron usuarios</td>';
                                echo '</tr>';
                            }

                            $mysqli->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</body>

</html>