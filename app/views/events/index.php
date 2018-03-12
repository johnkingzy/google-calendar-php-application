<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Google Calendar PHP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/dashboard.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/snackbar.css" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
    crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.js"></script>
</head>
<body>
<section>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="/">
            Google Calendar PHP
        </a>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <?php
foreach ($data['events_list'] as $events) {
    echo '<div class="col-md-3">
                <div class="card card-01 event-card">
                    <div class="card-body">
                        <span class="badge-box">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <h4 class="card-title">' .
    $events['summary'] .
    '</h4>
                        <p class="card-text">Created on: <small>' . date_format(new DateTime($events['created']), 'Y-m-d H:i:s') . '</small></p>
                        <p class="card-text">Status: <small>' . $events['status'] . '</small></p>
                        <u><p class="crad-text"> Start Date Info</p></u>';
    foreach ($events['start'] as $key => $value) {
        echo '<p class="card-text">' . $key . ': <small>' . date_format(new DateTime($value), 'Y-m-d H:i:s') . '</small></p>';
    }
    echo '<u><p class="crad-text"> End Date Info</p></u>';
    foreach ($events['end'] as $key => $value) {
        echo '<p class="card-text">' . $key . ': <small>' . date_format(new DateTime($value), 'Y-m-d H:i:s') . '</small></p>';
    }
    echo '
    <button event-id="' . $events['id'] . '" class="delete-event btn btn-center btn-danger"> Delete Event</button>
    </div>
                </div>
            </div>';
}
if (count($data['events_list']) === 0) {
    echo '
    <div class="col-md-12">
        <div class="card card-01">
            <div class="card-body">
                <h4 class="card-title"> This Calendar has no event </h4>
            </div>
        </div>
    </div>';
}
?>

        </div>
    </div>
</section>
<div id="snackbar">message..</div>
</body>
<!-- <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script> -->
<script>
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

// Send an ajax request to delete event
$('.delete-event').on('click', function(e) {
	// Event details
	$(this).addClass('loading');
	var parameters = {
		operation: 'delete',
		event_id: $(this).attr('event-id'),
		calendar_id: getUrlParameter('id') || 'primary',
    };
    const self = this;
	$('.delete-event').attr('disabled', 'disabled');
	$.ajax({
		type: 'POST',
		url: '/events/delete',
		data: { data: parameters },
		dataType: 'json',
		success: function(response) {
			$(self).removeClass('loading');
			$(self)
				.removeAttr('disabled')
				.hide();
			displaySnackbar('Event ID ' + parameters.event_id + ' deleted', 'success', location.reload());
		},
		error: function(response) {
			$(self).removeClass('loading');
			$(self).removeAttr('disabled');
			displaySnackbar(response.responseJSON.message, 'error');
		},
    });
    });
</script>
</html>
