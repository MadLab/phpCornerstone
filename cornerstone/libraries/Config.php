<?php

class Config
{

    private static $_data;

    /**
     * Get value from Config Key/Value Store
     * @static get
     *
     * @param string $key The Key to retrieve
     *
     * @return null|String The value
     */
    public static function get($key)
    {
        if (strpos($key, '.') === false) {
            if (array_key_exists($key, self::$_data)) {
                return self::$_data[$key];
            } else {
                return null;
            }
        }
        $parts = explode('.', $key);

        $return = & self::$_data;
        foreach ((array)$parts as $part) {
            $return = & $return[$part];
        }
        return $return;
    }

    /**
     * Store a value in the Config Key/Value store
     * @static set
     *
     * @param string $key The key to store the value in
     * @param string $value The value to store
     */
    public static function set($key, $value)
    {
        if (strpos($key, '.') === false) {
            self::$_data[$key] = $value;
        } else {
            $parts = explode('.', $key);
            $insertSpot = & self::$_data;
            foreach ((array)$parts as $key => $part) {
                if ($key === count($parts) - 1) {
                    $insertSpot[$part] = $value;
                } else {
                    $insertSpot = & $insertSpot[$part];
                }
            }
        }
    }
}