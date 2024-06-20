<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cara";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = isset($_POST['name']) ? $_POST['name'] : ''; 
if (empty($name)) {
    // If $name is empty, select all rows
    $sql = "SELECT * FROM manufacture";
} else {
    $sql = "SELECT * FROM manufacture where name='" . $name . "'";
}

$result = $conn->query($sql);



echo "<table style='border-collapse: collapse; width: 100%; margin-top: 20px;'>";
echo "<tr style='background-color: #f2f2f2;'>";
echo "<th style='padding: 15px; '>Name</th><th style='padding: 15px; '>Type</th><th style='padding: 15px; '>City</th><th style='padding: 15px; '>Country</th>";
echo "</tr>";

if ($result->num_rows > 0) {
    // output data of each row
    $rowCounter = 0;
    while($row = $result->fetch_assoc()) {
        $rowStyle = $rowCounter % 2 == 0 ? 'background-color: #f2f2f2;' : 'background-color: #ffffff;';
        echo "<tr style='$rowStyle'>";
        echo "<td style='padding: 10px;'>" . $row["name"]. "</td><td style='padding: 10px;'>" . $row["type"]. "</td><td style='padding: 10px;'>" . $row["city"]. "</td><td style='padding: 10px;'>" . $row["country"] ."</td>";
        echo "</tr>";
        $rowCounter++;
    }
    echo "</table>"; // Close the table tag here
} else {
    echo "<p style='color: #ff0000;'>0 results</p>";
}

$conn->close();
?>
