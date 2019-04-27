$( document ).ready(function() {
	$.ajax({
	  url: "get_children.php",
	  success: function(data){
	    data = jQuery.parseJSON(data);
	    data.forEach(function(child, i, data) {
	    	$('.children').prepend('<li cid='+ child.id +'>'+ child.name +' '+ child.age +'</li>');
		});
	  }
	});
	$.ajax({ // получаем клиентов для выпадающего списка
	  url: "get_clients.php",
	  success: function(data){
	    data = jQuery.parseJSON(data);
	    data.forEach(function(client, i, data) {
	    	$('[name=parent]').prepend('<option value='+ client.id +'>'+ client.name +' '+ client.surname +'</option>');
		});
	  }
	});

	$('.children').on('click', $('li'), function(e){ // e чтобы определять, куда кликнули
		$form = $('.add_edit_child');
		$form[0].reset();
		$('[name=mod]', $form).val('edit');
		$.ajax({
	  		url: "get_children.php",
	  		type: "POST",
	  		data: {'cid': $(e.target).attr('cid')},
	  		success: function(data){
	    		data = jQuery.parseJSON(data);
	    		$('[name=name]', $form).val(data[0].name);
	    		$('[name=gender]', $form).val(data[0].gender);
	    		$('[name=age]', $form).val(data[0].age);
	    		$('[name=tall]', $form).val(data[0].tall);
	    		$('[name=parent]', $form).val(data[0].parent);
	    		$('[name=id]', $form).val(data[0].id);
			}
	  	});
		$form.show();
	});

	// $('form').on('submit', function(e){e.preventDefault()}); //отключает перезагрузку после отправки формы, нужно было для тестов

	$('.OKbtn').on('click', function(){
		$form = $('.add_edit_child');
		$data = $form.serialize(); //преобразуется в json

		$.ajax({ // вызывает по url и отправляет json $data
			url: "add_edit_children.php",
			type: "POST",
		  	data: $data,
		  	dataType: 'json',
			success: function(data){
				data = jQuery.parseJSON(data);
			}
		});

	});

	$('.DELbtn').on('click', function(){
		$form = $('.add_edit_child');
		$data = $form.serialize(); //преобразуется в json

		$.ajax({ // вызывает по url и отправляет json $data
			url: "del_child.php",
			type: "POST",
		  	data: $data,
		  	dataType: 'json',
			success: function(data){
				data = jQuery.parseJSON(data);
			}
		});

	});


	$('.ADDbtn').on('click', function(event){
		$form = $('.add_edit_child');
		$form[0].reset();
		$('[name=mod]', $form).val('add');
		$form.show();
		$('.DELbtn').hide();
	});
	


});