<style>
    .swal2-success {
        border-color: green !important;
    }

    .swal2-success .swal2-icon-content {
        color: green !important;
    }

    .swal2-success-button {
        width: 100px;
        /* Adjust the width as needed */
        height: 50px;
        /* Adjust the height as needed */
        border-radius: 10px;
        /* Border radius for the button */
    }
</style>


<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<?php if (isset($_SESSION['added'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Successfully Added!',
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    confirmButton: 'swal2-styled swal2-success-button'
                }
            });
        });
    </script>
    <?php unset($_SESSION['added']); ?>
<?php endif; ?>