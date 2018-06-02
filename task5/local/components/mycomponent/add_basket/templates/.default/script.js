
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
		var output = $('#output');
		e.preventDefault();
        var $that = $(this),
        fData = $that.serialize();
		console.log({data: fData});
		console.log(BX.message('componentPath') + "/class.php");
		$.ajax({
		    url: BX.message('componentPath') + "/class.php",
		    type: $that.attr('method'),
		    data: {data: fData},
		    dataType: 'json',
			error: function(req, text, error){ 
			
				$.fancybox.open('Хьюстон, У нас проблемы! ' + text + ' | ' + error);
			},
			success: function(json) {
				//console.log(json);
			    $.fancybox.open('<div class="message">Сумма вашего заказа : ' + json + '</p></div>');
		    }
		}); 
	});
});