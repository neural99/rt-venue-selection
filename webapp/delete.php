<?php
require_once 'lib/bootstrap.php';

if (!isset($_POST['sid']))
    die('Inget urvals-id gavs.');

$selection = Selection::load($_POST['sid']);

if (!$selection->userCanUpdate())
    die('Du har inte rätt att ändra i det här urvalet.');

$selection->delete();
header('Location: ' . getTopLevelUrl());
