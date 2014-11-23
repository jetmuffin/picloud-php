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
		height_input.val(parseInt(new_width / scale));
	});
	height_input.keyup(function (e){
		var new_height = $(this).val();
		 width_input.val(parseInt(new_height*scale));
	});	
	$("#scale-reset").click(function(){
		height_input.val(pic_height);
		width_input.val(pic_width);
		$("#basic_slider").val(100);
	});

	$("#basic_slider").noUiSlider({
	            start: 100,
	            behaviour: 'tap',
	            connect: 'lower',
	            range: {
	                'min':  0,
	                'max':  100
	            }
	});
	$("#basic_slider").Link('lower').to($("#slider-value"), null, wNumb({
		decimals: 0,
		postfix:'%'
	}));
	$("#basic_slider").Link('lower').to($("#pic-width"), null, wNumb({
		decimals: 0,
		encoder:function( value ){
			return value * pic_width / 100;
		}
	}));
	$("#basic_slider").Link('lower').to($("#pic-height"), null, wNumb({
		decimals: 0,
		encoder:function( value ){
			return value * pic_height / 100;
		}
	}));		

	var jcrop_api;
	$('#jcrop').Jcrop({
		onChange:   showCoords,
	      	onSelect:   showCoords,
	      	onRelease:  clearCoords
	},function(){
	      	jcrop_api = this;
	});
	$('#jcrop-form').on('change','input',function(e){
	      	var x1 = $('#offset-x1').val();
	      	var x2 = $('#offset-x2').val();
	          	var y1 = $('#offset-y1').val();
	          	var y2 = $('#offset-y2').val();
	          	var width = $("#jcrop-width").val();
	          	var height = $("#jcrop_height").val();
	     	jcrop_api.setSelect([x1,y1,x2,y2]);
	});
	$("#jcrop-reset").click(function(){
		clearCoords();
	});
	function showCoords(c)
	{
		$('#offset-x1').val(c.x);
		$('#offset-x2').val(c.x2);
		$('#offset-y1').val(c.y);
		$('#offset-y2').val(c.y2);
		$('#jcrop-width').val(c.w);
		$('#jcrop-height').val(c.h);
	};
	function clearCoords()
	{
		$('#jcrop-form input').not("#jcrop-submit").val('');
	};
});