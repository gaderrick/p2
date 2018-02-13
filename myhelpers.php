<?php
/**
 * Escape HTML entities in the given String $str
 * @param $str
 * @return integer
 * From site: https://stackoverflow.com/questions/6041741/fastest-way-to-check-if-a-string-is-json-in-php
 */
function isJson($string)
{
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}