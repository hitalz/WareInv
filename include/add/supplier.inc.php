<?php
  session_start();
  include '../dbh.inc.php';

  if(!empty($_POST)) {
    $supplierName = mysqli_real_escape_string($conn,$_POST['supplierName']);
    $supplierAddress = mysqli_real_escape_string($conn,$_POST['supplierAddress']);
    $supplierCity = mysqli_real_escape_string($conn,$_POST['supplierCity']);
    $supplierState = mysqli_real_escape_string($conn,$_POST['supplierState']);
    $supplierZip = mysqli_real_escape_string($conn, $_POST['supplierZip']);
    $supplierCountry = mysqli_real_escape_string($conn,$_POST['supplierCountry']);

    $addSupplierQuery = "
    INSERT INTO supplier (supplier_name, supplier_address, supplier_city, state_id, supplier_zip, country_id)
    VALUES ('$supplierName', '$supplierAddress', '$supplierCity', '$supplierState', '$supplierZip', '$supplierCountry')
    ";

    $runSupplierQuery = mysqli_query($conn, $addSupplierQuery);
  }
?>
