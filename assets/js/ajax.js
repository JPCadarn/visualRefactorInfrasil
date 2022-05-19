$('.triggerModal').on('click', function(){
	let action = $(this).data('action');
	let dataRequest = {
		action: action,
		numeroModal: document.getElementsByClassName('modal').length,
		page: 1
	}

	$.ajax({
		url: 'action.php',
		type: 'POST',
		data: dataRequest,
		dataType: 'JSON'
	}).done(function(response){
		console.log(response);
		let htmlAtual = $('.div-modal').html();
		htmlAtual += response.html;
		$('.div-modal').html(htmlAtual);
		const elem = document.getElementById(response.idModal);
		const instance = M.Modal.init(elem, {dismissible: false});
		instance.open();
	});
});