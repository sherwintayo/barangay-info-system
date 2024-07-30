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
      $txt_edit_type = $_POST['status'];
  
      $milliseconds = round(microtime(true) * 1000);
      $image = $milliseconds.'_'.$name;
      $status = $_POST['status'];

      move_uploaded_file($temp, 'image/'.$image);
  
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
        datemove,
        status
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
        '$txt_date_of_transfer',
        '$status'
    )";
      // Execute the query
      if($con->query($sql)){
          // Redirect to success page
        //   header("Location: <?= $_SERVER['REQUEST_URI']");
        //   exit();

        ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        Swal.fire({
        icon: 'success',
        title: 'Resident Added Successfully!',
        showConfirmButton: false,
        timer: 1500,
        customClass: {
            confirmButton: 'swal2-square-button'
        }
    }).then(() => {
        window.location.href = "<?= $_SERVER['REQUEST_URI'] ?>"
    });
    })
</script>
<?php
      } else {
          // Error inserting data
          echo "Error: " . $sql . "<br>" . $con->error;
      }

}


if(isset($_POST['btn_save']))
{
    $txt_id = $_POST['hidden_id'];
    $txt_edit_lname = $_POST['txt_lname'];
    $txt_edit_fname = $_POST['txt_fname'];
    $txt_edit_mname = $_POST['txt_mname'];
    $txt_edit_bdate = $_POST['txt_bdate'];
    $txt_edit_bplace = $_POST['txt_bplace'];
    $dateOfBirth = $txt_edit_bdate;
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
    // $txt_edit_age = $diff->format('%y');
    $txt_edit_brgy = $_POST['txt_brgy'];   
    $txt_edit_province = $_POST['txt_province'];
    $txt_edit_zone = $_POST['txt_zone'];
    $txt_edit_householdmem = $_POST['txt_householdmem'];
    $txt_edit_cstatus = $_POST['txt_cstatus'];
    $txt_edit_occp = $_POST['txt_occp'];
    $txt_edit_householdnum = $_POST['txt_householdnum'];
    // $txt_edit_length = $_POST['txt_length'];
    $txt_edit_region = $_POST['txt_region'];
    $txt_edit_Citizenship = $_POST['txt_Citizenship'];
    $ddl_edit_gender = $_POST['ddl_gender'];
    $ddl_edit_eattain = $_POST['ddl_eattain'];
    $txt_edit_faddress = $_POST['txt_faddress'];
    $txt_edit_Municipality = $_POST['txt_Municipality'];
    $txt_edit_type = $_POST['status'];
    $milliseconds = round(microtime(true) * 1000);
    $txt_date_of_transfer = $_POST['txt_date_of_transfer'];


    // if(isset($_SESSION['role'])){
    //     $action = 'Update Resident named '.$txt_edit_lname.', '.$txt_edit_fname.' '.$txt_edit_mname;
    //     $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
    // }

    $su = mysqli_query($con,"SELECT * from tblnewresident");
    $ct = mysqli_num_rows($su);

    if ($_FILES['txt_image']['error'] > 0) {
        
        // $txt_edit_image = $image;
            $update_query = mysqli_query($con,"UPDATE tblnewresident SET
                                    lname = '$txt_edit_lname',
                                    fname = '$txt_edit_fname',
                                    mname = '$txt_edit_mname',
                                    bdate = '$txt_edit_bdate',
                                    bplace = '$txt_edit_bplace',
                                    barangay = '$txt_edit_brgy',
                                    zone = '$txt_edit_zone',
                                    totalhousehold = '$txt_edit_householdmem',
                                    province = '$txt_edit_province',
                                    civilstatus = '$txt_edit_cstatus',
                                    occupation = '$txt_edit_occp',
                                    householdnum = '$txt_edit_householdnum',
                                    region = '$txt_edit_region',
                                    Citizenship = '$txt_edit_Citizenship',
                                    gender = '$ddl_edit_gender',
                                    highestEducationalAttainment = '$ddl_edit_eattain',
                                    formerAddress = '$txt_edit_faddress',
                                    Municipality = '$txt_edit_Municipality',
                                    status = '$txt_edit_type',
                                    datemove = '$txt_date_of_transfer'
                                    where id = '$txt_id'
                            ") or die('Error: ' . mysqli_error($con));
                            ?>
                            <script>
                                document.addEventListener('DOMContentLoaded', () => {
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'Updated Successfully!',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    customClass: {
                                        confirmButton: 'swal2-square-button'
                                    }
                                }).then(() => {
                                    window.location.href = "<?= $_SERVER['REQUEST_URI'] ?>"
                                });
                                })
                            </script>
                            <?php
    }else{
        $name = basename($_FILES['txt_image']['name']);
        $temp = $_FILES['txt_image']['tmp_name'];
        $imagetype = $_FILES['txt_image']['type'];
        $size = $_FILES['txt_image']['size'];
        $image = $milliseconds.'_'.$name;
        
        if(($imagetype=="image/jpeg" || $imagetype=="image/png" || $imagetype=="image/bmp") && $size<=2048000){
            if(move_uploaded_file($temp, 'image/'.$image))
            {
        
            $txt_edit_image = $image;
            $update_query = mysqli_query($con,"UPDATE tblnewresident set 
                                     lname = '$txt_edit_lname',
                                    fname = '$txt_edit_fname',
                                    mname = '$txt_edit_mname',
                                    bdate = '$txt_edit_bdate',
                                    bplace = '$txt_edit_bplace',
                                    barangay = '$txt_edit_brgy',
                                    zone = '$txt_edit_zone',
                                    totalhousehold = '$txt_edit_householdmem',
                                    province = '$txt_edit_province',
                                    civilstatus = '$txt_edit_cstatus',
                                    occupation = '$txt_edit_occp',
                                    householdnum = '$txt_edit_householdnum',
                                    region = '$txt_edit_region',
                                    Citizenship = '$txt_edit_Citizenship',
                                    gender = '$ddl_edit_gender',
                                    highestEducationalAttainment = '$ddl_edit_eattain',
                                    formerAddress = '$txt_edit_faddress',
                                    Municipality = '$txt_edit_Municipality',
                                    status = '$txt_edit_type',
                                    image = '$txt_edit_image',
                                    datemove = '$txt_date_of_transfer'
                                    where id = '$txt_id'
                            ") or die('Error: ' . mysqli_error($con));
                            ?>
                            <script>
                                document.addEventListener('DOMContentLoaded', () => {
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'Updated Successfully!',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    customClass: {
                                        confirmButton: 'swal2-square-button'
                                    }
                                }).then(() => {
                                    window.location.href = "<?= $_SERVER['REQUEST_URI'] ?>"
                                });
                                })
                            </script>
                            <?php
            }
        }
        else{
            $_SESSION['filesize'] = 1; 
            header ("location: ".$_SERVER['REQUEST_URI']);
        }
    }

}


