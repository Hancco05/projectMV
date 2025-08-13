<?php
require_once '../../includes/db.php';

$payload = file_get_contents('php://input');
$event = json_decode($payload);

if ($event->type == 'payment_intent.succeeded') {
    $alumno_id = $event->data->object->metadata->alumno_id;
    $monto = $event->data->object->amount / 100; // Convertir a USD
    
    $conn->query("INSERT INTO pagos (alumno_id, concepto, monto, metodo) 
                 VALUES ($alumno_id, 'Pago Online', $monto, 'Stripe')");
}
http_response_code(200);
?>