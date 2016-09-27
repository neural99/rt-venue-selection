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

class Selection_SaveFailedException extends RuntimeException
{
}

/**
 * A saved selection.
 */
class Selection
{
    private $id = null;
    private $owner;
    private $name = null;
    private $created = null;
    private $updated = null;
    private $finished = false;
    private $prodNr = null;
    private $query = null;
    private static $all;

    function __construct($data = null)
    {
        if ($data !== null) {
            $this->name = $data->name;
            $this->owner = $data->owner;
            $this->created = $data->created;
            $this->updated = isset($data->updated)
                ? $data->updated
                : $this->created;
            $this->finished = $data->finished;
            $this->prodNr = $data->prodNr;
            $this->id = $data->id;

            if (isset($data->query))
                $this->query = new Query($data->query);
        } else {
            $this->owner = getCurrentUser();
        }
    }

    /**
     * Load a saved selection with the specified id.
     * @returns a Selection object
     */
    static function load($id)
    {
        $data = WSClient::premises()->call('getSelection', $id);
        return new Selection($data);
    }

    function getName() { return $this->name; }
    function setName($name) { $this->name = $name; }

    /**
     * Get the date this selection was saved (created)
     */
    function getId() { return $this->id; }

    // Workaround: PHP 5.2 can't (un)serialize DateTime objects.
    function getCreated() { return new DateTime($this->created); }
    function getUpdated() { return new DateTime($this->updated); }

    function getOwner() { return $this->owner; }
    function getProdNr() { return $this->prodNr; }
    function setProdNr($prodNr) { $this->prodNr = $prodNr; }
    function isFinished() { return $this->finished; }
    function setFinished($finished) { $this->finished = $finished; }
    function getQuery() { return $this->query; }
    function setQuery($query) { $this->query = $query; }

    /**
     * Is it possible to flag this selection as finished?
     * @returns A boolean
     */
    function canFinish()
    {
        foreach (self::all() as $id => $s)
            if ($this->prodNr == $s->prodNr && $s->finished
                && $this->id != $id)
                return false;
        return true;
    }

    function userCanUpdate()
    {
        return $this->getOwner() === getCurrentUser();
    }

    /**
     * Gets an array of saved queries based on a given filter
     * This function is used for saved_searches.php
     */
    static function filter($filter, $onlyFinished)
    {
        $filter = sanitizeAlphaNum($filter);
        $arr = array();
        foreach (self::all() as $s)
            if (($filter == "" || strpos($s->getName(), $filter) !== FALSE)
                && (!$onlyFinished || $s->isFinished()))
                    $arr[] = $s;
        return $arr;
     }

    /**
     * Compare two Selection objects by their updated field in
     * descending order (latest first).
     */
    private static function compareByUpdatedReverse($a, $b)
    {
	$a = $a->getUpdated();
	$b = $b->getUpdated();

        if ($a < $b)
            return 1;
        else if ($a > $b)
            return -1;
        else
            return 0;
    }

    /**
     * Get an array of all saved selections.
     * 
     * @returns An array of Selection objects
     */
    static function all()
    {
        if (!isset(self::$all)
            && !(self::$all = Cache::get('selection_list'))) {

            $data = WSClient::premises()->call('getSelectionList');
            self::$all = array();

            foreach ($data as $s)
                self::$all[] = new Selection($s);

            usort(self::$all, array('Selection', 'compareByUpdatedReverse'));

            Cache::put('selection_list', self::$all);
        }

        return self::$all;
    }

    /**
     * Save the selection.
     * @param name the name chosen for this query
     */
    function save()
    {
        $request = array(
            'id' => $this->id,
            'query' => $this->query->getWSData(),
            'name' => $this->name,
            'owner' => $this->owner,
            'finished' => $this->finished,
            'prodNr' => $this->prodNr
        );

        Cache::remove('selection_list');
        $id = WSClient::premises()->call('putSelection', $request);

        if ($id === -1) throw new Selection_SaveFailedException();

        $this->id = $id;
    }

    /**
     * Delete this saved selection.
     */
    function delete()
    {
        Cache::remove('selection_list');
        WSClient::premises()->call('deleteSelection', $this->id);
    }
}
