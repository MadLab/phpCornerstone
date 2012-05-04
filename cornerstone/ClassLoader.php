<?php

class ClassLoader{

   private $_includePath;

   /**
    * @param  string $includePath PHP Include Path, defaults to Current
    */
   public function __construct($includePath = null){
      $this->_includePath = $includePath;
      $this->register();
   }

   /**
    * Registers this ClassLoader on the SPL autoload stack.
    */
   public function register(){
      spl_autoload_register(array($this, 'loadClass'));
   }

   /**
    * Removes this ClassLoader from the SPL autoload stack.
    */
   public function unregister(){
      spl_autoload_unregister(array($this, 'loadClass'));
   }

   /**
    * Loads the given class or interface.
    *
    * @param string $classname The name of the class to load.
    *
    * @return boolean TRUE if the class has been successfully loaded, FALSE otherwise.
    */
   public function loadClass($className){
      $path = $this->_includePath !== null ? $this->_includePath . DIRECTORY_SEPARATOR : '';
      $path .= str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
      if(file_exists($path)){
         require $path;
         return true;
      }
      return false;
   }
}
