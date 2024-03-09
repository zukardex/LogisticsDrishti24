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

// Check if ID exists
$stmt = $conn->prepare("SELECT * FROM register WHERE id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // ID already exists, show alert
  echo "<script>alert('Please use another QR Code. The QR code you submitted is already registered.');</script>";
} else {
  // ID does not exist, insert data into database
  $stmt = $conn->prepare("INSERT INTO register (id, itemName, dept, floor, roomNumber, volunteer) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $id, $itemName, $dept, $floor, $roomNumber, $volunteer);
  
  if ($stmt->execute()) {
    echo "<script>alert('Data inserted successfully');</script>";
  } else {
    echo "Error: " . $stmt->error;
  }
}

// Close connections
$stmt->close();
$conn->close();
?>
