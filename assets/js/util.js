var testWidth = function(width){
	var folha = $('.folha-content');
	var folhaEscolhida = 0;
	// if ($(window).outerWidth() > width)
		for (var i = 0; i < folha.length; i++) {
			var folhaTemp = mergeContent(folha[i].children);
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
var mergeContent = function(children){
	var height = 0;
	for (var i = 0; i < children.length; i++) {
		var styles = window.getComputedStyle(children[i]);
		var margin = parseFloat(styles['margin-top']) + parseFloat(styles['margin-bottom']);
		height = height + children[i].offsetHeight + margin;
	}
	return height;
}
var getWindowHeight = function(){
	var win = $(window).outerHeight();
	var navbar = $('nav').outerHeight();
	return (win - navbar)-25;
}