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
    $sql = "SELECT * FROM customer";
} else {
    $sql = "SELECT * FROM customer where id='" . $ID . "'";
}

$result = $conn->query($sql);



echo "<table style='border-collapse: collapse; width: 100%; margin-top: 20px;'>";
echo "<tr style='background-color: #007BFF; color: #ffffff; text-align: left;'>";
echo "<th style='padding: 15px; '>Id</th><th style='padding: 15px;'>F_name</th><th style='padding: 15px;'>L_name</th><th style='padding: 15px;'>Address</th><th style='padding: 15px;'>Job</th>";
echo "</tr>";

if ($result->num_rows > 0) {
    // output data of each row
    $rowCounter = 0;
    while ($row = $result->fetch_assoc()) {
        $rowStyle = $rowCounter % 2 == 0 ? 'background-color: #f2f2f2;' : 'background-color: #ffffff;';
        echo "<tr style='$rowStyle'>";
        echo "<td style='padding: 10px;'>" . $row["id"] . "</td><td style='padding: 10px;'>" . $row["f_name"] . "</td><td style='padding: 10px;'>" . $row["l_name"] . "</td><td style='padding: 10px;'>" . $row["address"] . "</td><td style='padding: 10px;'>" . $row["job"] . "</td>";
        echo "</tr>";
        $rowCounter++;
    }
    echo "</table>";
} else {
    echo "<p style='color: #ff0000;'>0 results</p>";
}

$conn->close();
?>
