<?php
include '../includes/db.php';
include '../includes/auth.php';

if ($_SESSION['user_rol'] != 'profesor') {
    header("Location: ../index.php");
    exit();
}

// Obtener cursos asignados al profesor
$profesor_id = $_SESSION['user_id'];
$sql = "SELECT c.id, c.nombre FROM cursos c WHERE c.profesor_id = $profesor_id";
$cursos = $conn->query($sql);
?>

<form action="guardar_nota.php" method="POST">
    <select name="curso_id" required>
        <?php while ($curso = $cursos->fetch_assoc()): ?>
        <option value="<?= $curso['id'] ?>"><?= $curso['nombre'] ?></option>
        <?php endwhile; ?>
    </select>
    
    <select name="alumno_id" required>
        <?php 
        $alumnos = $conn->query("SELECT id, nombre, apellido FROM alumnos");
        while ($alumno = $alumnos->fetch_assoc()): 
        ?>
        <option value="<?= $alumno['id'] ?>"><?= $alumno['nombre'] ?> <?= $alumno['apellido'] ?></option>
        <?php endwhile; ?>
    </select>
    
    <input type="number" name="nota" step="0.01" min="0" max="20" placeholder="Nota" required>
    <button type="submit">Guardar</button>
</form>