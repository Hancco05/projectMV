<?php
include '../../includes/auth.php';
$alumno_id = $_SESSION['user_id'];
$pagos = $conn->query("SELECT * FROM pagos WHERE alumno_id = $alumno_id");
?>

<table>
    <?php while ($pago = $pagos->fetch_assoc()): ?>
    <tr>
        <td><?= $pago['concepto'] ?></td>
        <td>S/ <?= $pago['monto'] ?></td>
        <td><?= $pago['fecha'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>