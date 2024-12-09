<?php
// Connect to database
$host = '127.0.0.1';
$username = 'u510162695_barangay';
$password = '1Db_barangay';  // Replace with the actual password
$dbname = 'u510162695_barangay';

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . htmlspecialchars($conn->connect_error));
}

// Function to escape output for XSS protection
function escapeOutput($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// Function to display table
function displayTable($conn, $tableName) {
    $sql = "SELECT * FROM " . $conn->real_escape_string($tableName);
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div style='margin-bottom: 20px;'>";
        echo "<h2>" . escapeOutput(strtoupper($tableName)) . " TABLE</h2>";
        echo "<table border='1' cellpadding='10' cellspacing='0'>";

        // Get field information for headers
        $fields = $result->fetch_fields();
        echo "<tr>";
        foreach ($fields as $field) {
            echo "<th style='background-color: #f2f2f2;'>" . escapeOutput($field->name) . "</th>";
        }
        echo "<th style='background-color: #f2f2f2;'>Action</th>"; // Add delete button column header
        echo "</tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $key => $value) {
                // Mask password for security
                if (strpos(strtolower($key), 'password') !== false) {
                    echo "<td>[MASKED]</td>";
                } else {
                    echo "<td>" . escapeOutput($value ?? "NULL") . "</td>";
                }
            }
            // Add delete button for each row
            echo "<td><form method='POST' action='deletedb.php'><input type='hidden' name='tableName' value='" . escapeOutput($tableName) . "'><input type='hidden' name='id' value='" . escapeOutput($row['id']) . "'><button type='submit'>Delete</button></form></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "0 results found in " . escapeOutput($tableName) . " table";
    }
}

// Display tables
displayTable($conn, 'tblactivity');
displayTable($conn, 'tblactivityphoto');
displayTable($conn, 'tblblotter');
displayTable($conn, 'tblclearance');
displayTable($conn, 'tblhousehold');
displayTable($conn, 'tbllogs');
displayTable($conn, 'tblnewresident');
displayTable($conn, 'tblofficial');
displayTable($conn, 'tblpermit');
displayTable($conn, 'tblproject');
displayTable($conn, 'tblpurok');
displayTable($conn, 'tblpwd');
displayTable($conn, 'tblresident');

$conn->close();
?>

<style>
table {
    border-collapse: collapse;
    width: 100%;
    margin: 20px 0;
    font-family: Arial, sans-serif;
}

h2 {
    color: #333;
    border-bottom: 2px solid #ddd;
    padding-bottom: 10px;
}

th, td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f5f5f5;
}
</style>
