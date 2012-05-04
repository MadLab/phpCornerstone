<?php

class cs{

   private $_url;
   private $_domain;
   private $_args;

   /**
    * @var Database
    */
   public $db;
   /**
    * @var Session
    */
   public $session;
   /**
    * @var Smarty
    */
   public $smarty;
   public $startTime;

   public $isError;

   private static $_instance;

   public function __construct($cli = false){
      //Save timestamp, so we can measure page generation time
      $this->startTime = microtime(true);

      if(!$cli){

         //Catch all errors/exceptions
         set_error_handler(array($this, 'errorHandler'), E_ALL ^ E_NOTICE);
         register_shutdown_function(array($this, 'shutdownErrorHandler'));
         set_exception_handler(array($this, 'exceptionHandler'));
      }

      $this->loadLibrary('Config');
      if(!file_exists(CONFIG_FILE)){
         $this->throwError('Config Not Found');
         die();
      }
      include_once(CONFIG_FILE);

      require_once(CORNERSTONE_PATH . DS . 'ClassLoader.php');
      require_once(CORNERSTONE_PATH . DS . 'Controller.php');

      $this->loadLibrary('Route');
      include_once(ROUTES_FILE);

      new ClassLoader(APP_PATH . DS . 'models');
      new ClassLoader(APP_PATH . DS . 'helpers');
      new ClassLoader(CORNERSTONE_PATH . DS . 'helpers');
      new ClassLoader(APP_PATH . DS . 'libraries');
      new ClassLoader(CORNERSTONE_PATH . DS . 'libraries');
   }

   /**
    * Initializes framework object. Sets up Database, Session, and Templates if applicable
    */
   public function init($cli = false){
      $this->isError = false;
      $this->smarty = false;
      if(Config::get('useDatabase') !== false){
         /**
          * Load DB
          */
         $this->loadLibrary('Database');

         $connectionParams = array('dbname' => Config::get('database.database'), 'user' => Config::get('database.username'), 'password' => Config::get('database.password'), 'host' => Config::get('database.host'));
         $this->db = Database::getConnection($connectionParams);
      }

      if(Config::get('useSession') !== false && !$cli){
         $this->loadLibrary('Session');
         $this->session = new Session();
      }

      if(Config::get('useTemplate') !== false && !$cli){
         $this->loadLibrary('Smarty/Smarty');
         $this->smarty = new Smarty();

         $this->smarty->template_dir = APP_PATH . '/pages';
         $this->smarty->compile_dir = STORAGE_PATH . 'cache/templates';
         $this->smarty->plugins_dir[] = Config::get('SMARTY_PLUGIN_DIRECTORY');
         $this->smarty->caching = false;
      }
   }

   /**
    * Framework instance factory. Will return the active framework instance, or create one if it doesn't exist
    * @static getInstance
    * @return cs Instance object
    */
   public static function getInstance($cli = false){
      if(!isset(self::$_instance)){
         $c = __CLASS__;
         self::$_instance = new $c($cli);
         self::$_instance->init($cli);
      }
      return self::$_instance;
   }

   /**
    * Finds and loads a Controller for the given http request
    * @return boolean
    */
   public function dispatch(){
      include_once(BOOTSTRAP_FILE);
      $this->_domain = $_SERVER['HTTP_HOST'];
      $this->_url = $_SERVER['REQUEST_URI'];
      $this->_args = $_GET;

      $route = $this->findCustomRoute();

      if($route){
         //handle custom route
         if($route->isRedirect()){
            RequestHelper::redirect($route->httpStatus, $route->redirectLocation);
         }
         else{
            include(CONTROLLER_PATH . $route->controller . '/controller.php');
            $template = $route->controller . '/view';

            $controller = new page();
            $controller->set_view($template);
            $controller->set_args($route->pathVariables);
            $controller->get();

         }
      }
      else{
         //custom route not found, map url to filesystem

         //auto map subdomains to _subdomain_ folders
         $subdomain = str_replace(Config::get('NAKED_DOMAIN'), '', $this->_domain);
         $subdomainFolder = "";
         if(substr($subdomain, -1) == '.'){
            $subdomain = substr($subdomain, 0, -1);
         }
         if($subdomain != Config::get('DEFAULT_SUBDOMAIN')){
            //redirect naked domain to default subdomain, if necessary;
            if(empty($subdomain)){
               RequestHelper::redirect(UrlHelper::uri($this->_url));
               die();
            }
            else{
               $subdomainFolder = '_' . $subdomain . '_/';
               if(!is_dir(CONTROLLER_PATH . $subdomainFolder)){
                  if(is_dir(CONTROLLER_PATH . '_*_/')){
                     include(CONTROLLER_PATH . '_*_/controller.php');
                     $template = CONTROLLER_PATH . '_*_/view';

                     $controller = new page();
                     $controller->set_view($template);
                     $controller->set_args(array('subdomain' => $subdomain));
                     $controller->get();
                     die();
                  }
                  else{
                     $this->throwError('404');
                  }
               }
            }
         }
         //on default subdomain, so continue
         $path = UrlHelper::convertUrlToPath($this->_url);
         if(empty($path)){
            if(is_dir(CONTROLLER_PATH . $subdomainFolder) && is_readable(CONTROLLER_PATH . $subdomainFolder . 'controller.php')){
               include(CONTROLLER_PATH . $subdomainFolder . 'controller.php');
               $template = $subdomainFolder . 'view';
            }
            else{
               $this->throwError('404');
            }
         }
         elseif(is_dir(CONTROLLER_PATH . $subdomainFolder . $path) && is_readable(CONTROLLER_PATH . $subdomainFolder . $path . '/controller.php')){
            include(CONTROLLER_PATH . $subdomainFolder . $path . '/controller.php');
            $template = $subdomainFolder . $path . DS . 'view';
         }
         elseif(is_readable(CONTROLLER_PATH . $subdomainFolder . $path)){
            $file = CONTROLLER_PATH . $subdomainFolder . $path;

            if(function_exists('finfo_open')){
               $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
               header("Content-type: " . finfo_file($finfo, $file));
               finfo_close($finfo);
            }
            elseif(function_exists('mime_content_type')){
               header("Content-type: " . mime_content_type($file));
            }
            else{
               header("Content-type: text/plain");
            }
            readfile($file);
            die();
         }
         else{
            $this->throwError('404');
            return false;
         }

         $controller = new page();
         $controller->set_view($template);
         $controller->get();
      }
      return true;
   }

