<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Error</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/login/main.css" rel="stylesheet">
  </head>
  <body>

    <div class="container">
      <form class="form-error" >
        <h2 class="form-error-heading">
          <?php
            if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ):
              echo $_SESSION['message'];
            else:
              header("Location: index.php" );
            endif;
          ?>
        </h2>
        <hr>
        <a href="index.php" class="btn btn-lg btn-primary btn-block">Go back</a>
    </div>
  </body>
</html>
