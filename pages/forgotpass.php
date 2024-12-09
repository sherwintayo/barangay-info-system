<!-- forgotpass.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;">
                    <h3 class="panel-title"><strong>Forgot Password</strong></h3>
                    <p>Enter your email to reset your password</p>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" id="forgotPassForm">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter your email" required />
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary" name="btn_reset_pass">Send Reset Link</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['btn_reset_pass'])) {
        // Include PHPMailer
  use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require "./include/Exception.php";
    require "./include/PHPMailer.php";
    require "./include/SMTP.php";

        // Get the email from the form
        $email = $_POST['email'];

        // Connect to your database
        include 'pages/connection.php';

        // Check if the email exists in the database
        $stmt = $con->prepare("SELECT * FROM tbluser WHERE username = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userId = $row['id'];
            $resetToken = bin2hex(random_bytes(32)); // Create a unique reset token

            // Save the reset token in the database
            $stmt = $con->prepare("UPDATE tbluser SET reset_token = ? WHERE id = ?");
            $stmt->bind_param("si", $resetToken, $userId);
            $stmt->execute();

            // Send the reset link to the user's email
            $resetLink = "http://yourdomain.com/resetpassword.php?token=$resetToken";

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'sshin8859@gmail.com';
                $mail->Password = 'hhgwbzklpinejqjh';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                //Recipients
                $mail->setFrom('youremail@example.com', 'Your Name');
                $mail->addAddress($email); // User's email

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Password Reset Request';
                $mail->Body    = "Click the following link to reset your password: <a href='$resetLink'>$resetLink</a>";

                $mail->send();
                echo "<script>alert('Password reset link sent! Check your email.'); window.location.href = './login.php';</script>";
            } catch (Exception $e) {
                echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
            }
        } else {
            echo "<script>alert('Email not found in the system.');</script>";
        }
    }
    ?>
</body>
</html>
