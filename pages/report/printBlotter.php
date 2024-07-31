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

    <style>
        @media print {
            .dont-print{
                display: none !important;
            }
        }
    </style>

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
                

            <!-- Main content -->
            <section class="content">
      

            <div style="margin-top: 1rem" class="dont-print">
    <table id="table" class="table table-bordered table-striped">
        <thead>
            <tr>

                <th>Complainant</th>
                <th>Person To Complain</th>
                <th>Complaint</th>
                <th>Status</th>
                <th>Location of Incidence</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['blotter_filter'])) {
                if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
                    $from_date = $_GET['from_date'];
                    $to_date = $_GET['to_date'];
    
                    $query = "SELECT *,r.id as rid,b.id as bid,CONCAT(r.lname,', ', r.fname, ' ', r.mname) as rname from tblblotter b left join tblresident r on b.personToComplain = r.id WHERE dateRecorded BETWEEN '$from_date' AND '$to_date'";
                    $result = $con->query($query);
    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '
                                                <tr>
                                                    <td>' . $row['complainant'] . '</td>
                                                    <td>' . $row['rname'] . '</td>
                                                    <td>' . $row['complaint'] . '</td> 
                                                    <td>' . $row['sStatus'] . '</td>
                                                    <td>' . $row['locationOfIncidence'] . '</td>
                                                </tr>
                                            ';
                        }
                    } else {
                        echo "
                                            <tr>
                                                <td>No Record Found</td>
                                            </tr>
                                        ";
                    }
                }
            }
           
            ?>
        </tbody>
    </table>
</div>

                <button type="button" onclick="window.print()" class="btn btn-primary btn-sm" style="margin-left: 20px;">Print this page</button>

          
              
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
