<?php
session_start();
$max_attempts = 3;
$lockout_duration = 180; // 3 minutes

// Initialize session variables if not set
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['lockout_time'] = 0;
}

$locked_out = false;
$remaining_time = 0;

// Check if the user is locked out
if ($_SESSION['login_attempts'] >= $max_attempts && time() < $_SESSION['lockout_time']) {
    $locked_out = true;
    $remaining_time = $_SESSION['lockout_time'] - time();
}

if (isset($_POST['btn_login']) && !$locked_out) {
    $username = clean($_POST['txt_username']);
    $password = clean($_POST['txt_password']);

    // Simulate user validation (replace with actual DB validation)
    $valid_user = ($username === "admin" && $password === "password123");

    if ($valid_user) {
        $_SESSION['login_attempts'] = 0; // Reset attempts on successful login
        echo "<script>
                Swal.fire({
                    title: 'Success!',
                    text: 'Welcome!',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'pages/dashboard/dashboard.php';
                });
              </script>";
    } else {
        $_SESSION['login_attempts']++;
        if ($_SESSION['login_attempts'] >= $max_attempts) {
            $_SESSION['lockout_time'] = time() + $lockout_duration;
        }
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Incorrect username or password.',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
              </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    <div class="container">
        <form method="post">
            <input type="text" name="txt_username" placeholder="Username" required>
            <input type="password" name="txt_password" placeholder="Password" required>
            <button type="submit" name="btn_login" id="btnLogin" 
                <?php if ($locked_out) echo "disabled"; ?>>
                Log in
            </button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const btnLogin = document.getElementById("btnLogin");

            <?php if ($locked_out): ?>
            const remainingTime = <?php echo $remaining_time; ?>;
            btnLogin.disabled = true;

            const timer = setInterval(() => {
                if (remainingTime <= 0) {
                    btnLogin.disabled = false;
                    clearInterval(timer);
                }
            }, 1000);

            setTimeout(() => {
                btnLogin.disabled = false;
            }, remainingTime * 1000);
            <?php endif; ?>
        });
    </script>
</body>
</html>
