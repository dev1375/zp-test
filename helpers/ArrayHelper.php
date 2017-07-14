<?php

namespace helpers;

/**
 * Class ArrayHelper
 * @package helpers
 */
class ArrayHelper
{
    /**
     * Getting value from array, else default value
     *
     * @param $array
     * @param $key
     * @param null $defaultValue
     * @return null
     */
    public static function getValue($array, $key, $defaultValue = null)
    {
        if (isset($array[$key]))
            return $array[$key];

        return $defaultValue;
    }
}