<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'lib/vendor/autoload.php';
require './connect.php';

$mail = new PHPMailer(true);

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
  $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

  if (!empty($data['email'])) {
    $email = trim($data['email']);
    $sql = "SELECT id, email, name FROM users WHERE email = '$email' LIMIT 1";

    $query = mysqli_query($conn, $sql);

    if (($query) && (mysqli_num_rows($query) !== 0)) {
      $row_user = mysqli_fetch_array($query);
      $id = $row_user['id'];
      $key_recover_password = password_hash($id, PASSWORD_DEFAULT);


      $sql_up_recover_key = "UPDATE users SET recover_key = '$key_recover_password' WHERE id = '$id'";
      $up_recover_key = mysqli_query($conn, $sql_up_recover_key);

      if ($up_recover_key) {
        $link = "http://localhost/PHPprojects/alterPasswordMysqli/update_password.php?key=$key_recover_password";

        try {
          // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
          $mail->CharSet = 'UTF-8';
          $mail->isSMTP();
          $mail->Host       = 'smtp.gmail.com';
          $mail->SMTPAuth   = true;
          $mail->Username   = 'luizgsiewerdt@gmail.com';
          $mail->Password   = 'lzourxbrakplikbh';
          $mail->SMTPSecure = "ssl";
          $mail->Port       = 465;

          $mail->setFrom('luizgsiewerdt@gmail.com', 'email do luiz');
          $mail->addAddress($row_user['email'], $row_user['name']);

          $mail->isHTML(true);                                  //Set email format to HTML
          $mail->Subject = 'Recuperar senha';
          $mail->Body    = 'Prezado(a) ' . $row_user['name'] . ".<br><br>Você solicitou alteração de senha.<br><br>Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: <br><br><a href='" . $link . "'>" . $link . "</a><br><br>Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.<br><br>";
          $mail->AltBody = 'Prezado(a) ' . $row_user['name'] . "\n\nVocê solicitou alteração de senha.\n\nPara continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: \n\n" . $link . "\n\nSe você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.\n\n";

          $mail->send();
          header("Location: login.php");
        } catch (PDOException $e) {
          echo "Erro: E-mail não enviado sucesso. Mailer Error: {$mail->ErrorInfo}";
        }
      }
    }
  }
  ?>
  <form action="" method="post" class="container">
    <div class="card" style="height: 320px; margin-top: 20vh">
      <div class="title">
        <h2>Recuperar senha</h2>
      </div>
      <div class="input">
        <input type="email" name="email" placeholder="coloque seu email...">
      </div>
      <div class="button">
        <button type="submit">Enviar</button>
      </div>
    </div>
  </form>
  </div>
</body>

</html>