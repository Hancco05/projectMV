<?php
use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';

function enviarEmail($destinatario, $asunto, $cuerpo) {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tucorreo@gmail.com';
    $mail->Password = 'tucontraseña';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('notificaciones@colegio.com', 'Sistema Escolar');
    $mail->addAddress($destinatario);
    $mail->Subject = $asunto;
    $mail->Body = $cuerpo;

    if (!$mail->send()) {
        error_log("Error al enviar email: " . $mail->ErrorInfo);
        return false;
    }
    return true;
}

// Ejemplo de uso (notificación de pago)
enviarEmail(
    'padre@email.com', 
    'Pensión Registrada', 
    'Se ha registrado su pago de S/ 500.00 para el mes de Julio.'
);