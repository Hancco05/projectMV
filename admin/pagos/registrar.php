<?php
include '../../includes/auth.php';
include '../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO pagos (alumno_id, concepto, monto) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $_POST['alumno_id'], $_POST['concepto'], $_POST['monto']);
    $stmt->execute();
}
?>

<form method="POST">
    <select name="alumno_id" required>
        <?php
        $alumnos = $conn->query("SELECT id, nombre FROM alumnos");
        while ($a = $alumnos->fetch_assoc()):
        ?>
            <option value="<?= $a['id'] ?>"><?= $a['nombre'] ?></option>
        <?php endwhile; ?>
    </select>
    <input type="text" name="concepto" placeholder="Matrícula/Pensión" required>
    <input type="number" name="monto" step="0.01" required>
    <button type="submit">Registrar</button>
</form>