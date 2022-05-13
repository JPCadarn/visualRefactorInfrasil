$('.triggerModal').click(function(){
	let action = $(this).data('action');
	let dataRequest = {
		action: action
	}
	$('#modal1 .modal-header').html('<h3>VAMOOOOOOO</h3>');
	$('#modal1 .modal-content').html('<h5>pra frenteeeeeeee</h5>');
	$('#modal1').modal('open');
	// let request = $.ajax({
	// 	url: 'action.php',
	// 	type: 'POST',
	// 	data: dataRequest,
	// 	dataType: 'JSON'
	// }).done(function(response){
	// 	$('#modal1 .modal-content').html(response.html);
	// 	$('#modal1').modal('open');
	// });
});