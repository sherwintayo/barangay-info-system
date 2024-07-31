<form class="form-inline" action="" method="GET">
    <div class="form-group">
        <label for="from_date">From Date</label>
        <input type="date" class="form-control" id="from_date" name="from_date" value="<?php if (isset($_GET['from_date'])) {
            echo $_GET['from_date'];
        } ?>" />
    </div>
    <div class="form-group">
        <label for="to_date">To Date:</label>
        <input type="date" class="form-control" id="to_date" name="to_date" value="<?php if (isset($_GET['to_date'])) {
            echo $_GET['to_date'];
        } ?>" />
    </div>
    <button type="submit" name="blotter_filter" class="btn btn-primary">Filter</button>
</form>

<div style="margin-top: 1rem">
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

 <?php 
    if (isset($_GET['from_date'])) {
        ?>
        <a href="printBlotter.php?from_date=<?= $_GET['from_date'] ?>&to_date=<?= $_GET['to_date'] ?>&blotter_filter" class="btn btn-primary btn-sm" style="margin-left: 20px;">Print</a>
        <?php 
    }
?>
<script>
    function dateformat(date) {
        var d = new Date(date);
        var day = d.getDate();
        var month = d.getMonth() + 1;
        var year = d.getFullYear();
        return year + '-' + (month < 10 ? `0${month}` : month) + '-' + day;
    }

    function handlFilterDate(action, value) {
        const date = new Date(value);
        if (action === 'min') {
            const nextday = date.setDate(date.getDate() + 1);
            const _dateformat = dateformat(nextday)
            document.getElementById("to_date").setAttribute("min", _dateformat)
        } else if (action === 'max') {
            const prevday = date.setDate(date.getDate() - 1);
            const _dateformat = dateformat(prevday)
            document.getElementById("from_date").setAttribute("max", _dateformat)
        }
    }

    $(function () {
        const from_date = document.getElementById("from_date");
        const to_date = document.getElementById("to_date");

        handlFilterDate("min", from_date.value);
        handlFilterDate("max", to_date.value)
    });

    function handleChange(event, action) {
        handlFilterDate(action, event.target.value);
    }
</script>
