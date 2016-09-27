<?php

/* Webservice configuration */
Config::$premisesWsdl =
    'http://194.71.244.146:8080/5_RiksteaternEntAppWeb/PremisesWSService?wsdl';
Config::$repertoarWsdl =
    'http://194.71.244.146:8080/5_RiksteaternEntAppWeb/RepertoarWSService?wsdl';
Config::$wsUser = 'webla';
Config::$wsPassword = 'HLlmfe7FlgB6';

Config::$cacheLifetime = 3600;

// Set a low TTL for WSDL cache for now.
// Raise it later when web service is "done".
ini_set('soap.wsdl_cache_ttl', '3600');

Config::$defaultColumns = array(
    'lokalnamn', 'lanId', 'kommunId', 'spelplats', 'farg', 'lokaltyp',
    'antalPlatser', 'logePlatser'
);

// Timezone
date_default_timezone_set('Europe/Stockholm');
