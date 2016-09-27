<?php

/* Used by AJAX code to fetch results */

require_once 'lib/bootstrap.php';

if (!isset($query)) $query = new Query($_REQUEST);
$result = $query->submit();
$numCols = count($query->getColumns());

?>
<div id="hits"><p>Totalt <?=$result->getTotalCount()?> träffar.</p></div>
<table id="result_table" class="result">
<thead>
  <tr>
    <th class="org-expander"></th>
    <?php
          $descending = 'ascending';
	  $icon = 's';
	  if($query->getDescending()) {
	     $descending = 'descending';
             $icon = 'n';
	  }
	  foreach ($query->getColumns() as $col): 
	  if($query->getSortBy() === $col): ?>
         <th class="data sortBy <?=$descending?>" name="<?=$col?>"><span><?= h(Attribute::get($col)->getHumanName())?><span style="display: inline-block; vertical-align: -20%;" class="ui-icon ui-icon-triangle-1-<?=$icon?>"/></span></th>
      <?else:?> 
	      <th class="data" name="<?=$col?>"><?= h(Attribute::get($col)->getHumanName()) ?></th>
	  <?endif?>
    <? endforeach ?>
  </tr>
</thead>
<tbody>
<?php
    $rowcolor = 'even';
    foreach ($result->getVenues() as $venue): 
    if($rowcolor == 'even') $rowcolor='odd';
    else if($rowcolor == 'odd') $rowcolor='even';
?>
    <tr class="<?=$rowcolor?>">
      <td class="org-expander" >
          <input type="checkbox" name="<?=h($venue->getId())?>_orgs[]" id="<?=h($venue->getId())?>_org">
        <label for="<?=h($venue->getId())?>_org" class="<?php
            if(!($venue->getOrganisations())){
                print('ui-helper-hidden-accessible');
            }
            ?>"></label>
      </td>

      <? foreach ($query->getColumns() as $col): ?>
        <td class="data"><? if ($col == 'lokalnamn'): ?>
          <a href="http://www.scenrum.nu/lokal/index.asp?lokalid=<?=
             h($venue->getId())?>" target="_blank"><?=
             h(Attribute::get($col)->presentValueFor($venue)) ?></a>
          <? else: ?><?= h(Attribute::get($col)->presentValueFor($venue))
          ?><? endif ?></td>
      <? endforeach ?>
        
    </tr>
    <tr class="orglist expand-child">
      <td></td>
      <td class="orglist" colspan="<?= $numCols?>">
        <? foreach ($venue->getOrganisations() as $org):  ?>
          <div class="organisation">
          <? foreach ($org->getInfo() as $name => $value): ?>
              <?php // "Snygg" utskrift
              if($name == "Namn"){
                  ?><b class="organisationsNamn"><?= $value ?></b><br><?php
              }else if(($value != null) && (strlen(trim($value)) > 0)){
                  ?><b><?= $name ?></b>: <?= $value ?><br><?php
              }
              ?>
          <? endforeach; ?> 
          </div>
        <? endforeach ?>
      </td>
    </tr>
  <? endforeach ?>
  <tr><td colspan="<?= $numCols+1?>">sida: <?php
    $pagecount = ($result->getTotalCount())/($query->getLimit());
        if(($result->getTotalCount())%($query->getLimit()) > 0)
            $pagecount = $pagecount + 1;
        
    for ($i = 1; $i <= $pagecount; $i += 1):
        if($query->getPageNumber() == $i):?> 
            <a class="pagenumber" style="font-weight: bold;"><?=$i?></a>
        <? else: ?>
      <a class="pagenumber" href="javascript:resultPage(<?=$i?>)"><?=$i?></a>
        <? endif ?>
  <? endfor ?>
  </td></tr>
  </tbody>
</table>
