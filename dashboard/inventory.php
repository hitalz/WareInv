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
      $referenceQuery="
      SELECT *
      FROM reference, customer, supplier, carrier, package
      WHERE reference.customer_id = customer.customer_id AND reference.supplier_id = supplier.supplier_id AND reference.carrier_id = carrier.carrier_id AND reference.package_id = package.package_id
      ORDER BY reference.reference_id
      ";

      $runReferenceQuery = mysqli_query($conn, $referenceQuery);
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
            <li class="active"><a href="#">Inventory</a></li>
            <li><a href="customers.php">Customers</a></li>
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
            <li><a href="" data-toggle="modal" data-target="#newReferenceModal">New Reference</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="sub-header">Warehouse Inventory</h2>
          <div class="table-responsive">
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
              </thead>
              <tbody>
                <?php
                  while($row = mysqli_fetch_array($runReferenceQuery)) {
                ?>
                <tr>
                  <td><?php echo $row["reference_id"] ?></td>
                  <td><?php echo $row["customer_name"] ?></td>
                  <td><?php echo $row["supplier_name"] ?></td>
                  <td><?php echo $row["arrival_date"] ?></td>
                  <td><?php echo $row["arrival_time"] ?></td>
                  <td><?php echo $row["purchase_order"] ?></td>
                  <td><?php echo $row["carrier_name"] ?></td>
                  <td><?php echo $row["tracking_number"] ?></td>
                  <td><?php echo $row["package_quantity"] ?></td>
                  <td><?php echo $row["package_type"] ?></td>
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

<!-- New Reference Modal -->
<div class="modal fade" id="newReferenceModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">New Reference</h3>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
        <form id="newReference" method="POST">
          <div class="form-group">
            <div class="row">
              <div class="col-md-2">
                <label for="referenceCustomer" class="col-form-label">Customer</label>
              </div>
              <div class="col-md-10">
                <select name="referenceCustomer" id="referenceCustomer" class="form-control">
                  <?php
                    $sql = mysqli_query($conn, "SELECT customer_id, customer_name FROM customer");
                    while ($row = $sql->fetch_assoc()) {
                      $CustomerName = $row['customer_name'];
                      ?>
                      <option value="<?= $row['customer_id']; ?>"><?php echo $CustomerName ?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-2">
                <label for="referenceSupplier" class="col-form-label">Supplier</label>
              </div>
              <div class="col-md-9">
                <select name="referenceSupplier" id="referenceSupplier" class="form-control">
                  <?php
                    $sql = mysqli_query($conn, "SELECT supplier_id, supplier_name FROM supplier");
                    while ($row = $sql->fetch_assoc()) {
                      $SupplierName = $row['supplier_name'];
                      ?>
                      <option value="<?= $row['supplier_id']; ?>"><?php echo $SupplierName ?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
              <div class="col-auto"><button type=button name="addNewSupplier" class="btn btn-primary" data-toggle="modal" data-target="#newSupplierModal" data-dismiss="modal">+</button></div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-3">
                <label for="referenceArrivalDate" class="ol-form-label">Arrival Date:</label>
              </div>
              <div class="col-md-3">
                <input type="date" class="form-control" id="referenceArrivalDate" name="referenceArrivalDate" value="<?php echo date('Y-m-d'); ?>"/>
              </div>
              <div class="col-md-3">
                <label for="referenceArrivalTime" class="col-form-label">Arrival Time:</label>
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control" id="referenceArrivalTime" name="referenceArrivalTime" value="<?php date_default_timezone_set('America/Chicago'); echo date('h:i'); ?>"/>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-2">
                <label for="referenceCarrier" class="col-form-label">Carrier</label>
              </div>
              <div class="col-md-9">
                <select name="referenceCarrier" id="referenceCarrier" class="form-control">
                  <?php
                    $sql = mysqli_query($conn, "SELECT carrier_id, carrier_name FROM carrier");
                    while ($row = $sql->fetch_assoc()) {
                      $CarrierName = $row['carrier_name'];
                      ?>
                      <option value="<?= $row['carrier_id']; ?>"><?php echo $CarrierName ?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
              <div class="col-auto"><button type=button name="addNewSupplier" class="btn btn-primary" data-toggle="modal" data-target="#newCarrierModal" data-dismiss="modal">+</button></div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-3">
                <label for="referencePurchaseOrder" class="ol-form-label">Purchase Order:</label>
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control" id="referencePurchaseOrder" name="referencePurchaseOrder">
              </div>
              <div class="col-md-3">
                <label for="referenceTrackingNumber" class="col-form-label">Tracking Number:</label>
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control" id="referenceTrackingNumber" name="referenceTrackingNumber">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-3">
                <label for="referencePackageQuantity" class="ol-form-label">Package Quantity:</label>
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control" id="referencePackageQuantity" name="referencePackageQuantity">
              </div>
              <div class="col-md-3">
                <label for="referencePackageType" class="col-form-label">Package Type:</label>
              </div>
              <div class="col-md-3">
                <select name="referencePackageType" id="referencePackageType" class="form-control">
                  <?php
                    $sql = mysqli_query($conn, "SELECT package_id, package_type FROM package");
                    while ($row = $sql->fetch_assoc()) {
                      $PackageName = $row['package_type'];
                      ?>
                      <option value="<?= $row['package_id']; ?>"><?php echo $PackageName ?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="referenceDescription">Description</label>
            <textarea class="form-control" id="referenceDescription" name="referenceDescription" rows="3"></textarea>
          </div>
          <br />
          <input type="button" name="cancel" id="cancel" value="Cancel" class="btn" data-dismiss="modal" />
          <input type="submit" name="addReference" id="addReference" value="Add New Reference" class="btn btn-primary" />
        </form>
      </div>
    </div>
  </div>
</div>

<!-- New Supplier Modal -->
<div class="modal fade" id="newSupplierModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-toggle="modal" data-target="#newReferenceModal" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">New Supplier</h3>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
        <div class="container-fluid">
          <form id="newSupplier" method="POST">
            <div class="form-group">
              <label for="supplierName" class="col-form-label">Supplier</label>
              <input type="text" class="form-control" name="supplierName" id="supplierName" placeholder="Supplier Name">
            </div>
            <div class="form-group">
              <label for="supplierAddress" class="col-form-label">Address</label>
              <input type="text" class="form-control" name="supplierAddress" id="supplierAddress" placeholder="1234 Main St">
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="supplierCity">City</label>
                  <input type="text" class="form-control" name="supplierCity" id="supplierCity" placeholder="City">
                </div>
                <div class="col-md-3 mb-3">
                  <label for="supplierState">State</label>
                  <select name="supplierState" id="supplierState" class="form-control">
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
                  <input type="text" class="form-control" name="supplierZip" id="supplierZip" placeholder="Zip">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="supplierCountry">Country</label>
                  <select name="supplierCountry" id="supplierCountry" class="form-control">
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
            <input type="submit" name="insertSupplier" id="insertSupplier" value="Add Supplier" class="btn btn-primary" />
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- New Carrier Modal -->
<div class="modal fade" id="newCarrierModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-toggle="modal" data-target="#newReferenceModal" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">New Carrier</h3>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
        <div class="container-fluid">
          <form id="newCarrier" method="POST">
            <div class="form-group">
              <label for="carrierName" class="col-form-label">Carrier</label>
              <input type="text" class="form-control" name="carrierName" id="carrierName" placeholder="Carrier Name">
            </div>
            <div class="form-group">
              <label for="carrierAddress" class="col-form-label">Address</label>
              <input type="text" class="form-control" name="carrierAddress" id="carrierAddress" placeholder="1234 Main St">
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="carrierCity">City</label>
                  <input type="text" class="form-control" name="carrierCity" id="carrierCity" placeholder="City">
                </div>
                <div class="col-md-3 mb-3">
                  <label for="carrierState">State</label>
                  <select name="carrierState" id="carrierState" class="form-control">
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
                  <input type="text" class="form-control" name="carrierZip" id="carrierZip" placeholder="Zip">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="carrierCountry">Country</label>
                  <select name="carrierCountry" id="carrierCountry" class="form-control">
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
            <input type="submit" name="insertCarrier" id="insertCarrier" value="Add Carrier" class="btn btn-primary" />
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
