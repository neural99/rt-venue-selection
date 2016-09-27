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
 * A search query for the venue database.
 */
class Query
{
    private $parameters = array();
    private $includeNulls = true;
    private $limit = 25;
    private $offset = 0;
    private $sortBy = 'lokalnamn';
    private $descending = false;
    private $columns;

    function __construct($source = array())
    {
        if (is_object($source))
            $this->initFromSelection($source);
        else
            $this->parseForm($source);
    }

    /**
     * Initialize the Query from HTTP POST data (PHP super global REQUEST is used) 
     */
    private function parseForm(array $request) 
    {
        foreach (Attribute::all() as $name => $attr) {
            $values = $attr->parseForm($request);
            if (!empty($values))
                $this->parameters[$name] = $values;
        }

        if (isset($request['limit']))
            $this->limit = (int) $request['limit'];

        if (isset($request['pagenr']))
            $this->offset = ((int)$request['pagenr']-1)*($this->limit);

        if (isset($request['sortBy']))
            $this->sortBy = $request['sortBy'];

        if (isset($request['descending']))
            $this->descending = (boolean) $request['descending'];

        if (isset($request['col']))
            $this->columns = $request['col'];
        else
            $this->columns = Config::$defaultColumns;
    }

    /**
     * Initialize the Query from a selection
     * 
     * @param $s The selection 
     */
    private function initFromSelection($s)
    {
        $this->columns = Config::$defaultColumns;

        foreach ($s->parameters as $p)
            if (isset($p->values))
                $this->parameters[$p->attribute] = $p->values;
    }

    function getParameters() { return $this->parameters; }
    function getParameter($name) { return safeGet($this->parameters, $name); }
    function getColumns() { return $this->columns; }
    function hasColumn($col) { return in_array($col, $this->columns); } 
    function getLimit() { return $this->limit; }
    function setLimit($limit) { $this->limit = $limit; }
    function getPageNumber() { return ($this->offset)/($this->limit)+1; }
    function getSortBy() { return $this->sortBy; }
    function getDescending() { return $this->descending; }

    /**
     * Converts from internal format to the format used by the WS
     *
     * @returns RetValQuery array conforming to web service specification
     */
    function getWSData()
    {
        $data = array(
            'descending' => $this->descending,
            'includeNulls' => $this->includeNulls,
            'limit' => $this->limit,
            'offset' => $this->offset,
            'sortBy' => $this->sortBy,
            'parameters' => array()
        );

        foreach ($this->parameters as $name => $values)
            if ($values != null)
                $data['parameters'][]
                    = array('attribute' => $name, 'values' => $values);

        return $data;
    }

    /**
     * Submit query to the database and parse the results.
     *
     * @returns The Result object.
     */
    function submit()
    {
        $data = WSClient::premises()->call('search', $this->getWSData());
        return new Result($data);
    }
}
