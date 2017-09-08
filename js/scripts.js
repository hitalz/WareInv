// Add new customer.
$(document).ready(function(){
	$('#newCustomer').on("submit", function(event){
		event.preventDefault();
		if($('#customerName').val() == "") {
			alert("Customer name is required");
		} else if($('#customerAddress').val() == '') {
			alert("Address is required");
		} else if($('#customerCity').val() == '') {
			alert("City is required");
		} else if($('#customerState').val() == '') {
			alert("Select a valid state");
		} else if($('#customerZip').val() == '') {
			alert("ZIP is required");
		} else if($('#customerCountry').val() == '') {
			alert("Select a valid country");
		} else {
			$.ajax({
				url:"../include/add/customer.inc.php",
				method:"POST",
				data:$('#newCustomer').serialize(),
				beforeSend:function(){
					$('#insertCustomer').val("Adding...");
				},
				success:function(data){
					$('#newCustomer')[0].reset();
					$('#newCustomerModal').modal('hide');
					location.reload();
				}
			});
		}
	});
});

// Add new supplier.
$(document).ready(function(){
	$('#newSupplier').on("submit", function(event){
		event.preventDefault();
		if($('#supplierName').val() == "") {
			alert("Supplier name is required");
		} else if($('#supplierAddress').val() == '') {
			alert("Address is required");
		} else if($('#supplierCity').val() == '') {
			alert("City is required");
		} else if($('#supplierState').val() == '') {
			alert("Select a valid state");
		} else if($('#supplierZip').val() == '') {
			alert("ZIP is required");
		} else if($('#supplierCountry').val() == '') {
			alert("Select a valid country");
		} else {
			$.ajax({
				url:"../include/add/supplier.inc.php",
				method:"POST",
				data:$('#newSupplier').serialize(),
				beforeSend:function(){
					$('#insertSupplier').val("Adding...");
				},
				success:function(data){
					$('#newSupplier')[0].reset();
					$('#newSupplierModal').modal('hide');
					location.reload();
				}
			});
		}
	});
});

// Add new carrier.
$(document).ready(function(){
	$('#newCarrier').on("submit", function(event){
		event.preventDefault();
		if($('#carrierName').val() == "") {
			alert("Carrier name is required");
		} else if($('#carrierAddress').val() == '') {
			alert("Address is required");
		} else if($('#carrierCity').val() == '') {
			alert("City is required");
		} else if($('#carrierState').val() == '') {
			alert("Select a valid state");
		} else if($('#carrierZip').val() == '') {
			alert("ZIP is required");
		} else if($('#carrierCountry').val() == '') {
			alert("Select a valid country");
		} else {
			$.ajax({
				url:"../include/add/carrier.inc.php",
				method:"POST",
				data:$('#newCarrier').serialize(),
				beforeSend:function(){
					$('#insertCarrier').val("Adding...");
				},
				success:function(data){
					$('#newCarrier')[0].reset();
					$('#newCarrierModal').modal('hide');
					$('#newReferenceModal').modal('show');
					location.reload();
				}
			});
		}
	});
});

// Add new reference
$(document).ready(function(){
	$('#newReference').on("submit", function(event){
		event.preventDefault();
		if($('#referenceCustomer').val() == "") {
			alert("Select a valid Customer");
		} else if($('#referenceSupplier').val() == '') {
			alert("Select a valid Supplier");
		} else if($('#referenceArrivalDate').val() == '') {
			alert("Date is required");
		} else if($('#referenceArrivalTime').val() == '') {
			alert("Time is required");
		} else if($('#referenceCarrier').val() == '') {
			alert("Select a valid Carrier");
		} else if($('#referencePurchaseOrder').val() == '') {
			alert("Enter a valid Purchase Order");
		} else if($('#referenceTrackingNumber').val() == '') {
			alert("Enter a valid Tracking Number");
		} else if($('#referencePackageQuantity').val() == '') {
			alert("Enter a valid Quantity");
		} else if($('#referencePackageType').val() == '') {
			alert("Select a valid type");
		} else {
			$.ajax({
				url:"../include/add/reference.inc.php",
				method:"POST",
				data:$('#newReference').serialize(),
				beforeSend:function(){
					$('#addReference').val("Adding...");
				},
				success:function(data){
					$('#newReference')[0].reset();
					$('#newReferenceModal').modal('hide');
					location.reload();
				}
			});
		}
	});
});
