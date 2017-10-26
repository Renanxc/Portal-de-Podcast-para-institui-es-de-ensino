var testWidth = function(width){
	var folha = $('.folha-content');
	var folhaEscolhida = 0;
	if ($(window).outerWidth() > width)
		for (var i = 0; i < folha.length; i++) {
			var folhaTemp = countContent(folha[i].children);
			if (folhaEscolhida < folhaTemp)
				folhaEscolhida = folhaTemp;
		}
	else
		for (var i = 0; i < folha.length; i++) {
			var folhaTemp = countContent(folha[i].children);
			folhaEscolhida = folhaEscolhida + folhaTemp;
		}

	return folhaEscolhida;
}
var testHeight = function(folhaEscolhida){
	var win = getWindowHeight()
	var height;
	if (win < folhaEscolhida)
		height = folhaEscolhida + 40;
	else
		height = win;
	$('.bg-folha').height(height);
	return height;
}
var testHeightFolha = function(width,height){
	var folha = $('.folha-content');
	if (!width) 
		$('.respH').height(height/folha.length);
	else
		$('.respH').height(height);
}
var countContent = function(children){
	var height = 0;
	for (var i = 0; i < children.length; i++) {
		height = height + children[i].offsetHeight;
	}
	return height;
}
var getWindowHeight = function(){
	var win = $(window).outerHeight();
	var navbar = $('nav').outerHeight();
	return (win - navbar)-40;
}