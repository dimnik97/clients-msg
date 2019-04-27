$( document ).ready(function() {
	$.ajax({
	  url: "get_orders.php",
	  success: function(data){
	    data = jQuery.parseJSON(data);
	    data.forEach(function(order, i, data) {
	    	$('.orders').prepend('<li cid='+ order.id +'>'+ order.cl_name +' '+ order.surname +' '+ order.name +'</li>');
		});
	  }
	});
	$.ajax({ // получаем клиентов для выпадающего списка
	  url: "get_clients.php",
	  success: function(data){
	    data = jQuery.parseJSON(data);
	    data.forEach(function(item, i, data) {
	    	$('[name=client]').prepend('<option value='+ item.id +'>'+ item.name +' '+ item.surname +'</option>');
		});
	  }
	});
	$.ajax({ // получаем товары для выпадающего списка
	  url: "get_products.php",
	  success: function(data){
	    data = jQuery.parseJSON(data);
	    data.forEach(function(item, i, data) {
	    	$('[name=product]').prepend('<option value='+ item.id +'>'+ item.name +'</option>');
		});
	  }
	});

	$('.orders').on('click', $('li'), function(e){ // e чтобы определять, куда кликнули
		$form = $('.add_edit_order');
		$form[0].reset();
		$('[name=mod]', $form).val('edit');
		$.ajax({
	  		url: "get_orders.php",
	  		type: "POST",
	  		data: {'cid': $(e.target).attr('cid')},
	  		success: function(data){
	    		data = jQuery.parseJSON(data);
	    		$('[name=client]', $form).val(data[0].cl_id);
	    		$('[name=product]', $form).val(data[0].pr_id);
	    		$('[name=id]', $form).val(data[0].id);
			}
	  	});
		$form.show();
	});

	// $('form').on('submit', function(e){e.preventDefault()}); //отключает перезагрузку после отправки формы, нужно было для тестов

	$('.OKbtn').on('click', function(){
		$form = $('.add_edit_order');
		$data = $form.serialize(); //преобразуется в json

		$.ajax({ // вызывает по url и отправляет json $data
			url: "add_edit_order.php",
			type: "POST",
		  	data: $data,
		  	dataType: 'json',
			success: function(data){
				data = jQuery.parseJSON(data);
			}
		});

	});

	$('.DELbtn').on('click', function(){
		$form = $('.add_edit_order');
		$data = $form.serialize(); //преобразуется в json

		$.ajax({ // вызывает по url и отправляет json $data
			url: "del_order.php",
			type: "POST",
		  	data: $data,
		  	dataType: 'json',
			success: function(data){
				data = jQuery.parseJSON(data);
			}
		});

	});


	$('.ADDbtn').on('click', function(event){
		$form = $('.add_edit_order');
		$form[0].reset();
		$('[name=mod]', $form).val('add');
		$form.show();
		$('.DELbtn').hide();
	});
	


});