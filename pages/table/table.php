<?php
include('../connection.php');

// Fetch all tables in the database
$tables_query = "SHOW TABLES";
$tables_result = mysqli_query($con, $tables_query);

if (!$tables_result) {
    die("Error retrieving tables: " . mysqli_error($con));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Viewer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        h1, h2 {
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Database Viewer</h1>

    <?php
    // Loop through each table
    while ($table = mysqli_fetch_array($tables_result)) {
        $table_name = $table[0];
        echo "<h2>Table: $table_name</h2>";

        // Fetch columns of the table
        $columns_query = "SHOW COLUMNS FROM `$table_name`";
        $columns_result = mysqli_query($con, $columns_query);

        if (!$columns_result) {
            echo "<p>Error retrieving columns for table $table_name: " . mysqli_error($con) . "</p>";
            continue;
        }

        echo "<table>";
        echo "<tr>";
        while ($column = mysqli_fetch_assoc($columns_result)) {
            echo "<th>" . $column['Field'] . "</th>";
        }
        echo "</tr>";

        // Fetch data from the table
        $data_query = "SELECT * FROM `$table_name`";
        $data_result = mysqli_query($con, $data_query);

        if (!$data_result) {
            echo "<p>Error retrieving data for table $table_name: " . mysqli_error($con) . "</p>";
            echo "</table>";
            continue;
        }

        // Display table rows
        while ($row = mysqli_fetch_assoc($data_result)) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
</body>
</html>

