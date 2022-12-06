( function ( $ ) {
	$('#pt_form').submit( function(e) {
		//alert("sss")
		e.preventDefault();
		var data = $(this).serialize();

		$.ajax({
			url: WPPT.ajaxurl,
			data: data,
			type: 'POST',
			dataType: 'json',
			success: function(resp) {
				console.log('updated')
			},
			error: function(error) {
				console.log(error)
			}
		})
	} );
} )( jQuery );