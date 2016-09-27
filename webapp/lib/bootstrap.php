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
 * Some bootstrap code that all pages should include first. Adds the
 * lib directory to the include path, and enables all error reporting.
 */

// Enable all error reports
error_reporting(E_ALL | E_STRICT);

// Paths
define('LIB_DIR', dirname(__FILE__));
define('APP_ROOT', LIB_DIR . '/..');
define('CONFIG_DIR', APP_ROOT . '/config');

// Setup include path
set_include_path(LIB_DIR . PATH_SEPARATOR . LIB_DIR . '/ext'
                 . PATH_SEPARATOR . get_include_path());

// Enable autoloading
function rtvs_autoload($class)
{
    return spl_autoload(preg_replace('/([a-z])([A-Z][a-z])/', '\1_\2',
                                     $class), '.php');
}
spl_autoload_register('rtvs_autoload');

// Send charset. Content type can always be overridden later.
header('Content-Type: text/html; charset=UTF-8');

// Load utilities
require_once 'util.php';

// Load configuration
require_once 'config.php';
