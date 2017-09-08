<?php
  session_start();
  include '../dbh.inc.php';

  if(!empty($_POST)) {
    $output = '';
    $customerName = mysqli_real_escape_string($conn,$_POST['customerName']);
    $customerAddress = mysqli_real_escape_string($conn,$_POST['customerAddress']);
    $customerCity = mysqli_real_escape_string($conn,$_POST['customerCity']);
    $customerState = mysqli_real_escape_string($conn,$_POST['customerState']);
    $customerZip = mysqli_real_escape_string($conn, $_POST['customerZip']);
    $customerCountry = mysqli_real_escape_string($conn,$_POST['customerCountry']);

    $addCustomerQuery = "
    INSERT INTO customer (customer_name, customer_address, customer_city, state_id, customer_zip, country_id)
    VALUES ('$customerName', '$customerAddress', '$customerCity', '$customerState', '$customerZip', '$customerCountry')
    ";

    $runCustomerQuery = mysqli_query($conn, $addCustomerQuery);
  }
?>
