<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>

<?php

$find_notifications = "Select * from tblnewresident where active = 1";
$result = mysqli_query($con, $find_notifications);
$count_active = '';
$notifications_data = array();
$deactive_notifications_dump = array();
while ($rows = mysqli_fetch_assoc($result)) {
    $count_active = mysqli_num_rows($result);
    $notifications_data[] = array(
        "id" => $rows['id'],
        "fname" => $rows['fname'],
        "lname" => $rows['lname'],
        "mname" => $rows['mname'],
        "datemove" => $rows['datemove']



    );
}
//only five specific posts
$deactive_notifications = "Select * from tblnewresident where active = 0 ORDER BY id DESC LIMIT 0,5";
$result = mysqli_query($con, $deactive_notifications);
while ($rows = mysqli_fetch_assoc($result)) {
    $deactive_notifications_dump[] = array(
        "id" => $rows['id'],
        "fname" => $rows['fname'],
        "lname" => $rows['lname'],
        "mname" => $rows['mname'],
        "datemove" => $rows['datemove']
    );
}

?>

<script>
    $(document).ready(function () {
        var ids = new Array();
        $('#over').on('click', function () {
            $('#list').toggle();
        });

        //Message with Ellipsis
        $('div.msg').each(function () {
            var len = $(this).text().trim(" ").split(" ");
            if (len.length > 12) {
                var add_elip = $(this).text().trim().substring(0, 1000)
                $(this).text(add_elip);
            }

        });


        $("#bell-count").on('click', function (e) {
            e.preventDefault();

            let belvalue = $('#bell-count').attr('data-value');

            if (belvalue == '') {

                console.log("inactive");
            } else {
                $(".round").css('display', 'none');
                $("#list").css('display', 'block');

                // $('.message').each(function(){
                // var i = $(this).attr("data-id");
                // ids.push(i);

                // });
                //Ajax
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
</script>
<style>
    .round {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        position: relative;
        background: red;
        display: inline-block;
        padding: 0.3rem 0.2rem !important;
        margin: 0.3rem 0.2rem !important;
        left: -18px;
        top: 10px;
        z-index: 99 !important;
    }

    .round>span {
        color: white;
        display: block;
        text-align: center;
        font-size: 1rem !important;
        padding: 0 !important;
    }

    #list {

        display: none;
        top: 33px;
        position: absolute;
        right: 2%;
        background: #ffffff;
        z-index: 100 !important;
        width: 25vw;
        margin-left: -37px;

        padding: 0 !important;
        margin: 0 auto !important;


    }

    .message>span {
        width: 100%;
        display: block;
        color: red;
        text-align: justify;
        margin: 0.2rem 0.3rem !important;
        padding: 0.3rem !important;
        line-height: 1rem !important;
        font-weight: bold;
        border-bottom: 1px solid white;
        font-size: 1.8rem !important;

    }

    .message {
        /* background:#ff7f50;
          margin:0.3rem 0.2rem !important;
          padding:0.2rem 0 !important;
          width:100%;
          display:block; */

    }

    .message>.msg {
        width: 90%;
        margin: 0.2rem 0.3rem !important;
        padding: 0.2rem 0.2rem !important;
        text-align: justify;
        font-weight: bold;
        display: block;


    }
</style>

<?php
echo '<header class="header">
    <a href="#" class="logo">
        <img src="../../images/tugas_logo.png" style="height: 50px; width:50px; float: left; margin-left: -10px;">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        <p style="font-size: 12px;"> Barangay Management System</p>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <ul class="nav navbar-nav navbar-right">
        <li><i class="fa fa-bell" id="over" data-value="' . $count_active . '" style="z-index:-99 !important;font-size:32px;color:black;margin:0.5rem 0.4rem !important;"></i></li>';
if (!empty($count_active)) {
    echo '<div class="round" id="bell-count" data-value="' . $count_active . '"><span>' . $count_active . '</span></div>';
}
if (!empty($count_active)) {
    echo '<div id="list">';
    foreach ($notifications_data as $list_rows) {
        echo '<li id="message_items">
<div class="message alert alert-warning" data-id="' . $list_rows['id'] . '">
<div class="msg">
    <p>' . $list_rows['fname'] . ' ' . $list_rows['mname'] . ' ' . $list_rows['lname'] . ' Date Move In: ' . $list_rows['datemove'] . ' is now officially resident of the barangay</p>
</div>
</div>
</li>';
    }
    echo '</div>';
} else {
    echo '<div id="list">';
    foreach ($deactive_notifications_dump as $list_rows) {
        echo '<li id="message_items">
<div class="message alert alert-danger" data-id="' . $list_rows['id'] . '">
<div class="msg">
    <p>' . $list_rows['fname'] . ' ' . $list_rows['mname'] . ' ' . $list_rows['lname'] . ' Date Move In: ' . $list_rows['datemove'] . ' is now officially resident of the barangay</p>
</div>
</div>
</li>';
    }
    echo '</div>';
}
echo '</ul>
        <div class="navbar-right">
            <ul class="nav navbar-nav" style="background:linear-gradient(to right, #00B7D8, #146CF6, #00B7D8);">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="resident" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i><span>' . $_SESSION['role'] . '<i class="caret"></i></span>
                    </a>
                  
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue" style="background:linear-gradient(to right, #00B7D8, #146CF6, #00B7D8);">
                            <p>' . $_SESSION['role'] . '</p>
                        </li>
                        <!-- Menu Body -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat" data-toggle="modal" data-target="#editProfileModal" style=" background:linear-gradient(to right, #80b3ff, #b2fefa);">Change Account</a>
                            </div>
                            <div class="pull-right">
                                <a href="../../logout.php" class="btn btn-default btn-flat" style="background:linear-gradient(to right, #80b3ff, #0ed2f7);">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>';

?>

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
                            if ($_SESSION['role'] == "Administrator") {
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