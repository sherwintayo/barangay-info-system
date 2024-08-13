<?php
if (isset($_POST['btn_add'])) {
    $txt_doc = $_POST['txt_doc'];
    $txt_act = $_POST['txt_act'];
    $barangay = $zone_barangay;


    // $chkdup = mysqli_query($con, "SELECT * from tblsession where householdno = ".$txt_householdno." ");
    //$num_rows = mysqli_num_rows($chkdup);

    if (isset($_SESSION['role'])) {
        $action = 'Added session ' . $txt_act;
        $iquery = mysqli_query($con, "INSERT INTO tbllogs (user,logdate,action) values ('" . $_SESSION['role'] . "', NOW(), '" . $action . "')");
    }


    //if($num_rows == 0){
   if ($isZoneLeader) {
    $query = mysqli_query($con, "INSERT INTO tblsession (date_of_session,session,barangay) 
    values ('$txt_doc', '$txt_act', '$barangay')") or die('Error: ' . mysqli_error($con));
   }else{
    $query = mysqli_query($con, "INSERT INTO tblsession (date_of_session,session) 
    values ('$txt_doc', '$txt_act')") or die('Error: ' . mysqli_error($con));
   }
    $id = mysqli_insert_id($con);
    if (isset($_FILES['files'])) {
        foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {

            $target = "photo/";
            $milliseconds = round(microtime(true) * 1000);
            $name = $milliseconds . $_FILES['files']['name'][$key];
            $target = $target . $name;

            if (move_uploaded_file($tmp_name, $target)) {
                mysqli_query($con, "INSERT INTO tblsessionphoto (sessionid,filename) 
                    values ('$id', '" . $name . "')") or die('Error: ' . mysqli_error($con));
            }

        }
    }

    if ($query == true) {
        $_SESSION['added'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
    }
    //}
    //else{
    //    $_SESSION['duplicate'] = 1;
    //    header ("location: ".$_SERVER['REQUEST_URI']);
    //}
}


if (isset($_POST['btn_save'])) {
    $txt_id = $_POST['hidden_id'];
    $txt_edit_doc = $_POST['txt_edit_doc'];
    $txt_edit_act = $_POST['txt_edit_act'];
    $txt_edit_desc = $_POST['txt_edit_desc'];
    $txt_edit_actStat = $_POST['txt_edit_actStat'];

    $update_query = mysqli_query($con, "UPDATE tblsession set dateofsession = '" . $txt_edit_doc . "', session = '" . $txt_edit_act . "', description = '" . $txt_edit_desc . "', actStat = '" . $txt_edit_actStat . "' where id = '" . $txt_id . "' ") or die('Error: ' . mysqli_error($con));

    if (isset($_SESSION['role'])) {
        $action = 'Update session ' . $txt_edit_act;
        $iquery = mysqli_query($con, "INSERT INTO tbllogs (user,logdate,action) values ('" . $_SESSION['role'] . "', NOW(), '" . $action . "')");
    }

    if ($update_query == true) {
        $_SESSION['edited'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
    }
}

if (isset($_POST['btn_delete'])) {
    if (isset($_POST['chk_delete'])) {
        foreach ($_POST['chk_delete'] as $value) {
            $delete_query = mysqli_query($con, "DELETE from tblsession where id = '$value' ") or die('Error: ' . mysqli_error($con));

            if ($delete_query == true) {
                $_SESSION['delete'] = 1;
                header("location: " . $_SERVER['REQUEST_URI']);
            }
        }
    }
}


if (isset($_POST['btn_addimage'])) {
    $id = $_POST['hidden_id'];

    if (isset($_FILES['photos'])) {
        foreach ($_FILES['photos']['tmp_name'] as $key => $tmp_name) {

            $target = "photo/";
            $milliseconds = round(microtime(true) * 1000);
            $name = $milliseconds . $_FILES['photos']['name'][$key];
            $target = $target . $name;

            if (move_uploaded_file($tmp_name, $target)) {
                $query = mysqli_query($con, "INSERT INTO tblsessionphoto (sessionid,filename) 
                    values ('$id', '" . $name . "')") or die('Error: ' . mysqli_error($con));
                if ($query == true) {
                    $_SESSION['added'] = 1;
                    header("location: " . $_SERVER['REQUEST_URI']);
                }
            }

        }
    }

}



if (isset($_POST['btn_remove'])) {
    if (isset($_POST['chk_deletephoto'])) {
        foreach ($_POST['chk_deletephoto'] as $value) {
            $delete_query = mysqli_query($con, "DELETE from tblsessionphoto where id = '$value' ") or die('Error: ' . mysqli_error($con));

            if ($delete_query == true) {
                $_SESSION['delete'] = 1;
                header("location: " . $_SERVER['REQUEST_URI']);
            }
        }
    }
}



?>
