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
 * A venue in the search result.
 */
class Venue 
{
    private $id;
    private $attributeValues = array();
    private $organisations = array();

    function __construct($data) 
    {
        $this->id = $data->id;

        foreach ($data->attributeValues as $attr)
            if (isset($attr->value))
                $this->attributeValues[$attr->attribute] = trim($attr->value);

        if (isset($data->orgIds)) {
            foreach ($data->orgIds as $id) {
                if (($org = Organisation::get($id)) !== null)
                    $this->organisations[$id] = Organisation::get($id);
                else
                    error_log("org id $id saknas");
            }
        }
    }

    /**
     * Get the ID of this venue. The ID is an integer which uniquely
     * identifies the venue.
     */
    function getId() { return $this->id; }

    /**
     * Get the organisations that are associated with this venue
     * 
     * @return An array of Organisations
     */
    function getOrganisations() { return $this->organisations; }

    /**
     * Get an array of attribute values for this venue. The array
     * uses attribute names as keys.
     */
    function getAttributeValues() { return $this->attributeValues; }

    /**
     * Get the value of a specific attribute for this venue.
     *
     * @param $name The name of the attribute.
     * @return The value of the attribute, or null if there is none.
     */
    function getAttributeValue($name) 
    {
        if (isset($this->attributeValues[$name]))
            return $this->attributeValues[$name];
        else
            return null;
    }

    /**
     * Get the value of a certain attribute of this venue
     * @param $name Name of the Attribute
     */
    function showAttributeValue($name) 
    {
        return Attribute::get($name)->presentValueFor($this);
    }
}
