<?php

require('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST["email"]);
  $password = trim($_POST["password"]);

  if (!empty($email) && !empty($password)) {
    $sql = "SELECT id, name, email, password FROM users WHERE email = '$email'";
    $query_result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($query_result);

    if (($query_result) && (mysqli_num_rows($query_result) !== 0)) {
      $row_user = mysqli_fetch_array($query_result);
      $id = $row_user["id"];
      $name = $row_user["name"];
      $email = $row_user["email"];

      if (password_verify($password, $row_user["password"])) {
        session_start();
        $_SESSION["id"] = $id;
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        header("location: index.php");
        exit;
      } else {
        echo "<script>alert('senhas incorretas')</script>";
      }
    } else {
      echo "<script>alert('algo de errado n esta certo')</script>";
    }
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
  <form action="" method="post" class="container">
    <div class="card" style="height: 320px; margin-top: 20vh">
      <div class="title">
        <h2>LOGIN</h2>
      </div>
      <div class="input">
        <input type="email" name="email" placeholder="email">
      </div>
      <div class="input">
        <input type="password" name="password" placeholder="senha">
      </div>
      <div class="button">
        <button type="submit">Logar</button>
      </div>
      <div class="recover_password">
        <a href="./recover_password.php">
          Esqueceu a senha?
        </a>
      </div>
    </div>
  </form>
  </div>
</body>

</html>