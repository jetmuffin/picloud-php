$(document).ready(function(){

	$(".nav-second-level").hide();
	
	//module set
	var module = $("#module_set").attr("data-module");
	$(".nav-li").each(function(){
		if($(this).attr("data-module") == module)
		{
			$(this).addClass("active");
			$(this).children(".nav-second-level").show();
		}
	})

	//折叠二级菜单
	var nav = $(".nav-second-level");
	var nav_list = $(".nav-li");
	$(".nav-button").each(function (i) {
		if(i != 0){
			$(this).click(function () {
				if ($(nav[i]).css("display") == "block") {
		                			$(nav[i]).slideUp(350);
		                			$(this).parent().removeClass('active');
		            		} else {
			                	for (var j = 0; j < nav.length; j++) {
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

	//ibox
	var ibox = $(".ibox");
	$(".ibox-tools .close-link").each(function (i){
		$(this).click(function(){
			$(ibox[i]).fadeOut();
		});
	});
	$(".ibox-tools .collapse-link").each(function (i){
		$(this).click(function(){
			$(ibox[i]).children(".ibox-content").slideToggle("fast");
			console.log($(this).children());
			$(this).children(i).toggleClass("fa-chevron-down");
		});
	});	


});