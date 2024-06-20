<?php

session_start();
if(isset($_SESSION['username'])){
    
}else{
    header('Location: loginView.html');
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cara";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_id"])&&  isset($_POST["new_id"])) {
  $oldName = $_POST["update_id"];
  $newName = $_POST["new_id"];

  // Validate and sanitize input if needed

  // Update only the "name" field in the "car" table
  $updateSql = "UPDATE car_part SET car='$oldName', part='$newName' WHERE car='$oldName'";
  if ($conn->query($updateSql) === TRUE) {
      echo "<p style='color: #008000;'>updated successfully</p>";
  } else {
      echo "<p style='color: #ff0000;'>Error updating name: " . $conn->error . "</p>";
  }
}
if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST["car"]) && isset($_POST["part"]) ) {
  $car = $_POST["car"];
  $part = $_POST["part"];
  
  // Validate and sanitize input if needed

  // Insert data into the "car" table
  $insertSql = "INSERT INTO car_part (car, part) VALUES ('$car', '$part')";
  if ($conn->query($insertSql) === TRUE) {
      echo "<p style='color: #008000;'>New record created successfully</p>";
  } else {
      echo "<p style='color: #ff0000;'>Error: " . $conn->error . "</p>";
  }
}

$sqlcar = "SELECT * FROM car";
$resultcar = $conn->query($sqlcar);

$sqlcarr = "SELECT * FROM device";
$resultcarr = $conn->query($sqlcarr);

$sqldevice = "SELECT * FROM device";
$resultd = $conn->query($sqldevice);

$sqlid = "SELECT car FROM car_part";
$resultid = $conn->query($sqlid);

$sql = "SELECT * FROM car_part";
$result = $conn->query($sql);

echo "<h1 style='color: #051530; text-align: center;'>The Car Part Table</h1>";

echo "<table style='border-collapse: collapse; width: 100%; margin-top: 20px;'>";
echo "<tr style='background-color: #007BFF; color: #ffffff; text-align: left;'>";
echo "<th style='padding: 15px; '>Car</th><th style='padding: 15px; '>Part</th>";
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
<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Car_Part</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
               body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h1, h2 {
            color: #62516D;
            text-align: center;
        }

        table {
            width: 40%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: 10%;
        }

        table th, table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #007BFF;
            color: #ffffff;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        form {
            max-width: 500px;
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #62516D;
            font-weight: bold;
        }

        input[type="number"],
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 12.5px 30px;
            border: 0;
            border-radius: 100px;
            background-color: #007BFF;
            color: #ffffff;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #005bb5;
        }
        .forms-container {
    display: flex;
    justify-content: space-between; /* Add space between the forms */
    margin-top: 20px;
}

.forms-container form {
    flex: 1; /* Each form takes equal width */
    margin-right: 90px;
     /* Add some space between the forms */
     margin-left: 90px;
}
.form-group {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
}

.form-group label {
    flex: 1;
    margin-right: 10px;
    text-align: right;
}

.form-group .input {
    flex: 2;
}

        @media screen and (max-width: 900px) {
            table{
                width: 500px;
            
            }
            h1{
                font-size: 20px;
            }
            tr{
                font-size: 10px; 
            }
            h2{
                font-size: 18px;   
            }
          select{
           width:70px ;
            }
            input{
                width:90px ;
            }
        }
        @media screen and (max-width: 400px) {
            table{
                width: 300px;
            
            } 
        }
        @media (max-width: 500px) {
    .forms-container {
        display: block; /* Display as block to stack vertically */
        text-align: center; /* Center the forms */
    }

    .forms-container form {
        margin-bottom: 20px; /* Add some space between stacked forms */
        width: 90%; /* Adjust width for better visibility */
        max-width: 400px; /* Set a maximum width */
        margin: 0 auto; /* Center the form */
    }
}
  

    </style>
</head>

<body>
    
<div class="forms-container">
    <form method="post" style="margin-top: 20px;">
        <h2 style="color: #051530;">Insert New Car_part</h2>
        <div class="form-group">
        <label for="car" style="color: #051530; font-weight: bold;"  >car:</label>
        <select name="car" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <?php
            // Populate the dropdown with existing addresses
            while ($row = $resultcar->fetch_assoc()) {
                echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
            }
            ?>
        </select>
        </div>
        <div class="form-group">
 
        <label for="part" style="color: #051530; font-weight: bold;"> part:</label>
        <select name="part" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;width:100%;">
            <?php
            // Populate the dropdown with existing addresses
            while ($row = $resultd->fetch_assoc()) {
                echo "<option value='" . $row["no"] . "'>" . $row["no"] . "</option>";
            }
            ?>
        </select>
</div>
         
        
        <input type="submit" value="Insert" style="margin: 10px;
            padding: 12.5px 30px;
            border: 0;
            border-radius: 100px;
            background-color: #007BFF;
            color: #ffffff;
            font-weight: bold;">
    </form>

    <form method="post" style="margin-top: 20px;">
    <h2 style="color: #051530;">Update car_part </h2>
    
    <label for="update_id" style="color: #051530; font-weight: bold;width:30%;"> car :</label>
    <select name="update_id" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;width:100%;">
        <?php
        
        while ($row = $resultid->fetch_assoc()) {
            echo "<option value='" . $row["car"] . "'>" . $row["car"] . "</option>";
        }
        ?>
    </select>
    
    <label for="new_id" style="color: #051530; font-weight: bold;width:30%;"> part :</label>
    <select name="new_id" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;width:100%;">
    <?php
        
        while ($row = $resultcarr->fetch_assoc()) {
            echo "<option value='" . $row["no"] . "'>" . $row["no"] . "</option>";
        }
        ?>
    </select>

    <input type="submit" value="Update" style="margin: 10px;
        padding: 12.5px 30px;
        border: 0;
        border-radius: 100px;
        background-color:#007BFF;
        color: #ffffff;
        font-weight: bold;">
</form>
</div>
    <label for="car"  style="color: #051530; font-weight: bold;">car:</label>
    <input type="text" id="car" name="customerId" style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;width:30%;">
    <button id="searchBtn" style="margin: 10px;
        padding: 12.5px 30px;
        border: 0;
        border-radius: 100px;
        background-color: #007BFF;
        color: #ffffff;
        font-weight: bold;">Search</button>
    <div id="searchResult"></div>
    <script>
        $(document).ready(function () {
            $("#searchBtn").click(function () {
                // Use $.post to send an AJAX POST request
                $.post("searchpart.php", {
                    car: $("#car").val()
                }, function (data, status) {
                    // Handle the response from the server
                    console.log("Data: " + data + "\nStatus: " + status);
                    $("#searchResult").html(data);
                });
            });
        });
    </script>

</body>

</html>
