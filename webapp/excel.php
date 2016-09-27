<?php
require_once 'lib/bootstrap.php';

$query = new Query($_REQUEST);
$query->setLimit(0);
$result = $query->submit();

setcookie('fileDownloaded', '1');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="urval.xls"');

function output_callback($buffer)
{
    return mb_convert_encoding($buffer, 'Windows-1252', 'UTF-8');
}
ob_start('output_callback');

$headings = array();
foreach ($query->getColumns() as $col)
    $headings[] = Attribute::get($col)->getHumanName();
$headings[] = 'Organisationer';
echo implode("\t", $headings) . "\r\n";

foreach ($result->getVenues() as $venue) {
    $values = array();

    foreach ($query->getColumns() as $col)
        $values[] = $venue->showAttributeValue($col);

    $orgs = array();
    foreach ($venue->getOrganisations() as $org)
        $orgs[] = $org->getName();
    $values[] = implode('; ', $orgs);

    // Quote values as necessary
    for ($i = 0; $i < count($values); $i++) {
        $v = $values[$i];
        if ($v === null || $v === '' || strpbrk($v, "\"\t\n\r,;") !== false)
            $values[$i] = '"' . strtr($v, '"', '""') . '"';
    }

    echo implode("\t", $values) . "\r\n";
}
