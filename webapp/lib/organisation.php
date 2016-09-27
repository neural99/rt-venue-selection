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
 * An organisation in the search result.
 */
class Organisation
{
    /* Names used in the UI. Should probably not be here. */
    private static $prettyNames = array(
        'name'    => 'Namn',
        'orgTyp'  => 'Organisationstyp',
        'adress1' => 'Adress 1',
        'adress2' => 'Adress 2',
        'epost'   => 'Epost',
        'http'    => 'HTTP',
        'id'      => 'ID',
        'postadress' => 'Postadress',
        'regDatum' => 'Registreringsdatum',
        'regSign'  => 'Registreringssignatur',
        'telefax'  => 'Fax',
        'telefon'  => 'Telefon',
        'updDatum' => 'Senast uppdaterad',
        'updSign'  => 'Uppdaterad av'
    );

    private $id, $info;
    public static $all = array();

    function __construct($data) 
    {
        $this->id = $data->id;
        $this->info = $data;
        self::$all[$this->id] = $this;
    }

    /**
     * Get the ID of this organisation. The ID is an integer which uniquely
     * identifies the organisation.
     */
    function getId() { return $this->id; }

    /**
     * Get an array of attribute values for this organisation. The array
     * uses human names as keys from an internal array of human names.
     */
    function getInfo()
    { 
        $ret = array();
        if (isset($this->info)) {
            $infovars = get_object_vars($this->info);
            foreach (self::$prettyNames as $name => $pname) {
                $ret[$pname] = safeGet($infovars, $name);
            }
        }
        return $ret;
    }

    /**
     * Get the name of this organisation. 
     */
    function getName() { return $this->info->name; }

    /**
     * Get the organisation with a certain id
     */
    static function get($id)
    {
        return safeGet(self::$all, $id);
    }
}
