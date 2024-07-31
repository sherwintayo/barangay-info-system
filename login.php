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
    <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="../css/style1.css" rel="stylesheet" type="text/css" />
    <!--/ icon link--->
    <link rel="icon" type="image/png" href="images/favicon_io/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="images/favicon_io/site.webmanifest">
    <!--/ end link-->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <style>
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
<?php include 'pages/connection.php';
$squery = mysqli_query($con, "SELECT * FROM tblsettings");
$data = $squery->fetch_assoc();
?>

<body class="skin-black">
    <div class="container" style="margin-top:50px ">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center; ">
                    <img src="images/<?= $data['logo'] ?>" alt="image" style="width: 200px;margin: 10px 0;">
                    <h3 class="panel-title">
                        <strong>
                            <?php echo $data['name'] ?>
                        </strong>
                    </h3>
                    <p>Login</p>
                </div>
                <div class="panel-body">
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="txt_username">Username</label>
                            <input type="text" class="form-control" style="border-radius:0px" name="txt_username"
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
                        <button type="submit" class="btn btn-sm btn-primary" name="btn_login"
                            style="background-color:#00BB27;">Log in</button>
                        <a href="pages/resetpassword.php" style="float: right;">Forgot password</a>
                        <label id="error" class="label label-danger pull-right"></label>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    include "pages/connection.php";


    if (isset($_POST['btn_login'])) {
        $username = $_POST['txt_username'];
        $password = $_POST['txt_password'];

        // Prepare and bind parameters
        $stmt = $con->prepare("SELECT * FROM tbluser WHERE username = ? AND password = ? AND type = 'administrator'");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $admin_result = $stmt->get_result();

        $stmt = $con->prepare("SELECT * FROM tblzone WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $zone_result = $stmt->get_result();

        $stmt = $con->prepare("SELECT * FROM tblstaff WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $staff_result = $stmt->get_result();

        $stmt = $con->prepare("SELECT * FROM tblresident WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $user_result = $stmt->get_result();

        if ($admin_result->num_rows > 0) {
            while ($row = $admin_result->fetch_assoc()) {
                $_SESSION['role'] = "Administrator";
                $_SESSION['userid'] = $row['id'];
                $_SESSION['username'] = $row['username'];
            }


            echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'Welcome, Administrator!',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'pages/dashboard/dashboard.php';
            });
        </script>";
        } elseif ($zone_result->num_rows > 0) {
            while ($row = $zone_result->fetch_assoc()) {
                $_SESSION['role'] = "Zone Leader";
                $_SESSION['userid'] = $row['id'];
                $_SESSION['username'] = $row['username'];
            }
            echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'Welcome, Zone Leader!',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'pages/permit/permit.php';
            });
        </script>";
        } elseif ($staff_result->num_rows > 0) {
            while ($row = $staff_result->fetch_assoc()) {
                $_SESSION['role'] = $row['name'];
                $_SESSION['staff'] = "Staff";
                $_SESSION['userid'] = $row['id'];
                $_SESSION['username'] = $row['username'];
            }
            echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'Welcome, Staff Member!',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'pages/resident/resident.php';
            });
        </script>";
        } elseif ($user_result->num_rows > 0) {
            while ($row = $user_result->fetch_assoc()) {
                $_SESSION['role'] = $row['fname'];
                $_SESSION['resident'] = 1;
                $_SESSION['userid'] = $row['id'];
                $_SESSION['username'] = $row['username'];
            }
            echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'Welcome, Resident!',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'pages/permit/permit.php';
            });
        </script>";
        } else {
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

</body>

</html>