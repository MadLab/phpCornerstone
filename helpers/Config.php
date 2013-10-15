<?php

class Config
{
    public static function get($key){
        $cs = \MadLab\Cornerstone\App::getInstance();
        return $cs->config->$key;
    }

    public static function set($key, $value){
        $cs = \MadLab\Cornerstone\App::getInstance();
        return $cs->config->$key = $value;
    }
}