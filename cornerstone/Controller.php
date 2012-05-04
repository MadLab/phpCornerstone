<?php

class Controller{

   private $_template;
   protected $_disableTemplate;
   protected $_session;
   protected $_data;
   protected $_view;
   protected $_config;
   protected $_args;
   protected $_cs;

   public function __construct(){
      $this->_cs = cs::getInstance();
      $this->_template = &$this->_cs->smarty;
      $this->_session = &$this->_cs->session;
      $this->_view = false;
   }

   /**
    * Returns true if there is this controller displays a template, false otherwise
    * @return boolean
    */
   public function get_templateEnabled(){
      if($this->_disableTemplate || !$this->_template){
         return false;
      }
      return true;
   }

   /**
    * Set the template to be displayed
    *
    * @param string $view path inside Pages folder to desired template
    */
   public function set_view($view){
      $this->_view = $view;
   }

   /**
    * Assigns a variable to the template, requires Smarty templating.
    *
    * @param string $key Key of variable to be accessed from template
    * @param string $val Data
    */
   public function assign($key, $val){
      if(!$this->_cs->smarty){
         $this->_cs->throwError('Smarty Not Enabled');
      }
      else{
         $this->_template->assign($key, $val);
      }
   }

   /**
    * Parses the given template, and returns string result
    *
    * @param string $template path to template in Pages folder to parse
    *
    * @return string result
    */
   public function fetch($template){
      if(!$this->_cs->smarty){
         $this->_cs->throwError('Smarty Not Enabled');
      }
      else{
         $this->_template->assign('session', $this->_session);
         return $this->_template->fetch($template);
      }
   }

   /**
    * Automatically called at end of page execution. This will output the template to browser, if applicable.
    */
   public function __destruct(){
      if($this->get_templateEnabled() && !$this->_cs->isError){
         $this->display($this->_view . '.tpl');
      }
   }

   /**
    * Outputs the associated template to browser
    */
   public function display(){
      if($this->get_templateEnabled() && $this->_view){
         $this->_template->assign('session', $this->_session);
         $this->_template->display($this->_view . '.tpl');
      }
   }

   /**
    * Same as die(), except this will disable the Controllers template, so nothing else is displayed.
    *
    * @param string $alert message to output before die-ing.
    */
   protected function fail($alert = ''){
      $this->_view = false;
      $this->_disableTemplate = true;
      die($alert);
   }

   /**
    * Throws a framework level error
    *
    * @param string $message the name/message of the error
    * @param bool $trace whether or not to include a stack trace
    */
   protected function throwError($message, $trace = false){
      $this->_disableTemplate = true;
      $this->_view = false;
      $this->_cs->throwError($message, $trace);
   }

   /**
    * Assigns variables from URL Route matching to arguments array, to be accessed by get_arg()
    *
    * @param array $args
    */
   public function set_args($args){
      $this->_args = $args;
   }

   /**
    * Retrieves a variable from arguments array, typically populated from URL Route matching
    *
    * @param string $arg The key of the argument to retrieve
    *
    * @return mixed
    */
   protected function get_arg($arg){
      return $this->_args[$arg];
   }
}
