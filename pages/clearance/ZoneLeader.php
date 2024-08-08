<div class="row">
    <!-- left column -->
    <div class="box">
        <div class="box-body table-responsive">
            <form method="post">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" /></th>
                            <th>Resident Name</th>
                            <th>Type of Clearance</th>
                            <th style="width: 25% !important;">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Assuming you have the barangay stored in the session
                        $barangay = $_SESSION['barangay'];
                        
                        $squery = mysqli_query($con, "SELECT *, CONCAT(r.lname, ', ' ,r.fname, ' ' ,r.mname) as residentname, p.id as pid FROM tblclearance p LEFT JOIN tblresident r ON r.id = p.residentid WHERE p.status = 'New' AND r.barangay = '$barangay'") or die('Error: ' . mysqli_error($con));
                        while ($row = mysqli_fetch_array($squery)) {
                            echo '
                        <tr>
                            <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="' . $row['pid'] . '" /></td>
                            <td>' . $row['residentname'] . '</td>
                            <td>' . $row['Clearance'] . '</td>
                            <td>
                                <button class="btn btn-success btn-sm" data-target="#approveModal' . $row['pid'] . '" data-toggle="modal"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Approve</button>
                                <button class="btn btn-danger btn-sm" data-target="#disapproveModal' . $row['pid'] . '" data-toggle="modal"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Disapprove</button>
                            </td>
                        </tr>
                        ';
                            include "approve_modal.php";
                            include "disapprove_modal.php";
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div><!-- /.row -->
