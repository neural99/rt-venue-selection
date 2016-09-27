<?php
/*
 * Example code using the venue selection web service
 * specification.
 *
 * This example may be run from the command line or a web browser.
 *
 * Per Olofsson <pelle@dsv.su.se>
 * Team Kappa, 2011
 */

// URL to WSDL must be entered here
$wsdl = 'http://localhost:8080/GlassfishStub/VenueSelectionService?wsdl';

// Disable WSDL caching
ini_set('soap.wsdl_cache_enabled', '0');
ini_set('soap.wsdl_cache_ttl', '0');

echo "<pre>\n";

$client = new SoapClient($wsdl, array('trace' => 1));

/*
 * Fetch attributes and print them out
 */

$attributes = $client->getAttributes()->return;

// PHP stupidity
if (!is_array($attributes))
    $attributes = array($attributes);

echo "Attributes:\n";
foreach ($attributes as $attr) {
    echo "{$attr->name} {$attr->type}: {$attr->humanName}\n";
    if ($attr->type == 'numeric') echo "limit={$attr->limit}\n";
    if ($attr->type == 'enum') {
        foreach ($attr->elements as $elem)
            echo "{$elem->id} => {$elem->name}\n";
    }
}
echo "\n";

/*
 * Perform a search
 */

$query = array(
    'parameters' => array(
        array('attribute' => 'antalPlatser',
              'values' => array('100', '100000')),
        array('attribute' => 'lanId',
              'values' => array('01', '02', '04')),
    ),
    'includeNulls' => true,
    'limit' => 100,
    'offset' => 0,
    'sortBy' => 'lokalnamn',
    'descending' => false
);

$result = $client->search(array('q' => $query))->return;

//echo $client->__getLastResponse() . "\n";

$venues = $result->venues;
if (!is_array($venues)) $venues = array($venues);

$organisations = $result->organisations;
if (!is_array($organisations)) $organisations = array($organisations);

foreach ($venues as $venue) {
    echo "Venue: {$venue->id}\n";
    $values = $venue->attributeValues;
    if (!is_array($values)) $values = array($values);
    foreach ($values as $a) {
        echo "{$a->attribute} => {$a->value}\n";
    }
}

echo "</pre>\n";
