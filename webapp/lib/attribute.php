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
 * Abstract base class for all attribute types. Represents a
 * particular attribute in the venue database, such as kommun,
 * antalPlatser, and so on. It is also responsible for keeping track
 * of the user-supplied parameters. It does not include any attribute
 * values, however.
 */
abstract class Attribute
{
    protected $name, $humanName;
    private static $all;

    function __construct($name, $humanName)
    {
        $this->name = $name;
        $this->humanName = $humanName;
        self::$all[$name] = $this;
    }

    /**
     * Get the identifying name of this attribute.
     */
    function getName() { return $this->name; }
    /**
     * Get the human-readable name of this attribute. Can be used to
     * label the attribute in a user interface.
     */
    function getHumanName() { return $this->humanName; }
    
    /**
     * Get the type of this attribute, like "enum", "numeric", etc.
     * @returns The type of the attribute as a string.
     */
    function getType()
    {
        return strtolower(str_replace('Attribute', '', get_class($this)));
    }

    /**
     * Get the value of this attribute from a venue
     */
    function presentValueFor(Venue $venue)
    {
        return $venue->getAttributeValue($this->name);
    }

    /**
     * Parse the HTTP POST data from the form (the PHP REQUEST magical global is used)
     *
     * @returns An array of the of values
     */
    abstract function parseForm(array $request);

    /**
     * Render (output HTML) a controller that is used in the form on the main page 
     * 
     * @param $values A list of the current values 
     */
    abstract function renderParamController(array $values = null);

    /**
     * Render (output HTML) a simple view of the attribute. Used in the show.php.
     * 
     * @param $values A list of the current values 
     */
    abstract function renderParamValues(array $values);

    /**
     * Get an array of all available attributes.
     *
     * @returns An array with attribute names as keys,
     * and the Attribute instances as values.
     */
    static function all()
    {
        self::ensureLoaded();
        return self::$all;
    }

    /**
     * Get the Attribute object of an attribute with a specific name.
     *
     * @param $attrName The name of the attribute.
     * @returns The Attribute object, or null if it doesn't exist.
     */
    static function get($attrName)
    {
        return safeGet(self::all(), $attrName);
    }

    /**
     * Ensure that the Attributes have been loaded from the configuration file
     */
    static function ensureLoaded()
    {
        if (!isset(self::$all)) {
            self::$all = array();
            require dirname(__FILE__) . '/../config/attributes.php';
        }
    }
}
