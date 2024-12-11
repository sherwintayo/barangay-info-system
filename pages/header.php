<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<!-- jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Include SweetAlert CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css" rel="stylesheet">

<!-- Include SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>


<style>
    /* Notification Count Badge */
    .round {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        position: absolute;
        background: red;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;
        margin: 0;
        left: 16px;
        /* Adjust horizontal positioning */
        top: 0px;
        /* Adjust vertical positioning */
        z-index: 99;
        /* Ensure it appears above other elements */
    }

    .round>span {
        color: white;
        font-size: 12px;
        /* Consistent font size */
        font-weight: bold;
        line-height: 1;
    }

    /* Notification Bell Icon */
    .fa-bell {
        position: relative;
        /* Allow badge to position relative to the bell */
        font-size: 20px;
        color: black;
        margin: 1.5rem 0.4rem !important;
    }

    /* Notification Dropdown */
    #list {
        display: none;
        /* Hidden by default */
        position: absolute;
        /* Position relative to bell icon */
        top: 40px;
        /* Adjust below the bell */
        right: 0;
        /* Align to the right edge */
        background: #ffffff;
        /* White background for visibility */
        z-index: 100;
        /* Keep above other elements */
        width: 300px;
        /* Fixed width for consistency */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Subtle shadow for depth */
        border: 1px solid #ddd;
        /* Light border */
        border-radius: 5px;
        /* Optional rounded corners */
        padding: 10px;
        /* Add padding inside */
    }

    .message {
        margin: 10px 0;
        /* Space between messages */
        padding: 10px;
        /* Padding inside each message */
        border-bottom: 1px solid #f0f0f0;
        /* Separate messages */
    }

    .message>.msg {
        color: #333;
        /* Neutral text color */
        font-size: 14px;
        /* Readable font size */
        line-height: 1.5;
        /* Comfortable line height */
    }

    /* Navbar and User Menu Styling */
    .navbar-right {
        display: flex;
        /* Align items horizontally */
        align-items: center;
        /* Vertically align items */
    }

    .user-menu {
        margin-left: 1rem;
        /* Add space between notification and user menu */
    }

    .user-menu a {
        color: black;
        /* Neutral link color */
        text-decoration: none;
        /* Remove underline */
    }

    .user-menu ul {
        list-style: none;
        /* Remove bullet points */
        padding: 0;
        margin: 0;
    }

    .user-menu ul li {
        padding: 10px;
        background: #f9f9f9;
        border-bottom: 1px solid #ddd;
    }

    .user-menu ul li a {
        color: #333;
        text-decoration: none;
    }

    .user-menu ul li a:hover {
        background: #007bff;
        color: white;
    }

    /* Media Query for Responsiveness */
    @media (max-width: 768px) {
        #list {
            width: 90%;
            /* Adjust dropdown width for smaller screens */
            right: 5%;
            /* Center it more */
        }

        .navbar-right {
            flex-direction: column;
            /* Stack items vertically */
        }

        .user-menu {
            margin-left: 0;
            /* Remove unnecessary margin */
        }
    }

    /* Print-Specific Styles */
    @media print {
        .dont-print {
            display: none !important;
        }
    }



    /* Styling for the navbar-right section */
    .navbar-right {
        margin-right: 20px;
    }

    /* Styling the dropdown menu */
    .dropdown-menu {
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 220px;
        /* Adjust width as needed */
    }

    /* Styling the user-header */
    .user-header {
        background-color: #0000FF;
        color: white;
        text-align: center;
        padding: 20px;
        border-radius: 8px;
    }

    /* Profile image style */
    .user-header img {
        border-radius: 50%;
        width: 50px;
        height: 50px;
        margin-bottom: 10px;
    }

    /* Styling the user-footer */
    .user-footer {
        display: flex;
        justify-content: space-between;
        padding: 10px;
    }

    /* Style for left button */
    .user-footer .pull-left .btn {
        background-color: #000;
        color: white;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 14px;
        text-transform: uppercase;
        transition: background-color 0.3s ease;
    }

    /* Style for right button */
    .user-footer .pull-right .btn {
        background-color: #000;
        color: white;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 14px;
        text-transform: uppercase;
        transition: background-color 0.3s ease;
    }

    /* Hover effect for buttons */
    .user-footer .pull-left .btn:hover,
    .user-footer .pull-right .btn:hover {
        background-color: black;
        /* For the Change Account button */
        background-color: black;
        /* For the Sign Out button */
    }

    /* Styling the dropdown toggle link */
    .dropdown-toggle {
        display: flex;
        align-items: center;
        font-size: 16px;
        color: #333;
    }

    .dropdown-toggle i {
        margin-right: 10px;
    }

    .dropdown-toggle span {
        font-weight: bold;
    }
