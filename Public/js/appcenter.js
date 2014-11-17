$(document).ready(function(){
	$(".chosen-select").chosen();

	//缩放输入框成比例调整
	var height_input = $("#pic-height");
	var width_input = $("#pic-width");
	var pic_height = height_input.attr("value");
	var pic_width = width_input.attr("value");
	var scale = pic_width/pic_height;
	width_input.keyup(function (e){
		var new_width = $(this).val();
		height_input.val(parseInt(new_width/scale));
	});
	height_input.keyup(function (e){
		var new_height = $(this).val();
		 width_input.val(parseInt(new_height*scale));
	});	
	$("#process-reset").click(function(){
		height_input.val(pic_height);
		width_input.val(pic_width);
	});

	$("#basic_slider").noUiSlider({
	            start: 40,
	            behaviour: 'tap',
	            connect: 'upper',
	            range: {
	                'min':  0,
	                'max':  100
	            }
	});


});