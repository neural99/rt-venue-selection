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
 * A numeric attribute.
 */
class NumericAttribute extends Attribute
{
    private $limit;
    private $unit;

    function __construct($name, $humanName, $limit, $unit = null)
    {
        $this->limit = $limit;
        $this->unit = $unit;
        parent::__construct($name, $humanName);
    }

    /**
     * Get the upper limit for the slider.
     */
    function getLimit() { return $this->limit; }

    function presentValueFor(Venue $venue)
    {
        $value = $venue->getAttributeValue($this->getName());

        if ($value == null) return null;

        if (round($value) - $value == 0)
            return (int)$value;
        else
            return $value;
    }

    function parseForm(array $request)
    {
        $min = (float) safeGet($request, $this->name . '_min');
        $max = safeGet($request, $this->name . '_max');

        if ($max === null)
            $max = INFINITY;
        else
            $max = (float) $max;

        if ($max == $this->limit) $max = INFINITY;

        if ($min > 0 || $max < INFINITY)
            return array((string) $min, (string) $max);
        else
            return null;
    }

    function renderParamController(array $values = null)
    {
        if ($values != null) {
            $min = $values[0];
            $max = $values[1];
        } else {
            $min = 0;
            $max = $this->limit;
        }

        if ($max > $this->limit) $max = $this->limit;

        echo "<input type='text' class='min_field' " .
            "name='{$this->name}_min' value='$min'>\n";
        echo "<div class='slider'></div>\n";
        echo "<input type='text' class='max_field' " .
            "name='{$this->name}_max' value='$max' " .
            "data-limit='{$this->limit}'>\n";
        echo "<span class='unit'>" . h($this->unit) . "</span>\n";
    }

    function renderParamValues(array $values)
    {
        if ($values[0] > 0)
            echo "min: " . $values[0]; 
        if ($values[1] < INFINITY)
            echo " max: " . $values[1];
    }
}
