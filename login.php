<?php
session_start();
$max_attempts = 3;
$lockout_duration = 180; // 3 minutes

if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['lockout_time'] = 0;
}

if (isset($_POST['btn_login'])) {
    if ($_SESSION['login_attempts'] >= $max_attempts && time() < $_SESSION['lockout_time']) {
        echo "<script>
                Swal.fire({
                    title: 'Account Locked!',
                    text: 'Too many failed login attempts. Please try again later.',
                    icon: 'error',
                    timer: 4000,
                    showConfirmButton: false
                });
              </script>";
        exit;
    }

    $username = clean($_POST['txt_username']);
    $password = clean($_POST['txt_password']);
    
    // Dummy example for login validation, replace with database logic
    $valid_username = "admin";
    $valid_password = "password";

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['login_attempts'] = 0; // Reset attempts on successful login
        echo "<script>
                Swal.fire({
                    title: 'Success!',
                    text: 'Login successful.',
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
                    text: 'Invalid username or password.',
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
    <title>Login Page</title>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const lockoutTime = <?= json_encode($_SESSION['lockout_time'] ?? 0) ?>;
            const loginButton = document.querySelector("button[name='btn_login']");

            function updateButtonState() {
                const currentTime = Math.floor(Date.now() / 1000);
                if (currentTime < lockoutTime) {
                    const remainingTime = lockoutTime - currentTime;
                    loginButton.disabled = true;
                    loginButton.innerText = `Try again in ${remainingTime}s`;

                    const interval = setInterval(() => {
                        const now = Math.floor(Date.now() / 1000);
                        if (now >= lockoutTime) {
                            clearInterval(interval);
                            loginButton.disabled = false;
                            loginButton.innerText = "Log in";
                        } else {
                            loginButton.innerText = `Try again in ${lockoutTime - now}s`;
                        }
                    }, 1000);
                }
            }

            updateButtonState();
        });
    </script>
</head>
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
                    title: 'Error!',
                    text: 'reCAPTCHA verification failed. Please try again.',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
              </script>";
        exit;
    }

    // Sanitize and validate user inputs
    $username = clean($_POST['txt_username']);
    $password = clean($_POST['txt_password']);

    // Query the database for the user
    $stmt = $con->prepare("SELECT * FROM tbluser WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            // Reset login attempts on successful login
            $_SESSION['login_attempts'] = 0;

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
            // Increment login attempts and set lockout time if necessary
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
        // Handle case where user does not exist
        $_SESSION['login_attempts']++;
        if ($_SESSION['login_attempts'] >= $max_attempts) {
            $_SESSION['lockout_time'] = time() + $lockout_duration;
        }

        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Account doesn\'t exist.',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
              </script>";
    }


        // Prepare and bind parameters
        // $stmt = $con->prepare("SELECT * FROM tbluser WHERE username = ? AND password = ? AND type = 'administrator'");
        // $stmt->bind_param("ss", $username, $password);
        // $stmt->execute();
        // $admin_result = $stmt->get_result();

        // $stmt = $con->prepare("SELECT * FROM tblzone WHERE username = ? AND password = ?");
        // $stmt->bind_param("ss", $username, $password);
        // $stmt->execute();
        // $zone_result = $stmt->get_result();

        // $stmt = $con->prepare("SELECT * FROM tblstaff WHERE username = ? AND password = ?");
        // $stmt->bind_param("ss", $username, $password);
        // $stmt->execute();
        // $staff_result = $stmt->get_result();

        // $stmt = $con->prepare("SELECT * FROM tblresident WHERE username = ? AND password = ?");
        // $stmt->bind_param("ss", $username, $password);
        // $stmt->execute();
        // $user_result = $stmt->get_result();

        // if ($admin_result->num_rows > 0) {
        //     while ($row = $admin_result->fetch_assoc()) {
        //         $_SESSION['role'] = "Administrator";
        //         $_SESSION['userid'] = $row['id'];
        //         $_SESSION['username'] = $row['username'];
        //     }
        //     echo "<script>
        //     Swal.fire({
        //         title: 'Success!',
        //         text: 'Welcome, Administrator!',
        //         icon: 'success',
        //         timer: 2000,
        //         showConfirmButton: false
        //     }).then(() => {
        //         window.location.href = 'pages/dashboard/dashboard.php';
        //     });
        // </script>";
        // } elseif ($zone_result->num_rows > 0) {
        //     while ($row = $zone_result->fetch_assoc()) {
        //         $_SESSION['role'] = "Zone Leader";
        //         $_SESSION['userid'] = $row['id'];
        //         $_SESSION['username'] = $row['username'];
        //     }
        //     echo "<script>
        //     Swal.fire({
        //         title: 'Success!',
        //         text: 'Welcome, Zone Leader!',
        //         icon: 'success',
        //         timer: 2000,
        //         showConfirmButton: false
        //     }).then(() => {
        //         window.location.href = 'pages/permit/permit.php';
        //     });
        // </script>";
        // } elseif ($staff_result->num_rows > 0) {
        //     while ($row = $staff_result->fetch_assoc()) {
        //         $_SESSION['role'] = $row['name'];
        //         $_SESSION['staff'] = "Staff";
        //         $_SESSION['userid'] = $row['id'];
        //         $_SESSION['username'] = $row['username'];
        //     }
        //     echo "<script>
        //     Swal.fire({
        //         title: 'Success!',
        //         text: 'Welcome, Staff Member!',
        //         icon: 'success',
        //         timer: 2000,
        //         showConfirmButton: false
        //     }).then(() => {
        //         window.location.href = 'pages/resident/resident.php';
        //     });
        // </script>";
        // } elseif ($user_result->num_rows > 0) {
        //     while ($row = $user_result->fetch_assoc()) {
        //         $_SESSION['role'] = $row['fname'];
        //         $_SESSION['resident'] = 1;
        //         $_SESSION['userid'] = $row['id'];
        //         $_SESSION['username'] = $row['username'];
        //     }
        //     echo "<script>
        //     Swal.fire({
        //         title: 'Success!',
        //         text: 'Welcome, Resident!',
        //         icon: 'success',
        //         timer: 2000,
        //         showConfirmButton: false
        //     }).then(() => {
        //         window.location.href = 'pages/permit/permit.php';
        //     });
        // </script>";
        // } else {
        //     echo "<script>
        //     Swal.fire({
        //         title: 'Error!',
        //         text: 'Invalid username or password.',
        //         icon: 'error',
        //         timer: 2000,
        //         showConfirmButton: false
        //     });
        // </script>";
        // }



    }
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let passwordInp = document.querySelector("input[name='txt_password']");
            let showPass = document.getElementById("togglePassword");

            showPass.onclick = () => {
                if (passwordInp.getAttribute("type") == "password") {
                    passwordInp.setAttribute("type", "text")
                    showPass.classList.replace("fa-eye", "fa-eye-slash")
                } else {
                    passwordInp.setAttribute("type", "password")
                    showPass.classList.replace("fa-eye-slash", "fa-eye")
                }
            }

        })
    </script>
</body>

</html>
