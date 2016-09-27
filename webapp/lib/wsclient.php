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
 * Handles all communications with a certain WS 
 */
class WSClient
{
    private $soapClient;

    private function __construct($wsdl)
    {
        $this->soapClient = new SoapClient(
            $wsdl,
            array('login' => Config::$wsUser,
                  'password' => Config::$wsPassword,
                  'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
                  'trace' => 1)
        );
    }

    /**
     * Get the WSClient object for the premise web service
     */
    static function premises()
    {
        static $client;

        if (!isset($client))
            $client = new WSClient(Config::$premisesWsdl);

        return $client;
    }

    /**
     * Get the WSClient object for the repertoar web service
     */
    static function repertoar()
    {
        static $client;

        if (!isset($client))
            $client = new WSClient(Config::$repertoarWsdl);

        return $client;
    }

    /**
     * Make a method innovocation on the WS with SOAP
     * @param $method Method name
     * @param $arg Arguments to be passed to the WS
     */
    function call($method, $arg = null)
    {
        if ($arg !== null)
            $request = array(array('arg0' => $arg));
        else
            $request = array();

        try {
            $response = $this->soapClient->__soapCall($method, $request);
            $this->debugCall($method, $request, $response);

            if (!isset($response->return))
                die("Missing SOAP return value.");

            return $response->return;
        } catch (SoapFault $e) {
            $this->debugCall($method, $request, null);
            die("Web service request failed: " . $e->getMessage());
        }
    }

    /**
     * Debug functions that prints out the communications with the
     * WS
     */
    private function debugCall($method, $request, $response)
    {
        if (isset($_REQUEST['showRequest']))
            debug_msg("Request $method:\n" . print_r($request, true));

        if (isset($_REQUEST['showRequestXML']))
            debug_msg("Request $method (XML):\n"
                      . prettyprint_xml($this->soapClient
                                        ->__getLastRequest()));

        if (isset($_REQUEST['showResponse']))
            debug_msg("Response $method:\n" . print_r($response, true));

        if (isset($_REQUEST['showResponseXML']))
            debug_msg("Response $method (XML):\n"
                      . prettyprint_xml($this->soapClient
                                        ->__getLastResponse()));
    }

}
