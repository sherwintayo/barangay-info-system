
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>
<body>
<?php
session_start();
    include "pages/connection.php";


    if (isset($_GET['verification'])) {
        $username = trim($_GET['email']);
        $verification = trim($_GET['verification']);

        $stmt = $con->query("SELECT * FROM tbluser WHERE username = '$username' AND verification = '$verification'");
        
        if ($stmt->num_rows > 0) {
            $status = 2;
            $update = $con->prepare("UPDATE tbluser SET status = ? WHERE username = ? AND verification = ?");
            $update->bind_param('iss', $status, $username, $verification);

            if ($update->execute()) {
                echo "<script>
                Swal.fire({
                    title: 'Success!',
                    text: 'Account confirmed successfully',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                }).then(function(){
                    window.location.href = 'login.php'
                });
            </script>";
            }

        }else{
            echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Incorrect Verification or Email',
                icon: 'error',
                timer: 1500,
                showConfirmButton: false
            });
        </script>";
        }
    }
    ?>

</body>

</html>
