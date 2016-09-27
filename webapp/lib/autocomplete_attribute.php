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

abstract class AutocompleteAttribute extends Attribute
{
    abstract protected function valuesToElementNames($values);
    abstract protected function elementNamesToValues($names);

    protected static function canonicalizeName($name)
    {
        return mb_strtolower(trim($name), 'utf-8');
    }

    function presentValueFor(Venue $venue)
    {
        $value = $venue->getAttributeValue($this->getName());
        $names = $this->valuesToElementNames(array($value));

        if ($names !== null && count($names) > 0)
            return $names[0];
        else
            return $value;
    }

    function parseForm(array $request)
    {
        $str = trim((string) safeGet($request, $this->name), '; ');
        if ($str === '') return null;

        $names = array();

        foreach (explode(';', $str) as $name)
            $names[] = $name;

        return $this->elementNamesToValues($names);
    }

    function renderParamController(array $values = null)
    {
        if ($values === null) $values = array();
        $names = $this->valuesToElementNames($values);

        echo "<input type='text' name='{$this->name}'"
            . " value='" . implode('; ', $names) . "'"
            . " id='input-{$this->name}' class='textfield'>\n";
    }

    function renderParamValues(array $values)
    {
        echo implode('; ', $this->valuesToElementNames($values));
    }
}
