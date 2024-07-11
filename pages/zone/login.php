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
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!--/ icons link-->
        <link rel="icon" type="image/png"  href="../../images/favicon_io/favicon.ico">
        <link rel="apple-touch-icon" sizes="180x180" href="../../images/favicon_io/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../../images/favicon_io/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../../images/favicon_io/favicon-16x16.png">
        <link rel="manifest" href="../../images/favicon_io/site.webmanifest">
        <!-- end link-->
    </head>
    <body class="skin-black">
        <div class="container" style="margin-top:30px">
          <div class="col-md-4 col-md-offset-4">
              <div class="panel panel-default">
            <div class="panel-heading" style="text-align:center; background: linear-gradient(to right, #b2fefa, #0ed2f7);">
                <img src="../../img/tugas_logo.png" style="height:150px;"/>
              <h3 class="panel-title">
                <strong>
                    Barangay Management System
                </strong>
                <p>(Zone Leader Approval)</p>
              </h3>
            </div>
            <div class="panel-body">
              <form role="form" method="post">
                <div class="form-group">
                  <label for="txt_username">Username</label>
                  <input type="text" class="form-control" style="border-radius:0px" name="txt_username" placeholder="Enter Username" required=""/>
                </div>
                <div class="form-group">
                  <label for="txt_password">Password</label>
                  <input type="password" class="form-control" style="border-radius:0px" name="txt_password" placeholder="Enter Password" required=""/>
                </div>
                <button type="submit" class="btn btn-sm btn-primary" name="btn_login" style="background: linear-gradient(to right, blue, #0ed2f7);">Log in</button>
                <label id="error" class="label label-danger pull-right"></label> 
              </form>
            </div>
          </div>
          </div>
        </div>

      <?php
        include "../connection.php";
        if(isset($_POST['btn_login']))
        { 
            $username = $_POST['txt_username'];
            $password = $_POST['txt_password'];

            // Using prepared statements to prevent SQL injection
            $stmt = $con->prepare("SELECT * FROM tblzone WHERE username = ? AND password = ?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc()){
                  $_SESSION['role'] = "Zone Leader";
                  $_SESSION['userid'] = $row['id'];
                  $_SESSION['username'] = $row['username'];
                }    
                header ('location: ../permit/permit.php');
            }
            else
            {
              echo '<script type="text/javascript">document.getElementById("error").innerHTML = "Invalid Account";</script>';
            }

            $stmt->close();
        }
      ?>
    </body>
</html>
