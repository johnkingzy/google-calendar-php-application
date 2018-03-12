# Google Calendar PHP Application

## About Apllication

This application explores the Google Calendar API, providing users with functionalities that helps you manage your google calendar, such as creating a new calendar, deleting a calendar, creating events for a specific calendar, view all lists of events from a specific calendar, deleting events from calendar and also updating calendar events. This application is built with PHP(7.0), it currently does not utilize any library/framework.

## How to Install on Local Machine

Make sure you have PHP 7 and above installed,

*   Register a Google Application and enable Calendar API.
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

## How to Register a Google Application and enable Calendar API

You need a Google Application so that you can get API keys through which you can make API calls. If you have an existing Google Application you can use that, just make sure that you enable Calendar API. If you don't have an existing Google Application follow the below steps to get one :

*   Go to Google API Console

*   Create a project by clicking "Select a project" (at the top), and then clicking on the "+" button in the dialogbox. In the next screen enter your project name, and agree with the Terms and Conditions.

*   After the project is created, select the created project from the top dropdown.
*   Click the Library tab on the left. Search for "Calendar API" and enable it. By enabling "Calendar API", your Google application can get access to the user's Calendar.
*   Now click on Credentials tab on the left. In the next screen click on "OAuth consent screen". Fill out the mandatory fields. Save it.
*   Now click on the "Credentials" tab (just beside "OAuth consent screen"). In the screen, click on "Create credentials". Choose "OAuth Client ID" as the type.
*   In the next screen fill out the name. The Application type should be "Web application"
*   Add a redirect url in the section Authorised redirect URIs. This url should point to your redirect url script. A redirect url is the url where Google redirects the user after he authorizes your Google Application.

*   In this project, the redirect url should point to http://localhost:4000/home
    You can leave out Authorised JavaScript origins as blank. Click on the Create button.
    On success you will get the App Client ID and App Secret. Save those as they will be required later.
