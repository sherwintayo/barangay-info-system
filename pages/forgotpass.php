<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: blue; /* Changed background color to blue */
    }
    .background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: blue;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .form-content-box {
        background-color: #fff;
        padding: 50px; /* Reduced padding for better appearance */
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
        width: 100%; /* Change width to 100% */
        max-width: 400px; /* Optional: limit the maximum width */
        text-align: center; /* Center align the form content */
    }
    .form-group {
        margin-bottom: 30px; /* Reduced margin between form groups */
    }
    .form-control {
        width: 100%; /* Change input field width to 100% */
    }
    .btn-submit {
        width: 100%; /* Change button width to 100% */
    }
</style>
</head>
<body>
<div class="background">
    <div class="form-content-box">
        <div class="login-header">
            <h3 class="text-center">Reset your Password</h3>
        </div>
        <div class="details">
            <form action="" method="post" onsubmit="return resetPassword()">
                <div class="form-group">
                    <input type="text" id="email" name="email" placeholder="Mobile number or Email" autocomplete="off" required class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Enter Password" autocomplete="off" required class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" name="forgot" class="btn btn-submit">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function resetPassword() {
        // Assume password reset logic is successful
        // Display prompt for successful reset
        alert("Password successfully reset!");

        // Clear the email and password fields
        document.getElementById("email").value = "";
        document.getElementById("password").value = "";

        // Prevent form submission
        return false;
    }
</script>
</body>
</html>
