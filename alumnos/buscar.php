<?php
include '../includes/db.php';

$query = "";
$resultados = [];
if (isset($_GET['q'])) {
    $query = $conn->real_escape_string($_GET['q']);
    $sql = "SELECT * FROM alumnos WHERE 
            nombre LIKE '%$query%' OR 
            apellido LIKE '%$query%' OR 
            dni LIKE '%$query%'";
    $resultados = $conn->query($sql);
}
?>

<form method="GET" class="mb-4">
    <input type="text" name="q" value="<?= htmlspecialchars($query) ?>" placeholder="Buscar alumno...">
    <button type="submit">Buscar</button>
</form>

<?php if ($resultados && $resultados->num_rows > 0): ?>
<table>
    <?php while ($row = $resultados->fetch_assoc()): ?>
    <tr>
        <td><?= $row['nombre'] ?></td>
        <td><?= $row['apellido'] ?></td>
        <td><?= $row['dni'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<?php endif; ?>