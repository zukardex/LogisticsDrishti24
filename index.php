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
    background-color: rgb(33, 150, 243, 0.5);
  }
  .container {
    margin-top: 50px;
    text-align: center;
  }
  h1 {
    color: #000;
    text-shadow: 0 0 10px rgba(33, 150, 243, 0.5);
  }
  .btn-container {
    margin-top: 50px;
  }
  .btn {
    font-size: 20px;
    margin: 10px;
    padding: 15px 30px;
    border-radius: 10px;
  }
  .btn-register {
    background-color: #2196F3;
    border: none;
    color: white;
  }
  .btn-register:hover {
    background-color: #1976D2;
  }
  .btn-search {
    background-color: rgba(0, 0, 0, 0.8);
    border: none;
    color: white;
  }
  .btn-search:hover {
    background-color: rgba(0, 0, 0, 0.6);
  }
</style>
</head>
<body>

<div class="container">
  <h1>DRISHTI'24 LOGISTIC MANAGEMENT</h1>
  
  <div class="btn-container">
    <a href="register.php?id=<?php echo (isset($_GET['id']))?($_GET['id']):''; ?>" class="btn btn-register">Register an Object</a>
    <a href="search.php?id=<?php echo (isset($_GET['id']))?($_GET['id']):''; ?>" class="btn btn-search">Search an Object</a>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
include 'config.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$id = $_POST['id'];
$itemName = $_POST['itemName'];
$dept = $_POST['dept'];
$floor = $_POST['floor'];
$roomNumber = $_POST['roomNumber'];
$volunteer = $_POST['volunteer'];
$volunteerContact = $_POST['volunteerContact'];

$stmt = $conn->prepare("SELECT * FROM register WHERE id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  echo "<script>alert('Please use another QR Code. The QR code you submitted is already registered.');</script>";
} else {
  $stmt = $conn->prepare("INSERT INTO register (id, itemName, dept, floor, roomNumber, volunteer, volunteerContact) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssss", $id, $itemName, $dept, $floor, $roomNumber, $volunteer, $volunteerContact);
  
  if ($stmt->execute()) {
    echo "<script>alert('QR Code Registered successfully');</script>";
  } else {
    echo "Error: " . $stmt->error;
    
    echo "<script>alert('"."Error: " .$stmt->error."');</script>";
  }
}

$stmt->close();
$conn->close();




if(isset($_COOKIE['volunteer'] ) && isset($_COOKIE['volunteerContact'] ) ){
    echo '<script>
                    document.getElementById("'.'volunteer'.'").value = "'.$_COOKIE['volunteer'].'";
                    document.getElementById("'.'volunteerContact'.'").value = "'.$_COOKIE['volunteerContact'].'";
                </script>
                ';
}else{
    if(isset($_POST['volunteer']) && isset($_POST['volunteerContact']))
    {
        setcookie('volunteer', $_POST['volunteer'], time() + (86400 * 30), "/");
        setcookie('volunteerContact', $_POST['volunteerContact'], time() + (86400 * 30), "/");
    }
}
?>
