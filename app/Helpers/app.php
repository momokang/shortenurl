<?php

/**
 * Add http to url
 * @param $url
 * @return string
 */
function addhttp($url)
{
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}