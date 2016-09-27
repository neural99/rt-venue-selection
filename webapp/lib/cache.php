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

require_once 'Cache/Lite.php';

/**
 * Manages the caching. 
 */
class Cache
{
    private static function getCache()
    {
        static $cache;

        if (!isset($cache))
            $cache = new Cache_Lite(
                array('cacheDir' => APP_ROOT . '/tmp/',
                      'automaticSerialization' => true,
                      'lifeTime' => Config::$cacheLifetime)
            );

        return $cache;
    }

    static function get($key)
    {
        return self::getCache()->get($key);
    }

    static function put($key, $data)
    {
        self::getCache()->save($data, $key);
    }

    static function remove($key)
    {
        self::getCache()->remove($key);
    }
}
