Building Web Applications using MySQL and PHP

A simple on-line photo gallery application using PHP and MySQL

Deploy Location : http://titan.dcs.bbk.ac.uk/~amusso01/w1fma/index.php

Author: Andrea Musso 08/08/2017

Installation:

1. Change value in the includes/config.php file to match your environment:
    1.1. $FILE_ROOT to match the root URL;
    1.2. database credentials to match your db;
    1.3. languages supported English->'en' and Italian->'it';
    1.4.

2. Create SQL Database, use the imageInfoDb.sql file provided in the root folder of the application

3. Make sure to set the right permission on the storedImage folder and subfolder (write, read, execute)

The application include a simple web service at this location:

http://titan.dcs.bbk.ac.uk/~amusso01/w1fma/api.php

the parameter to pass to this service is the id of the photo, api call exemple:

http://titan.dcs.bbk.ac.uk/~amusso01/w1fma/api.php?id=6

This call will return the id, filename, description, title, size, width, height and date of the uploaded image
in a JSON format.