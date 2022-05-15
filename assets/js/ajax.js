$('.triggerModal').click(function(){
	let action = $(this).data('action');
	let dataRequest = {
		action: action
	}
	let html = "<div id='modal1' class='modal'>" +
		"<div class='modal-header'>" +
		"<h2>Modal de testes</h2>" +
		"</div>" +
		"<div class='modal-content'>" +
		"<h4>Modal Header</h4>" +
		"  <p>A bunch of text</p>" +
		"</div>" +
		"<div class='modal-footer'>" +
		"  <a href='#!' class='modal-close waves-effect waves-green btn-flat'>Agree</a>" +
		"</div>" +
		"</div>";
	$.ajax({
		url: 'action.php',
		type: 'POST',
		data: dataRequest,
		dataType: 'JSON'
	}).done(function(response){
		let htmlAtual = $('.div-modal').html();
		htmlAtual += html;
		$('.div-modal').html(htmlAtual);
		const elem = document.getElementById('modal1');
		const instance = M.Modal.init(elem, {dismissible: false});
		instance.open();
	});
});