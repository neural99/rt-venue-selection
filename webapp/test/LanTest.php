<?php
require_once dirname(__FILE__) . '/../lib/bootstrap.php';

class TestLan extends PHPUnit_Framework_TestCase
{
  public function testGetAll(){
    $all = Lan::getAll();
    $this->assertNotEquals(null,$all);
  }
  
  public function testGet(){
    $all = Lan::getAll();
    $nr=count($all);
    foreach($all as $each){
      $lan = Lan::get($each->getId());
      $this->assertEquals($each,$lan);
    }
  }
}