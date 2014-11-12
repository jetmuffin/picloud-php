$(document).ready(function(){
	// $('.collapse').collapse();
	var nav = $(".nav-second-level");
	var nav_list = $(".nav-li");
	$(".nav-second-level").hide();
	$(".nav-button").each(function (i) {
		if(i != 0){
			$(this).click(function () {
				if ($(nav[i]).css("display") == "block") {
		                			$(nav[i]).slideUp(350);
		                			$(this).parent().removeClass('active');
		            		} else {
			                	for (var j = 1; j < nav.length; j++) {
			                    		$(nav[j]).slideUp(350);
			                    		$(nav_list[j]).removeClass('active');
			             	}
			             	console.log(nav[i]);
			             	$(nav[i]).slideDown(350);
			             	$(this).parent().addClass('active');
			             }
			});
		} 

	});
});