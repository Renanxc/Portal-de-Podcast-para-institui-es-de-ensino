$(function(){
		var h = testWidth(576);
		var w = testHeight(h);
		testHeightFolha(w,h)
	}
);
$(window).resize(
	function(){
		var h = testWidth(576);
		var w = testHeight(h);
		testHeightFolha(w,h)
	}
);