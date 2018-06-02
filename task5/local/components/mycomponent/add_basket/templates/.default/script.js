
$(function() {
	
	$("div input.notAuto").hide();
		$( "div input.auto" ).autocomplete({
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
				$("div input.notAuto").show(); 
			},	
			minLength: 0,
		});
	$('#form').on('submit', function(e){
		
		e.preventDefault();
        var $that = $(this),
        fData = $that.serialize();
		console.log({data: fData});
		$.ajax({
		    url: $that.attr('action'),
		    type: $that.attr('method'),
		    data: {data: fData},
		    dataType: 'json',
			
			complete: function(){ // функция вызывается по окончании запроса
				$.fancybox.open('<div class="message">You are awesome!</p></div>');
			},
			success: function(data) {
			    
		    }
		}); 
	});
});