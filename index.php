<?php
  require 'includes/dbh.inc.php';
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Warehouse Inventory</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/login/main.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="includes/login.inc.php" method="post" autocomplete="off">
        <h2 class="form-signin-heading">Warehouse Inventory</h2>
        <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Username" autofocus>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
        <button name"login" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->


  </body>
</html>
