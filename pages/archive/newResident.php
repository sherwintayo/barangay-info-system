<!DOCTYPE html>
<html>

<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
} else {
    ob_start();
    include ('../head_css.php'); ?>
    <style>
        .input-size {
            width: 418px;
        }
    </style>

    <body class="skin-black">
        <script>
            // Check if localStorage is supported
            if (typeof (Storage) !== "undefined") {
                // Check if the resident's addition date is stored
                if (!localStorage.residentAddedDate) {
                    // If not stored, store the current date
                    localStorage.residentAddedDate = new Date().toISOString();
                } else {
                    // If stored, check if 6 months have passed
                    var currentDate = new Date();
                    var residentAddedDate = new Date(localStorage.residentAddedDate);
                    // Calculate the difference in milliseconds
                    var diffMilliseconds = currentDate - residentAddedDate;
                    // Calculate the difference in months
                    var diffMonths = diffMilliseconds / (1000 * 60 * 60 * 24 * 30);
                    // If 6 months have passed, show the notification
                    if (diffMonths >= 6) {
                        alert("Congratulations! You are now a citizen of this barangay.");
                        // Optionally, you can reset the residentAddedDate here
                        // localStorage.residentAddedDate = currentDate.toISOString();
                    }
                }
            } else {
                // If localStorage is not supported, you can use other methods to store data
                // This is just a basic example
                alert("Sorry, your browser does not support local storage.");
            }
        </script>

        <!-- header logo: style can be found in header.less -->
        <?php

        include "../connection.php";
        ?>
        <?php include ('../header.php'); ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include ('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Archive
                    </h1>

                </section>

                <?php
                if (!isset($_GET['resident'])) {
                    ?>
                    <!-- Main content -->
                    <section class="content">
                        <div class="row">

                            <div class="info-box-content"
                                style="float: right; margin-top: -50px; font-weight: bold; margin-bottom: -20px;">
                                <span class="info-box-text">Total Resident</span>
                                <span class="info-box-number" style="text-align: center;">
                                    <?php
                                    $q = mysqli_query($con, "SELECT * from tblnewresident where statRes=0");
                                    $num_rows = mysqli_num_rows($q);
                                    echo $num_rows;
                                    ?>
                                </span>
                            </div>
                            <div class="box-body table-responsive">
                                <ul class="nav nav-tabs" id="myTab">
                                    <li class="active"><a href="resident.php">Active Residents</a></li>
                                    <li><a href="inactiveRes.php">Inactive Residents</a></li>
                                    <li><a href="newResident.php">New Residents</a></li>

                                </ul>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <form method="post" enctype="multipart/form-data">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <?php
                                                if (!isset($_SESSION['staff'])) {
                                                    ?>
                                                    <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]"
                                                            class="cbxMain" onchange="checkMain(this)" /></th>
                                                    <?php
                                                }
                                                ?>
                                                <th>Zone/SITION/PUROK</th>
                                                <th>Image</th>
                                                <th>Name</th>

                                                <th>Gender</th>
                                                <th>Former Address</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!isset($_SESSION['staff'])) {
                                                $squery = mysqli_query($con, "SELECT zone,id,CONCAT(lname, ', ', fname, ' ', mname) as cname, age, gender, formerAddress, image FROM tblnewresident where statRes=0 order by zone ");
                                                while ($row = mysqli_fetch_array($squery)) {
                                                    echo '
                                                    <tr>
                                                        <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="' . $row['id'] . '" /></td>
                                                        <td>' . $row['zone'] . '</td>
                                                        <td style="width:70px;"><image src="image/' . basename($row['image']) . '" style="width:60px;height:60px;"/></td>
                                                        <td>' . $row['cname'] . '</td>
                                                        
                                                        <td>' . $row['gender'] . '</td>
                                                        <td>' . $row['formerAddress'] . '</td>
                                                        
                                                    </tr>
                                                    ';

                                                }
                                            } else {
                                                $squery = mysqli_query($con, "SELECT zone,id,CONCAT(lname, ', ', fname, ' ', mname) as cname, age, gender, formerAddress, image FROM tblnewresident order by zone");
                                                while ($row = mysqli_fetch_array($squery)) {
                                                    echo '
                                                    <tr>
                                                        <td>' . $row['zone'] . '</td>
                                                        <td style="width:70px;"><image src="image/' . basename($row['image']) . '" style="width:60px;height:60px;"/></td>
                                                        <td>' . $row['cname'] . '</td>
                                                        <td>' . $row['age'] . '</td>
                                                        <td>' . $row['gender'] . '</td>
                                                        <td>' . $row['formerAddress'] . '</td>
                                                        <td><button class="btn btn-primary btn-sm" data-target="#editModal' . $row['id'] . '" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></td>
                                                    </tr>
                                                    ';

                                                    include "edit_modal.php";
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <?php include "../deleteModal.php"; ?>

                                </form>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->

                        <?php include "../edit_notif.php"; ?>

                        <?php include "../added_notif.php"; ?>

                        <?php include "../delete_notif.php"; ?>

                        <?php include "../duplicate_error.php"; ?>


                        <?php include "function_newresident.php"; ?>


            </div> <!-- /.row -->
            </section><!-- /.content -->
            <?php
                } else {
                    ?>
            <section class="content">
                <div class="row">
                    <!-- left column -->
                    <div class="box">

                        <div class="box-body table-responsive">
                            <form method="post" enctype="multipart/form-data">
                                <table id="table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]"
                                                    class="cbxMain" onchange="checkMain(this)" />
                                            </th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Former Address</th>
                                            <th style="width: 40px !important;">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $squery = mysqli_query($con, "SELECT id,CONCAT(lname, ', ', fname, ' ', mname) as cname, age, gender, formerAddress, image FROM tblnewresident where householdnum = '" . $_GET['resident'] . "'");
                                        while ($row = mysqli_fetch_array($squery)) {
                                            echo '
                                                <tr>
                                                    <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="' . $row['id'] . '" /></td>
                                                    <td style="width:70px;"><image src="image/' . basename($row['image']) . '" style="width:60px;height:60px;"/></td>
                                                    <td>' . $row['cname'] . '</td>
                                                    <td>' . $row['age'] . '</td>
                                                    <td>' . $row['gender'] . '</td>
                                                    <td>' . $row['formerAddress'] . '</td>
                                                    <td><button class="btn btn-primary btn-sm" data-target="#editModal' . $row['id'] . '" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></td>
                                                </tr>
                                                ';

                                            include "edit_modal.php";
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <?php include "../deleteModal.php"; ?>
                                <?php include "../duplicate_error.php"; ?>

                            </form>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div> <!-- /.row -->
            </section><!-- /.content -->
            <?php
                }
                ?>
        </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
    <?php }
include "../footer.php"; ?>
    <script type="text/javascript">
        $(function () {
            $("#table").dataTable({
                "aoColumnDefs": [{ "bSortable": false, "aTargets": [0, 6] }], "aaSorting": []
            });
        });
    </script>
</body>

</html>