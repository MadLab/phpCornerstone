<?php

class UrlHelper
{

    private static $_args;

    /**
     * Converts a URL to a filesystem path
     *
     * @static convertUrlToPath
     *
     * @param string $url The URL to parse
     *
     * @return array Array of pieces of the URL Path
     */
    public static function convertUrlToPath($url)
    {

        //remove querystring
        $pieces = explode('?', $url);
        $url = $pieces[0];

        //remove extension
        $url = str_replace('.php', '', $url);
        if (substr($url, 0, 1) == '/') {
            $url = substr($url, 1);
        }

        //remove trailing slash
        if (substr($url, -1) == '/') {
            $url = substr($url, 0, -1);
        }
        return str_replace('/', DIRECTORY_SEPARATOR, $url);
    }

    /**
     * Convenience function to build URL strings
     *
     * @static uri
     *
     * @param string $path The 'path portion of url, everything after domain
     * @param string $protocol which protocol to use, default 'http'
     * @param bool|string $subdomain optional subdomain
     * @param bool|array $appendArgs optional array of arguments to append as querystring
     *
     * @return string The full URL String
     */
    public static function uri($path, $protocol = 'http', $subdomain = false, $appendArgs = false)
    {
        $subdomain = $subdomain ? $subdomain : Config::get('DEFAULT_SUBDOMAIN');
        if (!empty($subdomain)) {
            $subdomain .= '.';
        }
        if ($path == '/') {
            $path = '';
        }
        $uri = $protocol . '://' . $subdomain . Config::get('NAKED_DOMAIN') . $path;

        if ($appendArgs && !empty(self::$_args)) {
            $uri = self::addArgsToUrl($uri);
        }


        return $uri;
    }

    /**
     * Adds argument to be appended to all URLs
     *
     * @static addArg
     *
     * @param string $key key of argument to append to url
     * @param string $value value of argument to append to url
     */
    public static function addArg($key, $value)
    {
        self::$_args[$key] = $value;
    }

    /**
     * Clears all arguments to be appended to all URLs
     * @static clearArgs
     *
     */
    public static function clearArgs()
    {
        self::$_args = array();
    }

    /**
     * Appends querystring to url with arguments set with the UrlHelper::addArg function
     *
     * @static addArgsToUrl
     *
     * @param string $url The url to append querystring to
     *
     * @return string The Url with querystring appended
     */
    public static function addArgsToUrl($url)
    {
        if (!self::$_args) {
            return $url;
        }
        $query = http_build_query(self::$_args);
        $parts = parse_url($url);
        if (!empty($parts['fragment'])) {
            $url = str_replace('#' . $parts['fragment'], '', $url);
        }

        if (empty($parts['query'])) {
            $url .= '?' . $query;
        } else {
            $url .= '&' . $query;
        }

        if (!empty($parts['fragment'])) {
            $url .= '#' . $parts['fragment'];
        }
        return $url;
    }
}