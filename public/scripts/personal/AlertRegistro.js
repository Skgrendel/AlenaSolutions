@if (session('success'))
    Swal.fire({
        title: "{{ session('tittle') }}",
        text: "{{ session('success') }}",
        icon: "{{ session('icon') }}"
    });
@endif
