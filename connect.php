<?php
  define("hostname", "localhost");
  define("username", "root");
  define("password", "");
  define("database", "trocar_password");

  $conn = mysqli_connect(hostname, username, password, database);

  if(!$conn) {
    die("Não foi possivel conectar, ". mysqli_connect_error());
  }

?>