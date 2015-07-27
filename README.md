# Documentation

## Getting Started

1.  [Download phpCornerstone](https://github.com/MadLab/phpCornerstone/archive/master.zip) and unzip to a directory where you can run PHP 5.3+
2.  Install dependencies by running `composer install`* in the root directory
    *   *Or follow these steps if you do not currently use [Composer](https://getcomposer.org)
    *   Navigate to the root folder of the project in terminal
    *   Get the Composer executable using the following command: `curl -sS https://getcomposer.org/installer | php`
    *   Install dependencies using the following command: `php composer.phar install`
3.  Give write permissions for the storage directory: `chmod -R 777 storage`

That's it! Load it in your browser and you should see the same page you see at [phpCornerstone.com](http://phpcornerstone.com).

## Requirements

phpCornerstone was built on the Apache server, with PHP 5.3 and above. To use it on other web servers you only need to replace the .htaccess file and rewrite the traffic to the index.php file with your preferred server's rewrite method.

## File Structure

phpCornerstone users the following folder structure to organize your code:

*   /config - Auto-loaded configuration files
*   /helpers - Auto-loaded helper functions, typically containing static functions
*   /libraries - 3rd party code libraries, etc go here. Libraries can be loaded with `$cs->loadLibrary();`
*   /migrations - Database migration files
*   /models - Your applications models go here. They will be auto-loaded.
*   /pages - Controllers and Views both go here, and will be auto-mapped to URLs
*   /public - Acts as the 'public_html' folder. You can place non-app code, static files, etc here. The .htaccess file inside routes all requests to index.php.
*   /storage - Folder for template cache, and any storage your app may need. Make sure to make the folder writable: `chmod -R 777 storage`
*   /boostrap.php - Code that auto loaded and is executed before the controllers.
*   /routes.php - Custom routes go here.