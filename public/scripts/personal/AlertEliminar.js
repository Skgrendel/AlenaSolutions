function AlertRegistro(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2DCE89',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, bórralo!',
        cancelButtonText: 'No, cancelar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/personals/' + id,
                type: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    // Recarga la página o haz algo cuando la eliminación sea exitosa
                    location.reload();
                },
                error: function(result) {
                    // Muestra un mensaje de error si algo sale mal
                    Swal.fire('Error!', 'No se pudo eliminar el registro.', 'error');
                }
            });
        }
    })
}
