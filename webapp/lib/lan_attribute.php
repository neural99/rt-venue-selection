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
 * An attribute which lets the user choose counties (Län)
 */
class LanAttribute extends Attribute
{
    function presentValueFor(Venue $venue)
    {
        if (($lan = Lan::get($venue->getAttributeValue($this->getName())))
            !== null)
            return $lan->getName();
        else
            return null;
    }

    function parseForm(array $request)
    {
        return safeGetArray($request, $this->name);
    }

    function renderParamController(array $values = null)
    {
        foreach (Lan::all() as $id => $lan) {
            $elem_id = h($this->getName() . '-' . $id);
            if ($values != null && in_array($id, $values))
                $checked = ' checked';
            else
                $checked = '';

            echo "<input type='checkbox' name='{$this->name}[]' "
                . "id='$elem_id' value='$id'$checked>";
            echo "<label for='$elem_id'>" . h($lan->getName())
                . "</label>\n";
        }
    }

    function renderParamValues(array $values)
    {
        $names = array();
        foreach ($values as $lanId)
            $names[] = Lan::get($lanId)->getName();
        return implode(', ', $names);
    }
}
