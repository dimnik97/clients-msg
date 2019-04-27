$( document ).ready(function() {
	$.ajax({
	  url: "get_clients.php",
	  success: function(data){
	    data = jQuery.parseJSON(data);
	    data.forEach(function(client, i, data) {
	    	$('.clients').prepend('<li cid='+ client.id +'>'+ client.name +' '+ client.surname +'</li>');
		});
	  }
	});

	$('.clients').on('click', $('li'), function(e){
		$form = $('.add_edit_client');
		$form[0].reset();
		$('[name=mod]', $form).val('edit');
		$.ajax({
	  		url: "get_clients.php",
	  		type: "POST",
	  		data: {'cid': $(e.target).attr('cid')},
	  		success: function(data){
	    		data = jQuery.parseJSON(data);
	    		$('[name=name]', $form).val(data[0].name);
	    		$('[name=surname]', $form).val(data[0].surname);
	    		$('[name=c_info]', $form).val(data[0].c_info);
	    		$('[name=id]', $form).val(data[0].id);
			}
	  	});
		$form.show();
	});


	$('.OKbtn').on('click', function(){
		$form = $('.add_edit_client');
		$data = $form.serialize();

		$.ajax({
			url: "add_edit_client.php",
			type: "POST",
		  	data: $data,
		  	dataType: 'json',
			success: function(data){
				data = jQuery.parseJSON(data);
			}
		});

	});


	$('.ADDbtn').on('click', function(event){
		$form = $('.add_edit_client');
		$form[0].reset();
		$('[name=mod]', $form).val('add');
		$form.show();
		$('.DELbtn').hide();
	});
	


});