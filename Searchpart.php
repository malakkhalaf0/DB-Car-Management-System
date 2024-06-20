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

$car = isset($_POST['car']) ? $_POST['car'] : ''; 
if (empty($car)) {
    // If $car is empty, select all rows
    $sql = "SELECT * FROM car_part"; 
} else {
    $sql = "SELECT * FROM car_part where car='" . $car . "'";
}

$result = $conn->query($sql);



echo "<table style='border-collapse: collapse; width: 100%; margin-top: 20px;'>";
echo "<tr style='background-color: #007BFF; color: #ffffff; text-align: left;'>";
echo "<th style='padding: 15px; '>Car</th><th style='padding: 15px; ;'>Part</th>";
echo "</tr>";

if ($result->num_rows > 0) {
  // output data of each row
  $rowCounter = 0;
  while($row = $result->fetch_assoc()) {
    $rowStyle = $rowCounter % 2 == 0 ? 'background-color: #f2f2f2;' : 'background-color: #ffffff;';
    echo "<tr style='$rowStyle'>";
    echo "<td style='padding: 10px;'>" . $row["car"]. "</td><td style='padding: 10px;'>" . $row["part"]. "</td>";
    echo "</tr>";
    $rowCounter++;
  }
  echo "</table>"; // Close the table tag here
} else {
  echo "<p style='color: #ff0000;'>0 results</p>";
}

$conn->close();
?>
