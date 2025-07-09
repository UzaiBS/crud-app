// js/script.js

document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            const userName = this.dataset.userName;
            if (!confirm(`¿Estás seguro de que quieres eliminar el registro de ${userName}?`)) {
                event.preventDefault(); // Evita la navegación si el usuario cancela
            }
        });
    });
});