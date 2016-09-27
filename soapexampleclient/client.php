<?php

$wsdl = 'http://194.71.244.146:8080/5_RiksteaternEntAppWeb/PremisesWSService?wsdl';

$client = new SoapClient($wsdl, array('trace' => 1, 'login' => 'webla', 'password' => 'HLlmfe7FlgB6'));

header('Content-type: text/plain; charset=UTF-8');

#print_r($client->__getFunctions());
#print_r($client->__getTypes());

$parameters = array(array('attribute' => 'riksteaterLokal', 'values' => array('true')), array('attribute' => 'orkesterdike', 'values' => array('false')));

try {
	$response = $client->search(array('arg0' => array('descending' => true, 'includeNulls' => true, 'limit' => 10, 'offset' => 0, 'parameters' => $parameters, 'sortBy' => 'lokalnamn')));
    print_r($response);
    foreach ($response->return->venues as $venue) {
        foreach ($venue->attributeValues as $attr) {
            if ($attr->attribute == 'lokalnamn') {
                print_r($attr->value . "\n");
            }
        }
    }

    #print_r($client->__getLastRequest()) . "\n\n";
    #print_r($client->__getLastResponse());
}
catch(SoapFault $e)
{
	die('Fault occurred using Web Service: '.$e->getMessage());
}

