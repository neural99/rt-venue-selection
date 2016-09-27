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
 * An attribute specifying the municipalities (kommuner).
 */
class KommunAttribute extends AutocompleteAttribute
{
    protected function elementNamesToValues($names)
    {
        $ids = array();
        foreach ($names as $name)
            if (($kommun = Kommun::getByName(trim($name))))
                $ids[] = $kommun->getGlobalId();

        if (count($ids) > 0)
            return array(implode(',', $ids));
        else
            return array();
    }

    protected function valuesToElementNames($values)
    {
        $names = array();
        if ($values !== null && isset($values[0]))
            foreach (explode(',', $values[0]) as $globalId)
                if (($kommun = Kommun::get($globalId)) !== null)
                    $names[] = $kommun->getName();
        return $names;        
    }

    function presentValueFor(Venue $venue)
    {
        $lanId = $venue->getAttributeValue('lanId');
        $kommunId = $venue->getAttributeValue('kommunId');

        if (($lan = Lan::get($lanId)) !== null
            && ($kommun = $lan->getKommun($kommunId)) !== null)
            return $kommun->getName();
        else
            return null;
    }
}
