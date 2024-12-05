<!DOCTYPE html>
<html>

<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
    exit;
}
ob_start();
include('../head_css.php'); ?>
<body class="skin-black">
    <?php include "../connection.php"; ?>
    <?php include('../header.php'); ?>

    <div class="wrapper row-offcanvas row-offcanvas-left">
        <?php include('../sidebar-left.php'); ?>

        <aside class="right-side">
            <section class="content-header">
                <h1>User</h1>
            </section>

            <section class="content">
                <div class="row">
                    <div class="box">
                        <div class="box-header">
                            <div style="padding:10px;">
    <?php
// Check if the session role is not equal to 'Administrator'
if ($_SESSION['role'] != 'Administrator') {
?>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addZoneModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Zone/Purok Leader</button>
                                <?php if (!isset($_SESSION['staff'])) { ?>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                <?php } ?>
    <?php } ?>
                            </div>
                        </div>

                        <div class="box-body table-responsive">
                            <form method="post">
                                <table id="table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <?php if (!isset($_SESSION['staff'])) { ?>
                                                <th style="width: 20px !important;"><input type="checkbox" class="cbxMain" onchange="checkMain(this)" /></th>
                                            <?php } ?>
                                            <th>Barangay</th>
                                            <th>Username</th>
                                            <th style="width: 40px !important;">Approval</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM tbluser";
                                        $squery = mysqli_query($con, $query);
                                        while ($row = mysqli_fetch_array($squery)) {
    $isApproved = isset($row['isApproved']) && $row['isApproved'] == 1;
    echo '<tr>';
    if (!isset($_SESSION['staff'])) {
        echo '<td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="' . $row['id'] . '" /></td>';
    }
    echo '<td>' . $row['barangay'] . '</td>';
    echo '<td>' . $row['username'] . '</td>';
    echo '<td>';
    if ($isApproved) {
        echo '<span class="badge badge-success">Approved</span>';
    } else {
        echo '<button class="btn btn-success btn-sm approve-btn" data-id="' . $row['id'] . '"><i class="fa fa-check" aria-hidden="true"></i> Approve</button>';
    }
    echo '</td>';
    echo '</tr>';
}

                                        ?>
                                    </tbody>
                                </table>

                                <?php include "../deleteModal.php"; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </aside>
    </div>

    <?php include "../footer.php"; ?>
    <script type="text/javascript">
        $(function() {
            $("#table").dataTable({
                "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [0, 3]
                }],
                "aaSorting": []
            });
        });

        $(document).on('click', '.approve-btn', function() {
            const id = $(this).data('id');
            if (confirm('Are you sure you want to approve this zone?')) {
                $.ajax({
                    url: 'approve_user.php',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        if (response === 'success') {
                            alert('Zone approved successfully!');
                            location.reload(); // Reload the page to reflect the changes
                        } else {
                            alert('Failed to approve the zone.');
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>
