<?php

$wsdl = 'http://194.71.244.146:8080/5_RiksteaternEntAppWeb/RepertoarWSService?wsdl';

$client = new SoapClient($wsdl, array('trace' => 1, 'login' => 'webla', 'password' => 'HLlmfe7FlgB6'));

header('Content-type: text/plain');

print_r($client->__getFunctions());
print_r($client->__getTypes());

try {
	$response = $client->GetRepertoarList(10, 0, 0, 0, 0, array(), array(), 0, 0, true);
    print_r($response);

    print_r($client->__getLastRequest()) . "\n\n";
    print_r($client->__getLastResponse());
}
catch(SoapFault $e)
{
	die('Fault occurred using Web Service: '.$e->getMessage());
}

