

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>

<?php
function clean($data): string{
    $data = htmlspecialchars(stripslashes(trim($data)));
    return $data;
}

$isZoneLeader = clean($_SESSION['role']) == 'Zone Leader' ? true : false;
$zone_barangay = isset($_SESSION['barangay']) ? clean($_SESSION['barangay']) : '';

$all_barangay = [
    "Kangwayan",
    "Kodia",
    "Pili",
    "Bunakan",
    "Tabagak",
    "Maalat",
    "Tarong",
    "Malbago",
    "Mancilang",
    "Kaongkod",
    "San Agustin",
    "Poblacion",
    "Tugas",
    "Talangnan",
];

$today = clean(date("Y-m-d"));

$count_tblactivity = $con->query("SELECT * FROM tblactivity WHERE DATE(date_created) = '$today'");

// $count_tblactivityphoto = $con->query("SELECT * FROM tblactivityphoto WHERE DATE(date_created) = '$today'");
$count_tblactivityphoto = $con->prepare("SELECT * FROM tblactivityphoto WHERE DATE(date_created) = ?");
$count_tblactivityphoto->bind_param('s', $today);

// $count_tblblotter = $con->query("SELECT * FROM tblblotter WHERE DATE(date_created) = '$today'");
// $count_tblclearance = $con->query("SELECT * FROM tblclearance WHERE DATE(date_created) = '$today'");
// $count_tblhousehold = $con->query("SELECT * FROM tblhousehold WHERE DATE(date_created) = '$today'");
// $count_tbllogs = $con->query("SELECT * FROM tbllogs WHERE DATE(logdate) = '$today'");
// $count_tblofficial = $con->query("SELECT * FROM tblofficial WHERE DATE(date_created) = '$today'");
// $count_tblpermit = $con->query("SELECT * FROM tblpermit WHERE DATE(date_created) = '$today'");
// $count_tblproject = $con->query("SELECT * FROM tblproject WHERE DATE(date_created) = '$today'");
// $count_tblsession = $con->query("SELECT * FROM tblsession WHERE DATE(date_created) = '$today'");
// $count_tblsettings = $con->query("SELECT * FROM tblsettings WHERE DATE(date_created) = '$today'");
// $count_tblstaff = $con->query("SELECT * FROM tblstaff WHERE DATE(date_created) = '$today'");
// $count_tbluser = $con->query("SELECT * FROM tbluser WHERE DATE(date_created) = '$today'");
// $count_tblvisitor = $con->query("SELECT * FROM tblvisitor WHERE DATE(date_created) = '$today'");
// $count_tblzone = $con->query("SELECT * FROM tblzone WHERE DATE(date_created) = '$today'");





// $find_notifications = "Select * from tblresident where  DATE(date_created) = '$today'";
// $result = mysqli_query($con, $find_notifications);
// $count_active = '';
// $notifications_data = array();
// $deactive_notifications_dump = array();
// while ($rows = mysqli_fetch_assoc($result)) {
//     $count_active = mysqli_num_rows($result);
//     $notifications_data[] = array(
//         "id" => clean($rows['id']),
//         "fname" => clean($rows['fname']),
//         "lname" => clean($rows['lname']),
//         "mname" => clean($rows['mname']),
//         "datemove" => clean($rows['datemove'])



//     );
// }


// $total_count = 
//             $count_tblactivity->num_rows + 
//             $count_tblactivityphoto->num_rows +
//             $count_tblblotter->num_rows + 
//             $count_tblclearance->num_rows + 
//             $count_tblhousehold->num_rows + 
//             $count_tbllogs->num_rows + 
//             $count_tblofficial->num_rows + 
//             $count_tblpermit->num_rows + 
//             $count_tblproject->num_rows +
//             $count_tblsession->num_rows + 
//             $count_tblsettings->num_rows + 
//             $count_tblstaff->num_rows +
//             $count_tbluser->num_rows +
//             $count_tblvisitor->num_rows + 
//             $count_tblzone->num_rows + 
//             $result->num_rows
//             ;

// //only five specific posts
// $deactive_notifications = "Select * from tblresident where  DATE(date_created) = '$today' ORDER BY id DESC LIMIT 0,5";
// $result = mysqli_query($con, $deactive_notifications);
// while ($rows = mysqli_fetch_assoc($result)) {
//     $deactive_notifications_dump[] = array(
//         "id" => clean($rows['id']),
//         "fname" => clean($rows['fname']),
//         "lname" => clean($rows['lname']),
//         "mname" => clean($rows['mname']),
//         "datemove" => clean($rows['datemove'])
//     );
// }

?>


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

        @media print {
            .dont-print{
                display: none !important;
            }
        }
   
</style>

<?php
// $squery = mysqli_query($con, "SELECT * FROM tblsettings");
// $data = $squery->fetch_assoc();
// $logo = clean($data['logo']);
// $name = clean($data['name']);

