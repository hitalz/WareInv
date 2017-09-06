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
					$('#insert').val("Adding..");
				},
				success:function(data){
					$('#newCustomer')[0].reset();
					$('#newCustomerModal').modal('hide');
					$('#customerTable').html(data);
				}
			});
		}
	});
});
