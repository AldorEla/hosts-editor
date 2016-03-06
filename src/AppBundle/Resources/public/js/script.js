$(document).ready(function() {
	$('.js-edit-host').click(function() {
		$.ajax({
		  url: $(this).data('edit-url'),
		  data: {
		    zipcode: 97201
		  },
		  success: function( data ) {
		    $( "#weather-temp" ).html( "<strong>" + data + "</strong> degrees" );
		  }
		});
	});
});