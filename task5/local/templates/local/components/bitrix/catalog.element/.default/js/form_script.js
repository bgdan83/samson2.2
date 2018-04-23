$(document).ready(function(){
	$("#tip5").fancybox({
		'scrolling'		: 'no',
		'titleShow'		: false,
		'onClosed'		: function() {
			$("#login_error").hide();
		}
    });

	$("#login_form").bind("submit", function() {

		if ($("#like_price").val().length < 1 || $("#fio").val().length < 1 || $("#phone").val().length < 1){
			$("#login_error").show();
			$.fancybox.resize();
			return false;
		}

		//$.fancybox.showActivity();
		var $that = $(this),
		fData = $that.serialize(); 
		console.log(fData);
		$.ajax({
		    url: "/ajax/low_price/ajax.php", 
		    type: $that.attr('method'), 
		    data: {form_data: fData},
		    dataType: 'json',
		    complete: function() {
			   $that.html("Мы вам сообщим свое решение"); 
		    }
		});
		return false;
	});
});
