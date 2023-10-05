
<?php
session_start();
if ($_SESSION['user']['rol_id'] != 1) {
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dist//output.css">
    <script src="../../accions/modales.js" defer></script>
    <script src="../../accions/modal_salir.js" defer></script>
       <!-- Script Kit Fontawesome -->
    <script src="https://kit.fontawesome.com/c852b10d16.js" crossorigin="anonymous"></script> 
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
                <div class="border-t border-gray-700 mb-2 pt-4 text-sm">Administrador</div>
                <div class="border-t border-gray-700 pt-4 text-sm uppercase flex items-center justify-center">Menu Administracion</div>
                <div class="mt-6 space-y-2">
                    <a href="../permisos_usuarios/admin_views_permisos.php" class=" flex flex-row justify-center  group">
                       <!--  <img src="../../assets/permisos.svg" alt="llave" height="32px" width="32px"> -->
                       <i class="mr-3 text-lg fa-solid fa-user-gear "></i>
                        <p class="px-4"> Permisos </p>
                    </a>
                    <a href="../crud_maestro/admin_views_profe.php" class=" flex flex-row justify-center  group">
                       <!--  <img src="../../assets/profe.svg" alt="" height="32px" width="32px"> -->
                       <i class="mr-3 text-lg fa-solid fa-chalkboard-user"></i>
                        <p class=" px-4"> Maestros </p>
                    </a>
                    <a href="./admin_views_alum.php" class=" flex flex-row justify-center  group">
                      <!--   <img src="../../assets/alumno.svg" alt="" height="32px" width="32px"> -->
                      <i class="mr-3 text-lg fa-solid fa-graduation-cap"></i>
                        <p class="px-4"> Alumnos </p>
                    </a>
                    <a href="../crud_clases/admin_views_clases.php" class=" flex flex-row justify-center group">
                       <!--  <img src="../../assets/clases.svg" alt="" height="32px" width="32px"> -->
                       <i class="mr-3 text-lg fa-solid fa-tv"></i>
                        <p class="px-4"> Clases </p>
                    </a>
                </div>
            </div>
        </div>
        <div class="flex flex-col w-[calc(100%-15rem)] px-2">
            <nav class="flex h-10 w-full  flex-row justify-between items-center">
                <div class=" flex flex-row justify-items-stretch">
                    <a href="../admin_db.php" class="relative  flex flex-row items-center group">
                    <i class="fa-solid fa-bars"></i>
                        <p class="px-4"> Home </p>
                    </a>
                </div>
                <div class=" flex flex-row justify-between items-center">
                    <button id="buttonToggle" class="relative flex justify-center items-center group">
                        <p class="px-4"> Administrador </p>
                        <div id="toggleMenu" class=" absolute top-full min-w-full w-max bg-white mt-1 rounded hidden">

                            <ul class="text-left border none">
                            <a href="../perfil_admin.php">
                                    <li class="px-4 py-1 border-b flex flex-row gap-3"> <img src="../../assets/person.svg" alt="">
                                        Perfil
                                    </li>
                                </a>
                                <a href="../../accions/logout.php">
                                    <li class="px-4 py-1 border-b flex flex-row gap-3"><img src="../../assets/cerrar.svg" alt="">
                                        Salir
                                    </li>
                                </a>
                            </ul>
                        </div>
                        <i class="text-gray-300 fa-sharp fa-solid fa-chevron-down"></i>
                    </button>
                </div>
            </nav>
            <section class=" h-screen bg-blue-50">
                <div class="flex  w-full flex-row justify- items-center ">
                    <div class="flex h-10 w-full  flex-row justify-between items-center">
                        <h1 class="text-xl"> Lista de Alumno</h1>
                        <div>
                            <a href="../admin_db.php" class=" text-blue-500">Home</a>/
                            <span>Alumnos</span>
                        </div>
                    </div>
                </div>
                <div class="max-w-full mx-auto p-8 bg-white rounded shadow-lg mt-8">
                    <div class="flex justify-between mb-4">
                        <h2 class="text-2xl font-semibold">Informacion Alumnos</h2>
                        
                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer" id="abrirModal">Agregar Alumno</button>
                    </div>
                    <div class="modalAdd hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 z-50">
                        <div class="modal flex justify-center items-center h-screen">
                            <div class="bg-white p-8 rounded shadow-lg w-1/2">
                                <h2 class="text-2xl font-semibold mb-4">Agregar Alumno</h2>
                                <form action="./agregar_alumno.php" method="POST">
                                    <div class="mb-4">
                                        <label for="dni" class="block font-medium">DNI:</label>
                                        <input type="number" id="dni" name="dni" placeholder="Ingresa la Matricula" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                    </div>
                                    <div class="mb-4">
                                        <label for="correo" class="block font-medium">Correo Electrónico:</label>
                                        <input type="email" id="correo" name="correo" placeholder="Ingresa el email" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                    </div>
                                    <div class="mb-4">
                                        <label for="nombre" class="block font-medium">Nombre(s):</label>
                                        <input type="text" id="nombre" name="nombre" placeholder="Ingresa Nombre(s)" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                    </div>
                                    <div class="mb-4">
                                        <label for="apellidos" class="block font-medium">Apellido(s):</label>
                                        <input type="text" id="apellidos" name="apellidos" placeholder="Ingresa  Apellido(s)" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                    </div>
                                    <div class="mb-4">
                                        <label for="direccion" class="block font-medium">Dirección:</label>
                                        <input type="text" id="direccion" name="direccion" placeholder="Ingresa la direccion" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                    </div>
                                    <div class="mb-4">
                                        <label for="fecha_nacimiento" class="block font-medium">Fecha de
                                            Nacimiento:</label>
                                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                        </div>
                                        <div class="flex justify-end gap-2 mt-6">
                                            <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500" id="cerrarModalAdd">Cerrar</button>
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" id="createBtn">Crear</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="w-full border-collapse border mt-4">
                        <thead>
                            <tr class="bg-gray-200 ">
                                <th class="py-2 px-4 border-r">#</th>
                                <th class="py-2 px-4 border-r">DNI</th>
                                <th class="py-2 px-4 border-r">Nombre</th>
                                <th class="py-2 px-4 border-r">Apellidos</th>
                                <th class="py-2 px-4 border-r">Correo</th>
                                <th class="py-2 px-4 border-r">Dirección</th>
                                <th class="py-2 px-4 border-r">Fec. Nacimiento</th>
                                <th class="py-2 px-4 border-r">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            include('../../accions/connection.php');

                            $query  = "SELECT `id_user`,`dni`,`nombre`,`apellido`, `email`,`direccion`,`fecha_nacimiento` FROM usuarios LEFT Join login_user on id_user = id_users WHERE rol_id = 3;";
                            $result = $mysqli->query($query);

                            $style = 'bg-white';
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr class='$style '>";
                                echo "<td class='py-2 px-4 border-r'>" . $row['id_user'] . "</td>";
                                echo "<td class='py-2 px-4 border-r'>" . $row['dni'] . "</td>";
                                echo "<td class='py-2 px-4 border-r'>" . $row['nombre'] . "</td>";
                                echo "<td class='py-2 px-4 border-r'>" . $row['apellido'] . "</td>";
                                echo "<td class='py-2 px-4 border-r'>" . $row['email'] . "</td>";
                                echo "<td class='py-2 px-4 border-r'>" . $row['direccion'] . "</td>";
                                echo "<td class='py-2 px-4 border-r'>" . $row['fecha_nacimiento'] . "</td>";
                                echo "<td class='py-2 px-4 border-r flex items-center justify-center'>";
                                echo "<button class='text-blue-500 hover:underline flex items-center justify-center' onclick='openUpdateModal(this)'><img src='../../assets/edit.svg' alt='edit'></button>";
                                echo " <form action='./delete_alumno.php' method='post' class='flex items-center justify-center'>  <input type='hidden' class='editId'' name='editId'> <button class='deleteBtn text-red-500 hover:underline ml-2' ><img src='../../assets/delete.svg' alt='delete'></button> </form> ";
                                echo "</td>";
                                echo "</tr>";
                                $style = ($style == 'bg-white') ? 'bg-gray-200' : 'bg-white';
                            }
                            $result->free();
                            ?>
                        </tbody>
                    </table>
                    <div id="modalEdt" class="hidden fixed top-0 left-0 w-full h-full flex justify-center items-center bg-opacity-50 bg-black">
                        <div class="bg-white p-8 rounded shadow-lg w-1/2">
                            <h2 class="text-2xl font-semibold mb-4">Actualizar Alumno</h2>
                            <form action="./editar_alumno.php" method="POST">
                                <input type="hidden" id="editId" name="editId">
                                <div class="mb-2">
                                    <label for="editDni" class="block font-medium">DNI:</label>
                                    <input type="int" id="editDni" name="editDni" placeholder="Ingresa la Matricula" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                </div>
                                <div class="mb-2">
                                    <label for="editEmail" class="block font-medium">Correo Electrónico:</label>
                                    <input type="email" id="editEmail" name="editEmail" placeholder="Ingresa el email" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                </div>
                                <div class="mb-2">
                                    <label for="editNombre" class="block font-medium">Nombre(s):</label>
                                    <input type="text" id="editNombre" name="editNombre" placeholder="Ingresa Nombre(s)" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                </div>
                                <div class="mb-2">
                                    <label for="editApellidos" class="block font-medium">Apellido(s):</label>
                                    <input type="text" id="editApellidos" name="editApellidos" placeholder="Ingresa  Apellido(s)" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                </div>
                                <div class="mb-2">
                                    <label for="editDireccion" class="block font-medium">Dirección:</label>
                                    <input type="text" id="editDireccion" name="editDireccion" placeholder="Ingresa la direccion" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                </div>
                                <div class="mb-2">
                                    <label for="editFechaNacimiento" class="block font-medium">Fecha de
                                        Nacimiento:</label>
                                    <input type="date" id="editFechaNacimiento" name="editFechaNacimiento" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                </div>
                                <div class="flex justify-end gap-2 mt-6">
                                    <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500" id="cerrarModalEdit">Cerrar</button>
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" id="updateBtn">Guardar cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>