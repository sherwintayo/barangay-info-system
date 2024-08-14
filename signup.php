<!DOCTYPE html>
<html>
<?php
session_start();
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

        .container {
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

        .card {
            width: 400px !important;
        }

        @media (max-width: 400px) {
            .card {
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
                    <!-- <img src="img/tugas_logo.png" style="height:150px;" />
                    <h3 class="panel-title">
                        <strong>
                            Management System
                        </strong>
                    </h3> -->
                    <p>Sign Up</p>
                </div>
                <div class="panel-body">
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="barangay">Barangay</label>
                            <select name="barangay" class="form-control input-sm" required="">
                                <option selected="" disabled="" value="">-Select Barangay-</option>
                                <option value="Kangwayan">Kangwayan</option>
                                <option value="Kodia">Kodia</option>
                                <option value="Pili">Pili</option>
                                <option value="Bunakan">Bunakan</option>
                                <option value="Tabagak">Tabagak</option>
                                <option value="Maalat">Maalat</option>
                                <option value="Tarong">Tarong</option>
                                <option value="Malbago">Malbago</option>
                                <option value="Mancilang">Mancilang</option>
                                <option value="Kaongkod">Kaongkod</option>
                                <option value="San Agustin">San Agustin</option>
                                <option value="Poblacion">Poblacion</option>
                                <option value="Tugas">Tugas</option>
                                <option value="Talangnan">Talangnan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="txt_username">Email</label>
                            <input type="email" class="form-control" style="border-radius:0px" name="txt_username"
                                placeholder="Enter Username" required="" />
                        </div>
                        <div class="form-group">
                            <label for="txt_password">Password</label>
                            <div style="position: relative;">
                                <input type="password" class="form-control" style="border-radius:0px"
                                    name="txt_password" id="txt_password" placeholder="Enter Password" required="" />
                                <i class="fas fa-eye eye-icon" id="togglePassword"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txt_password">Confirm Password</label>
                            <div style="position: relative;">
                                <input type="password" class="form-control" style="border-radius:0px"
                                    name="txt_confirm" id="txt_confirm" placeholder="Confirm Password" required="" />
                                <i class="fas fa-eye eye-icon" id="toggleConfirm"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary" name="btn_signup"
                            style="background-color:#00BB27;">Sign Up</button>
                        <a href="pages/resetpassword.php" style="float: right;">Forgot password</a>
                        <label id="error" class="label label-danger pull-right"></label>

                        <p class="text-center" style="margin-top: 20px;">Already an account? <a href="login.php">Sign In</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    include "pages/connection.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require "./include/Exception.php";
    require "./include/PHPMailer.php";
    require "./include/SMTP.php";

    if (isset($_POST['btn_signup'])) {
        $barangay = $_POST['barangay'];
        $username = $_POST['txt_username'];
        $password = $_POST['txt_password'];
        $confirm = $_POST['txt_confirm'];
        $type = "Zone Leader";
        $verification = uniqid() . rand(100, 999999999);

        $stmt = $con->prepare("INSERT INTO tbluser(username,password,barangay,type,verification) VALUES(?,?,?,?,?)");
        $stmt->bind_param('sssss', $username, $password, $barangay, $type, $verification);

        $check = $con->query("SELECT * FROM tbluser WHERE username = '$username'");

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sshin8859@gmail.com';
        $mail->Password = 'hhgwbzklpinejqjh';
        $mail->Port = 587;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom('barangaymanagement@gmail.com', 'Barangay Management');

        $mail->addAddress($username);
        $mail->Subject = "Email Account Verification";
        $mail->Body = "Click this link to verify account: http://localhost/bims_edit/verify-account.php?verification=" . $verification . "&email=" . $username;

        $mail->send();


        if ($password !== $confirm) {
            echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Password don\'t match',
                    icon: 'error',
                    timer: 1500,
                    showConfirmButton: false
                });
            </script>";
        } else {
            if ($check->num_rows > 0) {
                echo "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Username already exist',
                        icon: 'error',
                        timer: 1500,
                        showConfirmButton: false
                    });
                </script>";
            } else {
                if ($stmt->execute()) {
                    echo "<script>
                            Swal.fire({
                                title: 'Success!',
                                text: 'Account created successfully, We sent you a message to confirm your account.',
                                icon: 'success',
                                timer: 2500,
                                showConfirmButton: false
                            }).then(function(){
                                window.location.href = 'login.php'
                            });
                        </script>";
                }
            }
        }
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

            let confirmInp = document.querySelector("input[name='txt_confirm']");
            let showConfirmPass = document.getElementById("toggleConfirm");

            showConfirmPass.onclick = () => {
                if (confirmInp.getAttribute("type") == "password") {
                    confirmInp.setAttribute("type", "text")
                    showConfirmPass.classList.replace("fa-eye", "fa-eye-slash")
                } else {
                    confirmInp.setAttribute("type", "password")
                    showConfirmPass.classList.replace("fa-eye-slash", "fa-eye")
                }
            }

        })
    </script>

</body>

</html>
