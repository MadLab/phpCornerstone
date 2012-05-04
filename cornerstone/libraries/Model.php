<?php

abstract class Model{

   protected $_cs;
   protected $_db;
   protected $_session;

   public function __construct(){
      $this->_cs = cs::getInstance();
      $this->_db = &$this->_cs->db;

      if(Config::get('useSession') !== false){
         $this->_session = &$this->_cs->session;
      }

   }
}