<?php
// Database connection
$host = '127.0.0.1';
$username = 'u510162695_barangay';
$password = '1Db_barangay'; // Replace with the actual password
$dbname = 'u510162695_barangay';

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . htmlspecialchars($conn->connect_error));
}

// Handle deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_selected']) && !empty($_POST['table']) && !empty($_POST['ids'])) {
        $tableName = $conn->real_escape_string($_POST['table']);
        $ids = array_map('intval', $_POST['ids']);
        $placeholders = implode(",", array_fill(0, count($ids), "?"));

        $sql = "DELETE FROM $tableName WHERE id IN ($placeholders)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param(str_repeat("i", count($ids)), ...$ids);
            if ($stmt->execute()) {
                echo "Selected records deleted successfully.";
            } else {
                echo "Error deleting records: " . htmlspecialchars($stmt->error);
            }
            $stmt->close();
        } else {
            echo "Error preparing statement.";
        }
    } elseif (isset($_POST['delete']) && !empty($_POST['table']) && !empty($_POST['id'])) {
        $tableName = $conn->real_escape_string($_POST['table']);
        $id = intval($_POST['id']);

        $sql = "DELETE FROM $tableName WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo "Record deleted successfully.";
            } else {
                echo "Error deleting record: " . htmlspecialchars($stmt->error);
            }
            $stmt->close();
        } else {
            echo "Error preparing statement.";
        }
    }
}

// Function to display table
function displayTable($conn, $tableName) {
    $tableNameEscaped = htmlspecialchars($tableName);
    $sql = "SELECT * FROM $tableName";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "<div style='margin-bottom: 20px;'>";
        echo "<h2>" . strtoupper($tableNameEscaped) . " TABLE</h2>";
        echo "<form method='POST' onsubmit='return confirm(\"Are you sure you want to delete selected records?\");'>";
        echo "<input type='hidden' name='table' value='$tableNameEscaped'>";
        echo "<table border='1' cellpadding='10' cellspacing='0'>";

        // Get field information for headers
        $fields = $result->fetch_fields();
        echo "<tr>";
        echo "<th style='background-color: #f2f2f2;'>Select</th>"; // Add checkbox column
        foreach ($fields as $field) {
            echo "<th style='background-color: #f2f2f2;'>" . htmlspecialchars($field->name) . "</th>";
        }
        echo "<th style='background-color: #f2f2f2;'>Delete</th>"; // Add Delete column
        echo "</tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><input type='checkbox' name='ids[]' value='" . intval($row['id']) . "'></td>"; // Checkbox for row selection
            foreach ($row as $key => $value) {
                // Mask password for security
                if (strpos(strtolower($key), 'password') !== false) {
                    echo "<td>[MASKED]</td>";
                } else {
                    echo "<td>" . htmlspecialchars($value ?? "NULL") . "</td>";
                }
            }
            // Add delete button
            echo "<td>";
            echo "<form method='POST' style='display:inline;' onsubmit='return confirm(\"Are you sure you want to delete this record?\");'>";
            echo "<input type='hidden' name='table' value='$tableNameEscaped'>";
            echo "<input type='hidden' name='id' value='" . intval($row['id']) . "'>";
            echo "<input type='submit' name='delete' value='Delete'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<br>";
        echo "<input type='submit' name='delete_selected' value='Delete Selected'>";
        echo "</form>";
        echo "</div>";
    } else {
        echo "0 results found in $tableNameEscaped table";
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
displayTable($conn, 'tbluser');

$conn->close();
?>
