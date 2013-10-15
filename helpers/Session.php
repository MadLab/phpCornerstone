<?php

class Session
{
    public static function get($key){
        $cs = \MadLab\Cornerstone\App::getInstance();
        return $cs->getSessionHandler()->get($key);
    }

    public static function set($key, $value){
        $cs = \MadLab\Cornerstone\App::getInstance();
        return $cs->getSessionHandler()->set($key, $value);
    }
}