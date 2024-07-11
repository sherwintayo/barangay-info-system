<!DOCTYPE html>
<html id="blotter">
<style>
    @media print {
        .noprint {
            visibility: hidden;
        }
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
    $_SESSION['clr'] = $_GET['blotter'];
    include ('../head_css.php'); ?>

    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php

        include "../connection.php";
        ?>

        <div class="col-xs-12 col-sm-6 col-md-8" style="">
            <div style=" background: black;">
                <div class="col-xs-4 col-sm-6 col-md-3" style="background: white; margin-right:10px;  margin-top: 50px;">
                    <center>
                        <image src="../../img/tugas_logo.png" style="width:90%;height:164px;" />
                    </center>
                    <h1></h1>
                    <div style="margin-top:20px; text-align: center; word-wrap: break-word; border: 2px solid blue;">
                        <br>
                        <p style="font-size:  20px;"><b>SANGGUNIANG BARANGAY</b><br><br></p><b>
                            <?php
                            $qry = mysqli_query($con, "SELECT * from tblofficial");
                            while ($row = mysqli_fetch_array($qry)) {
                                if ($row['sPosition'] == "Captain") {
                                    echo '
                                    <p>
                                    <b>' . strtoupper($row['completeName']) . '</b><br>
                                    <span style="font-size:12px;">PUNONG BARANGAY</span>
                                    </p><br><p style="font-size:20px;">BARANGAY KAGAWAD</p>
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
                                    </p><br><br>
                                    ';
                                } elseif ($row['sPosition'] == "Barangay Secretary") {
                                    echo '
                                    <p><u>
                                     ' . strtoupper($row['completeName']) . '<br></u></b>
                                    <span style="font-size:12px;">Secretary</span>
                                    </p><br><br>
                                    ';
                                } elseif ($row['sPosition'] == "Barangay Treasurer") {
                                    echo '
                                    <p><u><b>
                                    ' . strtoupper($row['completeName']) . '<br></b></u>
                                    <span style="font-size:12px;">Treasurer</span>
                                    </p><br><br><br><br><br>
                                    ';
                                }
                            }
                            ?>
                    </div>
                </div>
                <div class="col-xs-7 col-sm-5 col-md-8" style="background: white;  margin-top: 50px; ">
                    <div class="pull-left" style="font-size: 16px;margin-left: 120px;">
                        <center>
                            <p style="font-size: 20px;">
                                Republic of the Philippines<br>
                                Province of Cebu<br>
                                Municipality of Madridejos<br>
                                Barangay Tugas<br>
                                <br></b>
                            </p>
                        </center><br>
                    </div>

                    <div class="col-xs-12 col-md-12" style="border:2px solid green;">
                        <br>
                        <p class="text-center" style="font-size: 20px; font-size:bold;">OFFICE OF THE PUNONG BARANGAY <br><b
                                style="font-size: 28px;">OFFICE OF THE LUPONG TAGAPAMAYAPA</b></p>

                        <?php
                        $qry = mysqli_query($con, "SELECT *,r.id as rid,b.id as bid,CONCAT(r.lname,', ', r.fname, ' ', r.mname) as rname from tblblotter b left join tblresident r on b.personToComplain = r.id ");
                        if ($row = mysqli_fetch_array($qry)) {
                            $bdate = date_create($row['bdate']);
                            $date = date_create($row['dateRecorded']);
                            echo '
                                <p><br>
                                     Complainant:<b> <u>' . strtoupper($_GET['blotter']) . '</u></b><br> Against:<br>Respondent:<b> <u>' . strtoupper($row['rname']) . '</u> </b>
                                </p>
                                <p style="font-size: 18px; text-align: center;">SUMMONS</p>
                                <p>
                                    &nbsp;&nbsp;&nbsp;You are hereby summon to appear before me in person, together with your witnesses on: <br>
                                    
                                  <center><b> <u>' . strtoupper(date_format($date, "F j, o")) . '</u></b>, BARANGAY HALL</center> &nbsp;&nbsp;&nbsp;Then and there to answer to a complainant made before me, of which is attached hereto, for mediation of your dispute with complainant. <br><br>&nbsp;&nbsp;&nbsp; You are hereby warned that if you refuse or willfully fail to appear in obedience to this Summons, you may be barred from filing any counter claim arising from said complainant.<br><br>Fail not or else face punishment as of for contempt of court.
                                </p>
                                ';
                        }
                        ?>

                        <div class="col-xs-offset-6 col-xs-5 col-md-offset-6 col-md-4"><br><br>
                            <?php
                            $qry = mysqli_query($con, "SELECT * from tblofficial");
                            while ($row = mysqli_fetch_array($qry)) {
                                if ($row['sPosition'] == "Captain") {
                                    echo '
                            <p>
                            <b style="font-size:11px;"><u>' . strtoupper($row['completeName']) . '</u><br>
                            <span style=" text-align: center;">Punong Barangay</span></b>
                            </p></p><br><br><br><p style="font-size: 9px;">NOT VALID WITHOUT SEAL</p>
                            ';
                                }
                            }
                            ?>
                        </div>
                    </div>

                </div>



            </div>
        </div>
        <button class="btn btn-primary noprint" id="printpagebutton" onclick="PrintElem('#clearance')">Print</button>
    </body>
    <?php
}
?>


<script>
    function PrintElem(elem) {
        window.print();
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