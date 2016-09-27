<?php

$wsdl = 'http://194.71.244.146:8080/5_RiksteaternEntAppWeb/PremisesWSService?wsdl';

$client = new SoapClient($wsdl, array('trace' => 1, 'login' => 'webla', 'password' => 'HLlmfe7FlgB6'));

header('Content-type: text/plain');

$parameters = array(array('attribute' => 'riksteaterLokal', 'values' => array('True')));

try {

		#Save new selection
#        $retValQuery = array('descending' => true, 'includeNulls' => true, 'limit' => 10, 'offset' => 0, 'parameters' => $parameters, 'sortBy' => 'lokalnamn');
#        $retValSelection = array('id' => null, 'query' => $retValQuery, 'name' => "Derp", 'owner' => "Derper", 'finished' => false, 'prodNr' => null);
		
#		$response1 = $client->putSelection(array('arg0' => $retValSelection));
#		$id = $response1->return;
#		print_r("id="); print_r($id); print_r("\n");
		
		# Get selection
        $response2 = $client->getSelection(array('arg0' => '61'));
          
#		print_r($response2);
    print_r($client->__getLastRequest()) . "\n\n";
    print_r($client->__getLastResponse());
}
catch(SoapFault $e)
{
	die('Fault occurred using Web Service: '.$e->getMessage());
}

