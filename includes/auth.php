<?php
session_start();
include 'db.php';

function login($username, $password) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT id, password, rol FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_rol'] = $user['rol']; // admin, profesor, alumno
            return true;
        }
    }
    return false;
}

function logout() {
    session_destroy();
    header("Location: ../index.php");
}
?>