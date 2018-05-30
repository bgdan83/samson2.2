
$(function() {
	$(".notAuto").hide();
		$( ":input" ).autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: BX.message('componentPath') + "/ajax_s.php",
					dataType: "json",
					data: {
						name_startsWith: request.term
					},
					success: function( data ) {
						response( $.map( data.code, function(key, value) {
						return {
							label: key,
							value: value
							}
						}));
					}
				});
			},
			select: function() {
				$(".notAuto").show(); 
			},	
			minLength: 0,
		});
	$('#my_form').on('submit', function(e){
		e.preventDefault();
        var $that = $(this),
        fData = $that.serialize();
		console.log({data: fData});
		$.ajax({
		    url: $that.attr('action'),
		    type: $that.attr('method'),
		    data: {data: fData},
		    dataType: 'json',
		    success: function(data) {
			    
		    }
		}); 
	});
});