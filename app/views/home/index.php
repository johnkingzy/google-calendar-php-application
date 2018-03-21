<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Home Index</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="/css/styles.css" />
  <link rel="stylesheet" type="text/css" media="screen" href="/css/dashboard.css" />
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
    crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="/js/home.js"></script>
</head>
<body>
<section class="bg-white">
  <div class="container-fluid">
    <div class="d-flex align-items-center flex-column justify-content-center h-100 text-black">
        <img src="http://awesomelytechie.com/wp-content/uploads/2014/11/google-calendar-logo.jpg" />
        <h6 class="mt-5 mb-5 text-center" style="width:40%">
        This application explores the Google Calendar API,
        providing users with functionalities that helps you manage your Google Calendar.
        such as
        <ul class="text-left mt-4 mb-4">
          <li>creating a new calendar,</li>
          <li>deleting a calendar,</li>
          <li>creating events for a specific calendar,</li>
          <li>view all lists of events from a specific calendar,</li>
          <li>deleting events from calendar and</li>
          <li>also updating calendar events</li>
        </ul>. This application is built with PHP(7.0),
        it currently does not utilize any library/framework. </h6>
      <a id="logo" class="btn btn-danger" href="<?=$data['login_url']?>">Login with Google</a>
    </div>
  </div>
</body>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</html>
