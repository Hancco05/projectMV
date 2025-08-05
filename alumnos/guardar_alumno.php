<?php
include 'includes/db.php';

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];

$sql = "INSERT INTO alumnos (nombre, apellido, email) VALUES ('$nombre', '$apellido', '$email')";

if ($conn->query($sql) {
    echo "Alumno registrado!";
} else {
    echo "Error: " . $conn->error;
}
?>