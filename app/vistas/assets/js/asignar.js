document.addEventListener('DOMContentLoaded', function() {
    // Buscamos todos los botones con la clase 'btn-move'
    const moveButtons = document.querySelectorAll('.btn-move');

    // Agregamos un manejador de eventos a cada botón
    moveButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Obtenemos el ID de la columna a la que moveremos el card
            const targetColumnId = this.closest('.columns').id === 'column1' ? 'column2' : 'column1';
            const targetColumn = document.getElementById(targetColumnId);

            // Obtenemos el card actual y lo movemos a la columna de destino
            const card = this.closest('.card');
            targetColumn.appendChild(card);

            // Cambiamos el ícono del botón a un icono diferente
            const icon = this.querySelector('.icon-btn-move');

            if (icon.classList.contains('fa-plus')) {
                button.classList.remove('btn-success');
                button.classList.add('btn-danger');
                icon.classList.remove('fa-plus');
                icon.classList.add('fa-minus');
            } else {
                button.classList.remove('btn-danger');
                button.classList.add('btn-success');
                icon.classList.remove('fa-minus');
                icon.classList.add('fa-plus');
            }
        });
    });
});