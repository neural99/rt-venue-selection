<?php
/*
 * Riksteatern Venue Selection
 * Copyright (C) 2010-2011  Team Kappa
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/** @file
 * Utility functions.
 */

/**
 * Big number. Fits into both single-precision floats and
 * 32-bit signed ints.
 */
define('INFINITY', 1000000000);

/**
 * Escape a string for HTML output
 *
 * @param $s The string to escape.
 * @returns The escaped string.
 */
function h($s)
{
    return htmlspecialchars($s);
}

/**
 * Sanitize user input. TODO: Implement.
 */
function sanitizeAlphaNum($str)
{
    return $str;
}

/**
 * Get the username of the current user
 *
 * @returns The username as a string
 */
function getCurrentUser() 
{
    return $_SERVER['REMOTE_USER'];
}

/**
 * Get the URL to the toplevel page 
 */
function getTopLevelUrl($page = '')
{
    return (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off'
            ? 'http' : 'https')
        . '://' . $_SERVER['HTTP_HOST']
        . preg_replace('/\/[^\/]*$/', '/' . $page, $_SERVER['SCRIPT_NAME']);
}

/**
 * Helper function to safetly get (no errors) an element (scalar) in an array
 */
function safeGet(array $arr, $key)
{
    if (isset($arr[$key]))
        return $arr[$key];
    else
        return null;
}

/**
 * Helper function to safetly get (no errors) an element (array) in an array
 */
function safeGetArray(array $arr, $key)
{
    if (isset($arr[$key]) && is_array($arr[$key]))
        return $arr[$key];
    else
        return array();
}

/**
 * Used for debugging 
 */
function prettyprint_xml($s)
{
    $doc = new DOMDocument();
    $doc->preserveWhiteSpace = false;

    if ($doc->loadXML($s)) {
        $doc->formatOutput = true;
        return $doc->saveXML();
    } else {
        return $s;
    }
}

/**
 * Used for debugging 
 */
function debug_msg($msg)
{
    echo '<pre>';
    echo h($msg);
    echo '</pre>';
}
