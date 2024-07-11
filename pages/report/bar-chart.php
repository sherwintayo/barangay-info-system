<?php include "../connection.php";


?>

<script>
	Morris.Bar({
		element: 'morris-bar-chart2',
		data: [
			<?php

				$start = 0;
				while($start!=100){
					$qry = mysqli_query($con,"select * from tblresident where age like '%$start%'");
					$cnt = mysqli_num_rows($qry);
					echo "{y:'$start',a:$cnt},";
					$start = $start+1;
				}
			?>
		],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['Age'],
		hideHover: 'auto'
	});

	Morris.Bar({
		element: 'morris-bar-chart3',
		data: [
			<?php

					$qry = mysqli_query($con,"SELECT *,count(*) as cnt FROM tblresident r group by r.zone ");
					while($row=mysqli_fetch_array($qry)){
					echo "{y:'".$row['zone']."',a:'".$row['cnt']."'},";
					}
			?>
		],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['Resident per Zone/Purok'],
		hideHover: 'auto'
	});

	

	Morris.Bar({
		element: 'morris-bar-chart5',
		data: [
			<?php

					$qry = mysqli_query($con,"SELECT *,count(*) as cnt FROM tblresident r group by r.householdnum ");
					while($row=mysqli_fetch_array($qry)){
					echo "{y:'".$row['householdnum']."',a:'".$row['cnt']."'},";
					}
			?>
		],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['householdnumber'],
		hideHover: 'auto'
	});

	Morris.Bar({
		element: 'morris-bar-chart6',
		data: [
			<?php

					$qry = mysqli_query($con,"SELECT *,count(*) as cnt FROM tblresident r group by r.gender ");
					while($row=mysqli_fetch_array($qry)){
					echo "{y:'".$row['gender']."',a:'".$row['cnt']."'},";
					}
			?>
		],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['gender'],
		hideHover: 'auto'
	});
</script>