<?php

class Route{

   public static $routes;
   public $domain;
   public $subdomain;
   public $path;
   public $controller;
   public $pathVariables;
   public $redirectLocation;
   public $httpStatus;
   public $regexArray;

   public function __construct(){
      $this->domain = Config::get('NAKED_DOMAIN');
      $this->subdomain = Config::get('DEFAULT_SUBDOMAIN');
   }

   /**
    * Creates a new Route object for a given domain/subdomain
    * @static domain
    *
    * @param string $domain The domain all routes will be based on
    * @param string|boolean $subdomain Optional subdomain to base routes on
    *
    * @return Route Instance of Route
    */
   public static function domain($domain, $subdomain = false){
      $domainRouter = new Route();
      $domainRouter->domain = $domain;
      if($subdomain){
         $domainRouter->subdomain = $subdomain;
      }
      return $domainRouter;
   }

   /**
    * @static subdomain
    *
    * @param string $subdomain The subdomain all routes will be based on
    *
    * @return Route Instance of Route
    */
   public static function subdomain($subdomain){
      $subdomainRouter = new Route();
      $subdomainRouter->subdomain = $subdomain;
      return $subdomainRouter;
   }

   /**
    * Adds a custom Route
    *
    * @param string $path The custom path to match
    * @param string $controller The controller in the pages folder to handle this Route
    * @param array $regexArray Optional array of regular expressions to validate any variables in path
    */
   public function addRoute($path, $controller, $regexArray = array()){
      if(isset($this) && get_class($this) == __CLASS__){
         $route = clone $this;
      }
      else{
         $route = new Route();
      }
      $route->path = $path;
      $route->controller = $controller;
      $route->regexArray = $regexArray;
      self::$routes[] = $route;
   }

   /**
    * Adds a Redirection Url
    *
    * @param string $path The custom path to match
    * @param int $httpStatus The HTTP Status to use in the redirect (301 or 302)
    * @param string $url The URL to redirect to
    */
   public function addRedirect($path, $httpStatus, $url){
      if(isset($this) && get_class($this) == __CLASS__){
         $route = clone $this;
      }
      else{
         $route = new Route();
      }
      $route->path = $path;
      $route->redirectLocation = $url;
      $route->httpStatus = $httpStatus;
      self::$routes[] = $route;
   }

   /**
    * Checks if given route is a redirection route
    * @return bool
    */
   public function isRedirect(){
      if($this->redirectLocation){
         return true;
      }
      return false;
   }

   /**
    * Tests if this Route matches the given domain and path
    *
    * @param string $domain
    * @param string $path
    *
    * @return boolean
    */
   public function matchUrl($domain, $path){
      $subdomain = str_replace($this->domain, '', $domain);
      if(substr($subdomain, -1) == '.'){
         $subdomain = substr($subdomain, 0, -1);
      }

      $subdomainMatch = $this->matchSubdomain($subdomain);
      if($subdomainMatch){
         if(substr($path, 0, 1) == '/'){
            $path = substr($path, 1);
         }

         $pathMatch = $this->matchPath($path);
         return $pathMatch;
      }
      return false;
   }

   /**
    * Tests if this Route matches the given subdomain
    *
    * @param string $subdomain
    *
    * @return boolean
    */
   private function matchSubdomain($subdomain){
      preg_match_all("|<([-_a-zA-Z0-9]+)>|", $this->subdomain, $namedParameterMatches);
      if($namedParameterMatches[0] && $subdomain != Config::get('DEFAULT_SUBDOMAIN')){
         $subdomainRegex = $this->subdomain;
         $pathVariables = array();
         foreach($namedParameterMatches[1] as $capture){
            $pathVariables[] = $capture;
            if(array_key_exists($capture, $this->regexArray)){
               $subdomainRegex = str_replace('<' . $capture . '>', $this->regexArray[$capture], $subdomainRegex);
            }
            else{
               $subdomainRegex = str_replace('<' . $capture . '>', "([^\.]+)", $subdomainRegex);
            }
         }
         if(preg_match('|^' . $subdomainRegex . '$|', $subdomain, $subdomainMatches)){
            array_shift($subdomainMatches);
            foreach($subdomainMatches as $match){
               $this->pathVariables[array_shift($pathVariables)] = $match;
            }
            return true;
         }
      }
      elseif($subdomain == $this->subdomain){
         return true;
      }
      return false;
   }

   /**
    * Tests if this Route matches the given path
    *
    * @param string $path
    *
    * @return boolean
    */
   private function matchPath($path){

      list($basePath, $querystring) = array_pad(explode('?', $path, 2), 2, null);

      if($this->path == '*'){
         $subdomainPath = UrlHelper::convertUrlToPath($path);
         $testPath = $this->controller . '/' . $subdomainPath;
         if(is_dir(CONTROLLER_PATH . $testPath) && is_readable(CONTROLLER_PATH . $testPath . '/controller.php')){
            $this->controller = $testPath;
            return true;
         }
      }

      preg_match_all("|<([-_a-zA-Z0-9]+)>|", $this->path, $namedParameterMatches);
      if($namedParameterMatches[0]){
         $pathRegex = $this->path;
         $pathVariables = array();
         foreach($namedParameterMatches[1] as $capture){
            $pathVariables[] = $capture;
            if(array_key_exists($capture, $this->regexArray)){
               $pathRegex = str_replace('<' . $capture . '>', $this->regexArray[$capture], $pathRegex);
            }
            else{
               $pathRegex = str_replace('<' . $capture . '>', "([^\.\?\/]+)", $pathRegex);
            }
         }

         //try matching url ignoring querystring
         if(preg_match('|^' . $pathRegex . '$|', $basePath, $pathMatches)){
            array_shift($pathMatches);
            foreach($pathMatches as $match){
               $this->pathVariables[array_shift($pathVariables)] = $match;
            }
            return true;
         }

         //try again using querystring
         if(preg_match('|^' . $pathRegex . '$|', $path, $pathMatches)){
            array_shift($pathMatches);
            foreach($pathMatches as $match){
               $this->pathVariables[array_shift($pathVariables)] = $match;
            }
            return true;
         }
      }
      elseif($this->path == $path || $this->path == $basePath){
         return true;
      }
      elseif(empty($this->path) && empty($basePath)){
         return true;
      }
      return false;
   }
}