</style>



// Fetch user data
$userid = $_SESSION['userid'];
$squery = mysqli_query($con, "SELECT * FROM tbluser WHERE id = '$userid' AND deleted = 0");
$user_data = $squery->fetch_assoc();

// Check if the user is an administrator
$is_admin = $user_data['type'] === 'administrator';

// Fetch settings for header
$settings_query = mysqli_query($con, "SELECT * FROM tblsettings WHERE user_id = '$userid'");
if ($settings_query && mysqli_num_rows($settings_query) > 0) {
$settings_data = $settings_query->fetch_assoc();
} else {
$settings_data = [
'name' => 'Barangay Management System',
'logo' => 'madridejos.png', // Default logo
];
}
$logo = $settings_data['logo'];
$name = $settings_data['name'];

// Calculate notifications and fetch data if the user is an administrator
$total_count = 0;
$notifications_data = [];
if ($is_admin) {
$today = date("Y-m-d");

// Count notifications from relevant tables
$tables_to_count = [
"tblactivity",
"tblactivityphoto",
"tblblotter",
"tblclearance",
"tblhousehold",
"tbllogs",
"tblofficial",
"tblpermit",
"tblproject",
"tblsession",
"tblsettings",
"tblstaff",
"tbluser",
"tblvisitor",
"tblzone",
];

foreach ($tables_to_count as $table) {
$count_query = $con->query("SELECT * FROM $table WHERE DATE(date_created) = '$today'");
$total_count += $count_query->num_rows;
}

// Fetch recent notifications
$notification_query = $con->query("SELECT * FROM tblresident WHERE DATE(date_created) = '$today' ORDER BY id DESC LIMIT
5");
while ($row = $notification_query->fetch_assoc()) {
$notifications_data[] = [
"id" => $row['id'],
"fname" => $row['fname'],
"lname" => $row['lname'],
"mname" => $row['mname'],
"datemove" => $row['datemove'],
];
}
}

// Render header
echo ' <header class="header">
    <a href="#" class="logo">
        <!-- Logo image with size and styling -->
        <img src="../../images/'.$logo. '" style="height: 50px; width: 50px; float: left; margin-left: -10px;">
        <!-- Text next to the logo, with a smaller font size -->
        <p style="font-size: 12px; font-family: Arial, sans-serif;">'.$name.'</p>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button -->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <ul class="nav navbar-nav navbar-right">';

            // Include notification bell for administrators
            if ($is_admin) {
            echo '<div class="navbar-right">
                <li style="position: relative;">
                    <i class="fa fa-bell" id="notification-bell"></i>';
                    if ($total_count > 0) {
                    echo '<div class="round" id="bell-count"><span>'.$total_count.'</span></div>';
                    }
                    echo '<div id="notification-list" style="display:none;">';
                        if (count($notifications_data) > 0) {
                        foreach ($notifications_data as $notification) {
                        echo '<div class="message">
                            <p>
                                '.$notification['fname'].' '.$notification['mname'].' '.$notification['lname'].'
                                - Date Move In: '.$notification['datemove'].'
                            </p>
                        </div>';
                        }
                        } else {
                        echo '<div class="message">
                            <p>No notifications available.</p>
                        </div>';
                        }
                        echo '</div>
                </li>
            </div>';
            }

            // Continue with the user account dropdown menu
            echo ' <ul class="nav navbar-nav" style="background-color:transparent;">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="resident" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i><span>' . $_SESSION['barangay'] . '<i
                                class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-black" style="background-color:#0000FF;">
                            <a href="#" class="btn btn-default btn-flat" data-toggle="modal"
                                data-target="#editProfileModal" style="background-color: #000; color:white;">Change
                                Account</a>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="javascript:void(0);" class="btn btn-default btn-flat"
                                    style="background-color: #000; color:white;" onclick="confirmLogout()">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </ul>
    </nav>
</header>';
?>


<script>
    // Toggle the notification list on bell click
    document.getElementById('notification-bell').addEventListener('click', function () {
        const list = document.getElementById('notification-list');
        list.style.display = list.style.display === 'none' ? 'block' : 'none';
    });
</script>


<div id="editProfileModal" class="modal fade">
    <form method="post">
        <div class="modal-dialog modal-sm" style="width:300px !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Change Account</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if ($_SESSION['role'] == "administrator") {
                                $user = mysqli_query($con, "SELECT * from tbluser where id = '" . $_SESSION['userid'] . "' ");
                                while ($row = mysqli_fetch_array($user)) {
                                    echo '
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input name="txt_username" id="txt_username" class="form-control input-sm" type="text" value="' . $row['username'] . '" />
                                    </div>
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input name="txt_password" id="txt_password" class="form-control input-sm" type="password"  value="' . $row['password'] . '"/>
                                    </div>';
                                }
                            } elseif ($_SESSION['role'] == "Zone Leader") {
                                $user = mysqli_query($con, "SELECT * from tblzone where id = '" . $_SESSION['userid'] . "' ");
                                while ($row = mysqli_fetch_array($user)) {
                                    echo '
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input name="txt_username" id="txt_username" class="form-control input-sm" type="text" value="' . $row['username'] . '" />
                                    </div>
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input name="txt_password" id="txt_password" class="form-control input-sm" type="password"  value="' . $row['password'] . '"/>
                                    </div>';
                                }
                            } elseif ($_SESSION['staff'] == "Staff") {
                                $user = mysqli_query($con, "SELECT * from tblstaff where id = '" . $_SESSION['userid'] . "' ");
                                while ($row = mysqli_fetch_array($user)) {
                                    echo '
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input name="txt_username" id="txt_username" class="form-control input-sm" type="text" value="' . $row['username'] . '" />
                                    </div>
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input name="txt_password" id="txt_password" class="form-control input-sm" type="password"  value="' . $row['password'] . '"/>
                                    </div>';
                                }
                            } else {
                                $user = mysqli_query($con, "SELECT * from tblresident where id = '" . $_SESSION['userid'] . "' ");
                                while ($row = mysqli_fetch_array($user)) {
                                    echo '
                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input name="txt_username" id="txt_username" class="form-control input-sm" type="text" value="' . $row['username'] . '" />
                                    </div>
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input name="txt_password" id="txt_password" class="form-control input-sm" type="password"  value="' . $row['password'] . '"/>
                                    </div>';
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel" />
                    <input type="submit" class="btn btn-primary btn-sm" id="btn_saveeditProfile"
                        name="btn_saveeditProfile" value="Save" />
                </div>
            </div>
        </div>
    </form>
</div>


<?php
if (isset($_POST['btn_saveeditProfile'])) {
    $username = $_POST['txt_username'];
    $password = $_POST['txt_password'];

    if ($_SESSION['role'] == "Administrator") {
        $updadmin = mysqli_query($con, "UPDATE tbluser set username = '$username', password = '$password' where id = '" . $_SESSION['userid'] . "' ");
        if ($updadmin == true) {
            header("location: " . $_SERVER['REQUEST_URI']);
        }
    } elseif ($_SESSION['role'] == "Zone Leader") {
        $updzone = mysqli_query($con, "UPDATE tblzone set username = '$username', password = '$password' where id = '" . $_SESSION['userid'] . "' ");
        if ($updzone == true) {
            header("location: " . $_SERVER['REQUEST_URI']);
        }
    } elseif ($_SESSION['staff'] == "Staff") {
        $updstaff = mysqli_query($con, "UPDATE tblstaff set username = '$username', password = '$password' where id = '" . $_SESSION['userid'] . "' ");
        if ($updstaff == true) {
            header("location: " . $_SERVER['REQUEST_URI']);
        }
    }
}

?>
<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to log out of your account?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, log out!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to logout page if user confirms
                window.location.href = '../../logout.php';
            } else {
                // Optionally: Handle cancel action here (e.g., show message)
                Swal.fire('Cancelled', 'You are still logged in!', 'info');
            }
        });
    }
