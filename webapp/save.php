<?php
require_once 'lib/bootstrap.php';

if (safeGet($_REQUEST, 'save_new'))
    $selection = new Selection();
else if (isset($_REQUEST['sid']))
    $selection = Selection::load($_REQUEST['sid']);
else
    die('Inget urvals-id gavs.');

if (!$selection->userCanUpdate())
    die('Du har inte rätt att ändra i det här urvalet.');

$selection->setQuery(new Query($_REQUEST));
$selection->setName(safeGet($_REQUEST, 'name'));
$prodnr = safeGet($_REQUEST, 'prodnr');
$selection->setProdNr($prodnr === '' ? null : (int) $prodnr);
$selection->setFinished((boolean) safeGet($_REQUEST, 'finished'));

if ($selection->isFinished() && !$selection->canFinish()) {
    echo '<html><head><meta charset="utf-8"><script>alert("Det finns redan ett färdigt urval med detta produktionsnummer!."); window.location = "index.php";</script></head></html>';
    exit();
}

$selection->save();
header('Location: ' . getTopLevelUrl() . '?sid=' . $selection->getId());
