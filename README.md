# Google Calendar PHP Application

## About Apllication

This application explores the Google Calendar API, providing users with functionalities that helps you manage your google calendar, such as creating a new calendar, deleting a calendar, creating events for a specific calendar, view all lists of events from a specific calendar, deleting events from calendar and also updating calendar events. This application is built with PHP(7.0), it currently does not utilize any library/framework.

## How to Install on Local Machine

Make sure you have PHP 7 and above installed

*   Clone the reposity using `git clone https://github.com/andela-ksolomon/Google_Calendar_PHP_Application.git`
*   Open your terminal, then navigate to the directory
*   run `php -S localhost:4000 -t public`

## Application Features and Pages

*   GET: `/` index page that displays the login button
*   GET: `/dashboard` dasboard page that displays a list of calendars the looged user has.
*   POST: `/dashboard/create` endpoint that create a new calendar
*   GET: `/events?id=` events page that displays a list of events for a specific calendar
*   GET: `/events/create` create events page that display a form for creating a new event
*   POST: `/events/create` endpoint that's use to create a new event
*   DELETE: `/event/delete` endpoint that's use to delete an event
