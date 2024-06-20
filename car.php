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

// Handle form submission for name update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_name"])) {
    $oldName = $_POST["update_name"];
    $model = $_POST["model"];
    $year = $_POST["year"];
    $made = $_POST["made"];

    // Validate and sanitize input if needed

    // Update only the "name" field in the "car" table
    $updateSql = "UPDATE car SET name='$oldName', model='$model', year='$year', made='$made' WHERE name='$oldName'";
    if ($conn->query($updateSql) === TRUE) {
        echo "<p style='color: #008000;'> updated successfully</p>";
    } else {
        echo "<p style='color: #ff0000;'>Error updating name: " . $conn->error . "</p>";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"]) && isset($_POST["model"]) && isset($_POST["year"]) && isset($_POST["made"])) {
    $name = $_POST["name"];
    $model = $_POST["model"];
    $year = $_POST["year"];
    $made = $_POST["made"];

    // Check if the name already exists in the table
    $checkNameSql = "SELECT * FROM car WHERE name = '$name'";
    $checkNameResult = $conn->query($checkNameSql);

    if ($checkNameResult->num_rows > 0) {
        echo "<p style='color: #ff0000;'>Error: Name already exists</p>";
    } else {
        // Insert data into the "car" table
        $insertSql = "INSERT INTO car (name, model, year, made) VALUES ('$name', '$model', '$year', '$made')";
        if ($conn->query($insertSql) === TRUE) {
            echo "<p style='color: #008000;'>New record created successfully</p>";
        } else {
            echo "<p style='color: #ff0000;'>Error: " . $conn->error . "</p>";
        }
    }
}


// Fetch existing car names for the combo box
$sqlNames = "SELECT name FROM car";
$resultNames = $conn->query($sqlNames);

$sql = "SELECT * FROM car";
$result = $conn->query($sql);

echo "<h1 style='color: #051530; text-align: center;'>The Cars Table</h1>";

echo "<table style='border-collapse: collapse;  margin-top: 20px; width: 100%;'>";
echo "<tr style='background-color: #62516D; color: #ffffff; '>";
echo "<th style='padding: 15px;'>Name</th><th style='padding: 15px;'>Model</th><th style='padding: 15px;'>Year</th><th style='padding: 15px;'>Made</th>";
echo "</tr>";

if ($result->num_rows > 0) {
    // output data of each row
    $rowCounter = 0;
    while ($row = $result->fetch_assoc()) {
        $rowStyle = $rowCounter % 2 == 0 ? 'background-color: #f2f2f2;' : 'background-color: #ffffff;';
        echo "<tr style='$rowStyle'>";
        echo "<td style='padding: 10px;text-align: center;'>" . $row["name"] . "</td><td style='padding: 10px; text-align: center;'>" . $row["model"] . "</td><td style='padding: 10px;text-align: center;'>" . $row["year"] . "</td><td style='padding: 10px;text-align: center;'>" . $row["made"] . "</td>";
        echo "</tr>";
        $rowCounter++;
    }
    echo "</table>";
} else {
    echo "<p style='color: #ff0000;'>0 results</p>";
}

?>
<div class="forms-container">
<!-- Insert form with styled labels and text fields -->
<form method="post" style="margin-top: 20px;" class="form-horizontal">
    <h2 style="color: #051530;">Insert New Car</h2>
    <div class="form-group">
    <label for="name" style="color: #051530; font-weight: bold;">Name:</label>
    <input type="text" name="name" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
    
    <label for="model" style="color: #051530; font-weight: bold;">Model:</label>
    <input type="text" name="model" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
</div>
<div class="form-group">
    <label for="year" style="color: #051530; font-weight: bold;">Year:</label>
    <input type="text" name="year" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
    <label for="made" style="color: #051530; font-weight: bold;">Made :</label>
    <select name="made" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        <?php
        $sqlNamess = "SELECT name FROM manufacture";
        $resultNamess = $conn->query($sqlNamess);
        // Populate the combo box with existing car names
        while ($row = $resultNamess->fetch_assoc()) {
            echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
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
        font-weight: bold;
        width:30%">
</form>

<!-- Update form for name only with combo box -->
<form method="post" style="margin-top: 20px; " class="form-horizontal">
    <h2 style="color: #051530;">Update On Car </h2>
    <div class="form-group">
    <label for="update_name" style="color: #051530; font-weight: bold;">Name:</label>
    <select name="update_name" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        <?php
        
        // Populate the combo box with existing car names
        while ($row = $resultNames->fetch_assoc()) {
            echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
        }
        ?>
    </select>
    
    <label for="model" style="color: #051530; font-weight: bold;">Model:</label>
    <input type="text" name="model" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
    </div>
    <div class="form-group">
    <label for="year" style="color: #051530; font-weight: bold;">Year:</label>
    <input type="text" name="year" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
    <label for="made" style="color: #051530; font-weight: bold;">Made :</label>
    <select name="made" required style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        <?php
        $sqlNamess = "SELECT name FROM manufacture";
        $resultNamess = $conn->query($sqlNamess);
        // Populate the combo box with existing car names
        while ($row = $resultNamess->fetch_assoc()) {
            echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
        }
        ?>
    </select>
   
    </div>
    <input type="submit" value="Update" style="margin: 10px;
        padding: 12.5px 30px;
        border: 0;
        border-radius: 100px;
        background-color:#007BFF;
        color: #ffffff;
        font-weight: bold;
        width:30%">
</form>
</div>
<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Car</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>

         body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h1, h2 {
            color: #333;
            text-align: center;
        }

        table {
            width: 70%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #007BFF;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #f5f5f5;
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
            color: #555;
            font-weight: 500;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            
            font-size: 12px;
        }

        input[type="submit"],
        button {
            display: block;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 4px;
            background-color: #007BFF;
            color: #fff;
           
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover,
        button:hover {
            background-color: #005bb5;
        }

        #result {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .forms-container {
        display: flex;
        justify-content: space-between; /* Adds space between the forms */
    }

    .forms-container form {
        flex: 1; /* Each form takes half of the container's width */
        margin-right: 120px; 
        /* Adds space between the forms */
        max-width: 300px; 
        
    }
    .forms-container form input[type="text"],
    .forms-container form select {
        width: 100%; /* Make the input and select fields span the full width of the form */
        padding: 6px; /* Reduce padding for a smaller height */
        font-size: 12px; /* Reduce font size for a smaller appearance */
        height: 20px;
    }
    #carName {
        padding: 8px; /* Reduce padding for a smaller appearance */
        font-size: 10px; /* Reduce font size for a smaller appearance */
        /* Set a smaller height for the input field */
        width: 400px; 
    }
    #b {
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

#b:hover {
    background-color: #17e346;
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

        @media screen and (max-width: 768px) {
            table {
                width: 100%;
            }

            form,
            #result {
                padding: 15px;
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
    

    <label for="carName"  style="color: #051530; font-weight: bold;">Car Name:</label>
    <input type="text" id="carName" name="carName" style="margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
    <button id="b" style="margin: 10px;
        padding: 12.5px 30px;
        border: 0;
        border-radius: 100px;
        background-color:  #007BFF;
        color: #ffffff;
        font-weight: bold;">Search</button>
   
    <div id="result"></div>
    <script>
        $(document).ready(function () {
            $("#b").click(function () {
                // Use $.post to send an AJAX POST request
                $.post("Searchcar.php", {
                    carName: $("#carName").val()
                }, function (data, status) {
                    // Handle the response from the server
                    console.log("Data: " + data + "\nStatus: " + status);
                    $("#result").html(data);
                });
            });
        });
    </script>

</body>

</html>
