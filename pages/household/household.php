<!DOCTYPE html>
<html>

    <?php
    session_start();
    if(!isset($_SESSION['role']))
    {
        header("Location: ../../login.php"); 
    }
    else
    {
    ob_start();
    include('../head_css.php');

        $request = $_SERVER['REQUEST_URI'];
if (substr($request, -4) == '.php') {
    $new_url = substr($request, 0, -4);
    header("Location: $new_url", true, 301);
    exit();
}
        
        ?>
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
                        Household
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                            <div class="box">
                                <div class="box-header">
                                    <div style="padding:10px;">
                                            <?php
// Check if the session role is not equal to 'Administrator'
if ($_SESSION['role'] != 'administrator') {
?>
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Household</button>  
                                        
                                        <?php 
                                            if(!isset($_SESSION['staff']))
                                            {
                                        ?>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button> 
                                        <?php
                                            }
}
                                        ?>
                                
                                    </div>    
                                    <div class="info-box-content" style="float: right; margin-top: -50px; font-weight: bold; margin-bottom: -20px;">
                                      <span class="info-box-text">Total Household</span>
                                      <span class="info-box-number" style="text-align: center;">
                                        <?php
                                            if ($isZoneLeader) {
                                                $q = mysqli_query($con,"SELECT * from tblhousehold WHERE barangay = '$zone_barangay'");
                                            }else{
                                                $q = mysqli_query($con,"SELECT * from tblhousehold");
                                            }
                                            $num_rows = mysqli_num_rows($q);
                                            echo $num_rows;
                                        ?>
                                      </span>
                                    </div>                            
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <form method="post">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <?php 
                                                if(!isset($_SESSION['staff']))
                                                {
                                                ?>
                                                <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)"/></th>
                                                <?php
                                                    }
                                                ?>
                                                <th>Household #</th>
                                                <th>Zone/Purok</th>
                                                <th>Total Members</th>
                                                <th>Head of Family</th>
                                                <?php
// Check if the session role is not equal to 'Administrator'
if ($_SESSION['role'] != 'administrator') {
?>
                                                <th style="width: 40px !important;">Option</th>
                                                    <?php
}
?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
if (!isset($_SESSION['staff'])) {
    if ($isZoneLeader) {
        $squery = mysqli_query($con, "SELECT *,h.id as hid,h.zone as hzone,CONCAT(r.lname, ', ', r.fname, ' ', r.mname) as hname FROM tblhousehold h LEFT JOIN tblresident r ON r.id = h.headoffamily WHERE h.barangay = '$zone_barangay'");
    } else {
        $squery = mysqli_query($con, "SELECT *,h.id as hid,h.zone as hzone,CONCAT(r.lname, ', ', r.fname, ' ', r.mname) as hname FROM tblhousehold h LEFT JOIN tblresident r ON r.id = h.headoffamily");
    }
    while ($row = mysqli_fetch_array($squery)) {
        echo '
        <tr>
            <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="' . $row['hid'] . '" /></td>
            <td><a href="../resident/resident.php?resident=' . $row['householdno'] . '">' . $row['householdno'] . '</a></td>
            <td>' . $row['hzone'] . '</td>
            <td>' . $row['totalhousehold'] . '</td>
            <td>' . $row['hname'] . '</td>';
        // Show "Edit" button only if session role is not Administrator
        if ($_SESSION['role'] !== 'administrator') {
            echo '<td><button class="btn btn-primary btn-sm" data-target="#editModal' . $row['hid'] . '" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></td>';
        } else {
           
        }
        echo '</tr>';

        include "edit_modal.php";
    }
} else {
    if ($isZoneLeader) {
        $squery = mysqli_query($con, "SELECT *,h.id as hid,h.zone as hzone,CONCAT(r.lname, ', ', r.fname, ' ', r.mname) as hname FROM tblhousehold h LEFT JOIN tblresident r ON r.id = h.headoffamily WHERE h.barangay = '$zone_barangay'");
    } else {
        $squery = mysqli_query($con, "SELECT *,h.id as hid,h.zone as hzone,CONCAT(r.lname, ', ', r.fname, ' ', r.mname) as hname FROM tblhousehold h LEFT JOIN tblresident r ON r.id = h.headoffamily");
    }
    while ($row = mysqli_fetch_array($squery)) {
        echo '
        <tr>
            <td><a href="../resident/resident.php?resident=' . $row['householdno'] . '">' . $row['householdno'] . '</a></td>
            <td>' . $row['hzone'] . '</td>
            <td>' . $row['totalhousehold'] . '</td>
            <td>' . $row['hname'] . '</td>';
        // Show "Edit" button only if session role is not Administrator
        if ($_SESSION['role'] !== 'administrator') {
            echo '<td><button class="btn btn-primary btn-sm" data-target="#editModal' . $row['hid'] . '" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></td>';
        } else {
        }
        echo '</tr>';

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

            <?php include "add_modal.php"; ?>

            <?php include "function.php"; ?>


                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <?php }
        include "../footer.php"; ?>
<script type="text/javascript">

    <?php
    if(!isset($_SESSION['staff']))
    {
    ?>
        $(function() {
            $("#table").dataTable({
               "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
            });
            $(".select2").select2();
        });
    <?php
    }
    else{
    ?>
        $(function() {
            $("#table").dataTable({
               "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 4 ] } ],"aaSorting": []
            });
            $(".select2").select2();
        });
    <?php
    }
    ?>
</script>
    </body>
</html>
