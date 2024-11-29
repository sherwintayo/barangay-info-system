<?php 
if (isset($_POST['btn_update'])) {
    $name = $_POST['name'];
    $userid = $_SESSION['userid'];

    // Update Barangay Logo
    if ($_FILES['logo']['error'] > 0) {
        // Update the name and user_id, but not the logo
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
    } else {
        $filename = $_FILES['logo']['name'];
        $tmpname = $_FILES['logo']['tmp_name'];
        $img_type = $_FILES['logo']['type'];
        $folder = "../../images/" . $filename;

        if ($img_type == "image/jpg" || $img_type == "image/png" || $img_type == "image/jpeg") {
            // Update the name, user_id, and logo
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
        } else {
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

    // Update Existing Logo (similar logic)
    if ($_FILES['existing_logo']['error'] > 0) {
        // No existing logo uploaded, update only the name and user_id
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
    } else {
        $existing_filename = $_FILES['existing_logo']['name'];
        $existing_tmpname = $_FILES['existing_logo']['tmp_name'];
        $existing_img_type = $_FILES['existing_logo']['type'];
        $existing_folder = "../../images/" . $existing_filename;

        if ($existing_img_type == "image/jpg" || $existing_img_type == "image/png" || $existing_img_type == "image/jpeg") {
            // Update the existing logo
            $stmt = $con->query("UPDATE tblsettings SET name = '$name', user_id = '$userid', existing_logo = '$existing_filename'");
            if ($stmt) {
                if (!file_exists($existing_folder)) {
                    move_uploaded_file($existing_tmpname, $existing_folder);
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
        } else {
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid image format for Existing Logo',
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
?>
