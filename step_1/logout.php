<!DOCTYPE html>
<html>
  <head>
    <title>Un document HTML formel</title>
    <meta charset="UTF-8">
  </head>
  <body>
  <?php
    session_start();
    session_unset();
    setcookie('email', '', 1);
    header("Location: login.php");
  ?>
  </body>
</html>


