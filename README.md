    <h1>Documentation</h1>

    <h2>Getting Started</h2>
    <ol>
        <li><a href="https://github.com/MadLab/phpCornerstone/archive/master.zip"><i class="fa fa-download"></i> Download phpCornerstone</a> and unzip to a directory where you can run PHP 5.3+</li>
        <li>Install dependencies by running <code>composer install</code>* in the root directory
            <ul>
                <li>*Or follow these steps if you do not currently use <a href="https://getcomposer.org">Composer</a></li>
                <li>Navigate to the root folder of the project in terminal</li>
                <li>Get the Composer executable using the following command: <code>curl -sS https://getcomposer.org/installer | php</code></li>
                <li>Install dependencies using the following command: <code>php composer.phar install</code></li>
            </ul>
        </li>
        <li>Give write permissions for the storage directory: <code>chmod -R 777 storage</code></li>
    </ol>
    <p>That's it! Load it in your browser and you should see the same page you see at <a href="http://phpcornerstone.com">phpCornerstone.com</a>.</p>

    <h2>Requirements</h2>
    <p>phpCornerstone was built on the Apache server, with PHP 5.3 and above. To use it on other web servers you only need to replace the .htaccess file and rewrite the traffic to the index.php file with your preferred server's rewrite method.</p>

    <h2>File Structure</h2>
    <p>phpCornerstone users the following folder structure to organize your code:</p>

    <ul>
        <li>/config - Auto-loaded configuration files</li>
        <li>/helpers - Auto-loaded helper functions, typically containing static functions</li>
        <li>/libraries - 3rd party code libraries, etc go here. Libraries can be loaded with <code>$cs->loadLibrary();</code></li>
        <li>/migrations - Database migration files</li>
        <li>/models - Your applications models go here. They will be auto-loaded.</li>
        <li>/pages - Controllers and Views both go here, and will be auto-mapped to URLs</li>
        <li>/public - Acts as the 'public_html' folder. You can place non-app code, static files, etc here. The .htaccess file inside routes all requests to index.php.</li>
        <li>/storage - Folder for template cache, and any storage your app may need. Make sure to make the folder writable: <code>chmod -R 777 storage</code></li>
        <li>/boostrap.php - Code that auto loaded and is executed before the controllers.</li>
        <li>/routes.php - Custom routes go here.</li>
    </ul>