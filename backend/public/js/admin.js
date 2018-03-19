$( document ).ready(function() {
	
	$( ".search-form" ).change(function() {
		
		var getParams = '';
		
		var name = $( "#search-name" );
		var short_description = $( "#search-short_description" );
		var active = $( "#search-active" );
		// для товаров
		var count = $( "#search-count" );
		var is_available = $( "#search-is_available" );
		
		// если значение не пустое
		if(name.val()){ getParams += name.attr('name') + '=[' + name.val() + ']&'; }
		if(short_description.val()){ getParams += short_description.attr('name') + '=[' + short_description.val() + ']&'; }
		if(active.val()) { getParams += active.attr('name') + '=' + active.val() + '&'; }
		// для товаров
		if(count.val()) { getParams += count.attr('name') + '=' + count.val() + '&'; }
		if(is_available.val()) { getParams += is_available.attr('name') + '=' + is_available.val() + '&'; }
		
		// удаляем лишний &  с конца строки.
		getParams = getParams.substring(0, getParams.length - 1);
		
		var location = 'http://' + window.location.hostname + window.location.pathname + '?' + getParams;
		
		window.location = location;
	});
	
	
	$('#add-category-button').click(function(){
		// берем выпадающий список у первого селекта
		var htmlOptions = $('.first-category-item').html();
		
		var htmlSelect = 
				'<div class="input-group select-category-item">'
				+ '<select name="Good[category_id][]" type="text" class="col-lg-3 form-control select-category-item">'
				+ htmlOptions
				+ '</select>'
				+ '<span class="input-group-btn">'
				+ '<button onclick="$(this).parents(\'div.input-group\').remove();" class="btn btn-danger delete-category-block" type="button"><span class="glyphicon glyphicon-remove"></span></button>'
				+ '</span>'
				+ '</div>';
		
		$('#select-category-container').append(htmlSelect);
		
	});
	
});
