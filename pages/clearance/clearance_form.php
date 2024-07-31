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
                <div class="col-xs-4 col-sm-6 col-md-3" style="background: white;  margin-top: 50px;">
                    <center><image src="../../img/<?= $logo ?>" style="width:90%;height:164px;"/></center>
                    <h1></h1>
                    <div style="margin-top:20px; text-align: center; word-wrap: break-word; margin-right:10px; border: 2px solid blue;">
                        <br><p style="font-size:  20px;"><b>SANGGUNIANG BARANGAY</b><br><br></p>
                        <?php
                            $qry = mysqli_query($con,"SELECT * from tblofficial");
                            while($row=mysqli_fetch_array($qry)){
                                if($row['sPosition'] == "Captain"){
                                    echo '
                                    <p>
                                    <b>'.strtoupper($row['completeName']).'<br>
                                    <span style="font-size:12px;">PUNONG BARANGAY</span>
                                    </p><br><p style="font-size:20px;">BARANGAY KAGAWAD</p>
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
                                     <br><br>
                                    </p>
                                    ';
                                }
                                elseif($row['sPosition'] == "Barangay Secretary"){
                                    echo '
                                    <p><u>
                                     '.strtoupper($row['completeName']).'<br></u></b>
                                    <span style="font-size:12px;">Secretary</span>
                                    </p>
                                    ';
                                }
                                elseif($row['sPosition'] == "Barangay Treasurer"){
                                    echo '
                                    <p><u><b>
                                    '.strtoupper($row['completeName']).'<br></b></u>
                                    <span style="font-size:12px;">Treasurer</span>
                                     <br><br><br><br><br><br><br><br><br><br><br>
                                    </p>
                                    ';
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="col-xs-7 col-sm-5 col-md-8" style="background: white; margin-top: 50px; ">
                    <div class="pull-left" style="font-size: 16px;margin-left: 95px;"><center><p style="font-size: 20px;">
                        Republic of the Philippines<br>
                        Province of Cebu<br>
                        Municipality of Madridejos<br>
                        Barangay Tugas<br>
                        </b></p><br><br><br></center>
                    </div>
                    
                    <div class="col-xs-12 col-md-12" style="border: 2px solid green;">
                        <br><p class="text-center" style="font-size: 20px; font-size:bold;">OFFICE OF THE PUNONG BARANGAY <br><b style="font-size: 28px;">BARANGAY CLEARANCE</b></p><br><br>
                        <p style="font-size: 18px;">To whom it may concern:</p><br><br><br>
                        <p style="text-indent:40px;text-align: justify;">This is to certify that the person whose name and signature appears heron is requested a BARANGAY CLEARANCE and the result are listed below;</p>

                        <?php
                            $qry=mysqli_query($con,"SELECT * from tblresident r left join tblclearance c on c.residentid = r.id where residentid = '".$_GET['resident']."' and clearanceNo = '".$_GET['clearance']."' ");
                            if($row = mysqli_fetch_array($qry)) {
                                $bdate = date_create($row['bdate']);
                                $date = date_create($row['dateRecorded']);
                                echo '
                                <p><br><br>
                                    Name:<b> <u>'.strtoupper($row['fname']).'</u> <u>'.strtoupper($row['mname']).'</u> <u>'.strtoupper($row['lname']).'</u></b><br>
                                    DATE of Birth & PLACE:<b> <u>'.strtoupper(date_format($bdate,"m-d-Y")).'/'.strtoupper($row['bplace']).'</u></b><br>
                                    Status:<b> <u>'.strtoupper($row['civilstatus']).'</u></b><br>
                                    Signature:_____________________<br><br><br>
                                    Remarks:<b> NO DEROGATORY RECORD
                                </b></p><br><br>
                                
                                <p>
                                    ISSUED AT: <u>'.strtoupper(date_format($date,"F j, o")).'</u><br>
                                    
                                   This certification is given to the above for any legal purposed that may that served his/her best.
                                    issued day of <u>'.strtoupper(date_format($date,"F j, o")).'</u> at Barangay Tugas, Madridejos <br>
                                </p>
                                ';
                            }
                        ?>
                          <div class="col-xs-offset-6 col-xs-5 col-md-offset-6 col-md-4" ><br><br>
                    <?php
                    $qry = mysqli_query($con,"SELECT * from tblofficial");
                    while($row=mysqli_fetch_array($qry)){
                        if($row['sPosition'] == "Captain"){
                            echo '
                            <p><u>
                            <b style="font-size:11px;">'.strtoupper($row['completeName']).'<br></u>
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
