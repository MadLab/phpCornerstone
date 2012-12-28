<?php

abstract class Model
{

    protected $_cs;
    protected $_db;
    protected $_session;

    public function __construct()
    {
        $this->_cs = cs::getInstance();
        $this->_db = & $this->_cs->db;

        if (Config::get('useSession') !== false) {
            $this->_session = & $this->_cs->session;
        }
    }

    public function __sleep()
    {
        unset($this->_cs);
        unset($this->_db);

        // default class values:
        $defaults = get_class_vars(get_class($this)); // not __CLASS__ or self::, if you'd like to use in descendant classes
        // values of $this object:
        $present = get_object_vars($this);


        $result = array(); // output array
        foreach ($present as $key => $value) {
            if (!is_resource($defaults[$key]) && ( // don't store resources
                is_object($defaults[$key]) || // always store objects
                    is_array($defaults[$key]) || // and arrays
                    $defaults[$key] !== $value) // and of course all that is not the default value
            ) // tip: try is_scalar as well
            {
                $result[] = $key;
            }
        }
        return $result;
    }

    public function __wakeup()
    {
        $this->_cs = cs::getInstance();
        $this->_db = & $this->_cs->db;

        if (Config::get('useSession') !== false) {
            $this->_session = & $this->_cs->session;
        }

    }
}