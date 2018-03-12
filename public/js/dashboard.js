// Display Snackbar
function displaySnackbar(message, type, next) {
	// Get the snackbar DIV
	var snackbar = document.getElementById('snackbar');
	switch (type) {
		case 'success':
			snackbar.style.backgroundColor = '#59983b';
			break;
		case 'error':
			snackbar.style.backgroundColor = '#dc3545';
			break;

		default:
			break;
	}
	// Add the "show" class to DIV
	snackbar.className = 'show';
	snackbar.innerHTML = message;
	// After 3 seconds, remove the show class from DIV
	setTimeout(function() {
		snackbar.className = snackbar.className.replace('show', '');
		next();
	}, 5000);
}
// Send Ajax Request to create new calendar
$('.save-calendar').on('click', function() {
	$(this).addClass('loading');
	var blank_reg_exp = /^([\s]{0,}[^\s]{1,}[\s]{0,}){1,}$/,
		error = 0,
		parameters;

	$('.input-error').removeClass('input-error');

	if (!blank_reg_exp.test($('#calendar_summary').val())) {
		$('#calendar_summary').addClass('input-error');
		error = 1;
	}
	if (!blank_reg_exp.test($('#calendar_description').val())) {
		$('#calendar_description').addClass('input-error');
		error = 1;
	}
	if (error == 1) return false;
	parameters = {
		summary: $('#calendar_summary').val(),
		description: $('#calendar_description').val(),
		operation: $(this).attr('data-operation'),
	};
	$.ajax({
		type: 'POST',
		url: 'dashboard/create',
		data: { data: parameters },
		dataType: 'json',
		success: function(response) {
			// close the modal if successfull
			$(this).removeClass('loading');
			$('#createModal').modal('hide');
			displaySnackbar('Calendar was created successfully', 'success', location.reload());
		},
		error: function(response) {
			// close the modal if an error occur then display the messages to the user
			$(this).removeClass('loading');
			displaySnackbar(json_decode(response), 'error');
			// alert(response.responseJSON.message);
		},
	});
});
// Send Ajax Request to Delete Event
$('.delete-calendar-btn').on('click', function(e) {
	$(this).addClass('loading');
	// Event details
	var parameters = {
		calendar_id: $(this).attr('data-calendar-id'),
	};
	console.log('parameters', parameters);
	$.ajax({
		type: 'POST',
		url: 'dashboard/delete',
		data: { data: parameters },
		dataType: 'json',
		success: function(response) {
			$(this).removeClass('loading');
			displaySnackbar('Calendar was deleted successfully', 'success', location.reload);
		},
		error: function(response) {
			$(this).removeClass('loading');
			alert(response.responseJSON.message);
		},
	});
});
