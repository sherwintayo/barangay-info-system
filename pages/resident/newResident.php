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
                        Resident
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
                                    <div style="padding:10px;">

                                        <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#addCourseModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Add
                                            Residents</button>
                                        <?php
                                        if (!isset($_SESSION['staff'])) {
                                            ?>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i
                                                    class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="info-box-content"
                                        style="float: right; margin-top: -50px; font-weight: bold; margin-bottom: -20px;">
                                        <span class="info-box-text">Total Resident</span>
                                        <span class="info-box-number" style="text-align: center;">
                                            <?php
                                            $q = mysqli_query($con, "SELECT * from tblresident where statRes=0 AND status = 'New Resident'");
                                            $num_rows = mysqli_num_rows($q);
                                            echo $num_rows;
                                            ?>
                                        </span>
                                    </div>
                                    <div class="navbar-left">
                                        <ul class="nav navbar-nav" style="background:white;">
                                            <!-- User Account: style can be found in dropdown.less -->
                                           

                                                <ul class="nav navbar-nav">
                                                    <li class="dropdown user user-menu">
                                                        <a href="resident.php" class="dropdown-toggle" data-toggle="dropdown">
                                                            <i class="glyphicon glyphicon-user"></i>
                                                            <span>Select Resident Status: <i class="caret"></i></span>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li class="user-header bg-white"></li>
                                                            <div class="box-body table-responsive">
                                                                <ul class="nav nav-tabs" id="myTab">
                                                                    <li class="user-footer">
                                                                        <a href="resident.php" class="btn btn-default btn-flat"
                                                                          >Active Resident</a>
                                                                        <a href="inactiveRes.php"
                                                                            class="btn btn-default btn-flat">Inactive
                                                                            Resident</a>
                                                                        <a href="newResident.php"
                                                                            class="btn btn-default btn-flat">New Resident</a>
                                                                            <a href="pwd.php" class="btn btn-default btn-flat">PWD</a>
                                                                    <a href="senior.php" class="btn btn-default btn-flat">Senior</a>
                                                                    <a href="pregnant.php" class="btn btn-default btn-flat">Pregnant</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </ul>
                                                    </li>
                                                </ul>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <form method="post" enctype="multipart/form-data">
                                        <table id="table" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <?php
                                                    if (!isset($_SESSION['staff'])) {
                                                        ?>
                                                        <th style="width: 20px !important;"><input type="checkbox" class="cbxMain" onchange="checkMain(this)" />
                                                        </th>
                                                        <?php
                                                    }
                                                    ?>
                                                    <th>Zone/Sitio/Purok</th>
                                                    <th>Image</th>
                                                    <th>Name</th>

                                                    <th>Gender</th>
                                                    <th>Former Address</th>
                                                    <th style="width: 40px !important;">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!isset($_SESSION['staff'])) {
                                                    $squery = mysqli_query($con, "SELECT *,zone,id,CONCAT(lname, ', ', fname, ' ', mname) as cname, age, gender, formerAddress, image FROM tblresident where statRes=0 AND status = 'New Resident' order by zone ");
                                                    while ($row = mysqli_fetch_array($squery)) {
                                                        echo '
                                                    <tr>
                                                        <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="' . $row['id'] . '" /></td>
                                                        <td>' . $row['zone'] . '</td>
                                                        <td style="width:70px;"><image src="image/' . basename($row['image']) . '" style="width:60px;height:60px;"/></td>
                                                        <td>' . $row['cname'] . '</td>
                                                        
                                                        <td>' . $row['gender'] . '</td>
                                                        <td>' . $row['formerAddress'] . '</td>
                                                        <td><button class="btn btn-primary btn-sm" data-target="#editModal' . $row['id'] . '" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></td>
                                                    </tr>
                                                    ';

                                                        include "edit_modalres.php";
                                                    }
                                                } else {
                                                    $squery = mysqli_query($con, "SELECT *,zone,id,CONCAT(lname, ', ', fname, ' ', mname) as cname, age, gender, formerAddress, image FROM tblresident WHERE status = 'New Resident' order by zone");
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

                                                        include "edit_modalres.php";
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

                            <?php include "add_modal.php"; ?>

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
                                                    <th style="width: 20px !important;"><input type="checkbox" class="cbxMain" onchange="checkMain(this)" />
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
                                                $squery = mysqli_query($con, "SELECT *,id,CONCAT(lname, ', ', fname, ' ', mname) as cname, age, gender, formerAddress, image FROM tblresident where householdnum = '" . $_GET['resident'] . "'");
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

                                                    include "edit_modalres.php";
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
         success();
        $(function () {
            $("#table").dataTable({
                "aoColumnDefs": [{ "bSortable": false, "aTargets": [0, 6] }], "aaSorting": []
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
