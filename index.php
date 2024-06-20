<?php
session_start();
if(isset($_SESSION['username'])){
    
}else{
    header('Location: loginView.html');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>car database </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            background-color: #f0e3d8;
        }
        #logout-link {
  --color: #0077ff;
  font-family: inherit;
  display: inline-block;
  width: 6em;
  height: 2.6em;
  line-height: 2.5em;
  overflow: hidden;
  cursor: pointer;
  margin: 20px;
  font-size: 17px;
  z-index: 1;
  color: var(--color);
  border: 2px solid var(--color);
  border-radius: 6px;
  position: relative;
  padding: 0 10px; /* Adjust padding if necessary */
  background-color: transparent; /* If you want the background to be transparent */
}

#logout-link::before {
  position: absolute;
  content: "";
  background: var(--color);
  width: 150px;
  height: 200px;
  z-index: -1;
  border-radius: 50%;
  transition: 0.3s all;
}

#logout-link:hover {
  color: white;
}

#logout-link::before {
  top: 100%;
  left: 100%;
}

#logout-link:hover::before {
  top: -30px;
  left: -30px;
}

        #header-container {
    display: flex;
 /* Stack items vertically */
    justify-content:  space-between; /* Center items vertically */
    align-items: center; /* Center items horizontally */
    padding: 20px;
}

      
        .grid-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .card-button {
            padding: 30px 50px;
            background-color: #f5f5f5;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #333;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            font-size: 18px;
            font-weight: 500;
            flex: 1;
            max-width: calc(50% - 20px); /* To ensure two buttons fit side by side with a gap */
            box-sizing: border-box;
            font-weight: bold; 
        }
        .card-button:hover {
    background-color: #007bff; /* Light blue background color */
    color: #1E3A55; /* Darkened text color for better contrast */
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional: Add a subtle shadow for a lifted effect */
}

        h1 {
    flex-grow: 1; /* This will allow the h1 element to take up any available space, pushing the logout button to the left */
    text-align: center;
    margin: 0;
    color: #007bff;
}
@media screen and (max-width: 500px) {
    .grid-container {
        flex-direction: column; /* Stack buttons vertically */
    }

    .card-button {
        max-width: 100%; /* Full width for buttons on smaller screens */
        margin-bottom: 10px; /* Space between buttons */
        font-size: 16px; /* Smaller font size for better readability on small screens */
        padding: 20px 30px; /* Adjust padding for smaller screens */
    }

    img {
        width: 100%; /* Make the image responsive on smaller screens */
        height: auto; /* Maintain aspect ratio */
    }
}

@media screen and (max-width: 300px) {
    .card-button {
        font-size: 14px; /* Even smaller font size for very small screens */
        padding: 15px 25px; /* Further adjust padding for very small screens */
    }
}
    </style>
</head>

<body>
    <div id="header-container">
        <button id="logout-link" onclick="redirectTo('logout.php')">Log Out</button>
        <h1>Welcome to our cars Database</h1>
    </div>

    <div class="grid-container">
        <button class="card-button" onclick="redirectTo('car.php')">Car</button>
        <button class="card-button" onclick="redirectTo('address.php')">Address</button>
        <button class="card-button" onclick="redirectTo('car_part.php')">Car Part</button>
        <button class="card-button" onclick="redirectTo('orders.php')">Orders</button>
        <button class="card-button" onclick="redirectTo('device.php')">Device</button>
        <button class="card-button" onclick="redirectTo('manufacture.php')">Manufacture</button>
        <button class="card-button" onclick="redirectTo('customer.php')">Customer</button>
        <img src="bmw1.jpg" alt=" Image" width="1000" height="500">
    </div>

    <script>
        function redirectTo(url) {
            window.location.href = url;
        }
    </script>
</body>

</html>
