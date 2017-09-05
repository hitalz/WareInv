<?php
  session_start();
  include 'dbh.inc.php';

  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";

  $result = $conn->query($sql);

  if (!$row = $result->fetch_assoc()) {
    $_SESSION['message'] = "Wrong username or password!";
    header("Location: ../error.php");
  } else {
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['first_name'] = $row['first_name'];
    $_SESSION['last_name'] = $row['last_name'];

    // This is how we'll know the user is logged in
    $_SESSION['logged_in'] = true;

    header("Location: ../dashboard/inventory.php");
  }
?>
