<?php 
  session_start();

  if(!isset($_SESSION["name"])) {
    header("location: login.php");
    exit;
  } else {
    echo $_SESSION["name"];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>FODAAAA</h1>
  <button>
    <a href="logout.php">
      AAAAAAAAAAAAAAAAAA
    </a>
  </button>
</body>
</html>