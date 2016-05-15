<?php

namespace RoketId\ImageMax;

class ImageMax
{
    const IMAGEMAX_URL = 'https://imagemax.roket.id/';

    protected static $config = ['canonical' => null, 'baseurl' => null, 'profiles' => []];
    protected static $canonical;
    protected static $baseurl;
    protected static $profiles;

    public function __construct($config = [])
    {
        $this->setConfig($config);
    }

    public function setConfig($config)
    {
        $config = array_replace(static::$config, $config);
        extract($config);

        static::$canonical = $canonical;
        static::$baseurl = rtrim($baseurl, '/').'/';
        static::$profiles = $profiles;
    }

    public function make($url, $options = null, $format = null)
    {
        if (!static::$canonical || ($options == null && $format == null)) {
            return $url;
        }

        $canonical = static::$canonical;
        $baseurl = static::$baseurl;
        $profiles = static::$profiles;
        
        $url = ltrim(static::replaceFirst($baseurl, '', $url), '/');

        $extension = $format ?: pathinfo($url, PATHINFO_EXTENSION);

        // options
        if (!is_array($options) && ($profile = Helper::get($profiles, $options))) {
            $options = $profile;
        }

        if (is_array($options)) {
            $format = Helper::get($options, 'fm', $extension);

            $modify = '';
            
            foreach (($modifications = Helper::except($options, ['w', 'h', 'fm'])) as $key => $value) {
                $modify .= '-imx'.$key.'-'.$value;
            }

            $width = Helper::get($options, 'w', '');
            $height = Helper::get($options, 'h', '');

            $size = $width. 'x' .$height;

            $options = $size. $modify. '.' .$format;
        }

        $options = ltrim($options, '_');

        $format = pathinfo($options, PATHINFO_EXTENSION);

        $sufix = $format ? $options : Helper::replaceLast($format, $extension, $options);

        return static::IMAGEMAX_URL. $canonical. '/'. $url.'_'.$sufix;
    }
}
