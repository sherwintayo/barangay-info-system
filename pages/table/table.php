<?php
include('../connection.php');

// Handle create table request
if (isset($_POST['create_table'])) {
    $table_name = $_POST['table_name'];
    $columns = $_POST['columns']; // Format: column1 type, column2 type, etc.

    $query = "CREATE TABLE `$table_name` ($columns)";
    if (mysqli_query($con, $query)) {
        echo "<script>alert('Table `$table_name` created successfully!');</script>";
    } else {
        echo "<script>alert('Error creating table: " . mysqli_error($con) . "');</script>";
    }
}

// Handle add column request
if (isset($_POST['add_column'])) {
    $target_table = $_POST['target_table'];
    $column_name = $_POST['column_name'];
    $column_type = $_POST['column_type'];

    $query = "ALTER TABLE `$target_table` ADD `$column_name` $column_type";
    if (mysqli_query($con, $query)) {
        echo "<script>alert('Column `$column_name` added successfully to `$target_table`!');</script>";
    } else {
        echo "<script>alert('Error adding column: " . mysqli_error($con) . "');</script>";
    }
}

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
        h1, h2, h3 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
            padding: 10px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input, select, button {
            padding: 10px;
            margin: 5px 0;
            width: 100%;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Database Viewer</h1>

    <!-- Form to Create a New Table -->
    <form method="POST">
        <h3>Create New Table</h3>
        <label>Table Name:</label>
        <input type="text" name="table_name" required>
        <label>Columns (Format: column1 type, column2 type):</label>
        <input type="text" name="columns" placeholder="Example: id INT PRIMARY KEY, name VARCHAR(100)" required>
        <button type="submit" name="create_table">Create Table</button>
    </form>

    <!-- Form to Add Column to an Existing Table -->
    <form method="POST">
        <h3>Add Column to Table</h3>
        <label>Target Table:</label>
        <select name="target_table" required>
            <?php
            // Populate the dropdown with existing tables
            mysqli_data_seek($tables_result, 0); // Reset the pointer to the first row
            while ($table = mysqli_fetch_array($tables_result)) {
                echo "<option value='" . $table[0] . "'>" . $table[0] . "</option>";
            }
            ?>
        </select>
        <label>Column Name:</label>
        <input type="text" name="column_name" required>
        <label>Column Type:</label>
        <input type="text" name="column_type" placeholder="Example: VARCHAR(255), INT" required>
        <button type="submit" name="add_column">Add Column</button>
    </form>

    <?php
    // Display existing tables and their contents
    mysqli_data_seek($tables_result, 0); // Reset the pointer to the first row
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
