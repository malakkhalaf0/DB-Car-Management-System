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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_id"])) {
  $id = $_POST["update_id"];
  $date = $_POST["date"];
  $customer = $_POST["customer"];
  $car = $_POST["car"];

  
  $updateSql = "UPDATE orders SET id='$id', date='$date',customer='$customer ',car='$car' WHERE id='$id'";
  if ($conn->query($updateSql) === TRUE) {
      echo "<p style='color: #008000;'>updated successfully</p>";
  } else {
      echo "<p style='color: #ff0000;'>Error updating name: " . $conn->error . "</p>";
  }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["date"]) && isset($_POST["customer"]) && isset($_POST["car"])) {
  $id = $_POST["id"];
  $date = $_POST["date"];
  $customer = $_POST["customer"];
  $car = $_POST["car"];

  // Check if the id already exists in the table
  $checkIdSql = "SELECT * FROM orders WHERE id = '$id'";
  $checkIdResult = $conn->query($checkIdSql);

  if ($checkIdResult->num_rows > 0) {
      echo "<p style='color: #ff0000;'>Error: Id already exists</p>";
  } else {
      // Insert data into the "orders" table
      $insertSql = "INSERT INTO orders (id, date, customer, car) VALUES ('$id', '$date', '$customer', '$car')";
      if ($conn->query($insertSql) === TRUE) {
          echo "<p style='color: #008000;'>New record created successfully</p>";
      } else {
          echo "<p style='color: #ff0000;'>Error: " . $conn->error . "</p>";
      }
  }
}


$sqlid = "SELECT id FROM orders";
$resultid = $conn->query($sqlid);
// Fetch cares for the dropdown
$sqlcustomer = "SELECT * FROM customer";
$resultcustomer = $conn->query($sqlcustomer);

$sqlcustomerr = "SELECT * FROM customer";
$resultcustomerr = $conn->query($sqlcustomerr);

$sqlcar = "SELECT * FROM car";
$resultcar = $conn->query($sqlcar);

$sqlcarr = "SELECT * FROM car";
$resultcarr = $conn->query($sqlcarr);

$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

echo "<h1 style='color: #051530; text-align: center;'>The Orders Table</h1>";

echo "<table style='border-collapse: collapse; width: 100%; margin-top: 20px;'>";
echo "<tr style='background-color: #007BFF; color: #ffffff;'>";
echo "<th style='padding: 15px; '>Id</th><th style='padding: 15px; '>Date</th><th style='padding: 15px; '>Customer</th><th style='padding: 15px;'>Car</th>";
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
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 20px;
    background-color: #f4f4f4;
}

.container {
    max-width: 1400px;
    margin: auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

h1, h2 {
    color: #333;
    text-align: center;
}
.forms-container {
            display: flex;
            justify-content: space-between;
            gap: 20px; /* Space between the forms */
        }

.form {
    flex: 1; /* Allows the forms to share the container width equally */
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
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

.search {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

#searchResult {
    margin-top: 20px;
}

#searchBtn {
    padding: 8px 20px;
    width: 400px;
    margin: 10px;
    padding: 12.5px 30px;
    border: 0;
    border-radius: 100px;
    background-color: #007BFF;
    color: #ffffff;
    font-weight: bold;
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
        @media screen and (max-width: 700px) {
    .forms-container {
        flex-direction: column; /* Stacks the forms vertically */
        align-items: center;    /* Centers the forms horizontally */
    }

    .forms-container form {
        width: 90%;             /* Makes the form take up 90% of the viewport width */
        margin: 10px 0;         /* Adds some vertical margin for spacing */
    }
}
   

    </style>
</head>

<body>
<div class="container">
<div class="forms-container">
    <form method="post" class="form" style="margin-top: 20px;">
        <h2 style="color: #051530;">Insert New Order</h2>
        <div class="form-group">
        <label for="id" style="color: #051530; font-weight: bold;"  >id:</label>
        <input type="number" name="id" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; ">
        
        <label for="date" style="color: #051530; font-weight: bold;">date:</label>
        <input type="date" name="date"class="btn" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        
    </div>
    <div class="form-group">
        <label for="customer" style="color: #051530; font-weight: bold;"> Customer:</label>
        <select name="customer" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <?php
            // Populate the dropdown with existing cares
            while ($row = $resultcustomer->fetch_assoc()) {
                echo "<option value='" . $row["id"] . "'>" . $row["id"] . "</option>";
            }
            ?>
        </select>

        <label for="car" style="color: #051530; font-weight: bold;">Car:</label>
        <select name="car" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <?php
            // Populate the dropdown with existing cares
            while ($row = $resultcar->fetch_assoc()) {
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
            font-weight: bold;
            ">
             </div>
    </form>

    <form method="post" class="form" style="margin-top: 20px;">
    <h2 style="color: #051530;">Update  on order </h2>
    <div class="form-group">
    <label for="update_id" style="color: #051530; font-weight: bold;"  >id:</label>
    <select name="update_id" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;;">
            <?php
            // Populate the dropdown with existing cares
            while ($row = $resultid->fetch_assoc()) {
                echo "<option value='" . $row["id"] . "'>" . $row["id"] . "</option>";
            }
            ?>
        </select>
        
        <label for="date" style="color: #051530; font-weight: bold;">date:</label>
        <input type="date" name="date"class="btn" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        
        </div>
        <div class="form-group">

        <label for="customer" style="color: #051530; font-weight: bold;"> Customer:</label>
        <select name="customer" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <?php
            // Populate the dropdown with existing cares
            while ($row = $resultcustomerr->fetch_assoc()) {
                echo "<option value='" . $row["id"] . "'>" . $row["id"] . "</option>";
            }
            ?>
        </select>

        <label for="car" style="color: #051530; font-weight: bold;">Car:</label>
        <select name="car" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <?php
            // Populate the dropdown with existing cares
            while ($row = $resultcarr->fetch_assoc()) {
                echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
            }
            ?>
        </select>
    
   

    <input type="submit" value="Update " style="margin: 10px;
        padding: 12.5px 30px;
        border: 0;
        border-radius: 100px;
        background-color: #007BFF;
        color: #ffffff;
        font-weight: bold;">
        </div>
</form>
</div>
<div class="search">
    <label for="id"  style="color: #051530; font-weight: bold;"> ID:</label>
    <input type="number" id="id" name="customerId" class="input" style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
    <button id="searchBtn" class="btn" style="margin: 10px;
        padding: 12.5px 30px;
        border: 0;
        border-radius: 100px;
        background-color: #007BFF;
        color: #ffffff;
        font-weight: bold;
       ">Search</button>
    <div id="searchResult"></div>
    </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#searchBtn").click(function () {
                // Use $.post to send an AJAX POST request
                $.post("searchorders.php", {
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
