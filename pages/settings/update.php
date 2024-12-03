<?php 
if (isset($_POST['btn_update'])) {
    $userid = $_SESSION['userid']; // Get user_id from session
    $name = $_POST['name']; // Get the name from the form

    // Check if a logo was uploaded
    if ($_FILES['logo']['error'] > 0) {
        // Update only the name in the database by user_id
        $stmt = $con->query("UPDATE tblsettings SET name = '$name' WHERE user_id = '$userid'");
        if ($stmt) {
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Name Updated Successfully!',
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
        }
    } else {
        // Process the uploaded logo
        $filename = $_FILES['logo']['name'];
        $tmpname = $_FILES['logo']['tmp_name'];
        $img_type = $_FILES['logo']['type'];
        $folder = "../../images/" . $filename;

        // Validate image format
        if ($img_type == "image/jpg" || $img_type == "image/png" || $img_type == "image/jpeg") {
            // Update name and logo in the database by user_id
            $stmt = $con->query("UPDATE tblsettings SET name = '$name', logo = '$filename' WHERE user_id = '$userid'");
            if ($stmt) {
                // Move uploaded file to the specified folder if it doesn't already exist
                if (!file_exists($folder)) {
                    move_uploaded_file($tmpname, $folder);
                }
                ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Name and Logo Updated Successfully!',
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
            }
        } else {
            // Handle invalid image format
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
        }
    }
}
?>
