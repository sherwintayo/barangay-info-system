<?php include "../connection.php";


?>

<script>
	Morris.Bar({
		element: 'morris-bar-chart3',
		data: [
			<?php
			if ($isZoneLeader) {
				$qry = mysqli_query($con, "SELECT *,count(*) as cnt FROM tblresident r WHERE r.barangay = '$zone_barangay' group by r.zone ");
			}else{
				$qry = mysqli_query($con, "SELECT *,count(*) as cnt FROM tblresident r group by r.zone ");
			}
			while ($row = mysqli_fetch_array($qry)) {
				echo "{y:'" . $row['zone'] . "',a:'" . $row['cnt'] . "'},";
			}
			?>
		],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['Resident per Zone'],
		hideHover: 'auto',
		barColors: ['#37B7C3'] // Change this color to your desired color
	});
</script>




<script>
	Morris.Bar({
		element: 'morris-bar-chart5',
		data: [
			<?php
			if ($isZoneLeader) {
				$qry = mysqli_query($con, "SELECT *,count(*) as cnt FROM tblresident r WHERE r.barangay = '$zone_barangay' group by r.householdnum ");
			}else{
				$qry = mysqli_query($con, "SELECT *,count(*) as cnt FROM tblresident r group by r.householdnum ");
			}
			while ($row = mysqli_fetch_array($qry)) {
				echo "{y:'" . $row['householdnum'] . "',a:'" . $row['cnt'] . "'},";
			}
			?>
		],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['householdnumber'],
		hideHover: 'auto',
		barColors: ['#37B7C3'] // Change this color to your desired color
	});
</script>


<script>
    Morris.Bar({
        element: 'morris-bar-chart6',
        data: [
            <?php
            // Check if the user is a Zone Leader and filter by barangay accordingly
            if ($isZoneLeader) {
                $qry = mysqli_query($con, "SELECT barangay, gender, COUNT(*) as cnt FROM tblresident 
                                           WHERE barangay = '$zone_barangay' 
                                           GROUP BY barangay, gender");
            } else {
                $qry = mysqli_query($con, "SELECT barangay, gender, COUNT(*) as cnt FROM tblresident 
                                           GROUP BY barangay, gender");
            }
            
            // Fetch and format data for Morris.js
            while ($row = mysqli_fetch_array($qry)) {
                echo "{y:'" . $row['barangay'] . " (" . $row['gender'] . ")', a:" . $row['cnt'] . "},";
            }
            ?>
        ],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Count'],
        hideHover: 'auto',
        barColors: ['#37B7C3'] // Adjust the color as needed
    });
</script>

</script>
