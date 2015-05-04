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

	//SubMenu
	$("li.menu-item-has-children>a").mouseenter(function(evt){
		$(".sub-menu").fadeOut(200);
		var sub=$(evt.target).next();
		console.log(sub);
		sub.fadeIn(200,function(){
			sub.mouseleave(function(){
			sub.fadeOut(200);
		});
		});
	});

		
	
});