<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DRISHTI'24 LOGISTICS MANAGEMENT</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    padding: 20px;
  }

  h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
  }

  form {
    max-width: 400px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  }

  label {
    display: block;
    margin-bottom: 5px;
    color: #555;
  }

  input[type="text"] {
    width: calc(100% - 10px);
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
  }

  input[type="submit"] {
    width: 100%;
    padding: 10px;
    border: none;
    background-color: #007bff;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
  }

  input[type="submit"]:hover {
    background-color: #0056b3;
  }
</style>
</head>
<body>
<h1>Register an item</h1>
<form action="index.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" method="POST">
  <label for="itemName">Item Name:</label>
  <input type="text" id="itemName" name="itemName" value="Desk" required>
  
  <label for="dept">Department:</label>
  <input type="text" id="dept" name="dept" required>
  
  <label for="floor">Floor:</label>
  <input type="text" id="floor" name="floor" required>
  
  <label for="roomNumber">Room Number:</label>
  <input type="text" id="roomNumber" name="roomNumber" required>
  
  <label for="volunteer">Your name:</label>
  <input type="text" id="volunteer" name="volunteer" required>

  <label for="volunteerContact">Your phone:</label>
  <input type="text" id="volunteerContact" name="volunteerContact" required>
  
  <input type="hidden" name="id" id="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
  
  <input type="submit" value="Submit" id="submitButton">
</form>
</body>
</html>

<?php
// Database connection
include 'config.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$id = $_GET['id'];

// Check if ID exists
$stmt = $conn->prepare("SELECT * FROM register WHERE id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();


 

if ($result->num_rows > 0) {

    //ID Already registered.
    echo '
        <script>
        alert("This QR Code is already in use.");
                document.getElementById("submitButton").disabled = true;
        </script>
        <style>
                body {
                    background-color: red; /* Set the background color to red */
                }
        </style>
    
    ';

    while ($row = $result->fetch_assoc()) {
      foreach ($row as $key => $value) {
          echo '<script>
                    document.getElementById("'.$key.'").value = "'.$value.'";
                </script>
                ';
      }
}
}else{



//Default loading of phone number and name

if(isset($_COOKIE['volunteer'] ) && isset($_COOKIE['volunteerContact'] ) ){
    echo '<script>
                    document.getElementById("'.'volunteer'.'").value = "'.$_COOKIE['volunteer'].'";
                    document.getElementById("'.'volunteerContact'.'").value = "'.$_COOKIE['volunteerContact'].'";
                </script>
                ';
}else{

    if(isset($_POST['volunteer'])&& isset($_POST['volunteerContact']))
   {     setcookie('volunteer', $_POST['volunteer'], time() + (86400 * 30), "/");
        setcookie('volunteerContact', $_POST['volunteerContact'], time() + (86400 * 30), "/");}
}
}
?>