<?php
  if (!isset($_SESSION)) {
    session_start();
  }
  include_once 'dbh.inc.php';

  if(!empty($_POST['customerName'])) {
    $customerName = mysqli_real_escape_string($conn,$_POST['customerName']);
    $customerAddress = mysqli_real_escape_string($conn,$_POST['customerAddress']);
    $customerCity = mysqli_real_escape_string($conn,$_POST['customerCity']);
    $customerState = mysqli_real_escape_string($conn,$_POST['customerState']);
    $customerZip = mysqli_real_escape_string($conn, $_POST['customerZip']);
    $customerCountry = mysqli_real_escape_string($conn,$_POST['customerCountry']);

    $query = "INSERT INTO customer (customer_name, customer_address, customer_city, state_id, customer_zip, country_id)
            VALUES ('$customerName', '$customerAddress', '$customerCity', '$customerState', '$customerZip', '$customerCountry')";

    if(mysqli_query($conn, $query)) {
      $output .= '<label class="text-success">Customer Added</label>';
      $select_query = "SELECT * FROM customer ORDER BY customer_id DESC";
      $result = mysqli_query($conn, $query);
      $output .= '
      <table class="table table-bordered">
        <tr>
          <th>Customer Name</th>
          <th>Customer Address</th>
        </tr>
      ';
      while ($row = mysqli_fetch_array($result)) {
        $output .= '
        <tr>
          <td><?php echo $row["customer_name"]; ?></td>
          <td><?php echo $row["customer_address"].', '.$row["customer_city"].', '.$row["customer_state"].', '.$row["customer_zip"].', '.$row["customer_country"]; ?> </td>
        </tr>
        ';
      }
      $output .='</table>';
    }
    echo $output;
  }
?>
