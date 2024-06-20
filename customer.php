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

if ($conn->connect_error) {
    die("Connection failed:" . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_id"])) {
  $id = $_POST["update_id"];
  $f_name = $_POST["f_name"];
    $l_name = $_POST["l_name"];
    $address = $_POST["address"];
    $job = $_POST["job"];

  // Validate and sanitize input if needed

  // Update only the "name" field in the "car" table
  $updateSql = "UPDATE customer SET id='$id',f_name=' $f_name',l_name='$l_name',address='$address', job=' $job' WHERE id='$id'";
  if ($conn->query($updateSql) === TRUE) {
      echo "<p style='color: #008000;'>updated successfully</p>";
  } else {
      echo "<p style='color: #ff0000;'>Error updating name: " . $conn->error . "</p>";
  }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["f_name"]) && isset($_POST["l_name"]) && isset($_POST["address"]) && isset($_POST["job"])) {
    $id = $_POST["id"];
    $f_name = $_POST["f_name"];
    $l_name = $_POST["l_name"];
    $address = $_POST["address"];
    $job = $_POST["job"];

    // Check if the id already exists in the table
    $checkIdSql = "SELECT * FROM customer WHERE id = '$id'";
    $checkIdResult = $conn->query($checkIdSql);

    if ($checkIdResult->num_rows > 0) {
        echo "<p style='color: #ff0000;'>Error: ID already exists</p>";
    } else {
        // Insert data into the "customer" table
        $insertSql = "INSERT INTO customer (id, f_name, l_name, address, job) VALUES ('$id', '$f_name', '$l_name', '$address', '$job')";
        if ($conn->query($insertSql) === TRUE) {
            echo "<p style='color: #008000;'>New record created successfully</p>";
        } else {
            echo "<p style='color: #ff0000;'>Error: " . $conn->error . "</p>";
        }
    }
}

$sqlid = "SELECT id FROM customer";
$resultid = $conn->query($sqlid);
// Fetch addresses for the dropdown
$sqlAddresses = "SELECT * FROM address";
$resultAddresses = $conn->query($sqlAddresses);

$sqlAddressess = "SELECT * FROM address";
$resultAddressess = $conn->query($sqlAddressess);
// Fetch customers for the table
$sql = "SELECT * FROM customer";
$result = $conn->query($sql);

echo "<h1 style='color: #051530; text-align: center;'>The Customer Table</h1>";

echo "<table style='border-collapse: collapse; width: 100%; margin-top: 20px;'>";
echo "<tr style='background-color: #007BFF; color: #ffffff; text-align: left;'>";
echo "<th style='padding: 15px; '>Id</th><th style='padding: 15px;'>F_name</th><th style='padding: 15px;'>L_name</th><th style='padding: 15px;'>Address</th><th style='padding: 15px;;'>Job</th>";
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

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customer</title>
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
        @media (max-width: 600px) {
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
        <h2 style="color: #051530;">Insert New Customer</h2>
        <div class="form-group">
        <label for="id" style="color: #051530; font-weight: bold;"  >id:</label>
        <input type="number" name="id" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 100%;">
        
        <label for="f_name" style="color: #051530; font-weight: bold;">First Name:</label>
        <input type="text" name="f_name" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
    </div>
    <div class="form-group">
        <label for="l_name" style="color: #051530; font-weight: bold;">Last Name:</label>
        <input type="text" name="l_name" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="address" style="color: #051530; font-weight: bold;">Address:</label>
        <select name="address" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <?php
            // Populate the dropdown with existing addresses
            while ($row = $resultAddresses->fetch_assoc()) {
                echo "<option value='" . $row["id"] . "'>" . $row["id"] . "</option>";
            }
            ?>
        </select>
        </div>
        <div class="form-group">
        <label for="job" style="color: #051530; font-weight: bold;">Job:</label>
        <input type="text" name="job" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        
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
    <h2 style="color: #051530;">Update On customer </h2>
    <div class="form-group">
    <label for="update_id" style="color: #051530; font-weight: bold;"  >id:</label>
    <select name="update_id" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <?php
            // Populate the dropdown with existing addresses
            while ($row = $resultid->fetch_assoc()) {
                echo "<option value='" . $row["id"] . "'>" . $row["id"] . "</option>";
            }
            ?>
        </select>
        
        <label for="f_name" style="color: #051530; font-weight: bold;"> First Name:</label>
        <input type="text" name="f_name" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        </div>
        <div class="form-group">
        <label for="l_name" style="color: #051530; font-weight: bold;">Last Name:</label>
        <input type="text" name="l_name" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="address" style="color: #051530; font-weight: bold;">Address:</label>
        <select name="address" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <?php
            // Populate the dropdown with existing addresses
            while ($row = $resultAddressess->fetch_assoc()) {
                echo "<option value='" . $row["id"] . "'>" . $row["id"] . "</option>";
            }
            ?>
        </select>
        </div>
        <div class="form-group">
        <label for="job" style="color: #051530; font-weight: bold;">Job:</label>
        <input type="text" name="job" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
    
    

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
    <label for="customerId"  style="color: #051530; font-weight: bold;">Customer ID:</label>
    <input type="number" id="customerId" name="customerId" style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;width:30%">
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
                $.post("searchcustomer.php", {
                    ID: $("#customerId").val()
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
