<?php
  require '../include/dbh.inc.php';
  session_start();

  // Check if user is logged in using the session variable
  if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "You must be logged in to view this page!";
    header("Location: ../error.php");
  } else {
      // Makes it easier to read
      $first_name = $_SESSION['first_name'];
      $last_name = $_SESSION['last_name'];
      $customersQuery="
      SELECT customer.*, state.*, country.*
      FROM customer, state, country
      WHERE customer.state_id = state.state_id AND customer.country_id=country.country_id
      ORDER BY customer.customer_name
      ";

      $runCustomersQuery = mysqli_query($conn, $customersQuery);
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Warehouse Inventory | <?= $first_name.' '.$last_name ?></title>

    <!-- Bootstrap CSS-->
    <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!--  CSS -->
    <link href="../css/dashboard.css" rel="stylesheet">
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/scripts.js"></script>
  </head>

  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Warehouse</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="inventory.php">Inventory</a></li>
            <li class="active"><a href="customers.php">Customers</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <?php echo $first_name.' '.$last_name ?><span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="../include/logout.inc.php">Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="" data-toggle="modal" data-target="#newCustomerModal">New Customer</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="sub-header">Customers</h2>
          <div id="customerTable" class="table-responsive">
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
              </thead>
              <tbody>
                <?php
                  while($row = mysqli_fetch_array($runCustomersQuery)) {
                ?>
                <tr>
                  <td><?php echo $row["customer_name"] ?></td>
                  <td><?php echo $row["customer_address"] ?></td>
                  <td><?php echo $row["customer_city"] ?></td>
                  <td><?php echo $row["state_abbr"] ?></td>
                  <td><?php echo $row["customer_zip"] ?></td>
                  <td><?php echo $row["country_abbr"] ?></td>
                </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

<!--  New Customer Modal -->
<div class="modal fade" id="newCustomerModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">New Customer</h3>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
        <div class="container-fluid">
          <form id="newCustomer" method="POST">
            <div class="form-group">
              <label for="customerName" class="col-form-label">Customer</label>
              <input type="text" class="form-control" name="customerName" id="customerName" placeholder="Customer Name">
            </div>
            <div class="form-group">
              <label for="customerAddress" class="col-form-label">Address</label>
              <input type="text" class="form-control" name="customerAddress" id="customerAddress" placeholder="1234 Main St">
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="customerCity">City</label>
                  <input type="text" class="form-control" name="customerCity" id="customerCity" placeholder="City">
                </div>
                <div class="col-md-3 mb-3">
                  <label for="customerState">State</label>
                  <select name="customerState" id="customerState" class="form-control">
                    <?php
                      $sql = mysqli_query($conn, "SELECT state_id, state_name FROM state");
                      while ($row = $sql->fetch_assoc()) {
                        $StateName = $row['state_name'];
                        ?>
                        <option value="<?= $row['state_id']; ?>"><?php echo $StateName ?></option>
                      <?php
                      }
                    ?>
                  </select>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="customerZip">Zip</label>
                  <input type="text" class="form-control" name="customerZip" id="customerZip" placeholder="Zip">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="customerCountry">Country</label>
                  <select name="customerCountry" id="customerCountry" class="form-control">
                    <?php
                      $sql = mysqli_query($conn, "SELECT country_id, country_name FROM country");
                      while ($row = $sql->fetch_assoc()) {
                        $CountryName = $row['country_name'];
                        ?>
                        <option value="<?= $row['country_id']; ?>"><?php echo $CountryName ?></<</option>
                      <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <br />
            <input type="button" name="cancel" id="cancel" value="Cancel" class="btn" data-dismiss="modal" />
            <input type="submit" name="insert" id="insert" value="Add Customer" class="btn btn-primary" />
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
