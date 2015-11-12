jQuery(document).ready(function($) {
	jQuery('body').on('click', '#menu_toggle', function(event) {
		event.preventDefault();
		/* Act on the event */

		$.ajax({
			url: ROOT_PATH + "common/ajax/toggle_sidebar.php",
			type: 'GET',
			dataType: 'json'
		})
		.done(function(response) {
			// console.log(response);
		})
		.fail(function() {
			// console.log("error");
		})
		.always(function() {
			// console.log("complete");
		});
		
	});
});