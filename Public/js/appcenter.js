$(document).ready(function(){


	var image_name = 'test.jpg';
	var scale_link = 'http://localhost:8080/PicServer/ScaleImage';
	var crop_link = 'http://localhost:8080/PicServer/CropImage';
	var watermask_text_link = 'http://localhost:8080/PicServer/WaterMask'
	var uid = $('#user_id').html();

	var val = $('#spaces_select').val();
	var url = "http://localhost:8080/PicServer/ListPicture";
	$(".chosen-select").chosen();
	select_reload(val,uid,url);

	//select 重新加载方法
	function select_reload(val,uid,url){
		$.getJSON(url, { space: val, uid: uid }, function(json){
			if(json.Picture) {
	 		 	var options = '<option></option>';
			 	$.each(json.Picture,function(n,value){
			 		options += '<option>' + value.name + '</option>';
			 	});
			 	$('#pictures_select').html(options);
			 	$(".chosen-select").trigger("chosen:updated");			
			 } else {
			 	$('#pictures_select').html('<option></option>');
			 	$(".chosen-select").trigger("chosen:updated");
			 }
		});	
	}

	//ajax添加chosen-select
	$('#spaces_select').change(function(){
		var val = $(this).val();
		var url = "http://localhost:8080/PicServer/ListPicture";
		select_reload(val,uid,url);
	});

	//ajax加载图片
	$(".chosen-select").chosen().change(function(){
		image_name = $('.chosen-single span').html();
		var url_base = 'http://localhost:8080/PicServer/ScaleImage?uid='+uid+'&image=';
		var url_overview = url_base + image_name + '&width=270';
		var url_crop = url_base + image_name + '&width=500';
		var url_watermask = url_base + image_name + '&width=500';
		$('#picture_overview').attr('src',url_overview);
		$('#watermask-text-pic').attr('src',url_watermask);
		$('.watermask-text-link').hide();
		$('#jcrop-word').hide();
	//	$('#jcrop').attr('src',url).show();
		$('#jcrop').Jcrop({
			onChange:   showCoords,
		      	onSelect:   showCoords,
		      	onRelease:  clearCoords
		},function(){
		      	jcrop_api = this;
		});
		jcrop_api.setImage(url_crop);
	});

	//缩放输入框成比例调整
	var height_input = $("#pic-height");
	var width_input = $("#pic-width");
	var pic_height = height_input.attr("value");
	var pic_width = width_input.attr("value");
	var scale = pic_width/pic_height;

	//width_input 键盘监听
	width_input.keyup(function (e){
		var new_width = $(this).val();
		var new_height = parseInt(new_width / scale);
		height_input.val(new_height);
		$(".scale-link").html(scale_link +'?image=' + image_name +
																		 "&width=" + new_width + "&height=" + new_height);
	});

	//height_input 键盘监听
	height_input.keyup(function (e){
		var new_height = $(this).val();
		var new_width = parseInt(new_height*scale);
		width_input.val(new_width);
		$(".scale-link").html(scale_link +'?image=' + image_name + "&width=" +
													 new_width + "&height=" + new_height);
	});	

	//reset事件
	$("#scale-reset").click(function(){
		height_input.val(pic_height);
		width_input.val(pic_width);
		$("#basic_slider").val(100);
	});

	//noUiSlider设置
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
	$("#basic_slider").on({
		slide: function(){
			var value = $(this).val();
			var height = parseInt(value * pic_height / 100);
			var width = parseInt(value * pic_width / 100);
			var new_link = scale_link +'?image=' + image_name + "&width=" +
										 width + "&height=" + height;
			$(".scale-link").html(new_link);
		}
	});

	//jcrop设置
	var jcrop_api;
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
		$('.crop-link').html(crop_link +'?image=' + image_name + '&width=' + c.w +
				'&height=' + c.h + '&offsetX=' + c.x + '&offsetY=' + c.y);
	};
	function clearCoords()
	{
		$('#jcrop-form input').not("#jcrop-submit").val('');
	};

	//watermask设置
	$("#watermask-text").keyup(function (e){
		var text = $(this).val();
		var new_link = watermask_text_link +'?image=' + image_name +
																		 '&type=text&text=' + text;
		$('.watermask-text-link').html(new_link);
	});



});