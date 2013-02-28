<?php

/**
 *  phpCornerstone Framework Vars
 */

// Paths
Config::set('NAKED_DOMAIN', 'example.com');
Config::set('DEFAULT_SUBDOMAIN', 'www');
Config::set("SMARTY_PLUGIN_DIRECTORY", APP_PATH . '/libraries/smartyPlugins/');


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
