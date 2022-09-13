# The Snail Problem

A snail is at the bottom of a well of H height and wants to climb to the top. The snail can climb U feet while the sun is up, but slides down D feet at night while sleeping. The snail has a fatigue factor of F %, which means that on each successive day the snail climbs F % * H = W feet less than it did the previous day. The distance lost to fatigue is always F % of the *first\* day's climbing distance. All four numbers must be between 1 and 100, inclusive.

Depending on the parameters of the problem, the snail will eventually either leave the well — Success — or slide back to the bottom of the well — Failure.

## About the App

This app aims to solve the snail problem. It provides the solution as a RESTful web service that takes in the parameters of the problem and provides the solution as a string, which says if the snail succeeded or failed. This solution is facilitated by a User Interface (UI) hosted on the web, which can be found [here](https://snail-view.herokuapp.com/).

### Architecture

This application follows the Model-View-Controller (MVC) architectural design pattern. As the backend portion of the solution, this repository contains the Model and Controller pieces of the architecture. The View (frontend) can be found [here](https://github.com/esarrit/snail-problem-frontend).

### Backend Tech Stack

This application was developed using the PHP web application framework, Laravel. It provides great tools for building robust applications and allows for the implementation of MVC patterns smoothly. See below for more detals.

The database for this application is a PostgreSQL database instance hosted on [Heroku](https://www.heroku.com/).

#### Relevant Files for the Model

-   [config/database.php](https://github.com/esarrit/snail-problem/blob/master/config/database.php): allows the database connection set up
-   [Migrations file](https://github.com/esarrit/snail-problem/blob/master/database/migrations/2022_09_11_150648_create_snail_logs_table.php): defines the schema for the database and allows you to set up that schema with a php command after the database is configured
-   [Seeders](https://github.com/esarrit/snail-problem/tree/master/database/seeders): populate your database with mock data for testing via a php command.
-   [app/Models](https://github.com/esarrit/snail-problem/tree/master/app/Models): provides mapping for the database schema by leveraging Laravel's Eloquent ORM (obejct relational mapper). It works great out of the box and performs a lof of the heavy lifting related to database mapping and queries automatically.

#### Relevant files for the Controller

-   [app/Http/Controllers](https://github.com/esarrit/snail-problem/tree/master/app/Http/Controllers): contains control logic. The endpoints of the RESTful service that will be reachable by outside parties (API) live here.

## API Specification

### List the snail's attempts to escape the well

You can see a list of all the attempts the snail has made to escape the well, which includes the date, attempt parameters, and result.

`GET /api/snailAttempts`

### Calculate the result of a snail escape attempt given a set of conditions

You can provide the parameters for the snail to attempt escaping the well. The result will be calculated and returned to you. The parameters and its corresponding result will be stored in the database.

`PUT /api/snailCheck`

#### Parameters

-   h: height of the well in feet
-   u: distance in feet that the snail can climb during the day
-   d: distance in feet that the snail slides down during the night
-   f: fatigue factor expressed as a percentage

All parameters are required. All parameters must be between 1 and 100, inclusive.

## Running the app Locally

### Requirements

-   PHP and [Composer](https://getcomposer.org) installed
-   [Node and NPM](https://nodejs.org/en/) for dependency and package management.

If you are developing on macOS, PHP and Composer can be installed via Homebrew.

### Steps

1. Use `npm install` to download all project dependencies.
2. Start Laravel's local development server using the Laravel's Artisan CLI serve command: `php artisan serve`
3. One the development server starts, the application will be accessible at `http://localhost:8000`
4. You can now make API calls via cURL, Postman, or other methods. An example of the GET endpoint looks like `localhost:8000/api/snailAttempts`
