<html>
<head>
    <meta charset="UTF-8">
    <title>Barangay Information System</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    
    <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="../js/morris/morris-0.4.3.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="../css/style1.css" rel="stylesheet" type="text/css" />
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <link href="../css/menu.css" rel="stylesheet" type="text/css" />
    <link href="../css/slideshow.css" rel="stylesheet" type="text/css" />
    <link href="../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../css/select2.css" rel="stylesheet" type="text/css" />
    <!--/ icon link--->
     <link rel="icon" type="image/png"  href="../images/favicon_io/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="../images/favicon_io/site.webmanifest">
    <!--/ end link-->
    <script src="../js/jquery-1.12.3.js" type="text/javascript"></script>
    <style>
    .no-print{
        display:none;
    }
    .dataTables_filter input { 
    padding-top: 20px;
    padding-bottom: 20px;}
    </style>
</head>
<body>
<div id="container">
  <div id="top">
    <header>
    <img src="images/header.png" style="width: 100%; height: 50%;">
  </header>
  </div>
  <div id="menuh-container">
    <div id="menuh">
     <ul>
        <li ><a href="index.php" class="top_parent" >&nbsp; Home</a>
          <ul>
            <!--Home is single page only-->
          </ul>
        </li>
      </ul>
      <ul>
        <li><a href="about.php" class="top_parent">&nbsp; About</a>
         
        </li>
      </ul>
      <ul>
        <li><a href="residentsprofile.php" class="top_parent">&nbsp; Residents Profile</a>
          
        </li>
      </ul>
      <ul>
        <li><a href="../login.php" class="top_parent">&nbsp; Admin</a> 
       
    </li>
      </ul>
      
      <!--/start of others-->
    <ul>
        <li><a href="#" class="top_parent">&nbsp; Request Permit</a> 
          <ul>
            <li><a href="../pages/resident/login.php">Business Permit</a></li>
            <li><a href="../pages/resident/login.php">Barangay Clearance</a></li>
            
          </ul>
     </ul>
    <ul>        
<li><a href="Downloads.html">Permit Aprroval</a></li>
          
    
      </ul>
      <div class="bg-white">



    </div>
    </div><!--menuh-->
  </div>
  
  
  <div id="content">
      <!--/next is the slideshow-->
  
<div class="wrapper row-offcanvas row-offcanvas-left">
<div class="container-fluid">
<table id="table" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Barangay</th>
            <th>Zone</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Former Address</th>
            <th style="width: 5% !important;">Option</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "../pages/connection.php";
        $squery = mysqli_query($con, "SELECT *,CONCAT(lname, ', ', fname, ' ', mname) as cname FROM tblresident");
        while($row = mysqli_fetch_array($squery))
        {
            echo '
            <tr>
                <td style="width:70px;"><image src="../pages/resident/image/'.basename($row['image']).'" style="width:60px;height:60px;"/></td>
                <td>'.$row['cname'].'</td>
                <td>'.$row['barangay'].'</td>
                <td>'.$row['zone'].'</td>
                <td>'.$row['age'].'</td>
                <td>'.$row['gender'].'</td>
                <td>'.$row['formerAddress'].'</td>
                <td><button class="btn btn-primary btn-sm" data-target="#detailsModal'.$row['id'].'" data-toggle="modal"><i class="fa fa-search" aria-hidden="true"></i> Details</button></td>
            </tr>
            ';
            include "detailsModal.php";
        }
        ?>
    </tbody>
</table>

</div>
</div>



    
   
                           
                                   
                               
                                   
                               
                                    
                              
                               
                             


</div> <!--/content--> 
</div><!--/container-->

</body>


<script src="../js/alert.js" type="text/javascript"></script>
<script src="../js/bootstrap.min.js" type="text/javascript"></script>


<script src="../js/morris/raphael-2.1.0.min.js" type="text/javascript"></script>
<script src="../js/morris/morris.js" type="text/javascript"></script>
<script src="../js/select2.full.js" type="text/javascript"></script>

<script src="../js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="../js/buttons.print.min.js" type="text/javascript"></script>

<script src="../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="../js/AdminLTE/app.js" type="text/javascript"></script>
<script src="../js/slideshow.js" type="text/javascript"></script>
<script type="text/javascript">
  $(function() {
      $("#table").dataTable({
         "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": [],
         "dom":' <"search"f><"top"l>rt<"bottom"ip><"clear">'
      });
  });

  $(document).ready(function () {             
  $('.dataTables_filterinput[type="search"]').css(
     {'width':'350px','display':'inline-block'}
  );
});
</script>


</html>