<?php
  require 'includes/dbh.inc.php';
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Warehouse Inventory</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap -->
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Stylesheet -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="includes/login.inc.php" method="post" autocomplete="off">
        <h2 class="form-signin-heading">Warehouse Inventory</h2>
        <hr>
        <input type="email" name="username" id="inputEmail" class="form-control" placeholder="Username" autofocus>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
        <button name"login" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
  </body>
</html>
