<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DRISHTI'24 LOGISTIC MANAGEMENT</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    padding: 20px;
    max-width: 100%;
    overflow-x: hidden;
  }
  b {
    color: #333;
  }
  /* Add media query for smaller screens */
  @media only screen and (max-width: 600px) {
    body {
      padding: 10px;
    }
  }
</style>
</head>
<body>
<div class="container">
  <h1 class="text-center">DRISHTI'24 LOGISTIC MANAGEMENT</h1>
  <hr>
  <?php
include 'config.php';

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Get ID from URL parameter
  $id = $_GET['id'];

  // Check if ID exists
  $stmt = $conn->prepare("SELECT * FROM register WHERE id = ?");
  $stmt->bind_param("s", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  // If no rows returned, print message
  if ($result->num_rows === 0) {
    echo "THE QR CODE YOU SEARCHED FOR IS NOT REGISTERED";
  } else {
    // Print all rows
    while ($row = $result->fetch_assoc()) {
      foreach ($row as $key => $value) {
        switch ($key) {
          case 'id':
            $keyy = $key;
            break;
          case 'itemName':
            $keyy = 'Item Name';
            break;
          case 'dept':
            $keyy = 'Department';
            break;
          case 'floor':
            $keyy = 'Floor';
            break;
          case 'roomNumber':
            $keyy = 'Room Number';
            break;
          case 'volunteer':
            $keyy = 'Added by';
            break;
        case 'volunteerContact':
            $keyy = 'Contact:';
            break;
          default:
                $keyy=$key;
        }
        echo '<b>' . $keyy . "</b>: " . $value . "<br>";
      }
      echo "<br>";
    }
  }

  // Close connections
  $stmt->close();
  $conn->close();
  ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