</script>

<script>
    $(document).ready(function () {
        var ids = new Array();

        // Toggle dropdown visibility
        $('#over').on('click', function (e) {
            e.stopPropagation(); // Prevent click from propagating to the document
            $('#list').toggle();
        });

        // Hide dropdown when clicking outside
        $(document).on('click', function (e) {
            if (!$(e.target).closest('#list').length && !$(e.target).is('#over')) {
                $('#list').hide();
            }
        });

        // Message with Ellipsis
        $('div.msg').each(function () {
            var len = $(this).text().trim(" ").split(" ");
            if (len.length > 12) {
                var add_elip = $(this).text().trim().substring(0, 1000);
                $(this).text(add_elip);
            }
        });

        // Handle bell count click
        $("#bell-count").on('click', function (e) {
            e.preventDefault();
            let belvalue = $('#bell-count').attr('data-value');

            if (belvalue === '') {
                console.log("inactive");
            } else {
                $(".round").css('display', 'none');
                $("#list").css('display', 'block');

                // Ajax for deactivating notifications
                $('.message').click(function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: '../connection/deactive.php',
                        type: 'POST',
                        data: { "id": $(this).attr('data-id') },
                        success: function (data) {
                            console.log(data);
                            location.reload();
                        }
                    });
                });
            }
        });

        // Insert notification
        $('#notify').on('click', function (e) {
            e.preventDefault();
            var name = $('#notifications_name').val();
            var ins_msg = $('#message').val();
            if ($.trim(name).length > 0 && $.trim(ins_msg).length > 0) {
                var form_data = $('#frm_data').serialize();
                $.ajax({
                    url: './connection/insert.php',
                    type: 'POST',
                    data: form_data,
                    success: function (data) {
                        location.reload();
                    }
                });
            } else {
                alert("Please Fill All the fields");
            }
        });


    });

    <?php
    if ($_SESSION['role'] == "administrator") {

        ?>

        // Function to check for pending approvals
        function checkForApprovals() {
            $.ajax({
                url: '../check_approvals.php', // Backend endpoint
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    // Log response for debugging
                    console.log('Server Response:', response);

                    // Check for errors in the response
                    if (response.error) {
                        console.error('Error:', response.error);
                        return;
                    }

                    // Check for pending approvals
                    if (response.pendingCount > 0) {
                        Swal.fire({
                            title: 'Pending Approvals!',
                            text: There are ${ response.pendingCount } Zone Leaders waiting for approval.,
                                icon: 'warning',
                                    showCancelButton: true,
                                        confirmButtonText: 'Go to Approvals',
                                            cancelButtonText: 'Dismiss',
                        }).then((result) => {
                                                if (result.isConfirmed) {
                                                    window.location.href = 'https://barangayportal.com/pages/user/user.php'; // Redirect to the user page
                                                }
                                            });
        }
                },
        error: function(xhr, status, error) {
            // Log AJAX errors
            console.error('Error fetching pending approvals:', error);
            console.error('Response status:', status);
            console.error('Response text:', xhr.responseText);
        }
            });
        }

        // Set an interval to check for approvals every 1 minute
        setInterval(checkForApprovals, 60000);

        // Call immediately on page load
        checkForApprovals();

        <?php
    }

    ?>

</script>