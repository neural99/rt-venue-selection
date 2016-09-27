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

require_once 'lib/bootstrap.php';

if (isset($_REQUEST['sid'])) {
    $selection = Selection::load($_REQUEST['sid']);
    $query = $selection->getQuery();
} else {
    $query = new Query($_REQUEST);
}

?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sök lokal</title>
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css"
          href="css/cupertino/jquery-ui-1.8.9.custom.css">

    <link rel="stylesheet" type="text/css" href="css/form.css">
    <link rel="stylesheet" type="text/css" href="css/result.css">
    <link rel="stylesheet" type="text/css" href="css/saved.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui-1.8.9.custom.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/jquery.blockUI.js"></script>
	
	<script src="js/jquery.tablesorter.mod.js"></script> 
	<script src="js/jquery.uitablefilter.js"></script> 
	<script src="js/saved_table.js"></script> 
	
    <script src="autocomplete.php"></script>
    <script src="js/form.js"></script>
    <script src="js/saved.js"></script> 
    <script src="js/result.js"></script>
  </head>
  <body>
    <div id="login_message">Inloggad som <?=h(getCurrentUser())?></div>

    <h1>Tekniskt urval</h1>

    <div id="query_form_wrapper">
      <? require './form.php' ?>
    </div>

    <div id="result">
      <? if (isset($selection)) require './result.php' ?>
    </div>

    <button id="minimize_button">Sparade urval</button>

    <div id="saved_queries" title="Sparade urval">
      <a href="selections.php">Sök sparade urval</a><br><br>
	  <form id="filter-form">Sök på namn: <input name="filter" id="filter" value="" maxlength="30" size="30" type="text"></form><br>
      <table class="saved_table tablesorter">
        <col class="name">
        <col class="prodnr">
        <col class="owner">
        <col class="updated">
        <thead>
          <tr>
            <th>Namn</th>
            <th>Prod.nr</th>
            <th>Ägare</th>
            <th>Uppdaterad</th>
          </tr>
        </thead>
        <tbody>
          <? $sid = isset($selection) ? $selection->getId() : null ?>
          <? foreach (Selection::all() as $s): ?>
            <tr<?= $s->getId() == $sid ? ' class="selected"' : '' ?>>
              <td><a class="selection" href="#"
                     data-sid="<?=$s->getId()?>"><?=h($s->getName())?></a></td>
              <td><?= $s->getProdNr() ?><?= $s->isFinished() ? '*' : '' ?></td>
              <td><?= h($s->getOwner()) ?></td>
              <td><?= $s->getUpdated()->format('Y-m-d') ?></td>
            </tr>
          <? endforeach ?>
        </tbody>
      </table>
    </div>

    <div id="save_query_window" title="Spara urval">
      <form id="save_query_form">
        <p>Urvalsnamn:</p>
        <input type="text" name="query_name">
      </form>
    </div>

    <div id="copy_query_window" title="Kopiera urval">
      <form id="copy_query_form">
        <p>Urvalsnamn:</p>
        <input type="text" name="query_name">
      </form>
    </div>

    <div id="delete-selection-dialog" title="Ta bort urval">
      <form id="delete-selection-form" method="POST" action="delete.php">
        <input type="hidden" name="sid">
        <p>Är du säker på att du vill ta bort det här urvalet?</p>
      </form>
    </div>
  </body>
</html>
