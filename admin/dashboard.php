<?php
include '../includes/db.php';
include '../includes/auth.php';

// Solo para administradores
if ($_SESSION['user_rol'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

// Estadísticas rápidas
$total_alumnos = $conn->query("SELECT COUNT(*) FROM alumnos")->fetch_row()[0];
$total_profesores = $conn->query("SELECT COUNT(*) FROM profesores")->fetch_row()[0];
$total_cursos = $conn->query("SELECT COUNT(*) FROM cursos")->fetch_row()[0];
?>

<div class="row">
    <!-- Tarjetas de resumen -->
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5>Alumnos</h5>
                <h2><?= $total_alumnos ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5>Profesores</h5>
                <h2><?= $total_profesores ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5>Cursos</h5>
                <h2><?= $total_cursos ?></h2>
            </div>
        </div>
    </div>
</div>

<!-- Gráfico con Chart.js -->
<canvas id="chartAlumnosPorCurso" width="400" height="200"></canvas>
<script>
    const ctx = document.getElementById('chartAlumnosPorCurso').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($nombres_cursos) ?>,
            datasets: [{
                label: 'Alumnos matriculados',
                data: <?= json_encode($alumnos_por_curso) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.5)'
            }]
        }
    });
</script>