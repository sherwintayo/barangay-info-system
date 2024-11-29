<!DOCTYPE html>
<html>
<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
    exit();
} else {
    include('../head_css.php');
    include("../connection.php");
?>
    <script src="sweet_alert.js"></script>
    <style>
        .input-size {
            width: 418px;
        }
    </style>

    <body class="skin-black">
        <?php include('../header.php'); ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Settings</h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="box">
                            <div class="box-header"></div>
                            <div class="box-body table-responsive">
                                <form method="post" enctype="multipart/form-data">
                                    <?php
                                    // Fetch current settings for displaying
                                    $squery = $con->query("SELECT * FROM tblsettings LIMIT 1");
                                    $data = $squery->fetch_assoc();
                                    ?>
                                    
                                    <!-- Barangay Name -->
                                    <label for="name">Barangay Name</label>
                                    <input type="text" name="name" class="form-control input-size" style="margin: 10px 0;" value="<?= $data['name'] ?>" required>

                                    <!-- Barangay Logo -->
                                    <label for="logo">Barangay Logo</label>
                                    <br>
                                    <img src="../../images/<?= $data['logo'] ?>" alt="Barangay Logo" style="width: 200px; margin: 10px 0;">
                                    <input type="file" name="logo" accept="image/*" class="form-control input-size" style="margin: 10px 0;">
                                    
                                    <!-- Existing Logo (no removal, just update) -->
                                    <label for="existing_logo">Existing Logo</label>
                                    <br>
                                    <img src="../../images/<?= $data['existing_logo'] ?>" alt="Existing Logo" style="width: 200px; margin: 10px 0;">
                                    <input type="file" name="existing_logo" accept="image/*" class="form-control input-size" style="margin: 10px 0;">

                                    <!-- Update Button -->
                                    <input type="submit" class="btn btn-primary btn-sm" name="btn_update" value="Update">
                                </form>
                                <?php include "update.php"; ?>
                            </div>
                        </div>
                    </div>
                </section>
            </aside>
        </div>

        <!-- Footer -->
        <?php include "../footer.php"; ?>

        <!-- jQuery and SweetAlert -->
        <script type="text/javascript">
            $(function() {
                $("#table").dataTable({
                    "aoColumnDefs": [{
                        "bSortable": false,
                        "aTargets": [0, 6]
                    }],
                    "aaSorting": []
                });
            });
        </script>

        <style>
            .navbar-nav {
                background-color: white;
                border-radius: 8px;
                padding: 10px;
            }

            .dropdown-menu {
                background-color: #f8f9fa;
                border: none;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            .dropdown-menu .user-header {
                background-color: white;
            }

            .dropdown-menu .user-footer {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                padding: 10px;
            }

            .dropdown-menu .user-footer a {
                width: 100%;
                text-align: left;
                margin-bottom: 5px;
                color: #333;
                background-color: #fff;
                border: 1px solid #ddd;
                border-radius: 4px;
                padding: 10px 15px;
                transition: background-color 0.3s ease;
            }

            .dropdown-menu .user-footer a:hover {
                background-color: #e9ecef;
                color: #007bff;
            }
        </style>
    </body>
</html>
<?php 
} // Close the else statement for the session check
?>
