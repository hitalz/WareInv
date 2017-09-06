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

    if(mysqli_query($conn, $addCustomerQuery)) {
      $customerQuery = "
      SELECT customer.*, state.*, country.*
      FROM customer, state, country
      WHERE customer.state_id = state.state_id AND customer.country_id=country.country_id
      ORDER BY customer.customer_name
      ";
      $runCustomersQuqery = mysqli_query($conn, $customerQuery);
      $output .= '
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Customer Name</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>ZIP</th>
            <th>Country</th>
          </tr>
        </thead>';
      while($row = mysqli_fetch_array($runCustomersQuery)) {
        $output .= '
        <tbody>
          <tr>
            <td>' . $row["customer_name"] . '</td>
            <td>' . $row["customer_address"] . '</td>
            <td>' . $row["customer_city"] . '</td>
            <td>' . $row["state_abbr"] . '</td>
            <td>' . $row["customer_zip"] . '</td>
            <td>' . $row["country_abbr"] . '</td>
          </tr>
        </tbody>';
      }
      $output .= '
      </table>';
    }
  }
?>
