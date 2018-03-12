<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="/css/dashboard.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/snackbar.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
				<div class="col-md-12">
					<div class="card">
					<div id="form-container">
						<h3 class="text-center">Create a New Event</h3>
						<input class="form-control" type="text" id="event-title" placeholder="Event Title" autocomplete="off" />
						<select class="custom-select" id="event-type"  autocomplete="off">
							<option value="FIXED-TIME">Fixed Time Event</option>
							<option value="ALL-DAY">All Day Event</option>
            </select>
            <hr />
						<input class="form-control" type="text" value="" id="event-start-time" placeholder="Event Start Time" autocomplete="off" />
						<input class="form-control" type="text" id="event-end-time" placeholder="Event End Time" autocomplete="off" />
						<input class="form-control" type="text" id="event-date" placeholder="Event Date" autocomplete="off" />
						<button class="btn btn-primary" id="create-update-event" data-operation="create" data-event-id="">Create Event</button>
						<button class="btn btn-danger" id="delete-event" style="display:none">Delete Event</button>
					</div>
					</div>
				</div>
			</div>
    </div>
    <div id="snackbar">message..</div>
</section>
<script src="/js/create.js"></script>
</body>
</html>
