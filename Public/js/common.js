$(document).ready(function(){
	//pagewrapper 高度
	var height = $(window).height();
	$(".page-wrapper").css("min-height",height+"px");
	height -= 146;
	$(".wrapper-content").css("min-height",height+"px");
	$(".nav-second-level").hide();
	
	//响应式
	$(window).resize(function(data){
		if($(window).width() < 768) {
			$("body").addClass("mini-navbar");
		}	
		else{
			$("body").removeClass("mini-navbar");
		}
	});

	//模块设置
	var module = $("#module_set").attr("data-module");
	$(".nav-li").each(function (i){
		if(i != 0)
		{
			if($(this).attr("data-module") == module)
			{
				$(this).addClass("active");
				$(this).children(".nav-second-level").show();
			}			
		}
	})

	//折叠二级菜单
	var nav = $(".nav-second-level");
	var nav_list = $(".nav-li");
	$(".nav-button").each(function (i) {
		if(i != 0){
			$(this).click(function () {
				var nav_second_level = $(this).next(".nav-second-level");
				if (nav_second_level.css("display") == "block") {
		                			nav_second_level.slideUp("fast");
		                			$(this).parent().removeClass('active');
		            		} else {
		            			$(".nav-li").each(function(){
		            				$(this).removeClass('active');
		            			});
		            			$(".nav-second-level").each(function(){
		            				$(this).slideUp("fast");
		            			});
				             	nav_second_level.slideDown("fast");
				             	$(this).parent().addClass('active');
			             	}
			});
		} 

	});

	//ibox   Todo 修改选择器
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

	//最小化菜单
	$('.navbar-minimalize').click(function () {
	        $("body").toggleClass("mini-navbar");
	        SmoothlyMenu();
	});

	function SmoothlyMenu() {
		if (!$('body').hasClass('mini-navbar') || $('body').hasClass('body-small')) {
	        		$('#side-menu').hide();
	        		setTimeout(
	        			function () {
	        				$('#side-menu').fadeIn(500);
	        			}, 100);
	    	} else if ($('body').hasClass('fixed-sidebar')){
	        		$('#side-menu').hide();
	        		setTimeout(
	            			function () {
	                			$('#side-menu').fadeIn(500);
	            			}, 300);
	    	} else {
		        $('#side-menu').removeAttr('style');
	    	}
	}
});