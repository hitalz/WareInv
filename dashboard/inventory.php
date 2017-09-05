<?php
  require '../includes/dbh.inc.php';
  session_start();

  // Check if user is logged in using the session variable
  if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "You must be logged in to view this page!";
    header("Location: ../error.php");
  } else {
      // Makes it easier to read
      $first_name = $_SESSION['first_name'];
      $last_name = $_SESSION['last_name'];
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

    <link href="../css/dashboard.css" rel="stylesheet">
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
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <?php echo $first_name.' '.$last_name ?><span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="../includes/logout.inc.php">Log Out</a></li>
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
            <li class="active"><a href="#">Dashboard <span class="sr-only">(current)</span></a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="" data-toggle="modal" data-target="#newReferenceModal">New Reference</a></li>
            <li><a href="" data-toggle="modal" data-target="#newCustomerModal">New Customer</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="sub-header">Warehouse Inventory</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Header</th>
                  <th>Header</th>
                  <th>Header</th>
                  <th>Header</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1,001</td>
                  <td>Lorem</td>
                  <td>ipsum</td>
                  <td>dolor</td>
                  <td>sit</td>
                </tr>
                <tr>
                  <td>1,002</td>
                  <td>amet</td>
                  <td>consectetur</td>
                  <td>adipiscing</td>
                  <td>elit</td>
                </tr>
                <tr>
                  <td>1,003</td>
                  <td>Integer</td>
                  <td>nec</td>
                  <td>odio</td>
                  <td>Praesent</td>
                </tr>
                <tr>
                  <td>1,003</td>
                  <td>libero</td>
                  <td>Sed</td>
                  <td>cursus</td>
                  <td>ante</td>
                </tr>
                <tr>
                  <td>1,004</td>
                  <td>dapibus</td>
                  <td>diam</td>
                  <td>Sed</td>
                  <td>nisi</td>
                </tr>
                <tr>
                  <td>1,005</td>
                  <td>Nulla</td>
                  <td>quis</td>
                  <td>sem</td>
                  <td>at</td>
                </tr>
                <tr>
                  <td>1,006</td>
                  <td>nibh</td>
                  <td>elementum</td>
                  <td>imperdiet</td>
                  <td>Duis</td>
                </tr>
                <tr>
                  <td>1,007</td>
                  <td>sagittis</td>
                  <td>ipsum</td>
                  <td>Praesent</td>
                  <td>mauris</td>
                </tr>
                <tr>
                  <td>1,008</td>
                  <td>Fusce</td>
                  <td>nec</td>
                  <td>tellus</td>
                  <td>sed</td>
                </tr>
                <tr>
                  <td>1,009</td>
                  <td>augue</td>
                  <td>semper</td>
                  <td>porta</td>
                  <td>Mauris</td>
                </tr>
                <tr>
                  <td>1,010</td>
                  <td>massa</td>
                  <td>Vestibulum</td>
                  <td>lacinia</td>
                  <td>arcu</td>
                </tr>
                <tr>
                  <td>1,011</td>
                  <td>eget</td>
                  <td>nulla</td>
                  <td>Class</td>
                  <td>aptent</td>
                </tr>
                <tr>
                  <td>1,012</td>
                  <td>taciti</td>
                  <td>sociosqu</td>
                  <td>ad</td>
                  <td>litora</td>
                </tr>
                <tr>
                  <td>1,013</td>
                  <td>torquent</td>
                  <td>per</td>
                  <td>conubia</td>
                  <td>nostra</td>
                </tr>
                <tr>
                  <td>1,014</td>
                  <td>per</td>
                  <td>inceptos</td>
                  <td>himenaeos</td>
                  <td>Curabitur</td>
                </tr>
                <tr>
                  <td>1,015</td>
                  <td>sodales</td>
                  <td>ligula</td>
                  <td>in</td>
                  <td>libero</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- New Reference Modal -->
    <div class="modal fade" id="newReferenceModal" tabindex="-1" role="dialog" aria-labelledby="newRefenrenceModal" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">New Reference</h3>
          </div>
          <!-- Modal Body -->
          <div class="modal-body">
            <form>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-2"><label for="customer" class="col-form-label">Customer</label></div>
                  <div class="col-md-10"><input type="text" class="form-control" id="customer" name="customer"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-2"><label for="supplier" class="col-form-label">Supplier</label></div>
                  <div class="col-md-9"><input type="text" class="form-control" id="supplier" name="supplier"></div>
                  <div class="col-auto"><button type=button name="addNewSupplier" class="btn btn-primary" data-toggle="modal" data-target="#newSupplier" data-dismiss="modal">+</button></div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label for="arrivalDate" class="ol-form-label">Arrival Date:</label>
                  </div>
                  <div class="col-md-3">
                    <input type="text" class="form-control" id="arrivalDate" name="arrivalDate">
                  </div>
                  <div class="col-md-3">
                    <label for="inputClientZIP" class="col-form-label">Arrival Time:</label>
                  </div>
                  <div class="col-md-3">
                    <input type="text" class="form-control" id="inputClientZIP" name="inputClientZIP">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-2"><label for="supplier" class="col-form-label">Carrier</label></div>
                  <div class="col-md-9"><input type="text" class="form-control" id="supplier" name="supplier"></div>
                  <div class="col-auto"><button type=button name="addNewSupplier" class="btn btn-primary" data-toggle="modal" data-target="#newCarrier" data-dismiss="modal">+</button></div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label for="arrivalDate" class="ol-form-label">Purchase Order:</label>
                  </div>
                  <div class="col-md-3">
                    <input type="text" class="form-control" id="arrivalDate" name="arrivalDate">
                  </div>
                  <div class="col-md-3">
                    <label for="inputClientZIP" class="col-form-label">Tracking Number:</label>
                  </div>
                  <div class="col-md-3">
                    <input type="text" class="form-control" id="inputClientZIP" name="inputClientZIP">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label for="arrivalDate" class="ol-form-label">Package Quantity:</label>
                  </div>
                  <div class="col-md-3">
                    <input type="text" class="form-control" id="arrivalDate" name="arrivalDate">
                  </div>
                  <div class="col-md-3">
                    <label for="inputClientZIP" class="col-form-label">Package Type:</label>
                  </div>
                  <div class="col-md-3">
                    <input type="text" class="form-control" id="inputClientZIP" name="inputClientZIP">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
            </form>
          </div>
          <!-- Modal Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button name="submit" type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>

    <!--  New Customer Modal -->
    <div class="modal fade" id="newCustomerModal" tabindex="-1" role="dialog" aria-labelledby="newCustomerModal" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">New Customer</h3>
          </div>
          <!-- Modal Body -->
          <div class="modal-body">
            <div class="container-fluid">
              <form class="newCustomer" method="post">
                <div class="form-group">
                  <label for="customerName" class="col-form-label">Customer</label>
                  <input type="text" class="form-control" id="customerName" placeholder="Customer Name" required>
                </div>
                <div class="form-group">
                  <label for="customerAddress" class="col-form-label">Address</label>
                  <input type="text" class="form-control" id="customerAddress" placeholder="1234 Main St" required>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="customerCity">City</label>
                      <input type="text" class="form-control" id="customerCity" placeholder="City" required>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="customerState">State</label>
                      <select id="customerState" class="form-control">
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
                      <input type="text" class="form-control" id="customerZip" placeholder="Zip" required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="customerCountry">Country</label>
                      <select id="customerCountry" class="form-control">
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
              </form>
              <!-- Modal Footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="addCustomer">Save</button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- New Supplier Modal -->
    <div class="modal fade" id="newSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-toggle="modal" data-target="#newReferenceModal" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">New Supplier</h3>
          </div>
          <!-- Modal Body -->
          <div class="modal-body">
            <div class="container-fluid">
              <form>
                <div class="form-group">
                  <label for="supplierName" class="col-form-label">Supplier</label>
                  <input type="text" class="form-control" id="supplierName" placeholder="Supplier Name">
                </div>
                <div class="form-group">
                  <label for="supplierAddress" class="col-form-label">Address</label>
                  <input type="text" class="form-control" id="supplierAddress" placeholder="1234 Main St">
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="supplierCity">City</label>
                      <input type="text" class="form-control" id="supplierCity" placeholder="City" required>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="supplierState">State</label>
                      <select id="supplierState" class="form-control">
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
                      <label for="supplierZip">Zip</label>
                      <input type="text" class="form-control" id="supplierZip" placeholder="Zip" required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="supplierCountry">Country</label>
                      <select id="supplierCountry" class="form-control">
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
              </form>
            </div>
          </div>
          <!-- Modal Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#newReferenceModal" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>

    <!-- New Carrier Modal -->
    <div class="modal fade" id="newCarrier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-toggle="modal" data-target="#newReferenceModal" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">New Carrier</h3>
          </div>
          <!-- Modal Body -->
          <div class="modal-body">
            <div class="container-fluid">
              <form>
                <div class="form-group">
                  <label for="carrierName" class="col-form-label">Carrier</label>
                  <input type="text" class="form-control" id="carrierName" placeholder="Carrier Name">
                </div>
                <div class="form-group">
                  <label for="carrierAddress" class="col-form-label">Address</label>
                  <input type="text" class="form-control" id="carrierAddress" placeholder="1234 Main St">
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="carrierCity">City</label>
                      <input type="text" class="form-control" id="carrierCity" placeholder="City" required>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="carrierState">State</label>
                      <select id="carrierState" class="form-control">
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
                      <label for="carrierZip">Zip</label>
                      <input type="text" class="form-control" id="carrierZip" placeholder="Zip" required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="carrierCountry">Country</label>
                      <select id="carrierCountry" class="form-control">
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
              </form>
            </div>
          </div>
          <!-- Modal Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#newReferenceModal" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap/bootstrap.min.js"></script>
    </body>
</html>
