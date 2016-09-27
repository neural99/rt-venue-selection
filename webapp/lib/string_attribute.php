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
 * An attribute which may assume an arbitrary string value.
 */
class StringAttribute extends Attribute
{
    function parseForm(array $request)
    {
        $str = trim((string) safeGet($request, $this->name));
        return $str !== '' ? array($str) : null;
    }

    function renderParamController(array $values = null)
    {
        if ($values != null)
            $value = h(implode('; ', $values));
        else
            $value = '';

        echo "<input type='text' id='id-{$this->name}' "
            . "name='{$this->name}' value='$value' class='textfield'>\n";
    }

    function renderParamValues(array $values)
    {
        echo h(implode('; ', $values));
    }
}
