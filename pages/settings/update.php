<?php 
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
