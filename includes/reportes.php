<?php
require('../vendor/autoload.php'); // Instala FPDF con: composer require setasign/fpdf

function generarReporteAlumnosPDF() {
    global $conn;
    
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Reporte de Alumnos');
    $pdf->Ln(20);
    
    // Cabecera de tabla
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 10, 'ID', 1);
    $pdf->Cell(60, 10, 'Nombre', 1);
    $pdf->Cell(60, 10, 'Email', 1);
    $pdf->Ln();
    
    // Datos
    $result = $conn->query("SELECT id, nombre, apellido, email FROM alumnos");
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(30, 10, $row['id'], 1);
        $pdf->Cell(60, 10, $row['nombre'] . ' ' . $row['apellido'], 1);
        $pdf->Cell(60, 10, $row['email'], 1);
        $pdf->Ln();
    }
    
    $pdf->Output('D', 'reporte_alumnos.pdf'); // Descarga automática
}