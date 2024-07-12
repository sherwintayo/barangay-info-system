<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .swal2-success {
            border-color: green !important;
        }

        .swal2-success .swal2-icon-content {
            color: green !important;
        }

        .swal2-square-button {
            width: 100px;
            /* Adjust the width as needed */
            height: 100px;
            /* Adjust the height as needed */
            border-radius: 0;
            /* To make the button square */
        }
    </style>
</head>
<?php if (isset($_SESSION['edited'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Edit Successfully Saved!',
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    confirmButton: 'swal2-square-button'
                }
            });
        });
    </script>
    <?php unset($_SESSION['edited']); ?>
<?php endif; ?>