// echo htmlspecialchars(stripslashes(trim('<header class="header">
//     <a href="#" class="logo">
//         <img src="../../images/'.$logo.'" style="height: 50px; width:50px; float: left; margin-left: -10px;">
//         <!-- Add the class icon to your logo image or logo icon to add the margining -->
//         <p style="font-size: 12px;"> '.$name.'</p>
//     </a>
//     <!-- Header Navbar: style can be found in header.less -->
//     <nav class="navbar navbar-static-top" role="navigation">
//         <!-- Sidebar toggle button-->
//         <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
//             <span class="sr-only">Toggle navigation</span>
//             <span class="icon-bar"></span>
//             <span class="icon-bar"></span>
//             <span class="icon-bar"></span>
//         </a>
//         <ul class="nav navbar-nav navbar-right">
//         <li><i class="fa fa-bell" id="over" data-value="' . $total_count . '" style="z-index:-99 !important;font-size:20px;color:black;margin:1.5rem 0.4rem !important;"></i></li>')));
// if (!empty($total_count)) {
//     echo htmlspecialchars(stripslashes(trim('<div class="round" id="bell-count" data-value="' . $total_count . '"><span>' . $total_count . '</span></div>')));
// }
// if (!empty($count_active)) {
//     echo htmlspecialchars('<div id="list">');
//     foreach ($notifications_data as $list_rows) {
//         echo htmlspecialchars('<li id="message_items">
// <div class="message alert alert-warning" data-id="' . $list_rows['id'] . '">
// <div class="msg">
//     <p>' . $list_rows['fname'] . ' ' . $list_rows['mname'] . ' ' . $list_rows['lname'] . ' Date Move In: ' . $list_rows['datemove'] . ' is now officially resident of the barangay</p>
// </div>
// </div>
// </li>');
//     }
//     echo htmlspecialchars('</div>');
// } else {
//     echo htmlspecialchars(stripslashes(trim('<div id="list">')));
//     foreach ($deactive_notifications_dump as $list_rows) {
//         echo htmlspecialchars(stripslashes(trim('<li id="message_items">
// <div class="message alert alert-danger" data-id="' . $list_rows['id'] . '">
// <div class="msg">
//     <p>' . $list_rows['fname'] . ' ' . $list_rows['mname'] . ' ' . $list_rows['lname'] . ' Date Move In: ' . $list_rows['datemove'] . ' is now officially resident of the barangay</p>
// </div>
// </div>
// </li>')));
//     }
//     echo '</div>';
// }
// echo htmlspecialchars(stripslashes(trim('<ul>
//         <div class="navbar-right">
//             <ul class="nav navbar-nav" style="background-color:transparent;">
//                 <!-- User Account: style can be found in dropdown.less -->
//                 <li class="dropdown user user-menu">
//                     <a href="resident" class="dropdown-toggle" data-toggle="dropdown">
//                         <i class="glyphicon glyphicon-user"></i><span>' . $_SESSION['role'] . '<i class="caret"></i></span>
//                     </a>
                  
//                     <ul class="dropdown-menu">
//                         <!-- User image -->
//                         <li class="user-header bg-light-blue" style="background-color:#0000FF;">
//                             <p>' . $_SESSION['role'] . '</p>
//                         </li>
//                         <!-- Menu Body -->
//                         <!-- Menu Footer-->
//                         <li class="user-footer">
//                             <div class="pull-left">
//                                 <a href="#" class="btn btn-default btn-flat" data-toggle="modal" data-target="#editProfileModal" style=" background-color: #00BB27;">Change Account</a>
//                             </div>
//                             <div class="pull-right">
//                                 <a href="../../logout.php" class="btn btn-default btn-flat" style="background-color: #00BB27;">Sign out</a>
//                             </div>
//                         </li>
//                     </ul>
//                 </li>
//             </ul>
//         </div>
//     </nav>
// </header>')));

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
// if (isset($_POST['btn_saveeditProfile'])) {
//     $username = $_POST['txt_username'];
//     $password = $_POST['txt_password'];

//     if ($_SESSION['role'] == "Administrator") {
//         $updadmin = mysqli_query($con, "UPDATE tbluser set username = '$username', password = '$password' where id = '" . $_SESSION['userid'] . "' ");
//         if ($updadmin == true) {
//             header("location: " . $_SERVER['REQUEST_URI']);
//         }
//     } elseif ($_SESSION['role'] == "Zone Leader") {
//         $updzone = mysqli_query($con, "UPDATE tblzone set username = '$username', password = '$password' where id = '" . $_SESSION['userid'] . "' ");
//         if ($updzone == true) {
//             header("location: " . $_SERVER['REQUEST_URI']);
//         }
//     } elseif ($_SESSION['staff'] == "Staff") {
//         $updstaff = mysqli_query($con, "UPDATE tblstaff set username = '$username', password = '$password' where id = '" . $_SESSION['userid'] . "' ");
//         if ($updstaff == true) {
//             header("location: " . $_SERVER['REQUEST_URI']);
//         }
//     }
// }

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
