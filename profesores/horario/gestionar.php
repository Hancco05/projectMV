<?php
include '../../includes/auth.php';
// Verificar rol profesor
?>

<div id="horario">
    <!-- Bloques generados con AJAX -->
</div>

<script>
// Cargar horario desde API
fetch('../../api/horario/get.php')
    .then(response => response.json())
    .then(data => {
        document.getElementById('horario').innerHTML = data.html;
    });
</script>