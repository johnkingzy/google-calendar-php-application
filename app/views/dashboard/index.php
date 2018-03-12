<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
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
        <a class="navbar-brand" href="#">
            Google Calendar PHP
        </a>
        <div class="pull-right">
        <button class="btn btn-info" data-toggle="modal" data-target="#createModal"> Create New Calendar</button>
        <a href="/home/logout"><button class="btn btn-danger"> Logout</button></a>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <?php
foreach ($data['calendar_lists'] as $calendarLists) {
    echo '<div class="col-md-4">
                                <div class="card card-01">
                                    <div class="card-body">
                                        <span class="badge-box">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <h4 class="card-title">' .
        $calendarLists['summary'] .
        '</h4>
                                        <p class="card-text">Id: <small>' . $calendarLists['id'] . '</small></p>
                                        <p class="card-text">Timezone: <small>' . $calendarLists['timeZone'] . '</small></p>
                                        <a href="/events/create?calendar_id=' . $calendarLists['id'] . '" class="btn btn-primary btn-sm col-sm-4 create-event-btn">Create Event</a>
                                        <a href="/events?id=' . $calendarLists['id'] . '" class="btn btn-info btn-sm col-sm-4 view-event-btn">View Events</a>
                                        <a data-calendar-id="' . $calendarLists['id'] . '" class="btn btn-danger btn-sm col-sm-3 delete-calendar-btn">Delete</a>
                                    </div>
                                </div>
                            </div>';
}
if (count($data['calendar_lists']) === 0) {
    echo '
                    <div class="col-md-12">
                        <div class="card card-01">
                            <div class="card-body">
                                <h4 class="card-title"> You currently don\'t have any calendar. Go ahead and create one!</h4>
                            </div>
                        </div>
                    </div>';
}
?>

            </div>
        </div>
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Create a New Calendar</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group">
                    <label for="calendarInputTItle1">Title</label>
                    <input type="text" class="form-control" id="calendar_summary" aria-describedby="emailHelp" placeholder="Calendar Title">
                </div>
                <div class="form-group">
                    <label for="calendar_description">Description</label>
                    <textarea class="form-control" id="calendar_description" rows="3"></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" data-operation="create-calendar" class="btn btn-primary save-calendar">Save changes</button>
        </div>
        </div>
    </div>
    </div>
    <div id="snackbar">message..</div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="/js/dashboard.js"></script>
</body>
</html>
