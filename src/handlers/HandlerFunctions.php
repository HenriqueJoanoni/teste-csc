<?php


namespace src\handlers;

use DateTime;
use src\Config;

class HandlerFunctions
{
    /**
     * ##################
     * ###    UTIL    ###
     * ##################
     */

    /**
     * @param $str
     *
     * @return string|string[]|null
     */
    public static function clearStr($str)
    {
        $clear = preg_replace("/\D+/", "", $str);
        return $clear;
    }


    /**
     * ##################
     * ###   STRING   ###
     * ##################
     */

    public static function str_slug(string $string): string
    {
        $string = filter_var(mb_strtolower($string), FILTER_SANITIZE_STRIPPED);
        $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

        $slug = str_replace(["-----", "----", "---", "--"], "-",
            str_replace(" ", "-",
                trim(strtr(utf8_decode($string), utf8_decode($formats), $replace))
            )
        );
        return $slug;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public static function str_studly_case(string $string): string
    {
        $string = self::str_slug($string);
        $studlyCase = str_replace(" ", "",
            mb_convert_case(str_replace("-", " ", $string), MB_CASE_TITLE)
        );

        return $studlyCase;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public static function str_camel_case(string $string): string
    {
        return lcfirst(self::str_studly_case($string));
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public static function str_title(string $string): string
    {
        return mb_convert_case(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS), MB_CASE_TITLE);
    }

    /**
     * @param string $text
     *
     * @return string
     */
    public static function str_textarea(string $text): string
    {
        $text = filter_var($text, FILTER_SANITIZE_STRIPPED);
        $arrayReplace = ["&#10;", "&#10;&#10;", "&#10;&#10;&#10;", "&#10;&#10;&#10;&#10;", "&#10;&#10;&#10;&#10;&#10;"];
        return "<p>" . str_replace($arrayReplace, "</p><p>", $text) . "</p>";
    }

    /**
     * @param string $string
     * @param int    $limit
     * @param string $pointer
     *
     * @return string
     */
    public static function str_limit_words(string $string, int $limit, string $pointer = "..."): string
    {
        $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
        $arrWords = explode(" ", $string);
        $numWords = count($arrWords);

        if ($numWords < $limit) {
            return $string;
        }

        $words = implode(" ", array_slice($arrWords, 0, $limit));
        return "{$words}{$pointer}";
    }

    /**
     * @param string        $string
     * @param int           $limit
     * @param string|string $pointer
     *
     * @return string
     */
    public static function str_limit_chars(string $string, int $limit, string $pointer = "..."): string
    {
        $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
        if (mb_strlen($string) <= $limit) {
            return $string;
        }

        $chars = mb_substr($string, 0, mb_strrpos(mb_substr($string, 0, $limit), " "));
        return "{$chars}{$pointer}";
    }

    /**
     * @param string $param
     *
     * @return string|string[]|null
     */
    public static function inputPhoneMask(string $param)
    {
        if (strlen($param) == 11) {
            $pattern = '/^([[:digit:]]{2})([[:digit:]]{5})([[:digit:]]{4})$/';
            $replacement = '($1)$2-$3';
            $format = preg_replace($pattern, $replacement, $param);
        } else {
            $pattern = '/^([[:digit:]]{2})([[:digit:]]{4})([[:digit:]]{4})$/';
            $replacement = '($1)$2-$3';
            $format = preg_replace($pattern, $replacement, $param);
        }

        return $format;
    }

    /**
     * @param string $param
     *
     * @return string|string[]|null
     */
    public static function inputCpf(string $param) {

        $pattern = '/^([[:digit:]]{3})([[:digit:]]{3})([[:digit:]]{3})([[:digit:]]{2})$/';
        $replacement = '$1.$2.$3-$4';
        $format =  preg_replace($pattern, $replacement, $param);

        return $format;
    }

    /**
     * @param string $param
     *
     * @return string|string[]|null
     */
    public static function inputCep(string $param){

        $pattern = '/^([[:digit:]]{5})([[:digit:]]{3})$/';
        $replacement = '$1-$2';
        $format =  preg_replace($pattern, $replacement, $param);

        return $format;
    }


    /**
     * ################
     * ###   DATE   ###
     * ################
     */

    /**
     * @param string $date
     * @param string $targetFormat
     * @param string $expectedFormat
     *
     * @return string
     * @throws \Exception
     */
    public static function date_fmt(
        string $date = "now",
        string $targetFormat = "d/m/Y H\hi",
        string $expectedFormat = "d/m/Y H\hi"
    ): string
    {
        return DateTime::createFromFormat($targetFormat, $date)->format($expectedFormat);
    }
}