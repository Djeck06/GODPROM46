<?php

if (!function_exists('getTitle')) {
    function getTitle($title = null, $separator = ' - ')
    {
        if ($title) {
          $title .= $separator . config('godprom.title');
        } else {
          $title = config('godprom.title') . ' - ' . config('godprom.tagline');
        }

        return strip_tags($title);
    }
}

if (!function_exists('getDescription')) {
    function getDescription($description = null)
    {
        if ($description) {
          $description .= config('godprom.description');
        } else {
          $description = config('godprom.description');
        }

        return strip_tags($description);
    }
}