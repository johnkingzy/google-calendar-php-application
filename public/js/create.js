// Selected time should not be less than current time
function AdjustMinTime(ct) {
	var dtob = new Date(),
		current_date = dtob.getDate(),
		current_month = dtob.getMonth() + 1,
		current_year = dtob.getFullYear();

	var full_date =
		current_year +
		'-' +
		(current_month < 10 ? '0' + current_month : current_month) +
		'-' +
		(current_date < 10 ? '0' + current_date : current_date);

	if (ct.dateFormat('Y-m-d') == full_date) this.setOptions({ minTime: 0 });
	else this.setOptions({ minTime: false });
}

function getUrlParameter(sParam) {
	var sPageURL = decodeURIComponent(window.location.search.substring(1)),
		sURLVariables = sPageURL.split('&'),
		sParameterName,
		i;

	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split('=');

		if (sParameterName[0] === sParam) {
			return sParameterName[1] === undefined ? true : sParameterName[1];
		}
	}
}

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

// DateTimePicker plugin : http://xdsoft.net/jqplugins/datetimepicker/
$('#event-start-time, #event-end-time').datetimepicker({
	format: 'Y-m-d H:i',
	minDate: 0,
	minTime: 0,
	step: 5,
	onShow: AdjustMinTime,
	onSelectDate: AdjustMinTime,
});
$('#event-date').datetimepicker({ format: 'Y-m-d', timepicker: false, minDate: 0 });

$('#event-type').on('change', function(e) {
	if ($(this).val() == 'ALL-DAY') {
		$('#event-date').show();
		$('#event-start-time, #event-end-time').hide();
	} else {
		$('#event-date').hide();
		$('#event-start-time, #event-end-time').show();
	}
});

// Send an ajax request to create event
$('#create-update-event').on('click', function(e) {
	$(this).addClass('loading');
	var blank_reg_exp = /^([\s]{0,}[^\s]{1,}[\s]{0,}){1,}$/,
		error = 0,
		parameters;

	$('.input-error').removeClass('input-error');

	if (!blank_reg_exp.test($('#event-title').val())) {
		$('#event-title').addClass('input-error');
		error = 1;
	}

	if ($('#event-type').val() == 'FIXED-TIME') {
		if (!blank_reg_exp.test($('#event-start-time').val())) {
			$('#event-start-time').addClass('input-error');
			error = 1;
		}

		if (!blank_reg_exp.test($('#event-end-time').val())) {
			$('#event-end-time').addClass('input-error');
			error = 1;
		}
	} else if ($('#event-type').val() == 'ALL-DAY') {
		if (!blank_reg_exp.test($('#event-date').val())) {
			$('#event-date').addClass('input-error');
			error = 1;
		}
	}

	if (error == 1) return false;

	if ($('#event-type').val() == 'FIXED-TIME') {
		// If end time is earlier than start time, then interchange them
		if ($('#event-end-time').datetimepicker('getValue') < $('#event-start-time').datetimepicker('getValue')) {
			var temp = $('#event-end-time').val();
			$('#event-end-time').val($('#event-start-time').val());
			$('#event-start-time').val(temp);
		}
	}

	// Event details
	parameters = {
		calendar_id: getUrlParameter('calendar_id') || 'primary',
		title: $('#event-title').val(),
		start_time:
			$('#event-type').val() == 'FIXED-TIME'
				? $('#event-start-time')
						.val()
						.replace(' ', 'T') + ':00'
				: null,
		end_time:
			$('#event-type').val() == 'FIXED-TIME'
				? $('#event-end-time')
						.val()
						.replace(' ', 'T') + ':00'
				: null,
		event_date: $('#event-type').val() == 'ALL-DAY' ? $('#event-date').val() : null,
		all_day: $('#event-type').val() == 'ALL-DAY' ? 1 : 0,
		operation: $(this).attr('data-operation'),
		event_id: $(this).attr('data-operation') == 'create' ? null : $(this).attr('data-event-id'),
	};

	$('#create-update-event').attr('disabled', 'disabled');
	$.ajax({
		type: 'POST',
		url: '/events/create',
		data: { data: parameters },
		dataType: 'json',
		success: function(response) {
			$('#create-update-event').removeClass('loading');
			$('#create-update-event').removeAttr('disabled');

			if (parameters.operation == 'create') {
				$('#create-update-event')
					.text('Update Event')
					.attr('data-event-id', response.event_id)
					.attr('data-operation', 'update');
				$('#delete-event').show();
				$('#create-update-event').removeClass('loading');
				displaySnackbar('Event was created successfully', 'success');
			} else if (parameters.operation == 'update') {
				$('#create-update-event').removeClass('loading');
				displaySnackbar('Event with ID ' + parameters.event_id + ' was updated', 'success');
			}
		},
		error: function(response) {
			$('#create-update-event').removeClass('loading');
			$('#create-update-event').removeAttr('disabled');
			displaySnackbar(response.responseJSON.message, 'error', location.reload());
		},
	});
});

// Send an ajax request to delete event
$('#delete-event').on('click', function(e) {
	// Event details
	$(this).addClass('loading');
	var parameters = {
		operation: 'delete',
		event_id: $('#create-update-event').attr('data-event-id'),
		calendar_id: getUrlParameter('calendar_id') || 'primary',
	};

	$('#create-update-event').attr('disabled', 'disabled');
	$('#delete-event').attr('disabled', 'disabled');
	$.ajax({
		type: 'POST',
		url: '/events/delete',
		data: { data: parameters },
		dataType: 'json',
		success: function(response) {
			$('#delete-event').removeClass('loading');
			$('#delete-event')
				.removeAttr('disabled')
				.hide();

			$('#form-container input').val('');
			$('#create-update-event').removeAttr('disabled');
			$('#create-update-event')
				.text('Create Event')
				.attr('data-event-id', '')
				.attr('data-operation', 'create');

			displaySnackbar('Event ID ' + parameters.event_id + ' deleted', 'success', redirect());
		},
		error: function(response) {
			$('#delete-event').removeClass('loading');
			$('#delete-event').removeAttr('disabled');
			displaySnackbar(response.responseJSON.message, 'error');
		},
	});
	function redirect() {
		const calendar_id = getUrlParameter('calendar_id');
		window.location.href = '/events?id=' + calendar_id;
	}
});
