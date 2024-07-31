<!DOCTYPE html>
<html id="clearance">
<style>
    @media print {
        .noprint {
        visibility: hidden;
         }
    }
    @page { size: auto;  margin: 4mm; }
</style>
    <?php
    session_start();
    if(!isset($_SESSION['role']))
    {
        header("Location: ../../login.php"); 
    }
    else
    {
    ob_start();
    $_SESSION['clr'] = $_GET['clearance'];
    include('../head_css.php'); ?>
    <body class="skin-black" >
        <!-- header logo: style can be found in header.less -->
        <?php 
        
        include "../connection.php";
          $squery = mysqli_query($con, "SELECT * FROM tblsettings");
        $data = $squery->fetch_assoc();
        $logo = $data['logo'];
        $name = $data['name'];
        ?>
       
        <div class="col-xs-12 col-sm-6 col-md-8" style="" >
            <div style=" background: black;" >
                <div class="col-xs-4 col-sm-6 col-md-3" style="background: white; margin-right:10px; margin-top: 50px;">
                    <center><image src="../../images/<?= $logo ?>" style="width:90%;height:164px;"/></center>
                    <h1></h1>
                    <div style="margin-top:20px; text-align: center; word-wrap: break-word;  border: 2px solid blue;">
                        <br><p style="font-size:  20px;"><b>SANGGUNIANG BARANGAY</b><br><br></p>
                        <?php
                            $qry = mysqli_query($con,"SELECT * from tblofficial");
                            while($row=mysqli_fetch_array($qry)){
                                if($row['sPosition'] == "Captain"){
                                    echo '
                                    <p>
                                    <b>'.strtoupper($row['completeName']).'<br>
                                    <span style="font-size:12px;">PUNONG BARANGAY</span>
                                    </p><br><br><p style="font-size:20px;">BARANGAY KAGAWAD</p>
                                    ';
                                }elseif($row['sPosition'] == "Kagawad(Religious Affairs)"){
                                    echo '
                                    <p>
                                     '.strtoupper($row['completeName']).'<br>
                                    <span style="font-size:12px;"></span>
                                    </p>
                                    ';
                                }elseif($row['sPosition'] == "Kagawad(Peace and Order)"){
                                    echo '
                                    <p>
                                     '.strtoupper($row['completeName']).'<br>
                                    <span style="font-size:12px;"> </span>
                                    </p>
                                    ';
                                }elseif($row['sPosition'] == "Kagawad(Health)"){
                                    echo '
                                    <p>
                                    '.strtoupper($row['completeName']).'<br>
                                    <span style="font-size:12px;"></span>
                                    </p>
                                    ';
                                }elseif($row['sPosition'] == "Kagawad(Budget & Finance)"){
                                    echo '
                                    <p>
                                   '.strtoupper($row['completeName']).'<br>
                                    <span style="font-size:12px;"> </span>
                                    </p>
                                    ';
                                }elseif($row['sPosition'] == "Kagawad(Socio-Cultural Affairs)"){
                                    echo '
                                    <p>
                                     '.strtoupper($row['completeName']).'<br>
                                    <span style="font-size:12px;"></span>
                                    </p>
                                    ';
                                }elseif($row['sPosition'] == "Kagawad(Education)"){
                                    echo '
                                    <p>
                                    '.strtoupper($row['completeName']).'<br>
                                    <span style="font-size:12px;"> </span>
                                    </p>
                                    ';
                                }elseif($row['sPosition'] == "Kagawad(Infrastracture)"){
                                    echo '
                                    <p>
                                     '.strtoupper($row['completeName']).'<br>
                                    <span style="font-size:12px;"> </span>
                                    </p><br><br>
                                    ';
                                }
                                elseif($row['sPosition'] == "Barangay Secretary"){
                                    echo '
                                    <p><u>
                                     '.strtoupper($row['completeName']).'<br></u></b>
                                    <span style="font-size:12px;">Secretary</span>
                                    </p><br><br>
                                    ';
                                }
                                elseif($row['sPosition'] == "Barangay Treasurer"){
                                    echo '
                                    <p><u><b>
                                    '.strtoupper($row['completeName']).'<br></b></u>
                                    <span style="font-size:12px;">Treasurer</span>
                                    </p><br><br>
                                    ';
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="col-xs-7 col-sm-5 col-md-8" style="background: white;  margin-top: 50px; ">
                    <div class="pull-left" style="font-size: 16px;margin-left: 95px;"><center>
                        <p style="font-size: 20px;">
                        Republic of the Philippines<br>
                        Province of Cebu<br>
                        Municipality of Madridejos<br>
                        Barangay Tugas<br>
                        <br></b></p></center><br>
                    </div>
                    
                    <div class="col-xs-12 col-md-12" style="border:2px solid green;"><br>
                        <p class="text-center" style="font-size: 20px; font-size:bold;">OFFICE OF THE BARANGAY CAPTAIN<br><b style="font-size: 28px;">CERTIFICATE OF INDIGENCY</b></p><br><br>
                        <p style="font-size: 18px;">To whom it may concern:</p>
                        <br><br>

                        <?php
                            $qry=mysqli_query($con,"SELECT * from tblresident r left join tblclearance c on c.residentid = r.id where residentid = '".$_GET['resident']."' and clearanceNo = '".$_GET['clearance']."' ");
                            if($row = mysqli_fetch_array($qry)) {
                                $bdate = date_create($row['bdate']);
                                $date = date_create($row['dateRecorded']);
                                echo '
                                <p><center>
                                   This is to certify that <b><u>'.strtoupper($row['fname']).'</u> ,<u>'.strtoupper($row['mname']).'</u>, <u>'.strtoupper($row['lname']).'</u></b>, <u>'.strtoupper($row['age']).'</u> of age, is a bonafide resident of Barangay Tugas, Madridejos,Cebu. <br><br>&nbsp;&nbsp;&nbsp;This is to certify further that the above name  belong to an indigent family in this Barangay and in need of Financial Assistance.<br><br>&nbsp;&nbsp;&nbsp;This Certification is given to the above name for  any legal purposed that may serves him/her best.
                                   
                                </p>
                                
                                <p>
                                    &nbsp;&nbsp;&nbsp;Given this <b><u>'.strtoupper(date_format($date," j")).'</u></b>
                                     day of <b><u>'.strtoupper(date_format($date,"F , o")).'</u></b> at Barangay Tugas, Madridejos, Cebu , Philippines <br>
                                </p></center>
                                ';
                            }
                        ?>
                         <div class="col-xs-offset-6 col-xs-5 col-md-offset-6 col-md-4" ><br><br>
                    <?php
                    $qry = mysqli_query($con,"SELECT * from tblofficial");
                    while($row=mysqli_fetch_array($qry)){
                        if($row['sPosition'] == "Captain"){
                            echo '
                            <p>
                            <b style="font-size:11px;">'.strtoupper($row['completeName']).'<br>
                            <span style=" text-align: center;">Punong Barangay</span></b>
                            </p><br><br><br><p style="font-size: 9px;">NOT VALID WITHOUT SEAL</p>
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
         function PrintElem(elem)
    {
        window.print();
    }

    function Popup(data) 
    {
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
