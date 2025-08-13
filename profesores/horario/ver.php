<?php
require_once '../../includes/auth.php';
require_once '../../includes/db.php';

$alumno_id = $_SESSION['user_id'];
$horario = $conn->query("
    SELECT c.nombre, h.dia, h.hora_inicio, h.hora_fin 
    FROM horarios h
    JOIN cursos c ON h.curso_id = c.id
    JOIN matriculas m ON c.id = m.curso_id
    WHERE m.alumno_id = $alumno_id
");
?>

<table>
    <?php while ($clase = $horario->fetch_assoc()): ?>
    <tr>
        <td><?= $clase['nombre'] ?></td>
        <td><?= $clase['dia'] ?></td>
        <td><?= $clase['hora_inicio'] ?> - <?= $clase['hora_fin'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>