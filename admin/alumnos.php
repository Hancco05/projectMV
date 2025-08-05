<?php
include '../includes/db.php';
include '../includes/auth.php';

// Verificar si es administrador
if ($_SESSION['user_rol'] != 'admin') {
    header("Location: ../index.php?error=permisos");
    exit();
}

// Consulta SQL
$sql = "SELECT * FROM alumnos";
$result = $conn->query($sql);
?>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nombre'] ?></td>
            <td><?= $row['apellido'] ?></td>
            <td><?= $row['email'] ?></td>
            <td>
                <a href="editar_alumno.php?id=<?= $row['id'] ?>" class="btn btn-warning">Editar</a>
                <a href="eliminar_alumno.php?id=<?= $row['id'] ?>" class="btn btn-danger">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>