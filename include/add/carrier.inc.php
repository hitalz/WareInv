<?php
  session_start();
  include '../dbh.inc.php';

  if(!empty($_POST)) {
    $carrierName = mysqli_real_escape_string($conn,$_POST['carrierName']);
    $carrierAddress = mysqli_real_escape_string($conn,$_POST['carrierAddress']);
    $carrierCity = mysqli_real_escape_string($conn,$_POST['carrierCity']);
    $carrierState = mysqli_real_escape_string($conn,$_POST['carrierState']);
    $carrierZip = mysqli_real_escape_string($conn, $_POST['carrierZip']);
    $carrierCountry = mysqli_real_escape_string($conn,$_POST['carrierCountry']);

    $addCarrierQuery = "
    INSERT INTO carrier (carrier_name, carrier_address, carrier_city, state_id, carrier_zip, country_id)
    VALUES ('$carrierName', '$carrierAddress', '$carrierCity', '$carrierState', '$carrierZip', '$carrierCountry')
    ";

    $runCarrierQuery = mysqli_query($conn, $addCarrierQuery);
  }
?>
