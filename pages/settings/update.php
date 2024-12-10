<?php 
if (isset($_POST['btn_update'])) {
    $userid = $_SESSION['userid']; // Get user_id from session
    $name = $_POST['name']; // Get the name from the form
    // Check if a record exists for the given user_id
    $checkQuery = $con->query("SELECT COUNT(*) as count FROM tblsettings WHERE user_id = '$userid'");
    $row = $checkQuery->fetch_assoc();
    if ($row['count'] == 0) {
        // No data exists for this user_id, insert a new record
        if ($_FILES['logo']['error'] > 0) {
            // Insert without logo
            $stmt = $con->query("INSERT INTO tblsettings (name, user_id) VALUES ('$name', '$userid')");
        } else {
            // Insert with logo
            $filename = $_FILES['logo']['name'];
            $tmpname = $_FILES['logo']['tmp_name'];
            $img_type = $_FILES['logo']['type'];
            $folder = "../../images/" . $filename;
            // Validate image format
            if ($img_type == "image/jpg" || $img_type == "image/png" || $img_type == "image/jpeg") {
                $stmt = $con->query("INSERT INTO tblsettings (name, user_id, logo) VALUES ('$name', '$userid', '$filename')");
                if (!file_exists($folder)) {
                    move_uploaded_file($tmpname, $folder);
                }
            } else {
                // Invalid image format
                ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Image Format! Only JPG, PNG, and JPEG are allowed.',
                        showConfirmButton: false,
                        timer: 1500,
                        customClass: {
                            confirmButton: 'swal2-square-button'
                        }
                    }).then(() => {
                        window.location.href = "settings.php";
                    });
                </script>
                <?php
                exit; // Stop execution
            }
 if (isset($_POST['btn_update'])) {
    $name = $_POST['name'];
    $userid = $_SESSION['userid'];
    
    if ($_FILES['logo']['error'] > 0) {
        $stmt = $con->query("UPDATE tblsettings SET name = '$name', user_id = '$userid'");
        if ($stmt) {
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Updated Successfully!',
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        confirmButton: 'swal2-square-button'
                    }
                }).then(() => {
                    window.location.href = "settings.php"
                });
               
            </script>
            <?php 
        }
    }else{
        $filename = $_FILES['logo']['name'];
        $tmpname = $_FILES['logo']['tmp_name'];
        $img_type = $_FILES['logo']['type'];
        $folder = "../../images/" . $filename;

        if ($img_type == "image/jpg" || $img_type == "image/png" || $img_type == "image/jpeg") {
            $stmt = $con->query("UPDATE tblsettings SET name = '$name', user_id = '$userid', logo = '$filename'");
            if ($stmt) {
                if (!file_exists($folder)) {
                    move_uploaded_file($tmpname, $folder); 
                }
                    ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated Successfully!',
                            showConfirmButton: false,
                            timer: 1500,
                            customClass: {
                                confirmButton: 'swal2-square-button'
                            }
                        }).then(() => {
                            window.location.href = "settings.php"
                        });
                       
                    </script>
                    <?php 
                
            }
        }else{
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid image format',
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        confirmButton: 'swal2-square-button'
                    }
                }).then(() => {
                    window.location.href = "settings.php"
                });
               
            </script>
            <?php 
        }

    }

}
