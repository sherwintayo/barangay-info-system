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
                        Archieve
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
                                   if ($isZoneLeader) {
                                    $q = mysqli_query($con, "SELECT * from tblresident where statRes=0 AND barangay = '$zone_barangay' AND status = 'Inactive' ");
                                   }else{
                                    $q = mysqli_query($con, "SELECT * from tblresident where statRes=0 AND status = 'Inactive' ");
                                   }
                                    $num_rows = mysqli_num_rows($q);
                                    echo $num_rows;
                                    ?>
                                </span>
                            </div>
                            <!-- <div class="box-body table-responsive">
                                <ul class="nav nav-tabs" id="myTab">
                                    <li class="active"><a href="archive.php">Active Residents</a></li>
                                    <li><a href="inactiveRes.php">Inactive Residents</a></li>
                                    <li><a href="newResident.php">New Residents</a></li>

                                </ul>
                            </div> -->
                            <!-- /.box-header -->
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
                                                <th>Zone/Sitio/Purok</th>
                                                <th>Image</th>
                                                <th>Name</th>

                                                <th>Gender</th>
                                                <th>Former Address</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!isset($_SESSION['staff'])) {
                                               if ($isZoneLeader) {
                                                $squery = mysqli_query($con, "SELECT zone,id,CONCAT(lname, ', ', fname, ' ', mname) as cname, age, gender, formerAddress, image FROM tblresident where statRes=0 AND status = 'Inactive' AND barangay = '$zone_barangay' order by zone ");
                                               }else{
                                                $squery = mysqli_query($con, "SELECT zone,id,CONCAT(lname, ', ', fname, ' ', mname) as cname, age, gender, formerAddress, image FROM tblresident where statRes=0 AND status = 'Inactive' order by zone ");
                                               }
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
                                                $squery = mysqli_query($con, "SELECT zone,id,CONCAT(lname, ', ', fname, ' ', mname) as cname, age, gender, formerAddress, image FROM tblresident WHERE barangay = '$zone_barangay' order by zone");
                                                while ($row = mysqli_fetch_array($squery)) {
                                                    echo '
                                                    <tr>
                                                        <td>' . $row['zone'] . '</td>
                                                        <td style="width:70px;"><image src="image/' . basename($row['image']) . '" style="width:60px;height:60px;"/></td>
                                                        <td>' . $row['cname'] . '</td>
                                                        <td>' . $row['age'] . '</td>
                                                        <td>' . $row['gender'] . '</td>
                                                        <td>' . $row['formerAddress'] . '</td>
                                                        
                                                    </tr>
                                                    ';


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


                        <?php include "function.php"; ?>


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
                                        $squery = mysqli_query($con, "SELECT id,CONCAT(lname, ', ', fname, ' ', mname) as cname, age, gender, formerAddress, image FROM tblresident where householdnum = '" . $_GET['resident'] . "' AND status = 'Inactive' AND barangay = '$zone_barangay' ");
                                        while ($row = mysqli_fetch_array($squery)) {
                                            echo '
                                                <tr>
                                                    <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="' . $row['id'] . '" /></td>
                                                    <td style="width:70px;"><image src="image/' . basename($row['image']) . '" style="width:60px;height:60px;"/></td>
                                                    <td>' . $row['cname'] . '</td>
                                                    <td>' . $row['age'] . '</td>
                                                    <td>' . $row['gender'] . '</td>
                                                    <td>' . $row['formerAddress'] . '</td>
                                                    
                                                </tr>
                                                ';


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
