<?php
require_once dirname(__FILE__) . '/../lib/bootstrap.php';

class TestKommun extends PHPUnit_Framework_TestCase
{
  public function testGetLan(){
    $all = Lan::getAll();
    $nr=count($all);
    foreach($all as $each){
      $kommuner = $each->getKommuner();
      foreach($kommuner as $index)
        $this->assertEquals($each,$index->getLan());
    }
  }
  
  public function testGetByName(){
    $all = Lan::getAll();
    $nr=count($all);
    foreach($all as $each){
      $kommuner = $each->getKommuner();
      foreach($kommuner as $index)
        $this->assertEquals($index,$index->getByName($index->getName()));
    }
  }

  public function testGet(){
    $all = Lan::getAll();
    $nr=count($all);
    foreach($all as $each){
      $kommuner = $each->getKommuner();
      foreach($kommuner as $index)
        $this->assertEquals($index,$index->get($index->getGlobalId()));
    }
  }
}