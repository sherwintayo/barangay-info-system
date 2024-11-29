<?php
if (isset($_POST['btn_add'])) {
    $ddl_pos = $_POST['ddl_pos'];
    $txt_cname = $_POST['txt_cname'];
    $txt_contact = $_POST['txt_contact'];
    $txt_address = $_POST['txt_address'];
    $txt_sterm = $_POST['txt_sterm'];
    $txt_eterm = $_POST['txt_eterm'];

    // Determine the barangay based on session role
    if ($_SESSION['role'] === 'Administrator') {
        $barangay = $_POST['ddl_barangay']; // Use barangay from POST
    } else {
        $barangay = $zone_barangay; // Use zone_barangay for non-administrators
    }

    // Add a log entry if session role exists
    if (isset($_SESSION['role'])) {
        $action = 'Added Official named ' . $txt_cname;
        $iquery = mysqli_query($con, "INSERT INTO tbllogs (user, logdate, action) values ('" . $_SESSION['role'] . "', NOW(), '" . $action . "')");
    }

    // Check for duplicates
    $q = mysqli_query($con, "SELECT * FROM tblofficial WHERE sPosition = '$ddl_pos' AND termStart = '$txt_sterm' AND termEnd = '$txt_eterm' AND barangay = '$barangay'");
    $ct = mysqli_num_rows($q);

    if ($ct == 0) {
        // Insert new record
        if ($isZoneLeader) {
            $query = mysqli_query($con, "INSERT INTO tblofficial (sPosition, completeName, pcontact, paddress, termStart, termEnd, status, barangay) 
            VALUES ('$ddl_pos', '$txt_cname', '$txt_contact', '$txt_address', '$txt_sterm', '$txt_eterm', 'Ongoing Term', '$barangay')") or die('Error: ' . mysqli_error($con));
        } else {
            $query = mysqli_query($con, "INSERT INTO tblofficial (sPosition, completeName, pcontact, paddress, termStart, termEnd, status) 
            VALUES ('$ddl_pos', '$txt_cname', '$txt_contact', '$txt_address', '$txt_sterm', '$txt_eterm', 'Ongoing Term')") or die('Error: ' . mysqli_error($con));
        }

        if ($query == true) {
            $_SESSION['added'] = 1;
            header("location: " . $_SERVER['REQUEST_URI']);
        }
    } else {
        // Handle duplicate entry
        $_SESSION['duplicate'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
    }
}


if (isset($_POST['btn_save'])) {
    // Retrieve form values
    $txt_id = $_POST['hidden_id'];
    $txt_edit_cname = $_POST['txt_edit_cname'];
    $txt_edit_contact = $_POST['txt_edit_contact'];
    $txt_edit_address = $_POST['txt_edit_address'];
    $txt_edit_sterm = $_POST['txt_edit_sterm'];
    $txt_edit_eterm = $_POST['txt_edit_eterm'];

    // Handle barangay update if role is Administrator
    $barangay_update_clause = '';
    if ($_SESSION['role'] == 'Administrator') {
        $ddl_edit_barangay = $_POST['ddl_edit_barangay']; // Barangay selected from dropdown
        $barangay_update_clause = ", barangay = '$ddl_edit_barangay'";
    }

    // Log the update action
    if (isset($_SESSION['role'])) {
        $action = 'Updated Official named ' . $txt_edit_cname;
        $iquery = mysqli_query($con, "INSERT INTO tbllogs (user, logdate, action) VALUES ('" . $_SESSION['role'] . "', NOW(), '$action')");
    }

    // Execute the update query
    $update_query = mysqli_query($con, "
        UPDATE tblofficial 
        SET completeName = '$txt_edit_cname', 
            pcontact = '$txt_edit_contact', 
            paddress = '$txt_edit_address', 
            termStart = '$txt_edit_sterm', 
            termEnd = '$txt_edit_eterm' 
            $barangay_update_clause 
        WHERE id = '$txt_id'
    ") or die('Error: ' . mysqli_error($con));

    // Redirect with a success message
    if ($update_query) {
        $_SESSION['edited'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
}

if(isset($_POST['btn_end']))
{

    $txt_id = $_POST['hidden_id'];

    $end_query = mysqli_query($con,"UPDATE tblofficial set status = 'End Term' where id = '$txt_id' ") or die('Error: ' . mysqli_error($con));

    if($end_query == true){
        $_SESSION['end'] = 1;
        header("location: ".$_SERVER['REQUEST_URI']);
    }
}

if(isset($_POST['btn_start']))
{

    $txt_id = $_POST['hidden_id'];

    $start_query = mysqli_query($con,"UPDATE tblofficial set status = 'Ongoing Term' where id = '$txt_id' ") or die('Error: ' . mysqli_error($con));

    if($start_query == true){
        $_SESSION['start'] = 1;
        header("location: ".$_SERVER['REQUEST_URI']);
    }
}

if(isset($_POST['btn_delete']))
{
    if(isset($_POST['chk_delete']))
    {
        foreach($_POST['chk_delete'] as $value)
        {
            $delete_query = mysqli_query($con,"DELETE from tblofficial where id = '$value' ") or die('Error: ' . mysqli_error($con));
                    
            if($delete_query == true)
            {
                $_SESSION['delete'] = 1;
                header("location: ".$_SERVER['REQUEST_URI']);
            }
        }
    }
}


?>
