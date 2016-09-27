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
 * Represent a Municipal (Kommun). It is using the SCB's code system
 * of Lan + localId.  See Web Service Specification for more
 * information.
 */
class Kommun
{
    private $localId, $name, $lan;

    function __construct($localId, $name, Lan $lan)
    {
        $this->localId = $localId;
        $this->name = $name;
        $this->lan = $lan;
    }

    function getLocalId() { return $this->localId; }

    function getGlobalId()
    {
        return $this->lan->getId() . '|' . $this->localId;
    }

    function getName() { return $this->name; }
    function getLan() { return $this->lan; }


    /**
     * Get a Kommun object with a certain globalId
     */
    static function get($globalId)
    {
        list($lanId, $kommunId) = explode('|', $globalId);

        if (($lan = Lan::get($lanId)) !== null)
            return $lan->getKommun($kommunId);
        else
            return null;
    }

    /**
     * Get a Kommun object with a certain name
     */
    static function getByName($name)
    {
        $name = mb_strtolower($name, 'utf-8');

        foreach (Lan::all() as $lan) {
            foreach ($lan->getKommuner() as $kommun)
                if (mb_strtolower($kommun->getName(), 'utf-8') === $name)
                    return $kommun;
        }

        return null;
    }
}
