$(function(){
	var nb=$("#navbar");
	//Hide picture when Debuging
	$("img").fadeOut(700);
	//fix the Nav bar 
	$(document).scroll(function(){
		if (($(document).scrollTop() >= ($("#navpos").offset().top )) ) {
				if (nb.css("position") != "fixed") {
					nb.css({
						position:"fixed",
						top: inadmin ? "32px" : "0px" 
					});
				}
			}else{
				if (nb.css("position") == "fixed") {
					nb.removeAttr("style");
				}
			}
		});
});