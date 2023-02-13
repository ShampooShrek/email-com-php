<?php
session_start();
require './connect.php';

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
  <?php
  $key = filter_input(INPUT_GET, 'key', FILTER_DEFAULT);

  if (!empty($key)) {
    $sql_result = "SELECT id, name, email FROM users WHERE recover_key = '$key'";
    $result_user = mysqli_query($conn, $sql_result);

    if (($result_user) && (mysqli_num_rows($result_user) !== 0)) {
      $row_user = mysqli_fetch_array($result_user);
      $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

      if (!empty($data["validate"])) {
        $hash_password = password_hash($data["password"], PASSWORD_DEFAULT);
        $recover_key = "NULL";
        $id = $row_user['id'];

        $sql_update_password = "UPDATE users SET password = '$hash_password', recover_key = '$recover_key'
            WHERE id = '$id' LIMIT 1";

        $update_password = mysqli_query($conn, $sql_update_password) or die("não foi possivel fazer o nmegocio");

        if ($update_password) {
          header("location: login.php");
        } else {
          echo "<p style='color: #ff0000'>Erro: Tente novamente!</p>";
        }
      } else {
        echo "validar n foi";
      }
    } else{
      echo "sem key";
    }
  }
  ?>
  <form action="" method="post" class="container">
    <div class="card" style="height: 320px; margin-top: 20vh">
      <div class="title">
        <h2>Atualizar senha</h2>
      </div>
      <div class="input">
        <input type="password" name="password" placeholder="nova senha...">
      </div>
      <div class="input">
        <input type="password" name="confPassword" placeholder="confirmar senha...">
      </div>
      <div class="button">
        <input name="validate" value="require" type="submit">
      </div>
    </div>
  </form>
  </div>
</body>

</html>