<?php

if(isset($_POST['btn_add'])){
    // Establish database connection
      // Retrieve form data
      $txt_lname = $_POST['txt_lname'];
      $txt_fname = $_POST['txt_fname'];
      $txt_mname = $_POST['txt_mname'];
      $ddl_gender = $_POST['ddl_gender'];
      $txt_bdate = $_POST['txt_bdate'];
      $txt_bplace = $_POST['txt_bplace'];
  
      // Calculate age
      $dateOfBirth = $txt_bdate;
      $today = date("Y-m-d");
      $diff = date_diff(date_create($dateOfBirth), date_create($today));
      $txt_age = $diff->format('%y');
  
      $txt_brgy = $_POST['txt_brgy'];
      $txt_province = $_POST['txt_province'];
      $txt_zone = $_POST['txt_zone'];
      $txt_householdmem = $_POST['txt_householdmem'];
  
      // Check if txt_cstatus and txt_length are set in $_POST before accessing them
      $txt_cstatus = isset($_POST['txt_cstatus']) ? $_POST['txt_cstatus'] : '';
      $txt_length = isset($_POST['txt_lengthofstay']) ? $_POST['txt_lengthofstay'] : '';
  
      $txt_occp = $_POST['txt_occp'];
      $txt_householdnum = $_POST['txt_householdnum'];
      $txt_region = $_POST['txt_region'];
      $txt_Citizenship = $_POST['txt_Citizenship'];
      $ddl_eattain = $_POST['ddl_eattain'];
      $txt_faddress = $_POST['txt_faddress'];
      $txt_date_of_transfer = $_POST['txt_date_of_transfer'];
      // Define $txt_pass if it's submitted through the form
      $txt_pass = isset($_POST['txt_upass']) ? $_POST['txt_upass'] : '';
  
      // Assuming $txt_pass is defined somewhere in your code
      $hash_password = password_hash($txt_pass, PASSWORD_DEFAULT);
  
      $txt_Municipality = $_POST['txt_Municipality'];
  
      $name = basename($_FILES['txt_image']['name']);
      $temp = $_FILES['txt_image']['tmp_name'];
      $imagetype = $_FILES['txt_image']['type'];
      $size = $_FILES['txt_image']['size'];
  
      $milliseconds = round(microtime(true) * 1000);
      $image = $milliseconds.'_'.$name;
  
      // SQL query to insert data into the database
      $sql = "INSERT INTO tblnewresident (
        lname,
        fname,
        mname,
        bdate,
        bplace,
        age,
        barangay,
        zone,
        totalhousehold,
        province,
        civilstatus,
        occupation, 
        householdnum,
        lengthofstay,
        region,
        Citizenship,
        gender,
        highestEducationalAttainment,
        formerAddress,
        Municipality,
        image,
        datemove
    ) 
    values (
        '$txt_lname', 
        '$txt_fname', 
        '$txt_mname',  
        '$txt_bdate', 
        '$txt_bplace',
        '$txt_age',
        '$txt_brgy',
        '$txt_zone',
        '$txt_householdmem',
        '$txt_province', 
        '$txt_cstatus',
        '$txt_occp',  
        '$txt_householdnum',
        '$txt_length',
        '$txt_region',
        '$txt_Citizenship',
        '$ddl_gender', 
        '$ddl_eattain', 
        '$txt_faddress', 
        '$txt_Municipality', 
        '$image',
        '$txt_date_of_transfer'
    )";
      // Execute the query
      if($con->query($sql)){
          // Redirect to success page
          header("Location: newResident.php");
          exit();
      } else {
          // Error inserting data
          echo "Error: " . $sql . "<br>" . $con->error;
      }

}


