function dispararAjaxAberturaModal(elemento){
	let action = $(elemento).data('action');
	let dataRequest = {
		action: action,
		numeroModal: document.getElementsByClassName('modal').length,
		page: 1
	};
	let dataId = $(elemento).data('id');
	if(dataId !== ''){
		dataRequest['id'] = dataId;
	}

	$.ajax({
		url: 'src/action.php',
		type: 'POST',
		data: dataRequest,
		dataType: 'JSON'
	}).done(function(response){
		if(response.status === 200 && response.redirect !== '' && response.redirect !== undefined){
			window.location.href = response.redirect;
			return;
		}

		if(response.status !== 404) {
			$('.tooltipped').tooltip('close');
			$('.div-modal').html(response.html);
			const elem = document.getElementById(response.idModal);
			const instance = M.Modal.init(elem, {
				dismissible: false
			});
			instanciarJsMaterialize();
			fazerBindMascaras();
			if (response.hasOwnProperty('idTable')) {
				instanciarDataTables(response.idTable, response.idModal);
			}
			instance.open();
		}else{
			M.toast({html: response.message, classes: "red darken-3 rounded"})
		}
	});
}

function instanciarDataTables(idTabela, idModal) {
	$(document).ready(function() {
		let table = $('#'+idTabela).DataTable( {
			colReorder: true,
			bFilter: false,
			info: false,
		});
		let qtdElementos = Math.round($('#'+idModal+' .modal-content').height() / 65);
		table.page.len(qtdElementos).draw();
		let info = table.page.info();
		let html = '';

		for (let i = 0; i < info.pages; i++) {
			html += '<li class="waves-effect" id="page'+i+'"><a href="#!">'+(i+1)+'</a></li>';
		}
		$('#paginas').innerHTML = html;
		$('#paginas').html(html);
		$('#page0').addClass('active');

		let texto = 'Exibindo '+(info.start + 1)+'-'+info.end+'/'+info.recordsTotal;
		$('#teste').text(texto);

		$('select').formSelect();
		$('#next').on( 'click', function () {
			table.page( 'next' ).draw( 'page' );
			info = table.page.info();
			texto = 'Exibindo '+(info.start + 1)+'-'+info.end+'/'+info.recordsTotal;
			$('#teste').text(texto);
			$("li[id*='page']").each(function (i, el) {
				$('#'+el.id).removeClass('active')
			});
			$('#page'+info.page).addClass('active')
		} );

		$('#previous').on( 'click', function () {
			table.page( 'previous' ).draw( 'page' );
			info = table.page.info();
			texto = 'Exibindo '+(info.start + 1)+'-'+info.end+'/'+info.recordsTotal;
			$('#teste').text(texto);
			$("li[id*='page']").each(function (i, el) {
				$('#'+el.id).removeClass('active')
			});
			$('#page'+info.page).addClass('active')
		} );

		$('#filtrar').on('click', function(){
			let filteredData = table
				.columns( 1 )
				.data()
				.flatten()
				.filter( function ( value ) {
					return value.includes('ware');
				} );
			console.log(filteredData);
		})
	});
}

function instanciarJsMaterialize(){
	$('.sidenav').sidenav();
	$('.collapsible').collapsible();
	$('.tooltipped').tooltip();
	$('.fixed-action-btn').floatingActionButton();
	$('.collapsible').collapsible();
	$('select').formSelect();
}

function fazerBindMascaras(){
	$('.mask-date').mask('00/00/0000');
	$('.mask-hora').mask('00:00');
	$('.mask-coord').mask('00º 00\' 00\" A');
	$('.mask-telefone').mask('(00) 90000-0000');
	$('.mask-decimal').mask('000.000.000.000.000,00', {reverse: true});
	$('.mask-cep').mask('00000-000');
	$(".mask-cpfcnpj").keydown(function(){
		try {
			$(".mask-cpfcnpj").unmask();
		} catch (e) {}

		var tamanho = $(".mask-cpfcnpj").val().length;

		if(tamanho < 11){
			$(".mask-cpfcnpj").mask("999.999.999-99");
		} else {
			$(".mask-cpfcnpj").mask("99.999.999/9999-99");
		}

		// ajustando foco
		var elem = this;
		setTimeout(function(){
			// mudo a posição do seletor
			elem.selectionStart = elem.selectionEnd = 10000;
		}, 0);
		// reaplico o valor para mudar o foco
		var currentValue = $(this).val();
		$(this).val('');
		$(this).val(currentValue);
	});
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

$("body").on("submit", null, function(element){
	element.preventDefault();

	let formData = $('#' + element.target.getAttribute('id')).serializeArray();

	$.ajax({
		type: 'POST',
		url: 'src/action.php',
		data: formData,
		dataType: 'JSON',
		encode: true
	}).done(function (response) {
		if(response.type === 'error'){
			response.errors.forEach(function(msgErro){
				M.toast({
					html: msgErro,
					classes: "red darken-3 rounded",
					displayLength: 2500
				})
			})
		}else if(response.type === 'success'){
			let elementos = $('#' + element.target.getAttribute('id'))[0].elements;
			let formPossuiImagens = false;

			for(let i = 0; i < elementos.length; i ++){
				if(elementos[i].id === 'imagens'){
					formPossuiImagens = true;
				}
			}

			if(formPossuiImagens) {
				let imageData = new FormData();
				let contador = 0;
				Object.values($('#imagens')[0].files).forEach(function (elem) {
					imageData.append('file' + contador, elem);
					contador++;
				});
				imageData.append('idOAE', response.id);
				$.ajax({
					type: 'POST',
					url: 'src/upload.php',
					data: imageData,
					contentType: false,
					processData: false
				}).done(function (resposta) {
					if (resposta.type === 'error') {
						M.toast({
							html: resposta.message,
							classes: "red darken-3 rounded",
							displayLength: 2500
						});
					} else {
						M.toast({
							html: resposta.message,
							classes: "green darken-3 rounded",
							displayLength: 2500
						});
					}
				});
			}
			M.toast({
				html: response.message,
				classes: "green darken-3 rounded",
				displayLength: 2500
			});
			let idModal = document.getElementById(element.target.getAttribute('id')).parentNode.parentNode.id;
			let modal = document.getElementById(idModal);
			const instance = M.Modal.getInstance(modal);
			instance.destroy();
		}
	});
});