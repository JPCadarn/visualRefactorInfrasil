$('.triggerModal').click(function(){
	let action = $(this).data('action');
	let dataRequest = {
		action: action
	}
	let request = $.ajax({
		url: 'action.php',
		type: 'POST',
		data: dataRequest,
		dataType: 'JSON'
	}).done(function(response){
		$('#modal1 .modal-content').html(response.html);
		$('#modal1').modal('open');
	});
});