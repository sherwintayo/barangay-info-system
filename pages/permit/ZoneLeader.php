<div class="row">

<div class="box">

    <div class="box-header">
        <div style="padding:10px;">


            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Permit</button>

            <?php
            if (!isset($_SESSION['staff'])) {
            ?>
                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            <?php
            }
            ?>
        </div>

        <div class="info-box-content" style="float: right; margin-top: -50px; font-weight: bold; margin-bottom: -20px;">
            <span class="info-box-text">Permit Issued</span>
            <span class="info-box-number" style="text-align: center;">
                <?php
                $q = mysqli_query($con, "SELECT * from tblpermit where status = 'Approved' AND businessAddress = '$zone_barangay' ");
                $num_rows = mysqli_num_rows($q);
                echo $num_rows;
                ?>
            </span>
        </div>

    </div><!-- /.box-header -->

    <div class="box-body table-responsive">
        <ul class="nav nav-tabs" id="myTab">

            <li class="active"><a href="permit.php">Approved</a></li>
            <li><a data-target="#disapproved" data-toggle="tab">Disapproved</a></li>
            <li><a href="newApproved.php" class="notification">Issue Permit
            <span class="badge">
                <?php
                    $q = mysqli_query($con, "SELECT * from tblpermit where isRead = 1 AND businessAddress = '$zone_barangay' ");
                    $num_rows = mysqli_num_rows($q);
                    echo $num_rows;
                ?>
            </span>
                </a></li>
        </ul>

        <form method="post">

            <div class="tab-content">
                <div id="approved" class="tab-pane active in">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <?php
                                if (!isset($_SESSION['staff'])) {
                                    ?>
                                    <th style="width: 20px !important;"><input type="checkbox"
                                            name="chk_delete[]" class="cbxMain"
                                            onchange="checkMain(this)" /></th>
                                    <?php
                                }
                                ?>
                                <th>Resident</th>
                                <th>Business Name</th>
                                <th>Business Address</th>

                                <th>OR Number</th>
                                <th>Amount</th>
                                <th style="width: 20% !important;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if (!isset($_SESSION['staff'])) {

                                $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid, p.status AS pstatus FROM tblpermit p left join tblresident r on r.id = p.residentid where p.status = 'Approved' AND p.businessAddress = '$zone_barangay'") or die('Error: ' . mysqli_error($con));
                                while ($row = mysqli_fetch_array($squery)) {
                                    echo '
                        <tr>
                            <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="' . $row['pid'] . '" /></td>
                            <td>' . $row['residentname'] . '</td>
                            <td>' . $row['businessName'] . '</td>
                            <td>' . $row['businessAddress'] . '</td>
                            
                            <td>' . $row['orNo'] . '</td>
                            <td>₱ ' . number_format($row['samount'], 2) . '</td>
                            <td>
                        <button class="btn btn-primary btn-xs" data-target="#editModal' . $row['pid'] . '" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                            <a  href="print.php?resident=' . $row['residentid'] . '&permit=' . $row['businessName'] . '&val=' . sha1($row['businessName'] . '|' . $row['businessAddress'] . '|' . $row['dateRecorded']) . '" class="btn btn-success btn-xs" target="_blank"><i class="fa fa-print" aria-hidden="true"></i>Print</a> 
                                <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button> 
                                <?php
                                    }
                        ?> 
                        </td>
                        </tr>
                        ';

                                    include "edit_modal.php";


                                }

                            } else {
                                $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblpermit p left join tblresident r on r.id = p.residentid where status = 'Approved' and p.businessAddress = '$zone_barangay' ") or die('Error: ' . mysqli_error($con));
                                while ($row = mysqli_fetch_array($squery)) {
                                    echo '
                        <tr>
                            <td>' . $row['residentname'] . '</td>
                            <td>' . $row['businessName'] . '</td>
                            <td>' . $row['businessAddress'] . '</td>
                            
                            <td>' . $row['orNo'] . '</td>
                            <td>₱ ' . number_format($row['samount'], 2) . '</td>
                            <td><button class="btn btn-primary btn-sm" data-target="#editModal' . $row['pid'] . '" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></td>
                        </tr>
                        ';

                                    include "edit_modalres.php";

                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div id="disapproved" class="tab-pane">
                    <table id="table1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <?php
                                if (!isset($_SESSION['staff'])) {
                                    ?>
                                    <th style="width: 20px !important;"><input type="checkbox"
                                            name="chk_delete[]" class="cbxMain"
                                            onchange="checkMain(this)" /></th>
                                    <?php
                                }
                                ?>
                                <th>Resident</th>
                                <th>Business Name</th>
                                <th>Business Address</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if (!isset($_SESSION['staff'])) {

                                $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblpermit p left join tblresident r on r.id = p.residentid where p.status = 'Disapproved' AND p.businessAddress = '$zone_barangay'  ") or die('Error: ' . mysqli_error($con));
                               if ($squery->num_rows > 0) {
                                 while ($row = mysqli_fetch_array($squery)) {
                                    echo '
                        <tr>
                            <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="' . $row['pid'] . '" /></td>
                            <td>' . $row['residentname'] . '</td>
                            <td>' . $row['businessName'] . '</td>
                            <td>' . $row['businessAddress'] . '</td>
                        
                        </tr>
                        ';

                                }
                               }
                            } else {
                                $squery = mysqli_query($con, "SELECT *,CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname,p.id as pid FROM tblpermit p left join tblresident r on r.id = p.residentid where status = 'Disapproved' ") or die('Error: ' . mysqli_error($con));
                                while ($row = mysqli_fetch_array($squery)) {
                                    echo '
                        <tr>
                            <td>' . $row['residentname'] . '</td>
                            <td>' . $row['businessName'] . '</td>
                            <td>' . $row['businessAddress'] . '</td>
                            <td>' . $row['typeOfBusiness'] . '</td>
                        </tr>
                        ';

                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>


            </div>

            <?php include "../deleteModal.php"; ?>

            </form>



    </div><!-- /.box-body -->


</div><!-- /.box -->

</div>
