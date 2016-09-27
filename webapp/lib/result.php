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
 * The result from a venue search.
 */
class Result
{
    private $venues = array();
    private $totalCount = 100;

    function __construct($data)
    {
        if (isset($data->totalCount))
            $this->totalCount = $data->totalCount;
                
        if (isset($data->organisations))
            foreach ($data->organisations as $orgData)
                new Organisation($orgData);

        if (isset($data->venues))
            foreach ($data->venues as $venueData)
                $this->venues[] = new Venue($venueData);
    }

    /**
     * Returns the venues in the result set
     *
     * @returns An array of Venue objects
     */
    function getVenues() { return $this->venues; }

    /**
     * The the total number of venus in the result set
     */
    function getTotalCount() { return $this->totalCount; }
}
