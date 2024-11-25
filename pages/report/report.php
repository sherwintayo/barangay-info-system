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
               

            </section>
                <h1 style="text-align: center;">
                    Reports
                </h1>
                 <button onclick="window.print()" class="btn btn-primary btn-sm" style="margin-left: 20px;">Print this page</button>

            <!-- Main content -->
            <section class="content">
                <p style="font-weight: bold; font-size: 20px;">Permits Issued</p>
                <?php include('permit.php'); ?>
                <p style="font-weight: bold; font-size: 20px;">Clearance Issued</p>
                <?php include('clearance.php'); ?>
                <p style="font-weight: bold; font-size: 20px;">Blotter Issued</p>
                <?php include('blotter.php'); ?>
                <div class="row">
                    <!-- left column -->
                    <div class="box">
                        <div class="box-header">
                            <div style="padding:10px;">
                                
                            </div>
                        </div><!-- /.box-header -->

                        <div class="box-body table-responsive">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Population per Zone/Purok
                                        </div>
                                        <div class="panel-body">
                                            <div id="morris-bar-chart3"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                           Male and Female in Barangay
                                        </div>
                                        <div class="panel-body">
                                            <div id="morris-bar-chart6"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Resident Educational Attainment
                                        </div>
                                        <div class="panel-body">
                                            <div id="morris-donut-chart"></div>
                                        </div>
                                    </div>
                                </div>
                                                         <?php
// Check if the session role is not equal to 'Administrator'
if ($_SESSION['role'] != 'Administrator') {
?>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Age
                                        </div>
                                        <div class="panel-body">
                                            <div id="morris-bar-chart2"></div>
                                        </div>
                                    </div>
                                </div>
       <?php } ?>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Total Households
                                        </div>
                                        <div class="panel-body">
                                            <div id="morris-bar-chart5"></div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div> <!-- /.row -->
                </div>
            </section><!-- /.content -->
        </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->
    <!-- jQuery 2.0.2 -->
    <?php }
        include "../footer.php"; 

        include "donut-chart.php";
        include "bar-chart.php"; 
        ?>
         <script>
    function dateformat(date){
        var d = new Date(date);
        var day = d.getDate() < 10 ? `0${d.getDate()}` : d.getDate();
        var month = d.getMonth() + 1;
        var year = d.getFullYear();
        return year + '-' + (month < 10 ? `0${month}` : month) + '-' + day;
    }

    function handlFilterDate(action, value, el) {
        const date = new Date(value);
        if(action === 'min'){
            const nextday = date.setDate(date.getDate() + 1);
            const _dateformat = dateformat(nextday)
            if(el === 'from_date_permit') document.getElementById("to_date_permit").setAttribute("min", _dateformat)
            if(el === 'from_date_clearance')  document.getElementById("to_date_clearance").setAttribute("min", _dateformat)
        }else if(action === 'max'){
            const prevday = date.setDate(date.getDate() - 1);
            const _dateformat = dateformat(prevday)
           if(el === 'to_date_permit')document.getElementById("from_date_permit").setAttribute("max", _dateformat)
            if(el === 'to_date_clearance') document.getElementById("from_date_clearance").setAttribute("max", _dateformat)
        }
    }

    $(function() {
        const from_date = document.getElementById("from_date_permit");
        const to_date = document.getElementById("to_date_permit");

        handlFilterDate("min", from_date.value, 'from_date_permit');
        handlFilterDate("max", to_date.value, 'to_date_permit')

         const from_date_clearance = document.getElementById("from_date_clearance");
        const to_date_clearance = document.getElementById("to_date_clearance");

        handlFilterDate("min", from_date_clearance.value, 'from_date_clearance');
        handlFilterDate("max", to_date_clearance.value, 'to_date_clearance')


    });

    function handleChange(event, action){
        
        handlFilterDate(action, event.target.value, event.target.id);
    }
</script>
</body>

</html>
