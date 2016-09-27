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
 * An enumerated attribute. The attribute has a limited set of
 * discrete values that it may assume. Each value may also have an
 * opaque identifier.
 */
class EnumAttribute extends Attribute
{
    private static $elements;

    /**
     * Get an array of the values that this attribute may assume. The
     * keys of the array are the opaque identifiers for the values, as
     * used by the database. The values are the human-readable names
     * of the values (which may be presented in a UI).
     */
    function getElements()
    {
        if (!isset(self::$elements))
            self::loadElements();

        return safeGetArray(self::$elements, $this->name);
    }

    function presentValueFor(Venue $venue)
    {
        $value = $venue->getAttributeValue($this->getName());
        $elements = $this->getElements();
        
        if ($value != null && isset($elements[$value]))
            return $elements[$value];
        else
            return $value;
    }

    function parseForm(array $request)
    {
        return safeGetArray($request, $this->name);
    }

    function renderParamController(array $values = null)
    {
        foreach ($this->getElements() as $id => $name) {
            $elem_id = h(strtr($this->name . '-' . $id, ' ', '_'));
            if ($values != null && in_array($id, $values))
                $checked = ' checked';
            else
                $checked = '';

            echo "<input type='checkbox' name='$this->name[]' "
                . "id='$elem_id' value='$id'$checked>";
            echo "<label for='$elem_id'>" . h($name) . "</label>\n";
        }
    }

    function renderParamValues(array $values)
    {
        $names = array();

        foreach ($values as $id)
            if (($name = safeGet($this->getElements(), $id)) !== null)
                $names[] = $name;

        echo implode('; ', $names);
    }

    /** 
     * Load the enum elements (possible selections) from the WS 
     */
    private static function loadElements()
    {
        if ((self::$elements = Cache::get('enum_elements'))) return;

        $response = WSClient::premises()->call('getEnumAttributes');

        self::$elements = array();

        foreach ($response as $enum) {
            $elements = array();
            foreach ($enum->elements as $elm) {
                $elements[trim($elm->id)] = trim($elm->name);
            }
            // Why is this even uppercase?
            self::$elements[strtolower($enum->name)] = $elements;
        }

        // Fix bug in the web service 
        // This should be fixed 
        self::$elements['kategori']['*okänd*'] = '*okänd*';
    
        // Only show these countries
        self::$elements['land'] = array('45' => 'Danmark',
                                        '46' => 'Sverige',
                                        '47' => 'Norge',
                                        '358' => 'Finland');

        Cache::put('enum_elements', self::$elements);
    }

}
