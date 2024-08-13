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
    include('../head_css.php'); ?>
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
                        Blotter
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                            <div class="box">
                                <div class="box-header">
                                    <div style="padding:10px;">
                                        
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Blotter</button>  
                                        <?php 
                                            if(!isset($_SESSION['staff']))
                                            {
                                        ?>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button> 
                                        <?php
                                            }
                                        ?>
                                
                                    </div>  
                                    <div class="info-box-content" style="float: right; margin-top: -50px; font-weight: bold; margin-bottom: -20px;">
                                      <span class="info-box-text">Blotter Issued</span>
                                      <span class="info-box-number" style="text-align: center;">
                                        <?php
                                           if ($isZoneLeader) {
                                            $q = mysqli_query($con,"SELECT * from tblblotter WHERE sStatus='Solved' AND barangay = '$zone_barangay'");
                                           }else{
                                            $q = mysqli_query($con,"SELECT * from tblblotter WHERE sStatus='Solved'");
                                           }
                                            $num_rows = mysqli_num_rows($q);
                                            echo $num_rows;
                                        ?>
                                      </span>
                                    </div>                              
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <ul class="nav nav-tabs" id="myTab">
                                      <li ><a href="blotter.php">Blotter Cases</a></li>
                                      <li class="active"><a href="solvedcases.php">Solved Cases</a></li>
                                      <li><a href="unsolvedcases.php">Unsolved Cases</a></li>
                                      <li><a href="pendingcases.php">Pending Cases</a></li>
                                </ul>
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
                                                <th>Date Recorded</th>
                                                <th>Complainant</th>
                                                <th>Person To Complain</th>
                                                <th>Complaint</th>
                                                <th>Location of Incidence</th>
                                                <th>Person Handling this case</th>
                                                <th style="width: 20% !important;">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if(!isset($_SESSION['staff']))
                                            {

                                               if ($isZoneLeader) {
                                                $squery = mysqli_query($con, "SELECT *,r.id as rid,b.id as bid,CONCAT(r.lname,', ', r.fname, ' ', r.mname) as rname from tblblotter b left join tblresident r on b.personToComplain = r.id WHERE b.sStatus='Solved' AND b.barangay = '$zone_barangay' ") or die('Error: ' . mysqli_error($con));
                                               }else{
                                                $squery = mysqli_query($con, "SELECT *,r.id as rid,b.id as bid,CONCAT(r.lname,', ', r.fname, ' ', r.mname) as rname from tblblotter b left join tblresident r on b.personToComplain = r.id WHERE b.sStatus='Solved'") or die('Error: ' . mysqli_error($con));
                                               }
                                                while($row = mysqli_fetch_array($squery))
                                                {
                                                    echo '
                                                    <tr>
                                                        <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="'.$row['bid'].'" /></td>
                                                        <td>'.$row['dateRecorded'].'</td>
                                                        <td>'.$row['complainant'].'</td>
                                                        <td>'.$row['rname'].'</td>
                                                        <td>'.$row['complaint'].'</td>
                                                        <td>'.$row['locationOfIncidence'].'</td>
                                                        <td>'.$row['lupon'].'</td>
                                                        <td><button class="btn btn-primary btn-xs" data-target="#editModal'.$row['bid'].'" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                                        <a  href="printblotter.php?resident='.$row['bid'].'&blotter='.$row['complainant'].'&val='.sha1($row['complainant'].'|'.$row['personToComplain'].'|'.$row['dateRecorded']).'" onclick="location.reload();" class="btn btn-success btn-xs" target="_blank"><i class="fa fa-print" aria-hidden="true"></i>view</a></li>
                                                        <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button> 
                                                            <?php
                                                                }
                                                             ?></div></td>
                                                    </tr>
                                                    ';

                                                    include "edit_modal.php";
                                                }
                                            }
                                            else{
                                                $squery = mysqli_query($con, "SELECT *,r.id as rid,b.id as bid,CONCAT(r.lname,', ', r.fname, ' ', r.mname) as rname from tblblotter b left join tblresident r on b.personToComplain = r.id ") or die('Error: ' . mysqli_error($con));
                                                while($row = mysqli_fetch_array($squery))
                                                {
                                                    echo '
                                                    <tr>
                                                        <td>'.$row['dateRecorded'].'</td>
                                                        <td>'.$row['complainant'].'</td>
                                                        <td>'.$row['rname'].'</td>
                                                        <td>'.$row['complaint'].'</td>
                                                        
                                                        <td>'.$row['sStatus'].'</td>
                                                        <td>'.$row['locationOfIncidence'].'</td>
                                                        <td>'.$row['lupon'].'</td>
                                                        <td><button class="btn btn-primary btn-sm" data-target="#editModal'.$row['bid'].'" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></td>
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
               "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,8 ] } ],"aaSorting": []
            });
            $(".select2").select2();
        });
    <?php
    }
    else{
    ?>
        $(function() {
            $("#table").dataTable({
               "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 7 ] } ],"aaSorting": []
            });
            $(".select2").select2();
        });
    <?php
    }
    ?>
</script>
    </body>
</html>
