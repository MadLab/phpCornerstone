phpCornerstone
==============

phpCornerstone is a MVC framework focused on code organization, intelligent routing, and facilitating DRY principles.


REQUIREMENTS
------------

phpCornerstone was built on the Apache server, with PHP 5.3 and above. To use it on other web servers you only need to replace the .htaccess file and rewrite the traffic to the index.php file with your preferred server's regex rewrite method.


INSTALLATION
------------

Just place everything in the public_html folder. Then, just CHMOD -R 777 the 'storage' folder. You should see the following:

- **config/** - Auto-loaded configuration files
- **helpers/** - Auto-loaded helper functions, typically containing static functions
- **libraries/** - 3rd party code libraries, etc go here. Libraries can be loaded with $cs->loadLibrary();
- **models/** - Your applications models go here. They will be auto-loaded. 
- **pages/** - Controllers and Views both go here, and will be auto-mapped to URLs.
- **storage/** - Place for template cache, and any storage your app may need. Chmod -R 777 this folder.
- **public/** - Acts as the 'public_html' folder - can place non-app code, static files, etc here
- **.htaccess** - Apache file that routes all requests to index.php
- **routes.php** - File for defining custom URL mapping


THE END
-----------

In the future we would love to have proper documentation, tutorials, reference material, etc to [phpCornerstone.com](http://www.phpcornerstone.com/). Until then, this is the best you got (sorry). Contact Us if you have any questions, or would like to help out. 
