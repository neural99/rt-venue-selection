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
 * A grouping of attributes. It is used to determine the layout of the form.
 * The form is grouped by user categories. The AttributeGroups are loaded from
 * a configuration file in the config directory. 
 */
class AttributeGroup
{
    private $name, $humanName, $attributes;
    private static $all = array();

    function __construct($name, $humanName, array $attributes)
    {
        $this->name = $name;
        $this->humanName = $humanName;
        $this->attributes = $attributes;
        self::$all[$name] = $this;
    }

    /**
     * Get the identifying name of this attributegroup.
     */
    function getName() { return $this->name; }

    /**
     * Get the name used in the UI.
     */
    function getHumanName() { return $this->humanName; }

    /**
     * Get the attributes this attribute group contains
     *
     * @returns An array of attributes
     */
    function getAttributes() { return $this->attributes; }

    /**
     * Get all attribute groups
     *
     * @returns An array of AttributeGroups.
     */
    static function all()
    {
        Attribute::ensureLoaded();
        return self::$all;
    }

    /**
     * Get the attribute group with a certain name
     */
    static function get($name)
    {
        return safeGet(self::all(), $name);
    }

}
