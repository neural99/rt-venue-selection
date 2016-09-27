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
 * An attribute which may be true or false.
 */
class BooleanAttribute extends Attribute
{
    function presentValueFor(Venue $venue) {
        $value = $venue->getAttributeValue($this->getName());

        if ($value == true)
            return 'Ja';
        else if ($value == false)
            return 'Nej';
        else
            return null;
    }

    function parseForm(array $request)
    {
        return safeGetArray($request, $this->name);
    }

    function renderParamController(array $values = null)
    {
        if ($values == null) $values = array();

        echo "<input type='checkbox' class='boolean_true' "
            . "id='{$this->name}_true' name='{$this->name}[]' "
            . "value='1'" . (in_array('1', $values) ? " checked" : "")
            . ">";
        echo "<label for='{$this->name}_true'>Ja</label>\n";

        echo "<input type='checkbox' class='boolean_false' "
            . "id='{$this->name}_false' name='{$this->name}[]' "
            . "value='0'" . (in_array('0', $values) ? " checked" : "")
            . ">";
        echo "<label for='{$this->name}_false'>Nej</label>\n";
    }

    function renderParamValues(array $values)
    {
        $s = array();
        if (in_array('1', $values)) {
            $s[] = 'Ja';
        } 
        if (in_array('0', $values)) {
            $s[] = 'Nej';
        }
        echo implode(', ', $s);
    }
}
