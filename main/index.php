<!DOCTYPE html>
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
  <link rel="icon" type="image/png" href="../images/favicon_io/favicon.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="../images/favicon_io/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon_io/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon_io/favicon-16x16.png">
  <link rel="manifest" href="../images/favicon_io/site.webmanifest">
  <!--/ end link-->
  <script src="../js/jquery-1.12.3.js" type="text/javascript"></script>
  <script src="../js/jquery.bxslider.js" type="text/javascript"></script>

  <script>
    $(document).ready(function () {
      $('.slider').bxSlider();
    });
  </script>
  <style>
    .no-print {
      display: none;
    }

    .dataTables_filter input {
      padding-top: 20px;
      padding-bottom: 20px;
    }

    body {
      background-color: #0000FF;
      /* Set background color to blue */
    }
  </style>
</head>

<body>
  <div id="container">
    <div id="top">
      <header>
        <?php
        if (!isset($_SESSION['staff'])) {
          $squery = mysqli_query($con, "SELECT * FROM tblsettings");
          $data = $squery->fetch_assoc();
          ?>
          <form method="post" enctype="multipart/form-data">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control" style="margin: 10px 0;" value="<?= $data['name'] ?>">
            <label for="">Logo</label>
            <br>
            <img src="../../images/<?= $data['logo'] ?>" alt="image" style="width: 200px;margin: 10px 0;">
            <input type="file" name="logo" class="form-control" style="margin: 10px 0;">

            <input type="submit" class="btn btn-primary btn-sm" name="btn_update" id="btn_update" value="Update" />

            <?php require 'update.php' ?>
          </form>
          <?php
        }
        ?>
      </header>
    </div>
    <div id="menuh-container">
      <div id="menuh">
        <ul>
          <li class="active"><a href="index.php" class="top_parent">&nbsp; Home</a>
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
          <li><a href="../login.php" class="top_parent">&nbsp; Login</a>
            <ul>
              <!--/start of others-->
            </ul>
          </li>
        </ul>
      </div><!--menuh-->
    </div>

    <div id="content">
      <!--/next is the slideshow-->
      <div class="slideshow-container">

        <div class="mySlides fade">
          <div class="numbertext">1/6</div>
          <img src="../images/5.png" style="width:100%; height:500px;border: 1px solid blue; ">
          <div style="font-size: 12px; padding: 8px 12px; position: absolute; bottom: 100px; text-align: justify;">
            <center>
              <p>The Barangay Official of Barangay Tugas<br>Barangay Captain: Alen G.Chavez, Honorable: Alicia M. Marfa,
                Honorable: Gina C. Fernandez, Honorable: Evelyn S. Chavez,<br> Honorable: Marissa C. Tayactac,
                Honorable:Brendo Batasin-in, Honorable:Gomer Rebusit</p>
            </center>
          </div>
        </div>
        <!--/end of 1st pic-->
        <div class="mySlides fade">
          <div class="numbertext">2/9</div>
          <img src="../images/Slide1.png" style="width:100%; height:500px;border: 1px solid blue;">
          <div style="font-size: 15px; padding: 8px 12px; position: absolute; bottom: 100px; text-align: center;"> The
            every Activities Schedule of Barangay Tugas in every year!</div>
        </div>
        <!--/end of 2nd pic-->
        <div class="mySlides fade">
          <div class="numbertext">3/9</div>
          <img src="../images/15.png" style="width:100%; height:500px;border: 1px solid blue;">
          <div style="font-size: 15px; padding: 8px 12px; position: absolute; bottom: 100px; text-align: center;">The
            General assemly of Barangay Tugas 2 times in a Year</div>
        </div>
        <!--/ end of 3rd-->
        <div class="mySlides fade">
          <div class="numbertext">4/9</div>
          <img src="../images/20.png" style="width:100%; height:500px;border: 1px solid blue;">
          <div style="font-size: 15px; padding: 8px 12px; position: absolute; bottom: 100px; text-align: center;">The
            Orientation for the Barangay Drug Clearing Program.</div>
        </div>
        <!--/end of 4th pic-->
        <div class="mySlides fade">
          <div class="numbertext">5/9</div>
          <img src="../images/4.png" style="width:100%; height:500px;border: 1px solid blue;">
          <div style="font-size: 15px; padding: 8px 12px; position: absolute; bottom: -50px; text-align: center;">
            Barangay Tugas, Tugasnon Festival happened on April 29,2024.</div>
        </div>
        <!--/end of 5th pic-->
        <div class="mySlides fade">
          <div class="numbertext">6/9</div>
          <img src="../images/1.png" style="width:100%; height:500px;border: 1px solid blue;">
          <div style="font-size: 15px; padding: 8px 12px; position: absolute; bottom: 100px; text-align: center;">The
            Pasko sa Tugas Lights On Ceremony on every month of December.</div>
        </div>
        <!--/end of 6th pic-->
        <div class="mySlides fade">
          <div class="numbertext">7/9</div>
          <img src="../images/19.png" style="width:100%; height:500px;border: 1px solid blue;">
          <div style="font-size: 15px; padding: 8px 12px; position: absolute; bottom: 100px; text-align: center;">
            Barangay Tugas Opening Salvo 2024.</div>
        </div>
        <!--/end of 7th pic-->
        <div class="mySlides fade">
          <div class="numbertext">8/9</div>
          <img src="../images/17.png" style="width:100%; height:500px;border: 1px solid blue;">
          <div style="font-size: 15px; padding: 8px 12px; position: absolute; bottom: 100px; text-align: center;">The
            Monthly Clean up Drive of Barangay Tugas </div>
        </div>
        <!--/end of 8th pic-->
        <div class="mySlides fade">
          <div class="numbertext">9/9</div>
          <img src="../images/12.png" style="width:100%; height:500px;border: 1px solid blue;">
          <div style="font-size: 15px; padding: 8px 12px; position: absolute; bottom: 100px; text-align: center;">The
            Feeding Program sponsored By: Mrs. Melisa Rife and the second Feeding Program was sponsored by: The
            Bantayanon Group</div>
        </div>
        <!--/end of 9th pic-->
      </div> <!--slideshow container-->
      <br>

      <div style="text-align: center; margin-top: 5px; ">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
        <span class="dot" onclick="currentSlide(5)"></span>
        <span class="dot" onclick="currentSlide(6)"></span>
        <span class="dot" onclick="currentSlide(7)"></span>
        <span class="dot" onclick="currentSlide(8)"></span>
        <span class="dot" onclick="currentSlide(9)"></span>
      </div>
      <!--/end of the slide show-->
      <br><br><br><br><br><br><br><br><br>
    </div> <!--/content-->
  </div><!--/container-->

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
    $(function () {
      $("#table").dataTable({
        "aoColumnDefs": [{ "bSortable": false, "aTargets": [0, 5] }], "aaSorting": [],
        "dom": ' <"search"f><"top"l>rt<"bottom"ip><"clear">'
      });
    });

    $(document).ready(function () {
      $('.dataTables_filter input[type="search"]').css(
        { 'width': '350px', 'display': 'inline-block' }
      );
    });
  </script>

</body>

</html>