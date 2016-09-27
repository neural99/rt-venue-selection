<?php

/* This is used by the AJAX code to load the form of a saved search */

require_once 'lib/bootstrap.php';
require_once 'form_helper.php';

if (!isset($query) && isset($_REQUEST['sid'])) {
    $selection = Selection::load($_REQUEST['sid']);
    $query = $selection->getQuery();
}

?>
<form id="query_form" method="POST" action="index.php">
  <? if (isset($selection)): ?>
    <div id="selection-properties">
      <input type="hidden" name="sid" value="<?=$selection->getId()?>">
      <input type="hidden" name="save_new" value="0">
      <? prop_field('name', 'Namn', $selection->getName()) ?>
      <? prop_field(null, 'Ägare', $selection->getOwner()) ?>
      <? prop_field(null, 'Skapad',
                    $selection->getCreated()->format('Y-m-d H:i')) ?>
      <? prop_field(null, 'Senast uppdaterad',
                    $selection->getUpdated()->format('Y-m-d H:i')) ?>
      <? prop_field('prodnr', 'Produktionsnummer', $selection->getProdNr()) ?>
      <p>
        <label for="finished">Färdig?</label>
        <input type="checkbox" id="finished" name="finished"
               value="1" <?= $selection->isFinished() ? 'checked' : '' ?>
               <?= $selection->userCanUpdate() ? '' : 'style="display:none"' ?>>
        <? if (!$selection->userCanUpdate()): ?>
          <?= $selection->isFinished() ? 'Ja' : 'Nej' ?>
        <? endif ?>
      </p>
      <p>
        <label></label>
        <a href="show.php?sid=<?=$selection->getId()?>"
           target="_blank">Sammanfattningsvy</a>
      </p>
    </div>
  <? else: ?>
    <input type="hidden" name="save_new" value="1">
    <input type="hidden" name="name">
  <? endif ?>

  <div id="query_box">
    <? foreach (AttributeGroup::all() as $name => $group): ?>
       <? $id = 'show-param-group-' . $name ?>
       <div class="param-group-button">
         <input type="checkbox" id="<?=$id?>">
         <label for="<?=$id?>"><?=$group->getHumanName()?></label>
       </div>
       <? renderParamGroup($query, $group) ?>
    <? endforeach ?>
    <? if (safeGet($_REQUEST, 'debug')): ?>
      <p id="debug">
        Debug:
        <? foreach (array(
           'showRequest' => 'Visa fråga',
           'showRequestXML' => 'Visa XML-fråga',
           'showResponse' => 'Visa svar',
           'showResponseXML' => 'Visa XML-svar'
          ) as $id => $label): ?>
          <input id="<?=$id?>" name="<?=$id?>" type="checkbox">
          <label for="<?=$id?>"><?=$label?></label>
        <? endforeach ?>
      </p>
    <? endif ?>
    <label class="limit">Antal träffar per sida:
      <select name="limit">
        <?
           foreach (array(10, 25, 50, 100, 500) as $l)
               echo "<option value='{$l}'"
                   . ($query->getLimit() == $l ? ' selected' : '')
                   . ">{$l}</option>\n"
        ?>
      </select>
    </label>
  </div>

  <input type="hidden" name="pagenr"
         value="<?= $query->getPageNumber() ?>">
  <input type="hidden" name="sortBy"
         value="<?= $query->getSortBy() ?>">
  <input type="hidden" name="descending"
         value="<?= (int) $query->getDescending() ?>">

  <div id="bottom-bar">
    <a id="reset" class="button"
       href="index.php">Nollställ</a>
    <input id="search_button" type="submit" name="search" value="Sök">
    <input id="excel" type="submit" value="Hämta Excel-fil">
    <? if (!isset($selection)): ?>
      <button id="save-button">Spara urval</button>
    <? else: ?>
      <? if ($selection->userCanUpdate()): ?>
        <button id="update-button">Spara ändringar</button>
        <button id="delete-button">Ta bort urval</button>
      <? endif ?>
      <button id="copy-button">Kopiera urval</button>
    <? endif ?>
  </div>
</form>