if(isset($_POST['btn_save']))
{
    $txt_id = $_POST['hidden_id'];
    $txt_edit_lname = $_POST['txt_edit_lname'];
    $txt_edit_fname = $_POST['txt_edit_fname'];
    $txt_edit_mname = $_POST['txt_edit_mname'];
    $txt_edit_bdate = $_POST['txt_edit_bdate'];
    $txt_edit_bplace = $_POST['txt_edit_bplace'];

    $dateOfBirth = $txt_edit_bdate;
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
    $txt_edit_age = $diff->format('%y');
    $txt_edit_brgy = $_POST['txt_edit_brgy'];   
    $txt_edit_province = $_POST['txt_edit_province'];
    $txt_edit_zone = $_POST['txt_edit_zone'];
    $txt_edit_householdmem = $_POST['txt_edit_householdmem'];
    $txt_edit_cstatus = $_POST['ddl_edit_cstatus'];
    $txt_edit_occp = $_POST['txt_edit_occp'];
    $txt_edit_householdnum = $_POST['txt_edit_householdnum'];
    $txt_edit_length = $_POST['txt_edit_length'];
    $txt_edit_region = $_POST['txt_edit_region'];
    $txt_edit_Citizenship = $_POST['txt_edit_Citizenship'];
    $ddl_edit_gender = $_POST['ddl_edit_gender'];
    $ddl_edit_eattain = $_POST['ddl_edit_eattain'];
    $txt_edit_faddress = $_POST['txt_edit_faddress'];
    $txt_edit_Municipality = $_POST['txt_edit_Municipality'];
    $name = basename($_FILES['txt_edit_image']['name']);
    $temp = $_FILES['txt_edit_image']['tmp_name'];
    $imagetype = $_FILES['txt_edit_image']['type'];
    $size = $_FILES['txt_edit_image']['size'];

    $milliseconds = round(microtime(true) * 1000);
    $image = $milliseconds.'_'.$name;

    if(isset($_SESSION['role'])){
        $action = 'Update Resident named '.$txt_edit_lname.', '.$txt_edit_fname.' '.$txt_edit_mname;
        $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
    }

$su = mysqli_query($con,"SELECT * from tblnewresident");
$ct = mysqli_num_rows($su);

if($ct == 0){

    if($name != ""){
            if(($imagetype=="image/jpeg" || $imagetype=="image/png" || $imagetype=="image/bmp") && $size<=2048000){
                if(move_uploaded_file($temp, 'image/'.$image))
                {

                $txt_edit_image = $image;
                $update_query = mysqli_query($con,"UPDATE tblnewresident set 
                                        lname = '".$txt_edit_lname."',
                                        fname = '".$txt_edit_fname."',
                                        mname = '".$txt_edit_mname."',
                                        bdate = '".$txt_edit_bdate."',
                                        bplace = '".$txt_edit_bplace."',
                                        age = '".$txt_edit_age."',
                                        barangay = '".$txt_edit_brgy."',
                                        zone = '".$txt_edit_zone."',
                                        totalhousehold = '".$txt_edit_householdmem."',
                                        province = '".$txt_edit_province."',
                                       
                                        civilstatus = '".$ddl_edit_cstatus."',
                                        occupation = '".$txt_edit_occp."',
                                        
                                        householdnum = '".$txt_edit_householdnum."',
                                        lengthofstay = '".$txt_edit_length."',
                                        region = '".$txt_edit_region."',
                                        Citizenship = '".$txt_edit_Citizenship."',
                                        gender = '".$ddl_edit_gender."',
                                       
                                        
                                       
                                        highestEducationalAttainment = '".$ddl_edit_eattain."',
                                       
                                        
                                        
                                      
                                       
                                        formerAddress = '".$txt_edit_faddress."',
                                        Municipality = '".$txt_edit_Municipality."',
                                        image = '".$txt_edit_image."',
                                        where id = '".$txt_id."'
                                ") or die('Error: ' . mysqli_error($con));
                }
            }
            else{
                $_SESSION['filesize'] = 1; 
                header ("location: ".$_SERVER['REQUEST_URI']);
            }
    }
    else{

        $chk_image = mysqli_query($con,"SELECT * from tblnewresident where id = '".$_POST['hidden_id']."' ");
        $rowimg = mysqli_fetch_array($chk_image);

        $txt_edit_image = $rowimg['image'];
        $update_query = mysqli_query($con,"UPDATE tblnewresident set 
                                        lname = '".$txt_edit_lname."',
                                        fname = '".$txt_edit_fname."',
                                        mname = '".$txt_edit_mname."',
                                        bdate = '".$txt_edit_bdate."',
                                        bplace = '".$txt_edit_bplace."',
                                        age = '".$txt_edit_age."',
                                        barangay = '".$txt_edit_brgy."',
                                        zone = '".$txt_edit_zone."',
                                        totalhousehold = '".$txt_edit_householdmem."',
                                       
                                       
                                        province = '".$txt_edit_province."',
                                       
                                        civilstatus = '".$ddl_edit_cstatus."',
                                        occupation = '".$txt_edit_occp."',
                                        
                                        householdnum = '".$txt_edit_householdnum."',
                                        lengthofstay = '".$txt_edit_length."',
                                        region = '".$txt_edit_region."',
                                        Citizenship = '".$txt_edit_Citizenship."',
                                        gender = '".$ddl_edit_gender."',
                                      
                                       
                                       
                                        highestEducationalAttainment = '".$ddl_edit_eattain."',
                                        
                                      
                                       
                                       
                                        
                                        formerAddress = '".$txt_edit_faddress."',
                                        Municipality = '".$txt_edit_Municipality."',
                                        image = '".$txt_edit_image."',
                                        where id = '".$txt_id."'
                                ") or die('Error: ' . mysqli_error($con));
    }
        
        if($update_query == true){
            $_SESSION['edited'] = 1;
            header("location: ".$_SERVER['REQUEST_URI']);
        }

    }
    else{
        $_SESSION['duplicateuser'] = 0;
        header ("location: ".$_SERVER['REQUEST_URI']);
    }  

    
}

if(isset($_POST['btn_restore']))
{
    if(isset($_POST['chk_restore']))
    {
        foreach($_POST['chk_restore'] as $value)
        {
            $delete_query = mysqli_query($con,"UPDATE from tblnewresident set statRes=0 where id = '$value' ") or die('Error: ' . mysqli_error($con));
                    
            if($delete_query == true)
            {
                $_SESSION['restore'] = 1;
                header("location: ".$_SERVER['REQUEST_URI']);
            }
        }
    }
}
if(isset($_POST['btn_delete_update'])) {
    if(isset($_POST['deleteItem'])) {
        foreach($_POST['deleteItem'] as $value) {
            $delete_query = mysqli_query($con, "UPDATE tblnewresident SET statRes = 1 WHERE id = '$value' ") or die('Error: ' . mysqli_error($con));
            if($delete_query) {
                $_SESSION['delete'] = 1;
                header("location: ".$_SERVER['REQUEST_URI']);
                exit; 
            }
        }
    }
}

if(isset($_POST['btn_delete'])) {
    if(isset($_POST['chk_delete'])) {
        foreach($_POST['chk_delete'] as $value) {
            $delete_query = mysqli_query($con, "DELETE FROM tblnewresident WHERE id = '$value' ") or die('Error: ' . mysqli_error($con));
            if($delete_query) {
                $_SESSION['delete'] = 1;
                header("location: ".$_SERVER['REQUEST_URI']);
                exit; // Exit after redirect
            }
        }
    }
}
?>
