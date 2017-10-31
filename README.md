# PES Project

The project was built using the Slim framework. 

## Install the Application

* Copy all of the files into the Document Root

* Run composer install to acquire all of the other libraries needed.

* Point your virtual host document root to your new application's `public/` directory.

* Ensure `logs/` is web writeable.

* Edit src/settings.php to add the database credentials.

* Import perproject.sql into either a MySQL ot MarieDB database

## URL

* The API has been set up on a Digital Ocean droplet. To access you need to add the following to your local hosts file:

	146.185.136.56  pesproject.test

* To view the API visit http://pesproject.test/index.php followed by the relevant endpoint

## Hindsight

On reflection there are some things that I would do differently if there was more time:

* Actually finish the project and add all the required validation

* Add more logging

* Trap and report for errors

* Include a routine to differentiate between production and development to report the errors differently for each environment

* Fix the highly annoying issue of having to include index.php in the URL of the API
