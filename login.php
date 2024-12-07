<?php
session_start();

function clean($data) {
    $data = htmlspecialchars(stripslashes(trim($data)));
    return $data;
}

include "pages/connection.php";

// Initialize login attempts and lockout tracking
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['lockout_time'] = 0;
}

$max_attempts = 3; // Maximum allowed attempts
$lockout_duration = 3 * 60; // Lockout duration in seconds (3 minutes)

if (isset($_POST['btn_login'])) {
    if ($_SESSION['login_attempts'] >= $max_attempts && time() < $_SESSION['lockout_time']) {
        $remaining_time = $_SESSION['lockout_time'] - time();
        echo "<script>
                Swal.fire({
                    title: 'Account Locked!',
                    text: 'Too many failed login attempts. Try again in " . ceil($remaining_time / 60) . " minutes.',
                    icon: 'error',
                    timer: 4000,
                    showConfirmButton: false
                });
              </script>";
        exit;
    }

    $username = clean($_POST['txt_username']);
    $password = clean($_POST['txt_password']);

    // Query database to check login credentials
    $stmt = $con->prepare("SELECT * FROM tbluser WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['login_attempts'] = 0; // Reset login attempts on success

            // Store user details in session and redirect
            $_SESSION['role'] = clean($row['type']);
            $_SESSION['userid'] = clean($row['id']);
            $_SESSION['username'] = clean($row['username']);
            $_SESSION['barangay'] = clean($row['barangay']);

            echo "<script>
                    Swal.fire({
                        title: 'Success!',
                        text: 'Welcome, " . $row['type'] . "!',
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
    } else {
        $_SESSION['login_attempts']++;
        if ($_SESSION['login_attempts'] >= $max_attempts) {
            $_SESSION['lockout_time'] = time() + $lockout_duration;
        }

        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Account doesn\\'t exist.',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
              </script>";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <title>Barangay Information System</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <!-- <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="../css/style1.css" rel="stylesheet" type="text/css" /> -->
    <!--/ icon link--->
    <link rel="icon" type="image/png" href="images/favicon_io/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="images/favicon_io/site.webmanifest">
    <!--/ end link-->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"> -->
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(./images/bg-img.jpeg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .container{
            min-height: 100vh;
            display: grid;
            place-items: center;
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

        .card{
            width: 400px !important;
        }

        @media (max-width: 400px) {
            .card{
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center; ">
                    <img src="images/madridejos.png" style="height:150px;" />
                    <h3 class="panel-title">
                        <strong>
                            Management System
                        </strong>
                    </h3>
                    <p>Login</p>
                </div>
                <div class="panel-body">
                               <form role="form" method="post">
                <div class="form-group">
                    <label for="txt_username">Email</label>
                    <input type="text" class="form-control" style="border-radius:0px" name="txt_username" placeholder="Enter Username" required="" />
                </div>
                <div class="form-group">
                    <label for="txt_password">Password</label>
                    <div style="position: relative;">
                        <input type="password" class="form-control" style="border-radius:0px" name="txt_password" id="txt_password" placeholder="Enter Password" required="" />
                        <i class="fas fa-eye eye-icon" id="togglePassword"></i>
                    </div>
                </div>
                <!-- Google reCAPTCHA -->
                <div class="g-recaptcha" data-sitekey="6LfXLooqAAAAACMqm0n2nspU65tuJr6aI8z_3ZOj"></div>
                                   <br>
                <button type="submit" class="btn btn-sm btn-primary" name="btn_login" style="background-color:#00BB27;">Log in</button>
                <a href="pages/resetpassword.php" style="float: right;">Forgot password</a>
                <label id="error" class="label label-danger pull-right"></label>
            
                <p class="text-center" style="margin-top: 20px;">Don't have an account? <a href="signup.php">Sign Up</a></p>
            </form>
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>

                </div>
            </div>
        </div>
    </div>

    <?php
    //echo password_hash("dianna*123", PASSWORD_DEFAULT);

          // Define maximum login attempts and lockout duration
$max_attempts = 5;
$lockout_duration = 15 * 60; // 15 minutes

// Initialize login attempt tracking
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['lockout_time'] = 0;
}

if (isset($_POST['btn_login'])) {
    // Check if the user is locked out
    if ($_SESSION['login_attempts'] >= $max_attempts && time() < $_SESSION['lockout_time']) {
        $remaining_time = $_SESSION['lockout_time'] - time();
        echo "<script>
                Swal.fire({
                    title: 'Account Locked!',
                    text: 'Too many failed login attempts. Try again in " . ceil($remaining_time / 60) . " minutes.',
                    icon: 'error',
                    timer: 4000,
                    showConfirmButton: false
                });
              </script>";
        exit;
    }

    // Verify reCAPTCHA
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $secretKey = '6LfXLooqAAAAAPzzjG01n0BsGVab1yQDaa1s3LDI';
    $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse");
    $responseData = json_decode($verifyResponse);

    if (!$responseData->success) {
        echo "<script>
                Swal.fire({
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;">
                    <h3>Login</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="txt_username">Email</label>
                            <input type="text" class="form-control" name="txt_username" placeholder="Enter Username" required />
                        </div>
                        <div class="form-group">
                            <label for="txt_password">Password</label>
                            <div style="position: relative;">
                                <input type="password" class="form-control" name="txt_password" id="txt_password" placeholder="Enter Password" required />
                                <i class="fas fa-eye eye-icon" id="togglePassword"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="btn_login" id="btn_login">Log in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let loginBtn = document.getElementById("btn_login");
            let lockoutTime = <?php echo isset($_SESSION['lockout_time']) ? $_SESSION['lockout_time'] : 0; ?>;
            let currentTime = Math.floor(Date.now() / 1000);

            if (lockoutTime > currentTime) {
                let remainingTime = lockoutTime - currentTime;
                disableButton(loginBtn, remainingTime);
            }

            function disableButton(button, seconds) {
                button.disabled = true;
                let timer = setInterval(() => {
                    seconds--;
                    button.innerText = `Login (${seconds}s)`;
                    if (seconds <= 0) {
                        clearInterval(timer);
                        button.disabled = false;
                        button.innerText = "Log in";
                    }
                }, 1000);
            }

            // Password visibility toggle
            let passwordInp = document.getElementById("txt_password");
            let togglePassword = document.getElementById("togglePassword");
            togglePassword.onclick = function() {
                if (passwordInp.type === "password") {
                    passwordInp.type = "text";
                    togglePassword.classList.replace("fa-eye", "fa-eye-slash");
                } else {
                    passwordInp.type = "password";
                    togglePassword.classList.replace("fa-eye-slash", "fa-eye");
                }
            };
        });
    </script>
</body>
</html>
