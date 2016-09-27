<?php

$wsdl = "geocodeservice.wsdl";
$key = "AuwPLwfBwR7j07ioNvtW-X-qUK1CL0qpoWWQAM-KSWABRS5kxb7ZZLG4WZpfymq2";

$credentials = array('ApplicationId' => $key);
$client = new SoapClient($wsdl, array('trace' => 1));
$request = array(
	'Credentials' => $credentials,
	'Query' => 'Körsbärsvägen 9, Stockholm'
	);
try {
	$response = $client->Geocode(array('request' => $request));
}
catch(SoapFault $e)
{
	die('Fault occurred using Web Service: '.$e->getMessage());
}

$result = $response->GeocodeResult->Results->GeocodeResult[0];
$loc = $result->Locations->GeocodeLocation;
$lat = $loc->Latitude;
$long = $loc->Longitude;
echo "Latitud=$lat, longitud=$long\n";
