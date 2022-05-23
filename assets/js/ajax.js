function dispararAjaxAberturaModal(elemento){
	let action = $(elemento).data('action');
	let dataRequest = {
		action: action,
		numeroModal: document.getElementsByClassName('modal').length,
		page: 1
	}

	$.ajax({
		url: 'src/action.php',
		type: 'POST',
		data: dataRequest,
		dataType: 'JSON'
	}).done(function(response){
		if(response.status !== 404) {
			let htmlAtual = $('.div-modal').html();
			if($(elemento).hasClass('modal-close')){
				htmlAtual = response.html;
			}else {
				htmlAtual += response.html;
			}
			$('.div-modal').html(htmlAtual);
			const elem = document.getElementById(response.idModal);
			const instance = M.Modal.init(elem, {
				dismissible: false
			});
			instanciarJsMaterialize();
			instance.open();
		}else{
			M.toast({html: response.message, classes: "red darken-3 rounded"})
		}
	});
}

function instanciarJsMaterialize(){
	$('.sidenav').sidenav();
	$('.collapsible').collapsible();
	$('.tooltipped').tooltip();
	$('.fixed-action-btn').floatingActionButton();
	$('.collapsible').collapsible();
}

$("body").on("click", ".triggerModal", function(){
	dispararAjaxAberturaModal(this);
});

$("body").on("click", ".modal-close", function(element){
	let modal = document.getElementById($(this).parents()[1].id);
	modal.remove();
});

$('#formLogin').on('submit', function (event) {
	event.preventDefault();

	let formData = {
		usuario: $('#usuario').val(),
		senha: $('#senha').val(),
		action: 'login'
	}

	$.ajax({
		type: 'POST',
		url: 'src/action.php',
		data: formData,
		dataType: 'JSON',
		encode: true
	}).done(function (response) {
		if (response.status === 200 && response.type === 'success'){
			window.location.href = 'index.php';
		}else{
			M.toast({html: response.message, classes: "red darken-3 rounded"})
		}
	});
});

$('#formCadastroOAE').on('submit', function (event) {
	event.preventDefault();
	console.log('oasidhfiousadhf');
})