<?php

namespace App\Supports;

/**
 * Classe de higienização de dados
 */
class Sanitizer
{
    /**
     * Somente retornar números.
     *
     * @param string|array $value
     * @return mixed
     */
    public static function onlyNumber($value)
    {
        if (is_string($value)) {
            return preg_replace("/[^0-9]/", "", $value);
        }

        if (is_array($value)) {
            return Sanitizer::onlyNumber($value);
        }

        return $value;
    }

    /**
     * Retornar valor com trim.
     *
     * @param  string|array $value
     * @return mixed
     */
    public static function trim($value)
    {
        if (is_string($value)) {
            return trim($value);
        }

        if (is_array($value)) {
            return Sanitizer::trim($value);
        }

        return $value;
    }
}
