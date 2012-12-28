<?php

class RequestHelper
{


    /**
     * Returns the IP address of the currently connected client
     *
     * @static getIp
     * @return string The user's IP address
     *
     */
    public static function getIP()
    {
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
                $ip = getenv("HTTP_X_FORWARDED_FOR");
            } else {
                if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
                    $ip = getenv("REMOTE_ADDR");
                } else {
                    if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {
                        $ip = $_SERVER['REMOTE_ADDR'];
                    } else {
                        $ip = false;
                    }
                }
            }
        }

        $ipArray = explode(',', $ip);
        return $ipArray[0];
    }

    /**
     * Returns the difference between the current timestamp, and the begining of code execution
     * as defined by the '$cs->startTime' property.
     *
     * @static executionTime
     * @return float Execution time in seconds, rounded to 2 decimal places.
     */
    public static function executionTime()
    {
        $cs = cs::getInstance();
        $now = microtime(true);
        return round($now - $cs->startTime, 2);
    }

    /**
     * Sets redirect header to any URL, with optional status code.
     *
     * @static redirect
     *
     * @param string $location url to redirect to
     * @param bool $status optional status code (301 or 302)
     */
    public static function redirect($location, $status = false)
    {
        if ($status == '301') {
            header("HTTP/1.1 301 Moved Permanently");
        } elseif ($status == '302') {
            header("HTTP/1.1 302 Moved Temporarily");
        }
        header('Location: ' . $location);
        die();
    }
}
