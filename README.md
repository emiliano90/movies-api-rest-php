# Laravel 8.75 REST APi

This API is created using Laravel 8.75 API Resource. It has Users, Director, Actor, Movie, TvShow, Season, Episode and Genre. Protected routes are also added. Protected routes are accessed via JWT access token.

#### Following are the Models

User  
Director  
Actor  
Movie  
TvShow  
Season  
Episode  
Genre

#### Usage

Clone the project via `git clone` or download the zip file.

##### .env

Create a database and connect your database in `.env` file.

Run Migration
Run the following command to create migrations in the databbase.

`php artisan migrate`

#### API EndPoints

##### Authenticate

Auth POST Create http://localhost:8000/api/auth/login  
Auth POST Create http://localhost:8000/api/auth/register  
Auth POST Create http://localhost:8000/api/auth/logout  
Auth POST Create http://localhost:8000/api/auth/refresh  
Auth POST Create http://localhost:8000/api/auth/login  
Auth GET Single http://localhost:8000/api/auth/user-profile

##### Movie

Movie GET All http://localhost:8000/api/v1/movies  
Movie GET Single http://localhost:8000/api/v1/movies/1  
Movie POST Create http://localhost:8000/api/v1/movies  
Movie PUT Update http://localhost:8000/api/v1/movies/1  
Movie DELETE destroy http://localhost:8000/api/v1/movies/1

Same For TvShows, Actors, Directors, Seasons, Episodes, Genres.

##### Movies actors

Movies actors GET http://localhost:8000/api/v1/movies/{movie}/actors  
Movies actors GET All http://localhost:8000/api/v1/movies/{movie}/actors  
Movies actors GET Single http://localhost:8000/api/v1/movies/{movie}/actors/1  
Movies actors POST Create http://localhost:8000/api/v1/movies/{movie}/actors  
Movies actors DELETE destroy http://localhost:8000/api/v1/movies/{movie}/actors/1

##### TvShows actors

TvShows actors GET http://localhost:8000/api/v1/tvshows/{tvshow}/actors  
TvShows actors GET All http://localhost:8000/api/v1/tvshows/{tvshow}/actors  
TvShows actors GET Single http://localhost:8000/api/v1/tvshows/{tvshow}/actors/1  
TvShows actors POST Create http://localhost:8000/api/v1/tvshows/{tvshow}/actors  
TvShows actors DELETE destroy http://localhost:8000/api/v1/tvshows/{tvshow}/actors/1
