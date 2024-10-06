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
$zone_barangay = isset($_SESSION['barangay']) ? $_SESSION['barangay'] : '';

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

