<?php
require_once '../../includes/db.php';
require_once '../../vendor/autoload.php'; // Google API Client

// Configuración básica (debes reemplazar con tus credenciales)
$client = new Google_Client();
$client->setAuthConfig('credentials.json');
$client->addScope(Google_Service_Calendar::CALENDAR);

// Lógica de sincronización aquí
// ...
?>