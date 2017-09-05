<?php
  require '../includes/dbh.inc.php';
  if (!isset($_SESSION)) {
    session_start();
  }

  // Check if user is logged in using the session variable
  if ($_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "You must be logged in to view this page!";
    header("Location: ../error.php");
  } else {
      // Makes it easier to read
      $first_name = $_SESSION['first_name'];
      $last_name = $_SESSION['last_name'];
      $sql = "SELECT * FROM customer ORDER BY customer_id DESC";
      $result = mysqli_query($conn, $sql);
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Warehouse Inventory | <?= $first_name.' '.$last_name ?></title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="../css/dashboard/narrow-jumbotron.css" rel="stylesheet">
  </head>

  <body>
    <div class="header clearfix">
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Warehouse</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="inventory.php">Inventory</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="customers.php">Customers<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="#">Suppliers</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="#">Carriers</a>
            </li>
          </ul>
          <ul class="nav justify-content-end">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $first_name.' '.$last_name ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="../includes/logout.inc.php">Sign Out</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </div>
      <div class="table-responsive">
        <h1>Customers</h1>
        <div align="right">
         <button type="button" name="addCustomerButton" id="addCustomerButton" data-toggle="modal" data-target="#addCustomerModal" class="btn btn-primary">Add</button>
        </div>
        <div id="customers_table">
          <table class="table table-bordered">
            <tr>
              <th>Customer Name</th>
              <th>Customer Address</th>
            </tr>
            <?php
            while($row = mysqli_fetch_array($result)) {
            ?>
            <tr>
              <td><?php echo $row["customer_name"]; ?></td>
              <td><?php echo $row["customer_address"].', '.$row["customer_city"].', '.$row["customer_state"].', '.$row["customer_zip"].', '.$row["customer_country"]; ?> </td>
            </tr>
            <?php
            } ?>
          </table>
        </div>
      </div>

      <!--  New Customer Modal -->
      <div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="newCustomerModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">New Customer</h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
              <div class="container-fluid">
                <form name="newCustomer" class="newCustomer">
                  <div class="form-group">
                    <label class="col-form-label">Customer</label>
                    <input type="text" class="form-control" id="customerName" placeholder="Customer Name">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Address</label>
                    <input type="text" class="form-control" id="customerAddress" placeholder="1234 Main St">
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label>City</label>
                        <input type="text" class="form-control" id="customerCity" placeholder="City">
                        <div class="invalid-feedback">
                          Please provide a valid city.
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label>State</label>
                        <select id="customerState" class="form-control">
                          <?php
                            $sql = mysqli_query($conn, "SELECT state_id, state_name FROM state");
                            while ($row = $sql->fetch_assoc()) {
                              $StateName = $row['state_name'];
                              ?>
                              <option value="<?= $row['state_name']; ?>"><?php echo $StateName ?></option>
                            <?php
                            }
                          ?>
                        </select>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label>Zip</label>
                        <input type="text" class="form-control" id="customerZip" placeholder="Zip">
                        <div class="invalid-feedback">
                          Please provide a valid zip.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label>Country</label>
                        <select id="customerCountry" class="form-control">
                          <?php
                            $sql = mysqli_query($conn, "SELECT country_id, country_name FROM country");
                            while ($row = $sql->fetch_assoc()) {
                              $CountryName = $row['country_name'];
                              ?>
                              <option value="<?= $row['country_name']; ?>"><?php echo $CountryName ?></<</option>
                            <?php
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <button type="submit" class="btn btn-primary" name="addCustomer" id="addCustomer">Save</button>
                </form>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#newEntry" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary" id="addCustomer">Save</button>
                </div>
              </div>

          </div>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function(){
        $('button#newCustomer').click(function(){
          $.ajax({
            type: "POST",
            url: "../includes/add-customer.php",
            data: $('form.newCustomer').serialize(),
            success:function(data) {
              $('#newCustomerModal').modal('hide');
            }
          });
        });
      });
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

  </body>
</html>
