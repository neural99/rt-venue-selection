<?php
require_once 'organisation.php';

class OrganisationTest extends PHPUnit_Framework_TestCase
{
  private $test_id=4711;

  
  public function testGetId(){
    $test_info=array("name" => "SkånskPetroleum", "postadress" => "Eslöv");
    $org = new Organisation($test_id,$test_info);
    $this->assertEquals($org->getId(),$test_id);
  }
  
  public function testGetInfo(){
    $test_info=array('adress1' => 'Stortorget 1',
                     'adress2' => 'Storgatan 17',
                     'epost'   => 'info@sp.se:',
                     'http'    => 'www.sp.se',
                     'id'      => '17',
                     'name'    => 'Skånsk Petroleum',
                     'orgTyp'  => 'Bensinbolag',
                     'postadress' => 'Eslöv',
                     'regDatum' => '2011',
                     'regSign'  => 'Blaha',
                     'telefax'  => '5559876543210',
                     'telefon'  => '5551234567890',
                     'updDatum' => '2011',
                     'updSign'  => 'KJW');
    $org = new Organisation($test_id,$test_info);
    $result = $org->getInfo();
    foreach ($test_info as $k => $v) {
      $this->assertContains($v,$result);
    }
  }
}