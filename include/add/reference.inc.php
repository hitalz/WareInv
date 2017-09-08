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

    // $runReferenceQuery = mysqli_query($conn, $addReferenceQuery);
    if(mysqli_query($conn, $addReferenceQuery)) {
      $customerQuery = "
      SELECT *
      FROM reference, customer, supplier, carrier, package
      WHERE reference.customer_id = customer.customer_id AND reference.supplier_id = supplier.supplier_id AND reference.carrier_id = carrier.carrier_id AND reference.package_id = package.package_id
      ORDER BY reference.reference_id
      ";
      $runCustomersQuery = mysqli_query($conn, $customerQuery);
      $output .= '
      <table class="table table-striped">
        <thead>
          <tr>
          <th>Reference #</th>
          <th>Customer</th>
          <th>Supplier</th>
          <th>Arrival Date</th>
          <th>Arrival Time</th>
          <th>P.O.</th>
          <th>Carrier</th>
          <th>Tracking Number</th>
          <th>No. Packages</th>
          <th>Type</th>
          </tr>
        </thead>';
      while($row = mysqli_fetch_array($runCustomersQuery)) {
        $output .= '
        <tbody>
          <tr>
            <td>' . $row["reference_id"] . '</td>
            <td>' . $row["customer_name"] . '</td>
            <td>' . $row["supplier_name"] . '</td>
            <td>' . $row["arrival_date"] . '</td>
            <td>' . $row["arrival_time"] . '</td>
            <td>' . $row["purchase_order"] . '</td>
            <td>' . $row["carrier_name"] . '</td>
            <td>' . $row["tracking_number"] . '</td>
            <td>' . $row["package_quantity"] . '</td>
            <td>' . $row["package_type"] . '</td>
          </tr>
        </tbody>';
      }
      $output .= '
      </table>';
    }
  }
?>
