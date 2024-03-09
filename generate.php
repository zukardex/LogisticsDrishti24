<?php
include 'config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DRISHTI LOGISTICS MANAGEMENT</title>
<style>
  body {
    font-family: Arial, sans-serif;
    text-align: center;
  }
  div{
    margin:10px;
  }
  #qrcode {
    margin-top: 20px;
    max-width: 90%;
    height: auto;
  }
  table {
    width: 100%;
  }
  td {
    text-align: center;
  }
</style>
</head>
<body>
<h1>DRISHTI'24 LOGISTICS MANAGEMENT</h1>
<div id="qrcode"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcode-generator/1.4.4/qrcode.min.js"></script>
<script>
function generateQR(inp) {
  var urlInput = inp;//document.getElementById(inp).value;
  var qrDiv = document.getElementById(inp);

  qrDiv.innerHTML = '';

  var qr = qrcode(10, 'L');
  qr.addData('<?php echo $indexPage; ?>?id='+urlInput);
  qr.make();
  qrDiv.innerHTML = qr.createImgTag(4, 0) + '<br><center>' +inp + '</center>';
}
</script>
<center>
<table border="2">
    <tr>
    <?php
    $count = 0;
    for ($i = ((isset($_GET['min'])?(int)$_GET['min']:0)); $i < ((isset($_GET['max'])?(int)$_GET['max']:100)); $i++) {
        // Generate URL based on the pattern
        $urlInput = '0' . dechex($i). '0';
        echo  '<td><div id="'.$urlInput.'"></div></td>';
        echo '<script>generateQR("'.$urlInput.'");</script>';
        $count++;
        if ($count == (isset($_GET['nos']) ? $_GET['nos']: 100) ){
            echo "</tr><tr>";
            $count = 0;
        }
    }
    ?>
    </tr>
</table>
</center>
</body>
</html>
