<?php
  session_start();
  include '../dbh.inc.php';

  if(!empty($_POST)) {
    $output = '';
    $referenceCustomer = mysqli_real_escape_string($conn,$_POST['referenceCustomer']);
    $referenceSupplier = mysqli_real_escape_string($conn,$_POST['referenceSupplier']);
    $referenceArrivalDate = mysqli_real_escape_string($conn,$_POST['referenceArrivalDate']);
    $referenceArrivalTime = mysqli_real_escape_string($conn,$_POST['referenceArrivalTime']);
    $referenceCarrier = mysqli_real_escape_string($conn, $_POST['referenceCarrier']);
    $referencePurchaseOrder = mysqli_real_escape_string($conn,$_POST['referencePurchaseOrder']);
    $referenceTrackingNumber = mysqli_real_escape_string($conn,$_POST['referenceTrackingNumber']);
    $referencePackageQuantity = mysqli_real_escape_string($conn,$_POST['referencePackageQuantity']);
    $referencePackageType = mysqli_real_escape_string($conn,$_POST['referencePackageType']);
    $referenceDescription = mysqli_real_escape_string($conn,$_POST['referenceDescription']);

    $addReferenceQuery = "
    INSERT INTO reference (customer_id, supplier_id, arrival_date, arrival_time, carrier_id, purchase_order, tracking_number, package_quantity, package_id, description)
    VALUES ('$referenceCustomer', '$referenceSupplier', '$referenceArrivalDate', '$referenceArrivalTime', '$referenceCarrier', '$referencePurchaseOrder', '$referenceTrackingNumber', '$referencePackageQuantity', '$referencePackageType', '$referenceDescription')
    ";

    $runReferenceQuery = mysqli_query($conn, $addReferenceQuery);
  }
?>
