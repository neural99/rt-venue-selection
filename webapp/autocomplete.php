<?php
require_once 'lib/bootstrap.php';
header('Content-type: application/javascript; charset=utf-8');

$kommunerILan = array();
foreach (Lan::all() as $id => $lan) {
    $kommuner = array();
    foreach ($lan->getKommuner() as $kommun)
        $kommuner[] = $kommun->getName();

    $kommunerILan[$id] = $kommuner;
}
?>

var spelplatser =
<?= json_encode(array_values(Attribute::get('spelplats')->getElements())) ?>;

var kommunerILan = <?= json_encode($kommunerILan) ?>;
