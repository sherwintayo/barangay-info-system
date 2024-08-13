<?php include "../connection.php"; ?>
<script>
	Morris.Donut({
		element: 'morris-donut-chart',
		data: [{
			label: "No schooling completed",
			value: <?php
			if ($isZoneLeader) {
				$q = mysqli_query($con, "SELECT * from tblresident where highestEducationalAttainment = 'No schooling completed' AND barangay = '$zone_barangay' ");
			}else{
				$q = mysqli_query($con, "SELECT * from tblresident where highestEducationalAttainment = 'No schooling completed' ");
			}
			$numrow = mysqli_num_rows($q);
			echo $numrow;
			?>
		}, {
			label: "Elementary",
			value: <?php
			if ($isZoneLeader) {
				$q = mysqli_query($con, "SELECT * from tblresident where highestEducationalAttainment = 'Elementary' AND barangay = '$zone_barangay' ");
			}else{
				$q = mysqli_query($con, "SELECT * from tblresident where highestEducationalAttainment = 'Elementary' ");
			}
			
			$numrow = mysqli_num_rows($q);
			echo $numrow;
			?>
		}, {
			label: "High school, undergrad",
			value: <?php
			if ($isZoneLeader) {
				$q = mysqli_query($con, "SELECT * from tblresident where highestEducationalAttainment = 'High school, undergrad' AND barangay = '$zone_barangay' ");
			}else{
				$q = mysqli_query($con, "SELECT * from tblresident where highestEducationalAttainment = 'High school, undergrad' ");
			}
			$numrow = mysqli_num_rows($q);
			echo $numrow;
			?>
		}, {
			label: "High school graduate",
			value: <?php
			if ($isZoneLeader) {
				$q = mysqli_query($con, "SELECT * from tblresident where highestEducationalAttainment = 'High school graduate' AND barangay = '$zone_barangay' ");
			}else{
				$q = mysqli_query($con, "SELECT * from tblresident where highestEducationalAttainment = 'High school graduate' ");
			}
			$numrow = mysqli_num_rows($q);
			echo $numrow;
			?>
		}, {
			label: "College, undergrad",
			value: <?php
			if ($isZoneLeader) {
				$q = mysqli_query($con, "SELECT * from tblresident where highestEducationalAttainment = 'College, undergrad' AND barangay = '$zone_barangay' ");
			}else{
				$q = mysqli_query($con, "SELECT * from tblresident where highestEducationalAttainment = 'College, undergrad' ");
			}
			$numrow = mysqli_num_rows($q);
			echo $numrow;
			?>
		}, {
			label: "Vocational",
			value: <?php
			if ($isZoneLeader) {
				$q = mysqli_query($con, "SELECT * from tblresident where highestEducationalAttainment = 'Vocational' AND barangay = '$zone_barangay' ");
			}else{
				$q = mysqli_query($con, "SELECT * from tblresident where highestEducationalAttainment = 'Vocational' ");
			}
			$numrow = mysqli_num_rows($q);
			echo $numrow;
			?>
		}, {
			label: "Bachelor's degree",
			value: <?php
			if ($isZoneLeader) {
				$q = mysqli_query($con, "SELECT * from tblresident where highestEducationalAttainment = 'Bachelor''s degree' AND barangay = '$zone_barangay' ");
			}else{
				$q = mysqli_query($con, "SELECT * from tblresident where highestEducationalAttainment = 'Bachelor''s degree' ");
			}
			$numrow = mysqli_num_rows($q);
			echo $numrow;
			?>
		}, {
			label: "Master's degree",
			value: <?php
			if ($isZoneLeader) {
				$q = mysqli_query($con, "SELECT * from tblresident where highestEducationalAttainment = 'Master''s degree' AND barangay = '$zone_barangay' ");
			}else{
				$q = mysqli_query($con, "SELECT * from tblresident where highestEducationalAttainment = 'Master''s degree' ");
			}
			$numrow = mysqli_num_rows($q);
			echo $numrow;
			?>
		}, {
			label: "Doctorate degree",
			value: <?php
			if ($isZoneLeader) {
				$q = mysqli_query($con, "SELECT * from tblresident where highestEducationalAttainment = 'Doctorate degree' AND barangay = '$zone_barangay' ");
			}else{
				$q = mysqli_query($con, "SELECT * from tblresident where highestEducationalAttainment = 'Doctorate degree' ");
			}
			$numrow = mysqli_num_rows($q);
			echo $numrow;
			?>
		}],
		resize: true,
		colors: ['#FF5733', '#33FF57', '#3357FF', '#FFC300', '#DAF7A6', '#C70039', '#900C3F', '#581845', '#1E90FF'] // Custom colors
	});
</script>