   /**
    * Attempts to match the current URL to a custom route in the routes.php file
    * @return boolean|Route returns the matching Route if found, false otherwise
    */
   private function findCustomRoute(){
      foreach((array)Route::$routes as $route){
         if($route->matchUrl($this->_domain, $this->_url)){
            return $route;
         }
      }
      return false;
   }

   /**
    * Loads a code library. First checks the libraries folder in user directory. If not found,
    * it then checks the framework level libraries in the cornerstone folder. Filename must match
    * class name.
    *
    * @param string $pluginName The name of the library to load.
    *
    * @return boolean true if library found, false otherwise
    */
   public function loadLibrary($pluginName){
      if(file_exists(LIBRARY_PATH . $pluginName . '.php')){
         require_once LIBRARY_PATH . $pluginName . '.php';
         return true;
      }
      elseif(file_exists(CORNERSTONE_PATH . '/libraries/' . $pluginName . '.php')){
         require_once CORNERSTONE_PATH . '/libraries/' . $pluginName . '.php';
         return true;
      }
      else{
         $this->throwError("Plugin '$pluginName' Not Found", debug_backtrace(true));
         return false;
      }
   }


   /**
    * Stops controller execution, and handles error. Will look for a custom controller to display error message
    * to user. If not found, will use default framework error controller found in cornerstone/libs/pages
    *
    * @param string $message name/message of error
    * @param bool|string $trace optional backtrace from error calling location
    */
   public function throwError($message, $trace = false){
      $this->isError = true;
      if(!$trace){
         $trace = debug_backtrace(true);
      }
      $template = false;
      //mail('nick@horizontalverticals.com', 'njobsdev error', $message . "\r\n\r\n" . print_r($trace, true));
      if(file_exists(ERROR_PATH . $message . '/controller.php')){
         include(ERROR_PATH . $message . '/controller.php');
         $template = ERROR_PATH . DS . $message . '/view';
      }
      elseif($message == '404'){
         header('HTTP/1.0 404 Not Found');
         include(CORNERSTONE_PATH . DS . 'libs' . DS . 'pages' . DS . '404' . DS . 'controller.php');
      }
      elseif(file_exists(ERROR_PATH . 'error' . DS . 'controller.php')){
         include(ERROR_PATH . 'error' . DS . 'controller.php');
         $template = 'error' . DS . 'view';
      }
      else{
         require_once(CORNERSTONE_PATH . DS . 'libs' . DS . 'pages' . DS . 'error' . DS . 'controller.php');
      }

      $controller = new errorPage();

      $args['message'] = $message;
      $args['trace'] = $trace;
      $controller->set_args($args);
      $controller->get();
      if($template){
         if($controller->get_templateEnabled()){
            $controller->set_view($template);
         }
         $controller->display();
      }
      die();
   }

   /**
    * Registers a function to execute anytime a given event occurs
    *
    * @param callback $callback user defined callback function
    * @param string $event The event that triggers this function to run
    */
   public function registerCallback($callback, $event){
      $this->_handlers[$event][] = $callback;
   }

   /**
    * Overrides the default PHP error handler
    *
    * @param $errno
    * @param $errstr
    * @param $errfile
    * @param $errline
    */
   public function errorHandler($errno, $errstr, $errfile, $errline){
      foreach((array)$this->_handlers['php_error'] as $row){
         call_user_func($row, $errno, $errstr, $errfile, $errline);
      }

      if(Config::get('IS_TEST_SERVER')){
         $message
            = "
            Error: $errno - $errstr
            File: $errfile
            Line: $errline";
      }
      else{
         $message = "An error has occurred.";
      }
      $this->throwError($message);
      die();
   }

   /**
    * Acts as a global PHP Exception handler
    *
    * @param $e
    */
   public function exceptionHandler($e){
      foreach((array)$this->_handlers['php_exception'] as $row){
         call_user_func($row, $e);
      }
      $this->throwError($e);
      die();
   }

   /**
    * This error handler will catch any fatal (E_ERROR) errors. You should not recover from these errors, instead
    * it is recommended this is used for log/notification only.
    */
   public function shutdownErrorHandler(){
      $error = error_get_last();
      if($error['type'] == 1){
         foreach((array)$this->_handlers['syntax_error'] as $row){
            call_user_func($row, $error);
         }
      }
   }
}
