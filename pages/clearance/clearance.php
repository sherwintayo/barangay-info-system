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
                        Clearance
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">

                    <?php
                    if($_SESSION['role'] == "Administrator" || isset($_SESSION['staff']))
                    {
                            require 'Administrator.php';
                    }
                    elseif($_SESSION['role'] == "Zone Leader")
                    {
                        require 'ZoneLeader.php';
                    }
                    else
                    {
                        require 'Default.php';
                    }
                    ?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <?php 
        include "../edit_notif.php";
        include "../added_notif.php";
        include "../delete_notif.php";
        include "../duplicate_error.php";
        include "add_modal.php";
        include "function.php";
        
    }
        include "../footer.php"; ?>
<script type="text/javascript">

    <?php 
    if(!isset($_SESSION['staff']))
    {
    ?>
        $(function() {
            $("#table").dataTable({
               "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,7 ] } ],"aaSorting": []
            });
            $("#table1").dataTable({
               "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,3 ] } ],"aaSorting": []
            });
            $(".select2").select2();
        });
    <?php
    }
    else{
    ?>
        $(function() {
            $("#table").dataTable({
               "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 6 ] } ],"aaSorting": []
            });
            $("#table1").dataTable({
               "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 2 ] } ],"aaSorting": []
            });
            $(".select2").select2();
        });
    <?php
    }
    ?>

</script>
    </body>
</html>
