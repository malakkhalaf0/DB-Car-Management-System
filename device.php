<?php

session_start();
if (!isset($_SESSION['username'])) {
    // The user is not logged in, redirect to login page
    header('Location: loginView.html');
    exit;
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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_no"])) {
  $oldName = $_POST["update_no"];
  $name = $_POST["name"];
  $price = $_POST["price"];
  $weight = $_POST["weight"];
  $made = $_POST["made"];

  // Validate and sanitize input if needed

  // Update only the "name" field in the "car" table
  $updateSql = "UPDATE device SET no='$oldName', name='$name',price='$price',weight='$weight',made='$made' WHERE no='$oldName'";
  if ($conn->query($updateSql) === TRUE) {
      echo "<p style='color: #008000;'> updated successfully</p>";
  } else {
      echo "<p style='color: #ff0000;'>Error updating name: " . $conn->error . "</p>";
  }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["no"]) && isset($_POST["name"]) && isset($_POST["price"]) && isset($_POST["weight"]) && isset($_POST["made"])) {
    $no = $_POST["no"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $weight = $_POST["weight"];
    $made = $_POST["made"];

    // Check if the no already exists in the table
    $checkNoSql = "SELECT * FROM device WHERE no = '$no'";
    $checkNoResult = $conn->query($checkNoSql);

    if ($checkNoResult->num_rows > 0) {
        echo "<p style='color: #ff0000;'>Error: Number (Number) already exists</p>";
    } else {
        // Insert data into the "device" table
        $insertSql = "INSERT INTO device (no, name, price, weight, made) VALUES ('$no', '$name', '$price', '$weight', '$made')";
        if ($conn->query($insertSql) === TRUE) {
            echo "<p style='color: #008000;'>New record created successfully</p>";
        } else {
            echo "<p style='color: #ff0000;'>Error: " . $conn->error . "</p>";
        }
    }
}

$sqlAddresses = "SELECT * FROM manufacture";
$resultAddresses = $conn->query($sqlAddresses);

$sqlAddressess = "SELECT * FROM manufacture";
$resultAddressess = $conn->query($sqlAddressess);

$sqlid = "SELECT no FROM device";
$resultid = $conn->query($sqlid);

$sql = "SELECT * FROM device";
$result = $conn->query($sql);

echo "<h1 style='color: #051530; text-align: center;'>The Device Table</h1>";

echo "<table style='border-collapse: collapse; width: 100%; margin-top: 20px;'>";
echo "<tr style='background-color: ##007BFF; color: #ffffff; text-align: left;'>";
echo "<th style='padding: 15px; '>No</th><th style='padding: 15px;'>Name</th><th style='padding: 15px;'>Price</th><th style='padding: 15px;'>Weight</th><th style='padding: 15px;'>Made</th>";
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
<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Device</title>
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
            max-width: 500px;
            margin: 20px auto;
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
        @media screen and (max-width: 500px) {
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
        <h2 style="color: #051530;">Insert New device</h2>
        <div class="form-group">
        <label for="no" style="color: #051530; font-weight: bold;"  >no:</label>
        <input type="number" name="no" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 60px;width:100%;">
        
        <label for="name" style="color: #051530; font-weight: bold;"> Name:</label>
        <input type="text" name="name" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
    </div>
    <div class="form-group">
        <label for="price" style="color: #051530; font-weight: bold;">Price:</label>
        <input type="text" name="price" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="weight" style="color: #051530; font-weight: bold;">Weight:</label>
        <input type="text" name="weight" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
       
    </div>
    <div class="form-group">
        <label for="made" style="color: #051530; font-weight: bold;">Made :</label>
        <select name="made" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <?php
            // Populate the dropdown with existing addresses
            while ($row = $resultAddresses->fetch_assoc()) {
                echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
            }
            ?>
        </select>

   
        
        <input type="submit" value="Insert" style="margin: 10px;
            padding: 12.5px 30px;
            border: 0;
            border-radius: 100px;
            background-color: #007BFF;
            color: #ffffff;
            font-weight: bold;">
            </div>
    </form>

    <form method="post" style="margin-top: 20px;">
    <h2 style="color: #051530;">Update On device </h2>
    <div class="form-group">
    <label for="update_no" style="color: #051530; font-weight: bold;"  >no:</label>
         <select name="update_no" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <?php
            // Populate the dropdown with existing addresses
            while ($row = $resultid->fetch_assoc()) {
                echo "<option value='" . $row["no"] . "'>" . $row["no"] . "</option>";
            }
            ?>
        </select>
        
        <label for="name" style="color: #051530; font-weight: bold;"> Name:</label>
        <input type="text" name="name" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        </div>
        <div class="form-group">
        <label for="price" style="color: #051530; font-weight: bold;">Price:</label>
        <input type="text" name="price" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="weight" style="color: #051530; font-weight: bold;">Weight:</label>
        <input type="text" name="weight" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        </div>
        <div class="form-group">

        <label for="made" style="color: #051530; font-weight: bold;">Made :</label>
        <select name="made" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <?php
            // Populate the dropdown with existing addresses
            while ($row = $resultAddressess->fetch_assoc()) {
                echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
            }
            ?>
        </select>
    
    

    <input type="submit" value="Update" style="margin: 10px;
        padding: 12.5px 30px;
        border: 0;
        border-radius: 100px;
        background-color: #007BFF;
        color: #ffffff;
        font-weight: bold;">
        </div>
</form>
</div>
    <label for="device number"  style="color: #051530; font-weight: bold;">device number:</label>
    <input type="number" id="deviceNo" name="deviceNo" style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;width:30%">
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
                $.post("Searchdevice.php", {
                    NO: $("#deviceNo").val()
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
