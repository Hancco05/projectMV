<?php
include '../includes/db.php';
include '../includes/auth.php';

// Registrar pago
if ($_POST) {
    $stmt = $conn->prepare("INSERT INTO pagos (alumno_id, concepto, monto, fecha_vencimiento) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isds", $_POST['alumno_id'], $_POST['concepto'], $_POST['monto'], $_POST['fecha_vencimiento']);
    $stmt->execute();
}
?>

<!-- Formulario de registro -->
<form method="POST">
    <select name="alumno_id" required>
        <?php 
        $alumnos = $conn->query("SELECT id, nombre, apellido FROM alumnos");
        while ($a = $alumnos->fetch_assoc()): 
        ?>
        <option value="<?= $a['id'] ?>"><?= $a['nombre'] ?> <?= $a['apellido'] ?></option>
        <?php endwhile; ?>
    </select>
    <select name="concepto" required>
        <option value="Matrícula">Matrícula</option>
        <option value="Pensión">Pensión</option>
    </select>
    <input type="number" name="monto" step="0.01" min="0" placeholder="Monto" required>
    <input type="date" name="fecha_vencimiento" required>
    <button type="submit">Registrar</button>
</form>

<!-- Tabla de pagos -->
<table>
    <thead>
        <tr>
            <th>Alumno</th>
            <th>Concepto</th>
            <th>Monto</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $pagos = $conn->query("SELECT p.*, a.nombre, a.apellido FROM pagos p JOIN alumnos a ON p.alumno_id = a.id");
        while ($p = $pagos->fetch_assoc()):
        ?>
        <tr>
            <td><?= $p['nombre'] ?> <?= $p['apellido'] ?></td>
            <td><?= $p['concepto'] ?></td>
            <td>S/ <?= $p['monto'] ?></td>
            <td><span class="badge <?= $p['estado'] == 'Pagado' ? 'bg-success' : 'bg-danger' ?>"><?= $p['estado'] ?></span></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>