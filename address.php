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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_id"])) {
  $id = $_POST["update_id"];
  $buidling = $_POST["buidling"];
  $street= $_POST["street"];
  $city = $_POST["city"];
  $country = $_POST["country"];

  $updateSql = "UPDATE address SET id='$id',buidling='$buidling',street='$street',city='$city',country='$country' WHERE id='$id'";
  if ($conn->query($updateSql) === TRUE) {
      echo "<p style='color: #008000;'>updated successfully</p>";
  } else {
      echo "<p style='color: #ff0000;'>Error updating name: " . $conn->error . "</p>";
  }
}
if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST["id"]) && isset($_POST["buidling"]) && isset($_POST["street"]) && isset($_POST["city"])&& isset($_POST["country"])) {
  $id = $_POST["id"];
  $buidling = $_POST["buidling"];
  $street= $_POST["street"];
  $city = $_POST["city"];
  $country = $_POST["country"];
  // Validate and sanitize input if needed
  $checkIdSql = "SELECT * FROM address WHERE id = '$id'";
    $checkIdResult = $conn->query($checkIdSql);

    if ($checkIdResult->num_rows > 0) {
        echo "<p style='color: #ff0000;'>Error: ID already exists</p>";
    }
    else {
  // Insert data into the "car" table
  $insertSql = "INSERT INTO address (id, buidling, street, city,country) VALUES ('$id', '$buidling', '$street', '$city','$country')";
  if ($conn->query($insertSql) === TRUE) {
      echo "<p style='color: #008000;'>New record created successfully</p>";
  } else {
      echo "<p style='color: #ff0000;'>Error: " . $conn->error . "</p>";
  }
}
}
$sqlid = "SELECT id FROM address";
$resultid = $conn->query($sqlid);

$sql = "SELECT * FROM address";
$result = $conn->query($sql);

echo "<h1 style='color: #051530; text-align: center;'>The Address Table</h1>";

echo "<table style='border-collapse: collapse; width: 100%; margin-top: 20px;'>";
echo "<tr style='background-color: #007BFF; color: #ffffff;'>";
echo "<th style='padding: 15px; '>Id</th><th style='padding: 15px; '>Building</th><th style='padding: 15px; '>Street</th><th style='padding: 15px;'>City</th><th style='padding: 15px; '>Country</th>";
echo "</tr>";

if ($result->num_rows > 0) {
    // output data of each row
    $rowCounter = 0;
    while($row = $result->fetch_assoc()) {
        $rowStyle = $rowCounter % 2 == 0 ? 'background-color: #f2f2f2;' : 'background-color: #ffffff;';
        echo "<tr style='$rowStyle'>";
        echo "<td style='padding: 10px;'>" . $row["id"]. "</td><td style='padding: 10px;'>" . $row["buidling"]. "</td><td style='padding: 10px;'>" . $row["street"]. "</td><td style='padding: 10px;'>" . $row["city"] ."</td> <td style='padding: 10px;'>" . $row["country"]. "</td>";
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
<title>Address</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
         body {
            font-family: Arial, sans-serif;
    margin: 20px;
    background-color: #f4f4f4;
        }

        h1, h2 {
            color: #333;
    text-align: center;
    margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            flex: 1;
    padding: 20px;
    border: 1px solid #ccc;
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
            justify-content: space-between;
            gap: 20px;
        }

        .form {
            max-height: 250px; /* Set your desired maximum height */
    overflow-y: auto; 
            
        }
.forms-container form {
    max-height: 400px; /* Set your desired maximum height */
    overflow-y: auto;
}
.container {
            max-width: 1400px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
            margin-top: 10px;
        }
        .form-group {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
}

.form-group label {
    margin-right: 10px;
    text-align: right;
}

.form-group .input {
    margin-left: 10px;
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
<div class="container">
<div class="forms-container">
    <form method="post" style="margin-top: 20px;">
        <h2 style="color: #051530;">Insert New Address</h2>
        <div class="form-group">
        <label for="id" style="color: #051530; font-weight: bold;"  >id:</label>
        <input type="number" name="id" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; width:100%;">
        
        <label for="buidling" style="color: #051530; font-weight: bold;">building:</label>
        <input type="number" name="buidling" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        </div>
        <div class="form-group">
        <label for="street" style="color: #051530; font-weight: bold;">Street:</label>
        <input type="text" name="street" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="city" style="color: #051530; font-weight: bold;">City:</label>
        <input type="text" name="city" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        </div>
        <div class="form-group">
        <label for="country" style="color: #051530; font-weight: bold;">Country:</label>
        <input type="text" name="country" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        </div>
        <input type="submit" value="Insert" style="margin: 10px;
            padding: 12.5px 30px;
            border: 0;
            border-radius: 100px;
            background-color: #007BFF;
            color: #ffffff;
            font-weight: bold;
            width:30%;">
    </form>

    <form method="post" style="margin-top: 20px;">
    <h2 style="color: #051530;">Update On Address</h2>
    <div class="form-group">
    <label for="update_id" style="color: #051530; font-weight: bold;"> id:</label>
    <select name="update_id" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        <?php
        
        while ($row = $resultid->fetch_assoc()) {
            echo "<option value='" . $row["id"] . "'>" . $row["id"] . "</option>";
        }
        ?>
    </select>

        <label for="buidling" style="color: #051530; font-weight: bold;">building:</label>
        <input type="number" name="buidling" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
    </div>
        <div class="form-group">
        <label for="street" style="color: #051530; font-weight: bold;">Street:</label>
        <input type="text" name="street" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="city" style="color: #051530; font-weight: bold;">City:</label>
        <input type="text" name="city" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
    </div>
        <div class="form-group">
        <label for="country" style="color: #051530; font-weight: bold;">Country:</label>
        <input type="text" name="country" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
    </div>
    <input type="submit" value="Update" style="margin: 10px;
        padding: 12.5px 30px;
        border: 0;
        border-radius: 100px;
        background-color: #007BFF;
        color: #ffffff;
        font-weight: bold;
        width:30%;">
</form>
    </div>
    <label for="id"  style="color: #051530; font-weight: bold;">Address ID:</label>
    <input type="number" id="id" name="customerId" style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;width:50%;">
    <button id="searchBtn" style="margin: 10px;
        padding: 12.5px 30px;
        border: 0;
        border-radius: 100px;
        background-color: #007BFF;
        color: #ffffff;
        font-weight: bold;">Search</button>
    <div id="searchResult"></div>
    </div>
    <script>
        $(document).ready(function () {
            $("#searchBtn").click(function () {
                // Use $.post to send an AJAX POST request
                $.post("Searchaddress.php", {
                    ID: $("#id").val()
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
