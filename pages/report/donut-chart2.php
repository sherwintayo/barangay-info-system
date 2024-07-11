<?php include "../connection.php";?>
<script>
	Morris.Donut({
		element: 'morris-donut-chart1',
		data: [{
			label: "Police Clearance",
			value: <?php 
					$q = mysqli_query($con,"SELECT * from tblclearace where Clearance= 'Police Clearance' ");
					$numrow = mysqli_num_rows($q);
					echo $numrow;
			 	?>
		}, {
			label: "Employment",
			value: <?php 
					$q = mysqli_query($con,"SELECT * from tblclearace where Clearance = 'Employment' ");
					$numrow = mysqli_num_rows($q);
					echo $numrow;
			 	?>
		}, {
			label: "Loan",
			value: <?php 
					$q = mysqli_query($con,"SELECT * from tblclearace where Clearance = 'Loan' ");
					$numrow = mysqli_num_rows($q);
					echo $numrow;
			 	?>
		
		}],
		resize: true
	});
</script>