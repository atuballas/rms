$(document).ready(function(){
	$('#rooms').bind('change',function(){
		if($('#rooms').val()==0){
			$('#room-information').hide();
		}else{
			$('#room-information').show();
		}
	});
	if($('#boarders-data').length>0){
		$('div#boarders-body td.data-loading').show();
		$.ajax({
			type: 'POST',
			url: 'index.php',
			data: {ajaxcall:1, ajaxproc:'getLatestBoarders', index:0},
			dataType: 'json'
		}).done(function(response){
			$('div#boarders-body td.data-loading').hide();
			if(response.success){
				$('div#boarders-body tbody.data-field').html(appendData(response.data));
				setPagination(response.total_data);
			}else if(response.success == false){
				if(response.message=='no data fetched'){
					$('div#boarders-body tbody.data-field').html('<tr><td colspan="8" align="center">No data fetched</td></tr>');
				}
			}
		});
	}
	$('#data-pagination-select').live('change',function(){
		
	});
});

function setPagination(a){
	var trows = a;
	var totalpages = Math.ceil( trows / 10 );
	var options = '';
	for(var i=0; i<totalpages;i++){
		options += '<option>'+(i+1)+'</option>';
	}
	options += '<option>'+(i+1)+'</option>';
	$('#data-pagination').html('<div class="data-pagination-text">Showing Page:</div><div><select id="data-pagination-select">'+options+'</select></div><div class="data-pagination-text">of '+totalpages+'</div>');
}

function appendData(a){
	var str;
	for(var i=0; i<a.length;i++){
		str +=   '<tr>';
		str +=	'<td>'+a[i].name+'</td>';
		str +=	'<td>'+a[i].address+'</td>';
		str +=	'<td>'+a[i].telephone+'</td>';
		str +=	'<td>'+ucfirst(a[i].status)+'</td>';
		str +=	'<td>'+a[i].profession+'</td>';
		str +=	'<td>'+a[i].checked_in_date+'</td>';
			str +=	'<td>'+ucfirst(a[i].boarding_type)+'</td>';
		str +=	'<td>'+( ( a[i].board_status == 1 ) ? 'Active' : 'Inactive' )+'</td>';
		str +=   '</tr>';
	}
	return str;
}

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
	if(vObject.result){
		runLightbox('addboarder-loader',100);
		$.ajax({
			type: 'POST',
			url: 'index.php',
			data: $('#add-boader-form').serialize(),
			dataType: 'json'
		}).done(function(response){
			hideLightbox();
			if( response.success ){
				window.location.reload(true);
			}
		});
	}
}

function ucfirst(a){
	return a.slice(0,1).toUpperCase() + a.substring(1);
}