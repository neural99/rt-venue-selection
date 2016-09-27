<?php

ini_set('soap.wsdl_cache_enabled', '0');
ini_set('soap.wsdl_cache_ttl', '0');

class Base {
	public $basevar;
}
class Sub extends Base {
	public $subvar;
}

$wsdl = 'http://localhost:8080/axis2/services/dummyVenueSearch?wsdl';

$client = new SoapClient($wsdl,
			 array('trace' => 1,
			       'classmap' => array(
				       'Base' => 'Base',
				       'Sub' => 'Sub')));

$base = new Base();
$base->basevar = 1;
$sub = new Sub();
$sub->basevar = 2;
$sub->subvar = 3;

print_r($client->__getFunctions());

try {
	print_r($client->doBase(array('args0' => $base)));
	print_r($client->doSub(array('args0' => $sub)));
	print_r($client->doBase(array('args0' => $sub)));
	print_r($client->polyArray(array('args0' => array($base, $sub))));

	echo "Request: ", $client->__getLastRequest(), "\n";
	echo "Response: ", $client->__getLastResponse(), "\n";
}
catch(SoapFault $e)
{
	die('Fault occurred using Web Service: '.$e->getMessage());
}
