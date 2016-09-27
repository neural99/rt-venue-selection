<?php
require_once dirname(__FILE__) . '/../lib/bootstrap.php';

class TestVenue extends PHPUnit_Framework_TestCase
{
  private $test_id = 1337;
  private $test_id0 = 4712;
  private $test_id1 = 4747;
  private $test_str00="foo";
  private $test_str01="foobar";
  private $test_str10="bar";
  private $test_str11="barfoo";

  public function testGetId(){
    $test_attr=array($test_str00=>new NumericAttribute($test_str00,$test_str01,$test_id0),
                     $test_str10=>new NumericAttribute($test_str10,$test_str11,$test_id1));

    $test_orgs=array($test_id0=>new Organisation($test_id0,array("name" => "SkånskPetroleum", "postadress" => "Eslöv")),
                     $test_id1=>new Organisation($test_id1,array("name" => "Stora Kopparberg", "postadress" => "Tiskasjöberg")));

    $venue = new Venue($test_id,$test_attr,$test_orgs);
    $this->assertEquals($venue->getId(),$test_id);
  }

  public function testGetOrganisations()
  {
    $test_attr=array($test_str00=>new NumericAttribute($test_str00,$test_str01,$test_id0),
                     $test_str10=>new NumericAttribute($test_str10,$test_str11,$test_id1));

    $test_orgs=array($test_id0=>new Organisation($test_id0,array("name" => "SkånskPetroleum", "postadress" => "Eslöv")),
                     $test_id1=>new Organisation($test_id1,array("name" => "Stora Kopparberg", "postadress" => "Tiskasjöberg")));

    $venue = new Venue($test_id,$test_attr,$test_orgs);
    $this->assertEquals($venue->getOrganisations(),$test_orgs);    
  }
  
  public function testGetAttributeValues()
  {
    $test_attr=array($test_str00=>new NumericAttribute($test_str00,$test_str01,$test_id0),
                     $test_str10=>new NumericAttribute($test_str10,$test_str11,$test_id1));

    $test_orgs=array($test_id0=>new Organisation($test_id0,array("name" => "SkånskPetroleum", "postadress" => "Eslöv")),
                     $test_id1=>new Organisation($test_id1,array("name" => "Stora Kopparberg", "postadress" => "Tiskasjöberg")));

    $venue = new Venue($test_id,$test_attr,$test_orgs);
    $this->assertEquals($venue->getAttributeValues(),$test_attr);
  }

  public function testGetAttributeValue()
  {
    $test_attr=array($test_str00=>new NumericAttribute($test_str00,$test_str01,$test_id0),
                     $test_str10=>new NumericAttribute($test_str10,$test_str11,$test_id1));

    $test_orgs=array($test_id0=>new Organisation($test_id0,array("name" => "SkånskPetroleum", "postadress" => "Eslöv")),
                     $test_id1=>new Organisation($test_id1,array("name" => "Stora Kopparberg", "postadress" => "Tiskasjöberg")));

    $venue = new Venue($test_id,$test_attr,$test_orgs);
    $this->assertEquals($venue->getAttributeValue($test_str00),$test_attr[$test_str00]);
  }

  public function testGetAttributeValueNot()
  {
    $test_attr=array($test_str00=>new NumericAttribute($test_str00,$test_str01,$test_id0),
                     $test_str10=>new NumericAttribute($test_str10,$test_str11,$test_id1));

    $test_orgs=array($test_id0=>new Organisation($test_id0,array("name" => "SkånskPetroleum", "postadress" => "Eslöv")),
                     $test_id1=>new Organisation($test_id1,array("name" => "Stora Kopparberg", "postadress" => "Tiskasjöberg")));

    $venue = new Venue($test_id,$test_attr,$test_orgs);
    $this->assertEquals($venue->getAttributeValue("BLAHA"),null);
  }

  /* public function testGetAttributeValueNot() */
  /* { */
  /*   $test_attr=array($test_str00=>new NumericAttribute($test_str00,$test_str01,$test_id0), */
  /*                      $test_str10=>new NumericAttribute($test_str10,$test_str11,$test_id1)); */

  /*   $test_orgs=array($test_id0=>new Organisation($test_id0,array("name" => "SkånskPetroleum", "postadress" => "Eslöv")), */
  /*                      $test_id1=>new Organisation($test_id1,array("name" => "Stora Kopparberg", "postadress" => "Tiskasjöberg"))); */

  /*   $venue = new Venue($test_id,$test_attr,$test_orgs); */
  /*   $this->assertEquals($venue->getAttributeValue("BLAHA"),null); */
  /* } */
}
