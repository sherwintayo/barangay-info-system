<!DOCTYPE html>
<html id="permit">
<style>
    @media print {
        .noprint {
            visibility: hidden;
        }
    }

    .right-image {
        position: absolute;
        top: 0;
        right: 80%;
        width: 100px; /* Adjust size as needed */
        height: auto;
    }

    @page {
        size: auto;
        margin: 4mm;
    }
</style>
<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
} else {
    ob_start();
    // $_SESSION['clr'] = $_GET['print.php'];
    include ('../head_css.php'); ?>

    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php

        include "../connection.php";
        ?>

        <div class="col-xs-12 col-sm-6 col-md-8" style="" id="permit">
            <div style=" background: black; margin-top: 50px;">
                <div class="col-xs-4 col-sm-6 col-md-3">
                    <center>
                        <image src="../../images/madridejos.png" style="width:100px;height:100%;" />
                    </center>
                    <h1></h1>
                    <div
                        style="margin-top:20px; text-align: center; word-wrap: break-word; background: white; margin-right:10px; border: 2px solid red; margin-top: 50px;">
                        <br>
                        <p style="font-size:  20px;"><b>SANGGUNIANG BARANGAY</b><br><br></p>
                        <?php
                        $qry = mysqli_query($con, "SELECT * from tblofficial");
                        while ($row = mysqli_fetch_array($qry)) {
                            if ($row['sPosition'] == "Captain") {
                                echo '
                                    <p><b>
                                    <b>' . strtoupper($row['completeName']) . '</b><br>
                                    <span style="font-size:12px;">PUNONG BARANGAY<br><br></span>
                                    </p><p style="font-size:20px;">BARANGAY KAGAWAD</p>
                                    ';
                            } elseif ($row['sPosition'] == "Kagawad(Religious Affairs)") {
                                echo '
                                    <p>
                                     ' . strtoupper($row['completeName']) . '<br>
                                    <span style="font-size:12px;"></span>
                                    </p>
                                    ';
                            } elseif ($row['sPosition'] == "Kagawad(Peace and Order)") {
                                echo '
                                    <p>
                                     ' . strtoupper($row['completeName']) . '<br>
                                    <span style="font-size:12px;"> </span>
                                    </p>
                                    ';
                            } elseif ($row['sPosition'] == "Kagawad(Health)") {
                                echo '
                                    <p>
                                    ' . strtoupper($row['completeName']) . '<br>
                                    <span style="font-size:12px;"></span>
                                    </p>
                                    ';
                            } elseif ($row['sPosition'] == "Kagawad(Budget & Finance)") {
                                echo '
                                    <p>
                                   ' . strtoupper($row['completeName']) . '<br>
                                    <span style="font-size:12px;"> </span>
                                    </p>
                                    ';
                            } elseif ($row['sPosition'] == "Kagawad(Socio-Cultural Affairs)") {
                                echo '
                                    <p>
                                     ' . strtoupper($row['completeName']) . '<br>
                                    <span style="font-size:12px;"></span>
                                    </p>
                                    ';
                            } elseif ($row['sPosition'] == "Kagawad(Education)") {
                                echo '
                                    <p>
                                    ' . strtoupper($row['completeName']) . '<br>
                                    <span style="font-size:12px;"> </span>
                                    </p>
                                    ';
                            } elseif ($row['sPosition'] == "Kagawad(Infrastracture)") {
                                echo '
                                    <p>
                                     ' . strtoupper($row['completeName']) . '<br>
                                    <span style="font-size:12px;"> </span>
                                    <br><br>
                                    </p>
                                    ';
                            } elseif ($row['sPosition'] == "Barangay Secretary") {
                                echo '
                                    <p><u>
                                     ' . strtoupper($row['completeName']) . '<br></b></u>
                                    <span style="font-size:12px;">Secretary</span>
                                    </p><br><br><br>
                                    ';
                            } elseif ($row['sPosition'] == "Barangay Treasurer") {
                                echo '
                                    <p><u><b>
                                    ' . strtoupper($row['completeName']) . '<br></b></u>
                                    <span style="font-size:12px;">Treasurer</span>
                                    <br><br><br><br><br><br></p>
                                    ';
                            }
                        }
                        ?>
                    </div>
                </div>

                <div class="col-xs-7 col-sm-5 col-md-9" style="background: white; ">
                    <div class="pull-left" style="margin-left: 20px; margin-top: 50px;">
                        <center><b>
                                <p style="font-size: 20px;">
                                    Republic of the Philippines<br>
                                    Province of Cebu<br>
                                    Municipality of Madridejos<br>
                                    Barangay Tugas<br>
                            </b></p>
                        </center>

                    </div>
             <!-- Right Image Section -->
                    <div class="right-image">
                        <center>
                            <?php
                            // Fetch the image path from tblsettings by user_id
                            $user_id = $_SESSION['userid'];
                            $qry = mysqli_query($con, "SELECT * FROM tblsettings WHERE user_id = '$user_id'");
                            if ($row = mysqli_fetch_array($qry)) {
                                echo '<img src="../../images/' . $row['logo'] . '" style="width:100%;height:100%;" />';
                            } else {
                                echo '<img src="../../images/default.png" style="width:100%;height:100%;" />'; // Fallback image
                            }
                            ?>
                        </center>
                    </div>

                    <div class="col-xs-12 col-md-8" style=" border:2px solid green; margin-top: 50px;">
                        <br>
                        <p class="text-center" style="font-size: 20px; font-size:bold;">OFFICE OF THE PUNONG BARANGAY <br><b
                                style="font-size: 28px;">BARANGAY CLEARANCE FOR BUSINESS PERMIT </b></p><br><br>
                        <p style="font-size: 18px;">To whom it may concern:</p>
                        <br><br><br>

                        <?php
                        $qry = mysqli_query($con, "SELECT * from tblresident r left join tblpermit c on c.residentid = r.id where residentid = '" . $_GET['resident'] . "' and businessName = '" . $_GET['permit'] . "' ");
                        if ($row = mysqli_fetch_array($qry)) {
                            $bdate = date_create($row['bdate']);
                            $date = date_create($row['dateRecorded']);
                            echo '
                                <p><center>
                                   &nbsp;&nbsp;&nbsp; Barangay Clearance is hereby granted to  <b><u>' . strtoupper($row['fname']) . '</u> <u>' . strtoupper($row['mname']) . '</u> <u>' . strtoupper($row['lname']) . '</u></b> owner of 
                                    <b> <u>' . strtoupper($row['businessName']) . '</u></b>, located at Baranga Tugas, Madridejos, Cebu<br>
                                    after fully complied with the existing barangay ordinance, rules and regulations being enforced in this barangay
                                </b> <br><br><br></p>
                                
                                <p>
                                    &nbsp;&nbsp;&nbsp;This Clearance is issued upon request of the above named person for whatever legal purpose it may serve her/him best. <br><br><br>
                                    
                                   Issued this <u>' . strtoupper(date_format($date, " j")) . '</u> day of <u>' . strtoupper(date_format($date, "F , o")) . '</u>  at Barangay Tugas, Madridejos, Cebu, Philippines. <br>
                                </b></p>
                                ';
                        }
                        ?>
                        <div class="col-xs-offset-6 col-xs-5 col-md-offset-6 col-md-4"><br><br><br>
                            <?php
                            $qry = mysqli_query($con, "SELECT * from tblofficial");
                            while ($row = mysqli_fetch_array($qry)) {
                                if ($row['sPosition'] == "Captain") {
                                    echo '
                            <p style="font-size:11px;"><u>
                            <b>' . strtoupper($row['completeName']) . '</u><br>
                            <span style=" text-align: center;">Punong Barangay</span></b> <br><br><br>
                            </p><p style="font-size: 9px;">NOT VALID WITHOUT SEAL</p>
                            ';
                                }
                            }
                            ?>
                            </center>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <button class="btn btn-primary noprint" id="printpagebutton" onclick="PrintElem('#permit')">Print</button>
    </body>
    <?php
}
?>


<script>
    function PrintElem(elem) {
        window.print(document.getElementById(elem));
    }

    function Popup(data) {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        //mywindow.document.write('<html><head><title>my div</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        //mywindow.document.write('</head><body class="skin-black" >');
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        mywindow.document.write(data);
        //mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();

        printButton.style.visibility = 'visible';
        mywindow.close();

        return true;
    }
</script>

</html>
