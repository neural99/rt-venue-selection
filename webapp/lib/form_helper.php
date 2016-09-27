<?php
/*
 * Riksteatern Venue Selection
 * Copyright (C) 2010-2011  Team Kappa
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/** @file
 * Helper code for the search form.
 */

/* Temp global variabel used for debuging */
$data = array();

/**
 * Render a group of parameters in the query form.
 *
 * @param $query The query whose parameters are to be rendered.
 * @param $group The attribute group.
 */
function renderParamGroup(Query $query, AttributeGroup $group)
{
?>
<table class="param-group" id="<?=$group->getName()?>-param-group">
  <col class="param-show">
  <col class="param-name">
  <col class="param-controller">

  <? foreach ($group->getAttributes() as $attr): ?>
    <? $name = $attr->getName() ?>
    <? $param = $query->getParameter($name) ?>
    <tr class="attr <?=$attr->getType()?>_attr" id="param-<?=h($name)?>">
      <td class="attr_show">
        <input type="checkbox" name="col[]" value="<?=h($name)?>"<?
          if ($query->hasColumn($name)): ?> checked<? endif ?>>
      </td>
      <td class="attr_name"><?=h($attr->getHumanName())?> [<a href="javascript:helppopup('<?=strtolower(h($attr->getName()))?>')">?</a>]:</td>
      <td class="attr_controller">
              <? $attr->renderParamController($param) ?>
      </td>
    </tr>
  <? endforeach ?>
</table><?php
}

function renderParamGroupSimpleView(Query $query, AttributeGroup $group)
{
    foreach ($group->getAttributes() as $attr) {
        $param = $query->getParameter($attr->getName());
        if ($param != null) {
            ?>
              <b><?= $attr->getHumanName()?>: </b><?= $attr->renderParamValues($param) ?><br>
            <? 
        }
    }
}

function prop_field($name, $humanName, $value)
{
    global $selection;
?>
<p>
  <label<? if ($name !== null): ?> for="<?=$name?>"<? endif ?>><?=h($humanName)?>:</label>
  <? if ($name !== null && $selection->userCanUpdate()): ?>
    <input id="<?=$name?>" name="<?=$name?>" value="<?=h($value)?>">
  <? else: ?>
    <?=h($value)?>
    <input type="hidden" name="<?=$name?>" value="<?=h($value)?>">
  <? endif ?>
</p>
<?
}
