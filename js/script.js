$(document).ready(function(){
	$('#rooms').bind('change',function(){
		if($('#rooms').val()==0){
			$('#room-information').hide();
		}else{
			$('#room-information').show();
		}
		
	});
});

function showAddBoardersInterface(){
	$('#boarders-add').show();
	$('#boarders-data').hide();
	resetForm();
}

function showBoardersData(){
	$('#boarders-add').hide();
	$('#boarders-data').show();
}

function hideRoomInformation(){
	$('#room-information').hide();
}

function resetForm(){
	$('#add-boader-form input').each(function(){
		$(this).removeClass('inputerror');
		$(this).addClass('inputnormal');
	});
	$('#add-boader-form select').each(function(){
		$(this).removeClass('inputerror');
		$(this).addClass('inputnormal');
	});
	$('#add-boader-form')[0].reset();
	$('#form-error').html('');
	$('#form-error').hide();
}

function addBoarder(){
	// take out red border to inputs and selects if there are
	$('#add-boader-form input, #add-boader-form select').each(function(){
		$(this).removeClass('inputerror');
		$(this).addClass('inputnormal');
	});
	$('#form-error').html('');
	$('#form-error').hide();
	
	var validation = true;
	var target = $('#form-error');
	
	var vObject = new Validator();
	vObject.validate('name',$('#name').val(),{'required':''});
	vObject.validate('address',$('#address').val(),{'required':''});
	vObject.validate('telephone',$('#telephone').val(),{'required':''});
	vObject.validate('status',$('#status').val(),{'required':''});
	vObject.validate('profession',$('#profession').val(),{'required':''});
	vObject.validate('btype',$('#btype').val(),{'required':''});
	vObject.validate('date-1-dd',$('#date-1-dd').val(),{'required':''});
	vObject.validate('date-1-mm',$('#date-1-mm').val(),{'required':''});
	vObject.validate('date-1',$('#date-1').val(),{'required':''});
	vObject.validate('rooms',$('#rooms').val(),{'required':''});
	
	if(vObject.result==false){
		validation = false;
		target.html('An error occured during submission. Please see highlighted fields.');
		target.css('color','red');
		target.show();
	}
	//console.log('result:'+vObject.result);
	
	if(vObject.result){
		runLightbox('addboarder-loader',100);
		$.ajax({
			type: 'POST',
			url: 'index.php',
			data: $('#add-boader-form').serialize()
		}).done(function(response){
			hideLightbox();
		});
	}
}