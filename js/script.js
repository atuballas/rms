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
		getBoarders(1);
	}
	if($('#rooms-data').length>0){
		$('div#boarders-body td.data-loading').show();
		getRooms(1);
	}
	$('#data-pagination-select').live('change',function(){
		var p = $(this).attr('pagination');
		switch(p){
			case 'boarders':
				getBoarders($('#data-pagination-select').val());
			break;
			case 'rooms':
				getRooms($('#data-pagination-select').val());
			break;
		}
		
	});
});

function getBoarders(a){
	$.ajax({
		type: 'POST',
		url: 'index.php',
		data: {ajaxcall:1, ajaxproc:'getLatestBoarders', index:(a-1)},
		dataType: 'json'
	}).done(function(response){
		$('div#boarders-body td.data-loading').hide();
		if(response.success){
			$('div#boarders-body tbody.data-field').html(appendData(response.data,'boarders'));
			setPagination(response.total_data,'boarders');
		}else if(response.success == false){
			if(response.message=='no data fetched'){
				$('div#boarders-body tbody.data-field').html('<tr><td colspan="8" align="center">No data fetched</td></tr>');
			}
		}
		$('#data-pagination-select').val(a);
	});
}

function getRooms(a){
	$.ajax({
		type: 'POST',
		url: 'index.php',
		data: {ajaxcall:1, ajaxproc:'getLatestRooms', index:(a-1)},
		dataType: 'json'
	}).done(function(response){
		$('div#boarders-body td.data-loading').hide();
		if(response.success){
			$('div#boarders-body tbody.data-field').html(appendData(response.data,'rooms'));
			setPagination(response.total_data,'rooms');
		}else if(response.success == false){
			if(response.message=='no data fetched'){
				$('div#boarders-body tbody.data-field').html('<tr><td colspan="8" align="center">No data fetched</td></tr>');
			}
		}
		$('#data-pagination-select').val(a);
	});
}

function setPagination(a,b){
	var trows = a;
	var totalpages = Math.ceil( trows / pagination_limit );
	var options = '';
	for(var i=0; i<totalpages;i++){
		options += '<option>'+(i+1)+'</option>';
	}
	$('#data-pagination').html('<div class="data-pagination-text">Showing Page:</div><div><select id="data-pagination-select" pagination="'+b+'">'+options+'</select></div><div class="data-pagination-text">of '+totalpages+'</div>');
}

function appendData(a,b){
	var str;
	switch(b){
		case 'boarders':
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
		break;
		case 'rooms':
			for(var i=0; i<a.length;i++){
				str +=   '<tr>';
				str +=	'<td>'+a[i].room_no+'</td>';
				str +=	'<td>'+a[i].room_description+'</td>';
				str +=	'<td>PHP'+a[i].room_rate+'</td>';
				str +=	'<td>'+a[i].room_max+'</td>';
				str +=	'<td>'+a[i].room_amenities+'</td>';
				str +=	'<td>'+ucfirst(a[i].status)+'</td>';
				str +=   '</tr>';
			}
		break;
	}
	return str;
}

function showAddBoardersInterface(){
	$('#boarders-add').show();
	$('#boarders-data').hide();
	resetForm();
}

function showAddRoomsInterface(){
	$('#rooms-add').show();
	$('#rooms-data').hide();
	resetForm();
}

function showBoardersData(){
	$('#boarders-add').hide();
	$('#boarders-data').show();
}

function showRoomsData(){
	$('#rooms-add').hide();
	$('#rooms-data').show();
}

function hideRoomInformation(){
	$('#room-information').hide();
}

function resetForm(){
	$('#add-boader-form input, #add-room-form input, #add-boader-form select, #add-room-form select, #add-room-form textarea').each(function(){
		$(this).removeClass('inputerror');
		$(this).addClass('inputnormal');
	});
	$('#add-boader-form, #add-room-form')[0].reset();
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

function addRoom(){
	// take out red border to inputs and selects if there are
	$('#add-room-form input, #add-room-form select, #add-room-form textarea').each(function(){
		$(this).removeClass('inputerror');
		$(this).addClass('inputnormal');
	});
	$('#form-error').html('');
	$('#form-error').hide();
	
	var validation = true;
	var target = $('#form-error');
	
	var vObject = new Validator();
	vObject.validate('room_no',$('#room_no').val(),{'required':''});
	vObject.validate('room_description',$('#room_description').val(),{'required':''});
	vObject.validate('room_rate',$('#room_rate').val(),{'required':''});
	vObject.validate('max_occupants',$('#max_occupants').val(),{'required':''});
	vObject.validate('room_amenities',$('#room_amenities').val(),{'required':''});
	vObject.validate('room_status',$('#room_status').val(),{'required':''});
	
	if(vObject.result==false){
		validation = false;
		target.html('An error occured during submission. Please see highlighted fields.');
		target.css('color','red');
		target.show();
	}
	if(vObject.result){
		runLightbox('addroom-loader',100);
		$.ajax({
			type: 'POST',
			url: 'index.php',
			data: $('#add-room-form').serialize(),
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