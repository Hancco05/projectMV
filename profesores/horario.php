<div id="horario-container">
    <!-- Días de la semana -->
    <div class="dias">
        <div class="dia" data-dia="Lunes">Lunes</div>
        <div class="dia" data-dia="Martes">Martes</div>
        <!-- ... más días ... -->
    </div>

    <!-- Bloques horarios -->
    <div class="bloques" id="bloques-horario">
        <!-- Se llena con AJAX -->
    </div>
</div>

<script>
// Cargar horario al iniciar
$(document).ready(function() {
    $.ajax({
        url: 'includes/cargar_horario.php',
        type: 'GET',
        success: function(data) {
            $('#bloques-horario').html(data);
            initDragAndDrop();
        }
    });
});

function initDragAndDrop() {
    $('.clase-horario').draggable({
        revert: true,
        zIndex: 1000
    });

    $('.dia').droppable({
        accept: '.clase-horario',
        drop: function(event, ui) {
            const claseId = ui.draggable.data('id');
            const nuevoDia = $(this).data('dia');
            
            $.ajax({
                url: 'includes/actualizar_horario.php',
                type: 'POST',
                data: { 
                    clase_id: claseId,
                    nuevo_dia: nuevoDia 
                }
            });
        }
    });
}
</script>