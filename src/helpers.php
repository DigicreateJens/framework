<?php

use Illuminate\Support\Str;

/*
 * This file is part of WordPlate.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (!function_exists('config')) {

    /**
     * Get the specified configuration value.
     *
     * @param array|string $key
     * @param mixed $default
     *
     * @return mixed
     */
    function config($key = null, $default = null)
    {
        $config = [];

        foreach (glob(get_template_directory().'/config/*.php') as $file) {
            $config[basename($file, '.php')] = require $file;
        }

        if (is_null($key)) {
            return $config;
        }

        if (isset($config[$key])) {
            return $config[$key];
        }

        foreach (explode('.', $key) as $segment) {
            if (!is_array($config) || !array_key_exists($segment, $config)) {
                return $default;
            }

            $config = $config[$segment];
        }

        return $config;
    }
}

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     * Supports boolean, empty and null.
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if (!$value) {
            return value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;

            case 'false':
            case '(false)':
                return false;

            case 'empty':
            case '(empty)':
                return '';

            case 'null':
            case '(null)':
                return;
        }

        if (Str::startsWith($value, '"') && Str::endsWith($value, '"')) {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if (!function_exists('format_bytes')) {
    /**
     * Format bytes to kilobytes, megabytes, gigabytes.
     *
     * @param int $bytes
     * @param  int $precision
     * @return string
     */
    function format_bytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return sprintf('%s %s', round($bytes, $precision), $units[$pow]);
    }
}
