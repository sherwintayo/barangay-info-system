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
    // Generate a unique random color
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    // Generate an array of unique colors for each barangay
    function generateUniqueColors(count) {
        const colors = new Set();
        while (colors.size < count) {
            colors.add(getRandomColor());
        }
        return Array.from(colors);
    }

    // Define the data for the chart
    Morris.Bar({
        element: 'morris-bar-chart6',
        data: [
            <?php
            // Query to fetch data grouped by barangay and gender
            if ($isZoneLeader) {
                $qry = mysqli_query($con, "
                    SELECT barangay,
                           SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) as male_count,
                           SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) as female_count
                    FROM tblresident 
                    WHERE barangay = '$zone_barangay'
                    GROUP BY barangay
                ");
            } else {
                $qry = mysqli_query($con, "
                    SELECT barangay,
                           SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) as male_count,
                           SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) as female_count
                    FROM tblresident 
                    GROUP BY barangay
                ");
            }

            // Format data for Morris.js
            $barangayCount = 0; // Counter for the number of barangays
            while ($row = mysqli_fetch_array($qry)) {
                $barangayCount++;
                echo "{y: '" . $row['barangay'] . "', male: " . $row['male_count'] . ", female: " . $row['female_count'] . "},";
            }
            ?>
        ],
        xkey: 'y', // Barangay name
        ykeys: ['male', 'female'], // Separate bars for male and female
        labels: ['Male', 'Female'], // Legend labels
        hideHover: 'auto',
        barColors: function (row, series, type) {
            // Generate unique colors dynamically for each barangay
            const uniqueColors = generateUniqueColors(<?php echo $barangayCount; ?>);
            return uniqueColors[row.x];
        },
        stacked: false // Ensure bars are grouped, not stacked
    });
</script>

</script>
