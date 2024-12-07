<!DOCTYPE html>
<html>
<?php
session_start();

$request = $_SERVER['REQUEST_URI'];
if (substr($request, -4) == '.php') {
    $new_url = substr($request, 0, -4);
    header("Location: $new_url", true, 301);
    exit();
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
        <!-- jQuery (required for Bootstrap) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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

        .password-strength {
            margin-top: 5px;
            font-size: 12px;
        }

        .strength-weak { color: red; }
        .strength-medium { color: orange; }
        .strength-strong { color: green; }

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
                                    name="txt_password" id="txt_password" 
                                    placeholder="Enter Password" required 
                                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" />
                                <i class="fas fa-eye eye-icon" id="togglePassword"></i>
                            </div>
                            <div id="password-strength" class="password-strength"></div>
                        </div>
                        <div class="form-group">
                            <label for="txt_password">Confirm Password</label>
                            <div style="position: relative;">
                                <input type="password" class="form-control" style="border-radius:0px"
                                    name="txt_confirm" id="txt_confirm" 
                                    placeholder="Confirm Password" required 
                                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" />
                                <i class="fas fa-eye eye-icon" id="toggleConfirm"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="terms" required>
                                    I have read and agree to the <a href="#" data-toggle="modal" data-target="#termsModal">Terms and Conditions</a>
                                </label>
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

    <!-- Modal for Terms and Conditions (previous content remains the same) -->
    <div class="modal fade" id="termsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Barangay Portal Terms and Conditions</h4>
                </div>
               <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                    <!-- Full Terms and Conditions Content (from previous artifact) -->
                    <h4>1. Acceptance of Terms</h4>
                <p>1.1 Welcome to the Barangay Portal. By accessing or using this Portal, you agree to be bound by these Terms and Conditions. If you do not agree with these Terms, please do not use the Portal.</p>

                <h4>2. User Eligibility</h4>
                <p>2.1 To use the Portal, you must:</p>
                <ul>
                    <li>Be a resident of the specified barangay</li>
                    <li>Be at least 18 years of age</li>
                    <li>Possess valid identification</li>
                    <li>Create a verified account with accurate personal information</li>
                </ul>
                <p>2.2 Each user is limited to one account per household.</p>

                <h4>3. User Account</h4>
                <p>3.1 Account Creation</p>
                <ul>
                    <li>Users must provide accurate and current information during registration</li>
                    <li>Users are responsible for maintaining the confidentiality of their account credentials</li>
                    <li>Sharing of account credentials is strictly prohibited</li>
                </ul>
                <p>3.2 Account Security</p>
                <ul>
                    <li>Users must immediately report any unauthorized use of their account</li>
                    <li>The barangay is not liable for unauthorized access resulting from user negligence</li>
                </ul>

                <h4>4. Services and Usage</h4>
                <p>4.1 Available Services</p>
                <p>The Portal provides access to:</p>
                <ul>
                    <li>Community announcements</li>
                    <li>Online document requests</li>
                    <li>Complaint and feedback submission</li>
                    <li>Community event registrations</li>
                    <li>Local government updates</li>
                </ul>
                <p>4.2 Service Limitations</p>
                <ul>
                    <li>Not all services may be available at all times</li>
                    <li>Service availability is subject to technical maintenance and local government discretion</li>
                </ul>

                <h4>5. Data Privacy and Protection</h4>
                <p>5.1 Data Collection</p>
                <ul>
                    <li>The Portal collects personal information necessary for service delivery</li>
                    <li>All collected data is governed by local data protection regulations</li>
                </ul>
                <p>5.2 Data Usage</p>
                <ul>
                    <li>Personal information will be used solely for barangay administrative purposes</li>
                    <li>Information will not be shared with third parties without user consent, except as required by law</li>
                </ul>
                <p>5.3 User Consent</p>
                <p>By using the Portal, users consent to data processing as outlined in these terms</p>

                <h4>6. User Responsibilities</h4>
                <p>6.1 Acceptable Use</p>
                <p>Users agree to:</p>
                <ul>
                    <li>Use the Portal for lawful purposes only</li>
                    <li>Not upload malicious content</li>
                    <li>Respect community guidelines</li>
                    <li>Not impersonate other individuals</li>
                    <li>Maintain respectful communication</li>
                </ul>
                <p>6.2 Prohibited Activities</p>
                <p>Users are prohibited from:</p>
                <ul>
                    <li>Attempting unauthorized access to system resources</li>
                    <li>Interfering with Portal functionality</li>
                    <li>Posting offensive, defamatory, or inappropriate content</li>
                    <li>Sharing false or misleading information</li>
                </ul>

                <h4>7. Intellectual Property</h4>
                <p>7.1 Portal Content</p>
                <ul>
                    <li>All content on the Portal is the property of the barangay</li>
                    <li>Users may not reproduce, distribute, or create derivative works without explicit permission</li>
                </ul>

                <h4>8. Limitation of Liability</h4>
                <p>8.1 The barangay shall not be liable for:</p>
                <ul>
                    <li>Any direct, indirect, or consequential damages</li>
                    <li>Loss of data or service interruptions</li>
                    <li>Actions taken based on Portal information</li>
                    <li>Third-party content or links</li>
                </ul>

                <h4>9. Modifications to Terms</h4>
                <p>9.1 The barangay reserves the right to modify these Terms at any time.</p>
                <p>9.2 Continued use of the Portal constitutes acceptance of updated Terms.</p>

                <h4>10. Termination</h4>
                <p>10.1 The barangay may terminate or suspend user accounts for:</p>
                <ul>
                    <li>Violation of Terms</li>
                    <li>Suspicious activity</li>
                    <li>Inactivity</li>
                    <li>Technical or security reasons</li>
                </ul>

                <h4>11. Dispute Resolution</h4>
                <p>11.1 Any disputes shall be resolved through local administrative channels.</p>
                <p>11.2 Legal proceedings, if necessary, shall be conducted in the local jurisdiction.</p>


                <h4>12. Governing Law</h4>
                <p>These Terms are governed by local and national laws and regulations.</p>

                    <p><strong>By using the Barangay Portal, you acknowledge that you have read, understood, and agree to these Terms and Conditions.</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bind_param('sssss', $username, $hashed, $barangay, $type, $verification);

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
        $mail->Body = "Click this link to verify account: https://barangayportal.com/verify-account.php?verification=" . $verification . "&email=" . $username;

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
         // Password strength validation
         const passwordInput = document.getElementById('txt_password');
            const strengthDisplay = document.getElementById('password-strength');

            passwordInput.addEventListener('input', function() {
                const password = this.value;
                const strengthChecks = {
                    length: password.length >= 8,
                    lowercase: /[a-z]/.test(password),
                    uppercase: /[A-Z]/.test(password),
                    number: /\d/.test(password),
                    symbol: /[@$!%*?&]/.test(password)
                };

                let strengthText = '';
                let strengthClass = '';

                // Calculate strength
                const strengthScore = Object.values(strengthChecks).filter(v => v).length;

                if (strengthScore < 3) {
                    strengthText = 'Weak Password';
                    strengthClass = 'strength-weak';
                } else if (strengthScore === 3) {
                    strengthText = 'Medium Strength';
                    strengthClass = 'strength-medium';
                } else {
                    strengthText = 'Strong Password';
                    strengthClass = 'strength-strong';
                }

                // Display strength requirements
                const requirements = [
                    `Length: ${strengthChecks.length ? '✓' : '✗'} at least 8 characters`,
                    `Lowercase: ${strengthChecks.lowercase ? '✓' : '✗'} contains lowercase letter`,
                    `Uppercase: ${strengthChecks.uppercase ? '✓' : '✗'} contains uppercase letter`,
                    `Number: ${strengthChecks.number ? '✓' : '✗'} contains a number`,
                    `Symbol: ${strengthChecks.symbol ? '✓' : '✗'} contains a symbol (@$!%*?&)`
                ];

                strengthDisplay.innerHTML = `
                    <div class="${strengthClass}">${strengthText}</div>
                    <div>${requirements.map(req => `<div>${req}</div>`).join('')}</div>
                `;
            });

            // Form submission validation
            document.querySelector('form').addEventListener('submit', function(e) {
                const password = passwordInput.value;
                const confirmPassword = confirmInp.value;
                const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

                if (!passwordRegex.test(password)) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Invalid Password',
                        text: 'Password must be at least 8 characters long and include lowercase, uppercase, number, and symbol.',
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    });
                } else if (password !== confirmPassword) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Password Mismatch',
                        text: 'Passwords do not match.',
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    });
                }
            });
    </script>

</body>

</html>
