@if (session('success'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            text: '{{ session('success') }}',
            showConfirmButton: true,
            timer: 1500
        })
    </script>
@elseif(session('error'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: '{{ session('error') }}',
            showConfirmButton: true,
            timer: 1500
        })
    </script>
@endif


<script>
    $('body').on('click', '.btnDelete', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let action = $(this).data('action');
                $('#formDelete').attr('action', action);
                $('#formDelete').submit();
            }
        })
    })
</script>