// STORE

if(isset($_POST['btn_restore']))
{
    if(isset($_POST['chk_restore']))
    {
        foreach($_POST['chk_restore'] as $value)
        {
            $delete_query = mysqli_query($con,"UPDATE from tblnewresident set statRes=0 where id = '$value' ") or die('Error: ' . mysqli_error($con));
                    
            if($delete_query == true)
            {
                // $_SESSION['restore'] = 1;
                // header("location: ".$_SERVER['REQUEST_URI']);
                ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        Swal.fire({
        icon: 'success',
        title: 'Restored Successfully!',
        showConfirmButton: false,
        timer: 1500,
        customClass: {
            confirmButton: 'swal2-square-button'
        }
    }).then(() => {
        window.location.href = "<?= $_SERVER['REQUEST_URI'] ?>"
    });
    })
</script>
<?php
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
                // header("location: ".$_SERVER['REQUEST_URI']);
                // exit; 
                ?>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        Swal.fire({
                        icon: 'success',
                        title: 'Deleted Successfully!',
                        showConfirmButton: false,
                        timer: 1500,
                        customClass: {
                            confirmButton: 'swal2-square-button'
                        }
                    }).then(() => {
                        window.location.href = "<?= $_SERVER['REQUEST_URI'] ?>"
                    });
                    })
                </script>
                <?php
            }
        }
    }
}

if(isset($_POST['btn_delete'])) {
    if(isset($_POST['chk_delete'])) {
        foreach($_POST['chk_delete'] as $value) {
            $delete_query = mysqli_query($con, "DELETE FROM tblnewresident WHERE id = '$value' ") or die('Error: ' . mysqli_error($con));
            if($delete_query) {
                ?>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        Swal.fire({
                        icon: 'success',
                        title: 'Deleted Successfully!',
                        showConfirmButton: false,
                        timer: 1500,
                        customClass: {
                            confirmButton: 'swal2-square-button'
                        }
                    }).then(() => {
                        window.location.href = "<?= $_SERVER['REQUEST_URI'] ?>"
                    });
                    })
                </script>
                <?php
                $_SESSION['delete'] = 1;
                header("location: ".$_SERVER['REQUEST_URI']);
                exit; // Exit after redirect
                
            }
        }
    }
}
?>
