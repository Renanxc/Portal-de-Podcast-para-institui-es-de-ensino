$(function(){
	testHeightFolha(576,testHeight(testWidth(576)));
	// $('.titulo').click(function(event){
	// 	event.preventDefault();
	// });
});
$(window).resize(
	function(){
		testHeightFolha(576,testHeight(testWidth(576)));
	}
);

 
// create an observer instance
var observer = new MutationObserver(function(mutations) {
  mutations.forEach(function() {
    testHeightFolha(576,testHeight(testWidth(576)));
  });    
});
 
// select the target node
var target = $('#msg')[0];
// configuration of the observer:
var config = { attributes: true, childList: true, characterData: true };

if (target) { 
	// pass in the target node, as well as the observer options
	observer.observe(target, config);
}