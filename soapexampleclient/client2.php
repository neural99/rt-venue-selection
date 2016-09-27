<?php

$wsdl = 'http://194.71.244.146:8080/5_RiksteaternEntAppWeb/PremisesWSService?wsdl';
$client = new SoapClient($wsdl, array('trace' => 1, 'login' => 'webla', 'password' => 'HLlmfe7FlgB6'));

header('Content-type: text/plain; charset=UTF-8');

# Sök parametrar
$parameters1 = array(array('attribute' => 'spelplats', 'values' => array('Hallunda', 'Mölnbo')));
$parameters2 = array(array('attribute' => 'spelplats', 'values' => array('Hallunda')));
$parameters3 = array(array('attribute' => 'spelplats', 'values' => array('Mölnbo')));

try {
	$response = $client->search(array('arg0' => array('descending' => true, 'includeNulls' => true, 'limit' => 50, 'offset' => 0, 'parameters' => $parameters1, 'sortBy' => null)));

    echo 'Hallunda + Mölnbo:'; print_r(count($response->return->venues)); echo "\n";

	$response = $client->search(array('arg0' => array('descending' => true, 'includeNulls' => true, 'limit' => 50, 'offset' => 0, 'parameters' => $parameters2, 'sortBy' => null)));

    echo 'Hallunda:'; print_r(count($response->return->venues)); echo "\n";

	$response = $client->search(array('arg0' => array('descending' => true, 'includeNulls' => true, 'limit' => 50, 'offset' => 0, 'parameters' => $parameters3, 'sortBy' => null)));

    echo 'Mölnbo:'; print_r(count($response->return->venues)); echo "\n";
}
catch(SoapFault $e)
{
	die('Fault occurred using Web Service: '.$e->getMessage());
}

