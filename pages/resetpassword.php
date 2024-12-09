

<?php
include('connection.php');

session_start();

if (isset($_POST['reset'])) {
    resetpassword($_POST);
}

function resetpassword($data) {
    global $con; // Use global connection variable
    
    // Retrieve data from the form
    $username = $data['username'];
    $new_password = $data['new_password'];
    $confirm_password = $data['confirm_password'];

    // Check if the new password matches the confirmed password
    if ($new_password !== $confirm_password) {
        $_SESSION['alert'] = [
            "icon" => "error",
            "title" => "Error",
            "text" => "New Password and Confirm Password do not match."
        ];
        return;
    }

    // Hash the password using Bcrypt
    $hashed = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database
    $sql = "UPDATE tbluser SET password = ? WHERE username = ?";
    $stmt = $con->prepare($sql);
    if (!$stmt) {
        $_SESSION['alert'] = [
            "icon" => "error",
            "title" => "Error",
            "text" => "Error preparing SQL statement: " . $con->error
        ];
        return;
    }

    // Bind the parameters and execute the update
    $stmt->bind_param("ss", $hashed, $username);
    if (!$stmt->execute()) {
        $_SESSION['alert'] = [
            "icon" => "error",
            "title" => "Error",
            "text" => "Error updating password in the database: " . $stmt->error
        ];
        return;
    }
    $stmt->close();

    // Password update successful
    $_SESSION['alert'] = [
        "icon" => "success",
        "title" => "Success",
        "text" => "Password successfully updated.",
        "redirect" => "./login"
    ];
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <!-- Add your CSS file here -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(../images/bg-img.jpeg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-content-box {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px black;
            width: 100%;
            max-width: 400px;
        }
        .form-content-box h3 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        .form-content-box .form-group {
            margin-bottom: 15px;
        }
        .form-content-box .form-group input {
            width: 90%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 0 3px black;
        }
        .form-content-box .btn-submit {
            background: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            box-shadow: 0 0 10px #0056b3;
        }
        .form-content-box .btn-submit:hover {
            background: #0056b3;
        }
        .eye-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #777;
        }
        .eye-icon:hover {
            color: #333;
        }
    </style>
</head>
<body>
<section class="bg-grey">
    <div class="form-content-box">
        <div class="login-header">
            <center><h1 class="text-center">Reset Password</h1></center>
        </div>
        <div class="details">
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" name="username" placeholder="Enter username" autocomplete="on" required class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" name="new_password" placeholder="Enter new password" autocomplete="off" required class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" name="confirm_password" placeholder="Confirm new password" autocomplete="off" required class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" name="reset" class="btn btn-submit">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
    <?php
if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    echo '<script>
        Swal.fire({
            icon: "' . $alert['icon'] . '",
            title: "' . $alert['title'] . '",
            text: "' . $alert['text'] . '"
        }).then(() => {';
    if (!empty($alert['redirect'])) {
        echo 'window.location.href = "' . $alert['redirect'] . '";';
    }
    echo '});
    </script>';
    unset($_SESSION['alert']);
}
    ?>
</section>
<!-- SweetAlert Script -->

</body>
</html>
