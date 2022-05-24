CODE FOR BLOG: Live chat application with Server Sent Events in PHP.
-------------------------------------------------------------------

GETTING STARTED:
---------------
* Clone this repo into your machine and run `composer install` to install the app (in the root dir of this project)
dependencies that the app relies on.
* Run  `php -S localhost:8080` to start the app at `http://localhost:8080/`.
* Open different (incognito) tabs and open any users already in the `srcdata.sqlite` and load
different users, like so `http://localhost:8080/index?me=5` and `http://localhost:8080/index?me=1` where 5 and 1
are real user ids from the users table.
* 