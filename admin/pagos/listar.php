<?php
require_once '../../includes/auth.php';
require_once '../../includes/db.php';

if ($_SESSION['user_rol'] !== 'admin') {
    header("Location: /sistema_escolar/index.php");
    exit();
}

$pagos = $conn->query("SELECT p.*, a.nombre, a.apellido FROM pagos p JOIN alumnos a ON p.alumno_id = a.id");
?>

<table>
    <thead>
        <tr>
            <th>Alumno</th>
            <th>Concepto</th>
            <th>Monto</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($pago = $pagos->fetch_assoc()): ?>
        <tr>
            <td><?= "{$pago['nombre']} {$pago['apellido']}" ?></td>
            <td><?= $pago['concepto'] ?></td>
            <td><?= number_format($pago['monto'], 2) ?></td>
            <td><?= $pago['fecha'] ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>