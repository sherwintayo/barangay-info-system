<?php
if(isset($_POST['btn_add'])){
    $txt_barangay = $_POST['txt_barangay'];
    $txt_purok = $_POST['txt_purok'];
    $barangay = $zone_barangay;

    if(isset($_SESSION['role']) && isset($_POST['txt_barangay'])) {
        // Escape user input for security
        $txt_barangay = mysqli_real_escape_string($con, $_POST['txt_barangay']);
        
        // Construct the log action
        $action = 'Added Staff with name of ' . $txt_name;
        
        // Prepare the SQL statement
        $stmt = $con->prepare("INSERT INTO tbllogs (user, logdate, action) VALUES (?, NOW(), ?)");
        
        // Bind parameters
        $stmt->bind_param("ss", $_SESSION['role'], $action);
        
        // Execute the statement
        $stmt->execute();
        
        // Check if the query was successful
        if ($stmt->affected_rows > 0) {
            // Log entry inserted successfully
            // You can handle this as needed
        } else {
            // Error occurred while inserting log entry
            // You can handle this as needed
        }
        
        // Close statement
        $stmt->close();
    }
    
    $su = mysqli_query($con,"SELECT * from tblpurok where purok = '".$txt_purok."' ");
    $ct = mysqli_num_rows($su);
    
    if($ct == 0){
        if ($isZoneLeader) {
            $query = mysqli_query($con,"INSERT INTO tblpurok (barangay,purok) 
            values ('$txt_barangay', '$txt_purok')") or die('Error: ' . mysqli_error($con));
        }else{
            $query = mysqli_query($con,"INSERT INTO tblpurok(barangay,purok) 
            values ('$txt_barangay', '$txt_purok')") or die('Error: ' . mysqli_error($con));
        }
        if($query == true)
        {
            $_SESSION['added'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
        } 
    }
    else{
        $_SESSION['duplicateuser'] = 1;
        header ("location: ".$_SERVER['REQUEST_URI']);
    }   
}


if(isset($_POST['btn_save']))
{
    $txt_id = $_POST['hidden_id'];
    $txt_edit_name = $_POST['txt_edit_name'];
    $txt_edit_uname = $_POST['txt_edit_uname'];
    $txt_edit_pass = $_POST['txt_edit_pass'];

    if(isset($_SESSION['role'])){
        $action = 'Update Staff with name of '.$txt_edit_name;
        $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
    }

    $su = mysqli_query($con,"SELECT * from tblstaff where username = '".$txt_edit_uname."' ");
    $ct = mysqli_num_rows($su);
    
    if($ct == 0){
        $update_query = mysqli_query($con,"UPDATE tblstaff set name = '".$txt_edit_name."', username = '".$txt_edit_uname."', password = '".$txt_edit_pass."' where id = '".$txt_id."' ") or die('Error: ' . mysqli_error($con));

        if($update_query == true){
            $_SESSION['edited'] = 1;
            header("location: ".$_SERVER['REQUEST_URI']);
        }
    }
    else{
        $_SESSION['duplicateuser'] = 1;
        header ("location: ".$_SERVER['REQUEST_URI']);
    } 
}

if(isset($_POST['btn_delete']))
{
    if(isset($_POST['chk_delete']))
    {
        foreach($_POST['chk_delete'] as $value)
        {
            $delete_query = mysqli_query($con,"DELETE from tblstaff where id = '$value' ") or die('Error: ' . mysqli_error($con));
                    
            if($delete_query == true)
            {
                $_SESSION['delete'] = 1;
                header("location: ".$_SERVER['REQUEST_URI']);
            }
        }
    }
}


?>
