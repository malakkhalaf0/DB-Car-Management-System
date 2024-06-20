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

$ID = isset($_POST['ID']) ? $_POST['ID'] : ''; 
if (empty($ID)) {
    // If $ID is empty, select all rows
    $sql = "SELECT * FROM orders";
} else {
    $sql = "SELECT * FROM orders where id='" . $ID . "'";
}

$result = $conn->query($sql);



echo "<table style='border-collapse: collapse; width: 100%; margin-top: 20px;'>";
echo "<tr style='background-color: #007BFF;'>";
echo "<th style='padding: 15px; '>Id</th><th style='padding: 15px; '>Date</th><th style='padding: 15px; '>Customer</th><th style='padding: 15px; '>Car</th>";
echo "</tr>";

if ($result->num_rows > 0) {
  // output data of each row
  $rowCounter = 0;
  while($row = $result->fetch_assoc()) {
    $rowStyle = $rowCounter % 2 == 0 ? 'background-color: #f2f2f2;' : 'background-color: #ffffff;';
    echo "<tr style='$rowStyle'>";
    echo "<td style='padding: 10px;'>" . $row["id"]. "</td><td style='padding: 10px;'>" . $row["date"]. "</td><td style='padding: 10px;'>" . $row["customer"]. "</td><td style='padding: 10px;'>" . $row["car"] ."</td>";
    echo "</tr>";
    $rowCounter++;
  }
  echo "</table>"; // Close the table tag here
} else {
  echo "<p style='color: #ff0000;'>0 results</p>";
}

$conn->close();
?>
