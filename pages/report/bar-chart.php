<?php include "../connection.php"; ?>

<script>
	// Function to generate random colors
	function generateRandomColor() {
		var letters = '0123456789ABCDEF';
		var color = '#';
		for (var i = 0; i < 6; i++) {
			color += letters[Math.floor(Math.random() * 16)];
		}
		return color;
	}

	Morris.Bar({
		element: 'morris-bar-chart2',
		data: [
			<?php
			$start = 0;
			while ($start != 100) {
				$qry = mysqli_query($con, "SELECT * FROM tblresident WHERE age LIKE '%$start%'");
				$cnt = mysqli_num_rows($qry);
				echo "{y:'$start',a:$cnt},";
				$start = $start + 1;
			}
			?>
		],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['Age'],
		hideHover: 'auto',
		barColors: function (row, series, type) {
			return generateRandomColor(); // Random color for each bar
		}
	});

	Morris.Bar({
		element: 'morris-bar-chart3',
		data: [
			<?php
			$qry = mysqli_query($con, "SELECT *, COUNT(*) AS cnt FROM tblresident r GROUP BY r.zone");
			while ($row = mysqli_fetch_array($qry)) {
				echo "{y:'" . $row['zone'] . "',a:'" . $row['cnt'] . "'},";
			}
			?>
		],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['Resident per Zone/Purok'],
		hideHover: 'auto',
		barColors: function (row, series, type) {
			return generateRandomColor(); // Random color for each bar
		}
	});

	Morris.Bar({
		element: 'morris-bar-chart5',
		data: [
			<?php
			$qry = mysqli_query($con, "SELECT *, COUNT(*) AS cnt FROM tblresident r GROUP BY r.householdnum");
			while ($row = mysqli_fetch_array($qry)) {
				echo "{y:'" . $row['householdnum'] . "',a:'" . $row['cnt'] . "'},";
			}
			?>
		],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['householdnumber'],
		hideHover: 'auto',
		barColors: function (row, series, type) {
			return generateRandomColor(); // Random color for each bar
		}
	});

	Morris.Bar({
		element: 'morris-bar-chart6',
		data: [
			<?php
			$qry = mysqli_query($con, "SELECT *, COUNT(*) AS cnt FROM tblresident r GROUP BY r.gender");
			while ($row = mysqli_fetch_array($qry)) {
				echo "{y:'" . $row['gender'] . "',a:'" . $row['cnt'] . "'},";
			}
			?>
		],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['gender'],
		hideHover: 'auto',
		barColors: function (row, series, type) {
			return generateRandomColor(); // Random color for each bar
		}
	});
</script>