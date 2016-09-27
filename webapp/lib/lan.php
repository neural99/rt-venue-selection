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

/**
 * A country/province (Län). 
 */
class Lan
{
    private $id, $name, $kommuner;
    private static $all;

    function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->kommuner = array();

        self::$all[$id] = $this;
    }

    function getId() { return $this->id; }
    function getName() { return $this->name; }
    function getKommuner() { return $this->kommuner; }
    
    /**
     * Get the Kommun with a certain localId
     *
     * @returns A Kommun object
     */
    function getKommun($localId)
    {
        return safeGet($this->kommuner, $localId);
    }

    /**
     * Return all Lan objects
     */
    static function all()
    {
        if (!isset(self::$all)) self::load();
        return self::$all;
    }

    /**
     * Get the Lan object with a certain id
     */
    static function get($id)
    {
        return safeGet(self::all(), $id);
    }

    /**
     * Load the Lan objects from data obtained from the Repertoar web service
     */
    private static function load()
    {
        if ((self::$all = Cache::get('lan_kommuner')))
            return;

        $result = WSClient::repertoar()->call('GetRepertoarFilterList');

        $wslan = $result->retValRepertoarProvinceElement;
        self::$all = array();

        foreach ($wslan as $l) {
            $lan = new Lan($l->provinceId, $l->provinceName);

            foreach ($l->retValRepertoarCountyElement as $k)
                $lan->kommuner[$k->countyId] = new Kommun(
                    $k->countyId, $k->countyName, $lan
                );
        }

        Cache::put('lan_kommuner', self::$all);
    }
}
