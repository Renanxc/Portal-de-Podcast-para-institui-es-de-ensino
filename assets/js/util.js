var testWidth = function(width){
	var folha = $('.folha-content');
	var folhaEscolhida = 0;
	// if ($(window).outerWidth() > width)
		for (var i = 0; i < folha.length; i++) {
			var folhaTemp = mergeContent(folha[i].children,0);
			if (folhaEscolhida < folhaTemp)
				folhaEscolhida = folhaTemp;
		}
	// else
	// 	for (var i = 0; i < folha.length; i++) {
	// 		var folhaTemp = mergeContent(folha[i].children);
	// 		folhaEscolhida = folhaEscolhida + folhaTemp;
	// 	}

	if ($(window).outerWidth() > width)
		return folhaEscolhida;
	else return folhaEscolhida*2;
}
var testHeight = function(folhaEscolhida){
	var win = getWindowHeight()
	var height;
	if (win < folhaEscolhida)
		height = folhaEscolhida+20;
	else
		height = win;
	$('.bg-folha').height(height);
	return height;
}
var testHeightFolha = function(width,height){
	var folha = $('.folha-content');
	if ($(window).outerWidth() < width) 
		$('.respH').height(height/folha.length);
	else
		$('.respH').height(height);
}
var mergeContent = function(children,height){
	for (var i = 0; i < children.length; i++) {
		if (children[i].children.length != 0) {
			// console.log('entrei'+i);
			height = mergeContent(children[i].children,height);
		}
		else{
			var styles = window.getComputedStyle(children[i]);
			var margin = parseFloat(styles['margin-top']) + parseFloat(styles['margin-bottom']);
			var padding = parseFloat(styles['padding-top']) + parseFloat(styles['padding-bottom']);
			height = height + children[i].offsetHeight + margin + padding;
			// console.log(children[i].id);
		}
	}
	return height;
}
var getWindowHeight = function(){
	var win = $(window).outerHeight();
	var navbar = $('nav').outerHeight();
	return (win - navbar)-25;
}


$('#changePsw').click(function(evt){
	evt.preventDefault();
	$('.psw').each(function(){
		if ($(this).attr('type') == "password") $(this).attr('type','text');
		else $(this).attr('type','password');
	});
});

$('#limpaCampos').on('click',function(event){
	event.preventDefault();
	$('#nome').val('');
	$('#nasc').val('');
	$('#tel').val('');
	$('#email').val('');
	$('#login-cad').val('');
	$('#psw-cad').val('');
	$('#psw2').val('');
	$('#assunto').val('');
	$('#msg').val('');
	$('#descricao').val('');
	$('.jqte_editor').html('');
});

$('.editorhtml').jqte();

$('.jqte_tool_label').height('unset');

$("#myModal2").modal("show");

$('#pod').on('change',function(){
	$('#file_form').submit();
});