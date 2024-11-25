<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>

<?php
function clean($data){
    $data = htmlspecialchars(stripslashes(trim($data)));
    return $data;
}

$isZoneLeader = $_SESSION['role'] == 'Zone Leader' ? true : false;
$zone_barangay = isset($_SESSION['********************']) ? $_SESSION['********************'] : '';

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

$today = date("Y-m-d");

$count_tblactivity = $con->query("SELECT * FROM tblactivity WHERE DATE(date_created) = '$today'");

$count_tblactivityphoto = $con->query("SELECT * FROM tblactivityphoto WHERE DATE(date_created) = '$today'");
$count_tblblotter = $con->query("SELECT * FROM tblblotter WHERE DATE(date_created) = '$today'");
$count_tblclearance = $con->query("SELECT * FROM tblclearance WHERE DATE(date_created) = '$today'");
$count_tblhousehold = $con->query("SELECT * FROM tblhousehold WHERE DATE(date_created) = '$today'");
$count_tbllogs = $con->query("SELECT * FROM tbllogs WHERE DATE(logdate) = '$today'");
$count_tblofficial = $con->query("SELECT * FROM tblofficial WHERE DATE(date_created) = '$today'");
$count_tblpermit = $con->query("SELECT * FROM tblpermit WHERE DATE(date_created) = '$today'");
$count_tblproject = $con->query("SELECT * FROM tblproject WHERE DATE(date_created) = '$today'");
$count_tblsession = $con->query("SELECT * FROM tblsession WHERE DATE(date_created) = '$today'");
$count_tblsettings = $con->query("SELECT * FROM tblsettings WHERE DATE(date_created) = '$today'");
$count_tblstaff = $con->query("SELECT * FROM tblstaff WHERE DATE(date_created) = '$today'");
$count_tbluser = $con->query("SELECT * FROM tbluser WHERE DATE(date_created) = '$today'");
$count_tblvisitor = $con->query("SELECT * FROM tblvisitor WHERE DATE(date_created) = '$today'");
$count_tblzone = $con->query("SELECT * FROM tblzone WHERE DATE(date_created) = '$today'");





$find_notifications = "Select * from tblresident where  DATE(date_created) = '$today'";
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


$total_count = 
            $count_tblactivity->num_rows + 
            $count_tblactivityphoto->num_rows +
            $count_tblblotter->num_rows + 
            $count_tblclearance->num_rows + 
            $count_tblhousehold->num_rows + 
            $count_tbllogs->num_rows + 
            $count_tblofficial->num_rows + 
            $count_tblpermit->num_rows + 
            $count_tblproject->num_rows +
            $count_tblsession->num_rows + 
            $count_tblsettings->num_rows + 
            $count_tblstaff->num_rows +
            $count_tbluser->num_rows +
            $count_tblvisitor->num_rows + 
            $count_tblzone->num_rows + 
            $result->num_rows
            ;

//only five specific posts
$deactive_notifications = "Select * from tblresident where  DATE(date_created) = '$today' ORDER BY id DESC LIMIT 0,5";
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


<style>
   /* Notification Bell CSS */
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

.round > span {
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
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.message > span {
    width: 100%;
    display: block;
    color: red;
    text-align: justify;
    margin: 0.2rem 0.3rem !important;
    padding: 0.3rem !important;
    line-height: 1rem !important;
    font-weight: bold;
    border-bottom: 1px solid white;
    font-size: 1.2rem;
}

.message > .msg {
    width: 90%;
    margin: 0.2rem 0.3rem !important;
    padding: 0.2rem 0.2rem !important;
    text-align: justify;
    font-weight: bold;
}

.navbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #ffffff;
    padding: 0.5rem 1rem;
    border-bottom: 1px solid #e5e5e5;
}

.navbar-right {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.user-menu {
    position: relative;
}

.user-menu .dropdown-menu {
    position: absolute;
    right: 0;
    top: 100%;
    background: #ffffff;
    border: 1px solid #ddd;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    display: none;
    z-index: 1000;
}

.user-menu:hover .dropdown-menu {
    display: block;
}

</style>

<?php
$squery = mysqli_query($con, "SELECT * FROM tblsettings");
$data = $squery->fetch_assoc();
$logo = $data['logo'];
$name = $data['name'];

$total_count = 5; // Example count
$notifications_data = [
    ['id' => 1, 'fname' => 'John', 'mname' => 'Doe', 'lname' => 'Smith', 'datemove' => '2024-11-01'],
    ['id' => 2, 'fname' => 'Jane', 'mname' => 'A.', 'lname' => 'Doe', 'datemove' => '2024-11-15']
];

echo '<header class="header">
    <a href="#" class="logo">
        <img src="../../images/' . $logo . '" style="height: 50px; width:50px; float: left; margin-left: -10px;">
        <p style="font-size: 12px;">' . $name . '</p>
    </a>
    <nav class="navbar">
        <ul class="nav navbar-nav">
            <li>
                <i class="fa fa-bell" id="over" style="font-size: 20px; color: black;"></i>';
if ($total_count > 0) {
    echo '<div class="round" id="bell-count"><span>' . $total_count . '</span></div>';
    echo '<div id="list">';
    foreach ($notifications_data as $notification) {
        echo '<li class="message">
            <div class="msg">
                <p>' . $notification['fname'] . ' ' . $notification['mname'] . ' ' . $notification['lname'] . ' moved in on ' . $notification['datemove'] . '</p>
            </div>
        </li>';
    }
    echo '</div>';
}
echo '    </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i>
                    <span>' . $_SESSION['role'] . ' <i class="caret"></i></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="user-header bg-light-blue">
                        <p>' . $_SESSION['role'] . '</p>
                    </li>
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="#" class="btn btn-default btn-flat" style="background-color: #00BB27;">Change Account</a>
                        </div>
                        <div class="pull-right">
                            <a href="../../logout.php" class="btn btn-default btn-flat" style="background-color: #00BB27;">Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
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
