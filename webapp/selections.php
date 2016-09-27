<?php
require_once 'lib/bootstrap.php';

$filter = (string) safeGet($_GET, 'filter');
$onlyFlagged = (boolean) safeGet($_GET, 'onlyFlagged');

?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sök urval</title>
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css"
          href="css/cupertino/jquery-ui-1.8.9.custom.css">
    <link rel="stylesheet" type="text/css" href="css/saved.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui-1.8.9.custom.min.js"></script>      
  </head>
  <body>
    <a href="index.php">Tillbaka</a>

    <form action="selections.php" method="GET">
      <label>
        Sök efter namn:
        <input name="filter" value="<?= h($filter) ?>">
      </label>
      <br>
      <label>
        Visa bara färdiga urval:
        <input type="checkbox" name="onlyFlagged" value="1"
               <?= $onlyFlagged ? "checked" : "" ?>>
      </label>
      <br>
      <input type="submit" value="Sök">
    </form>

    <table class="saved_table tablesorter">
      <thead>
        <tr><th>Namn</th><th>Ägare</th><th>Uppdaterad</th><th>Färdig</th><th>Prodnr</th><th>Sammanfattning</th></tr>
      </thead>
      <tbody>
        <? foreach (Selection::filter($filter, $onlyFlagged) as $s): ?>
          <tr>
            <td><a href="index.php?sid=<?=$s->getId()?>"><?=h($s->getName())?></a></td>
            <td><?= $s->getOwner() ?></td>
            <td><?= $s->getUpdated()->format('Y-m-d H:i') ?></td>
            <td><?= $s->isFinished() ? 'Ja' : 'Nej' ?></td>
            <td><?= $s->getProdNr() === null ? 'Nej' : $s->getProdNr() ?></td>
            <td><a href="show.php?sid=<?= $s->getId() ?>"
                   >Sammanfattning</a>
          </tr>
        <? endforeach ?>
      </tbody>
    </table>
  </body>
</html>
