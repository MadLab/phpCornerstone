<?php

/**
 *  phpCornerstone Framework Vars
 */

// Server Host Name (change $_SERVER['SERVER_NAME'] to your domain)
Config::set('NAKED_DOMAIN', $_SERVER['SERVER_NAME']);
// Default Subdomain (e.g. "www")
Config::set('DEFAULT_SUBDOMAIN', '');



// Maintenance
Config::set('UNDER_MAINTENANCE', true);
Config::set('MAINTENANCE_KEY', 'example');
Config::set('MAINTENANCE_COOKIE_KEY', 'example');

// Database
Config::set('useDatabase', false);
//Config::set('database.database','databaseName');
//Config::set('database.username','databaseUser');
//Config::set('database.password','databasePass');
//Config::set('database.host','localhost');