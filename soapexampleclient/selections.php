<?php

$wsdl = 'http://194.71.244.146:8080/5_RiksteaternEntAppWeb/PremisesWSService?wsdl';

$client = new SoapClient($wsdl, array('trace' => 1, 'login' => 'webla', 'password' => 'HLlmfe7FlgB6'));

header('Content-type: text/plain');

$parameters = array(array('attribute' => 'spelplats', 'values' => array('Hallunda')));

try {
	$response = $client->getEnumAttributes();
    print_r($response);

    print_r($client->__getLastRequest()) . "\n\n";
    print_r($client->__getLastResponse());
}
catch(SoapFault $e)
{
	die('Fault occurred using Web Service: '.$e->getMessage());
}

