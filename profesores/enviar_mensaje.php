<?php
include '../../includes/db.php';
include '../../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO mensajes (remitente_id, destinatario_id, asunto, contenido) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $_SESSION['user_id'], $_POST['destinatario_id'], $_POST['asunto'], $_POST['contenido']);
    $stmt->execute();
    header("Location: bandeja.php?success=1");
}
?>

<form method="POST">
    <select name="destinatario_id" required>
        <?php 
        // Listar todos los usuarios excepto el actual
        $usuarios = $conn->query("SELECT id, username FROM usuarios WHERE id != " . $_SESSION['user_id']);
        while ($user = $usuarios->fetch_assoc()): 
        ?>
        <option value="<?= $user['id'] ?>"><?= $user['username'] ?></option>
        <?php endwhile; ?>
    </select>
    <input type="text" name="asunto" placeholder="Asunto" required>
    <textarea name="contenido" placeholder="Mensaje..." required></textarea>
    <button type="submit">Enviar</button>
</form>