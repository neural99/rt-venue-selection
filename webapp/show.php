<?php
require_once 'lib/bootstrap.php';
require_once 'form_helper.php';

if (!isset($_REQUEST['sid'])) {
    echo "Fel: urvals-ID saknas.";
    exit();
}

$selection = Selection::load($_REQUEST['sid']);
$query = $selection->getQuery();

?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tekniskt urval: <?=h($selection->getName())?></title>
  </head>
  <body>
    <h1>Tekniskt urval: <?=h($selection->getName())?></h1>

<p>
  <b>Namn:</b> <?=h($selection->getName())?><br>
  <b>Ägare:</b> <?=h($selection->getOwner())?><br>
  <b>Skapad:</b> <?=h($selection->getCreated()->format('Y-m-d H:i'))?><br>
  <b>Senast uppdaterad:</b>
    <?=h($selection->getUpdated()->format('Y-m-d H:i'))?><br>
  <b>Färdig:</b> <?=$selection->isFinished() ? "Ja" : "Nej"?><br>
  <b>Produktionsnummer:</b> <?= $selection->getProdNr() == null ? "Nej"
    : $selection->getProdNr() ?>
</p>

<h2>Parametrar</h2>

<? foreach (AttributeGroup::all() as $group): ?>
  <h3><?=$group->getHumanName()?></h3>
  <? renderParamGroupSimpleView($query, $group) ?>
<? endforeach ?>

<h2>Resultat</h2>

<?
  $result = $query->submit();
  $numCols = count($query->getColumns());
?>
<table style="text-align: left; width=100%;">
<? foreach ($result->getVenues() as $venue): ?>  
  <tr>
    <?php
    foreach ($query->getColumns() as $col): ?>
      <th><?= h(Attribute::get($col)->getHumanName()) ?></th>
    <? endforeach ?>
  </tr>
    <tr>
      <? foreach ($query->getColumns() as $col): ?>
        <td class="result"><?= h($venue->showAttributeValue($col)) ?></td>  
      <? endforeach ?>
	  </tr>
        <? if (count($venue->getOrganisations()) > 0): ?>
            <tr><th>Organisationer</th><tr>
        <? endif; ?>
		<? foreach ($venue->getOrganisations() as $org):  ?>
			<tr><td colspan="<?= $numCols ?>"> <?= $org->getName() ?> </td></tr>
		<? endforeach; ?>
	<tr><td colspan="<?= $numCols ?>"><hr></td></tr>
<? endforeach ?>
</table>
</body>
</html>
