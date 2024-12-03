<!DOCTYPE html>
<html>

<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
} else {
    ob_start();
    include('../head_css.php'); 
    
    ?>
    <script src="sweet_alert.js"></script>
    <style>
        .input-size {
            width: 418px;
        }
    </style>

    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php

        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Settings
                    </h1>

                </section>

                <?php
                if (!isset($_GET['resident'])) {
                ?>
                    <!-- Main content -->
                    <section class="content">
                        <div class="row">
                            <!-- left column -->
                            <div class="box">
                                <div class="box-header">
                                   
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <form method="post" enctype="multipart/form-data">

                                        <?php
                                        if (!isset($_SESSION['staff'])) {
                                           // Get the user_id from session
                                            $userid = $_SESSION['userid'];
                                            
                                            $squery = mysqli_query($con, "SELECT * FROM tblsettings WHERE user_id = '$userid'");
                                            
                                            if ($squery && mysqli_num_rows($squery) > 0) {
                                                $data = $squery->fetch_assoc();
                                            } else {
                                                // Default values if no data is found
                                                $data = [
                                                    'name' => '',
                                                    'logo' => 'madridejos.png' // Replace with a default image path
                                                ];
                                            }
                                        ?>
                                            <form method="post" enctype="multipart/form-data">
                                                <label for="">Name</label>
                                                <input type="text" name="name" class="form-control" style="margin: 10px 0;" value="<?= $data['name'] ?>">
                                                <label for="">Logo</label>
                                                <br>
                                                <img src="../../images/<?= $data['logo'] ?>" alt="image" style="width: 200px;margin: 10px 0;">
                                                <input type="file" name="logo" accept="image/*" class="form-control" style="margin: 10px 0;">

                                                <input type="submit" class="btn btn-primary btn-sm" name="btn_update" id="btn_update" value="Update" />

                                                <?php require 'update.php' ?>
                                            </form>
                                        <?php
                                        }
                                        ?>

                                        <?php # include "../deleteModal.php"; ?>

                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                          

                            <?php include "update.php"; ?>


                        </div> <!-- /.row -->
                    </section><!-- /.content -->
                <?php
                } ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
    <?php }
include "../footer.php"; ?>

    <script type="text/javascript">
        success();
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
