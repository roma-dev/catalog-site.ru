$( document ).ready(function() {
	
	$( ".search-form" ).change(function() {
		
		var getParams = '';
		
		var name = $( "#search-name" );
		var short_description = $( "#search-short_description" );
		var active = $( "#search-active" );
		
		// если значение не пустое
		if(name.val()){ getParams += name.attr('name') + '=[' + name.val() + ']&'; }
		if(short_description.val()){ getParams += short_description.attr('name') + '=[' + short_description.val() + ']&'; }
		if(active.val()) { getParams += active.attr('name') + '=' + active.val() + '&'; }
		
		// удаляем лишний &  с конца строки.
		getParams = getParams.substring(0, getParams.length - 1);
		
		var location = 'http://' + window.location.hostname + window.location.pathname + '?' + getParams;
		
		window.location = location;
	});
});