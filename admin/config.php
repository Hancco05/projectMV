<?php
include '../includes/db.php';
include '../includes/auth.php';

// Actualizar configuración
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_colegio = $conn->real_escape_string($_POST['nombre_colegio']);
    $conn->query("UPDATE config SET valor = '$nombre_colegio' WHERE clave = 'nombre_colegio'");
    header("Location: config.php?success=1");
}

// Obtener valores actuales
$config = $conn->query("SELECT * FROM config")->fetch_all(MYSQLI_ASSOC);
?>

<form method="POST">
    <?php foreach ($config as $item): ?>
    <div class="form-group">
        <label><?= ucfirst(str_replace('_', ' ', $item['clave'])) ?></label>
        <input type="text" name="<?= $item['clave'] ?>" value="<?= htmlspecialchars($item['valor']) ?>">
    </div>
    <?php endforeach; ?>
    <button type="submit">Guardar</button>
</form>