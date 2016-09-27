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

class SpelplatsAttribute extends AutocompleteAttribute
{
    private $elements;

    function getElements()
    {
        if (!isset($this->elements)) {
            // Should get this from WS instead.
            $this->elements = array();
            $f = fopen(CONFIG_DIR . '/spelplatser.txt', 'rb');
            while ($line = fgets($f)) {
                $spelplats = chop($line, "\r\n");
                $this->elements[self::canonicalizeName($spelplats)]
                    = $spelplats;
            }
            fclose($f);
        }
        return $this->elements;
    }

    protected function valuesToElementNames($values)
    {
        return $values;
    }

    protected function elementNamesToValues($names)
    {
        $values = array();
        foreach ($names as $name) {
            $value = safeGet($this->getElements(),
                             self::canonicalizeName($name));
            if ($value !== null) $values[] = $value;
        }
        return $values;
    }
}
