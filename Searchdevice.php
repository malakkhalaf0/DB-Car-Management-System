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

$NO = isset($_POST['NO']) ? $_POST['NO'] : ''; 
if (empty($NO)) {
    // If $NO is empty, select all rows
    $sql = "SELECT * FROM device";
} else {
    $sql = "SELECT * FROM device where no='" . $NO . "'";
}

$result = $conn->query($sql);



echo "<table style='border-collapse: collapse; width: 100%; margin-top: 20px;'>";
echo "<tr style='background-color: #62516D; color: #ffffff; text-align: left;'>";
echo "<th style='padding: 15px; '>No</th><th style='padding: 15px;'>Name</th><th style='padding: 15px;;'>Price</th><th style='padding: 15px;'>Weight</th><th style='padding: 15px;'>Made</th>";
echo "</tr>";

if ($result->num_rows > 0) {
    // output data of each row
    $rowCounter = 0;
    while ($row = $result->fetch_assoc()) {
        $rowStyle = $rowCounter % 2 == 0 ? 'background-color: #f2f2f2;' : 'background-color: #ffffff;';
        echo "<tr style='$rowStyle'>";
        echo "<td style='padding: 10px;'>" . $row["no"] . "</td><td style='padding: 10px;'>" . $row["name"] . "</td><td style='padding: 10px;'>" . $row["price"] . "</td><td style='padding: 10px;'>" . $row["weight"] . "</td><td style='padding: 10px;'>" . $row["made"] . "</td>";
        echo "</tr>";
        $rowCounter++;
    }
    echo "</table>";
} else {
    echo "<p style='color: #ff0000;'>0 results</p>";
}

$conn->close();
?>
