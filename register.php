<?php

  require('connect.php');

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confPassword = trim($_POST["confPassword"]);

    if($password != $confPassword || !$username || !$email || !$password) {
      echo "<script>alert('senhas incorretas')</script>";
    } else {
      $password = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO users(name, email, password) VALUES('$username', '$email', '$password')";
      mysqli_query($conn, $sql) || die("Não foi possivel inserir no bando");
      header("location: login.php");
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/log_layout.css">
  <title>Document</title>
</head>
<body>
  <form  action="" method="post" class="container" >
    <div class="card">
    <div class="title">
      <h2>REGISTER</h2>
    </div>
      <div class="input">
        <input type="text" name="name" placeholder="nome">
      </div>
      <div class="input">
        <input type="email" name="email" placeholder="email">
      </div>
      <div class="input">
        <input type="password" name="password" placeholder="senha">
      </div>
      <div class="input">
        <input type="password" name="confPassword" placeholder="confirmar senha">
      </div>
      <div class="button">
        <button type="submit">Enviar</button>
      </div>
    </div>
  </form>
  </div>
</body>
</html>