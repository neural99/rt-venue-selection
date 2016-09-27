<?php
require_once dirname(__FILE__) . '/../lib/bootstrap.php';

class EnumAttributePub extends EnumAttribute
{
  public function __construct($name, $humanName)
  {
    parent::__construct($name, $humanName);
  }
}

class LanAttributePub extends LanAttribute
{
  public function __construct($name, $humanName)
  {
    parent::__construct($name, $humanName);
  }
}

class KommunAttributePub extends KommunAttribute
{
  public function __construct($name, $humanName)
  {
    parent::__construct($name, $humanName);
  }
}

class BooleanAttributePub extends BooleanAttribute
{
  public function __construct($name, $humanName)
  {
    parent::__construct($name, $humanName);
  }
}

class StringAttributePub extends StringAttribute
{
  public function __construct($name, $humanName)
  {
    parent::__construct($name, $humanName);
  }
}


class AttributeTest extends PHPUnit_Framework_TestCase
{
  private $str_arg0='foo';
  private $str_arg1='bar';
  private $int_arg0=17;
  private $int_arg1=4711;

  public function testNumericAttributesName()
  {
    $attr = new NumericAttribute($this->str_arg0,$this->str_arg1,$this->int_arg1);
    $this->assertEquals($attr->getName(),$this->str_arg0);
  }

  public function testNumericAttributesHumanName()
  {
    $attr = new NumericAttribute($this->str_arg0,$this->str_arg1,$this->int_arg1);
    $this->assertEquals($attr->getHumanName(),$this->str_arg1);
  }

  public function testNumericAttributesType()
  {
    $attr = new NumericAttribute($this->str_arg0,$this->str_arg1,$this->int_arg1);
    $this->assertEquals($attr->getType(),"numeric");
  }

  public function testNumericAttributesLimit()
  {
    $attr = new NumericAttribute($this->str_arg0,$this->str_arg1,$this->int_arg1);
    $this->assertEquals($attr->getLimit(),$this->int_arg1);
  }

  public function testNumericAttributesLimitNot()
  {
    $attr = new NumericAttribute($this->str_arg0,$this->str_arg1,$this->int_arg1);
    $this->assertNotEquals($attr->getLimit(),17);
  }

  /* ---------------------------------------------------------- */

  public function testEnumAttributesName()
  {
    $attr = new EnumAttributePub($this->str_arg0,$this->str_arg1);
    $this->assertEquals($attr->getName(),$this->str_arg0);
  }

  public function testEnumAttributesHumanName()
  {
    $attr = new EnumAttributePub($this->str_arg0,$this->str_arg1);
    $this->assertEquals($attr->getHumanName(),$this->str_arg1);
  }

  public function testEnumAttributesType()
  {
    $this->assertEquals(EnumAttribute::getType(),"enum");
  }
 
  public function testEnumGetElements()
  {
    $attr = new EnumAttributePub('farg',"Färg");
    $this->assertContains("Vit",$attr->getElements());
    $this->assertContains("Blå",$attr->getElements());
    $this->assertContains("Gul",$attr->getElements());
    $this->assertNotContains("orsacbidsnoaedisnhtoeayis",$attr->getElements());
    $this->assertNotContains("ntsohisntnshdnht",$attr->getElements());
  }

  public function testEnumParseForm()
  {
    $attr = new EnumAttributePub('farg',"Färg");
    $arr_inp = array('djur'=>array('Apa','Hest'),'farg'=>array("Svart","Blå"),'name'=>array("Putte","Snel"));
    $arr_res = array("Svart","Blå");
    $this->assertEquals($arr_res,$attr->parseForm($arr_inp));
  }

  public function testEnumPresentValueFor()
  {
    $attr = new EnumAttributePub('farg','Färg');
    $attrs = array('farg' => 'Blå', 'mingel' => true);
    $test_orgs=
      array($test_id0=>new Organisation($test_id0,array("name" => "SkånskPetroleum", "postadress" => "Eslöv")),
            $test_id1=>new Organisation($test_id1,array("name" => "StoraKopparberg", "postadress" => "Tiskasjöberg")));
    $venue = new Venue(4711,$attrs,$test_orgs);
    $this->assertEquals('Blå',$attr->presentValueFor($venue));
  }

  /* -------------------- */

  public function testLanAttributesType()
  {
    $this->assertEquals(LanAttribute::getType(),"lan");
  }

  public function testLanParseForm()
  {
    $example = array("Karlskrona","Ronneby","Karlshamn","Sölvesborg");
    $tryit = new LanAttributePub("Blekinge", "Blekinge län");
    $attr = array("Gotland"=>array("Gotland"),"Blekinge" => $example, "Jämtland" => array("Härjedalen", "Östersund"));
    $this->assertEquals($example,$tryit->parseForm($attr));
  }

  public function testLanPresentValueFor()
  {
    $ex0 = Lan::get(10);
    $nm0 = $ex0->getName();
    $tryit0 = new LanAttributePub($nm0, '10');
    $arrs = array('Blekinge län'=>'10');
    $test_orgs=
      array($test_id0=>new Organisation($test_id0,array("name" => "SkånskPetroleum", "postadress" => "Eslöv")),
            $test_id1=>new Organisation($test_id1,array("name" => "StoraKopparberg", "postadress" => "Tiskasjöberg")));
    $venue = new Venue(4711,$arrs,$test_orgs);
    $this->assertEquals('Blekinge län',$tryit0->presentValueFor($venue));
  }

  /* -------------------- */

  public function testKommunAttributesType()
  {
    $this->assertEquals(KommunAttribute::getType(),"kommun");
  }

  public function testKommunParseForm()
  {
    $ex0 = Kommun::get('07,65');
    $tryit = new KommunAttributePub("Kronobergs län", 'blaha');
    $req = array("Kronobergs län" => $ex0->getName());
    $this->assertEquals(array($ex0->getGlobalId()),$tryit->parseForm($req));
  }

  public function testKommunPresentValueFor()
  {
    $ex0 = Kommun::get('10,80');
    $karlskrona = $ex0->getName();
    $tryit0 = new KommunAttributePub($karlskrona,'10,80');
    $arrs = array('lanId'=> '10', 'kommunId'=>'80');
    $test_orgs=
      array($test_id0=>new Organisation($test_id0,array("name" => "SkånskPetroleum", "postadress" => "Eslöv")),
              $test_id1=>new Organisation($test_id1,array("name" => "StoraKopparberg", "postadress" => "Tiskasjöberg")));
    $venue = new Venue(4711,$arrs,$test_orgs);
    $this->assertEquals($karlskrona,$tryit0->presentValueFor($venue));
  }

  /* -------------------- */

  public function testBooleanAttributesType()
  {
    $this->assertEquals(BooleanAttribute::getType(),"boolean");
  }

  public function testBooleanParseForm()
  {
    $tryit = new BooleanAttributePub("Mingel", 'Ta hans Efternamn');
    $req = array("Disco" => array(false,true,false), "Mingel" => array(true,false,false), "Skumpa" => array(true,true,true));
    $this->assertEquals(array(true,false,false),$tryit->parseForm($req));
  }

  public function testBooleanPresentValueFor()
  {
    $tryit = new BooleanAttributePub("Mingel", 'Ta hans Efternamn');
    $arr = array("Disco" => false, "Mingel" => true, "Skumpa" => true);
    $test_orgs=
      array($test_id0=>new Organisation($test_id0,array("name" => "SkånskPetroleum", "postadress" => "Eslöv")),
            $test_id1=>new Organisation($test_id1,array("name" => "StoraKopparberg", "postadress" => "Tiskasjöberg")));
    $venue = new Venue(4711,$arr,$test_orgs);    
    $this->assertEquals('Ja',$tryit->presentValueFor($venue));
  }

  public function testBooleanPresentValueForNot()
  {
    $tryit = new BooleanAttributePub("Disco", 'Göra kaoz');
    $arr = array("Disco" => false, "Mingel" => true, "Skumpa" => true);
    $test_orgs=
      array($test_id0=>new Organisation($test_id0,array("name" => "SkånskPetroleum", "postadress" => "Eslöv")),
            $test_id1=>new Organisation($test_id1,array("name" => "StoraKopparberg", "postadress" => "Tiskasjöberg")));
    $venue = new Venue(4711,$arr,$test_orgs);    
    $this->assertEquals('Nej',$tryit->presentValueFor($venue));
  }

  /* -------------------- */

  public function testStringAttributesType()
  {
    $this->assertEquals(StringAttribute::getType(),"string");
  }

  public function testStringParseForm()
  {
    $tryit = new StringAttributePub("namn", 'Människonamn');
    $req = array("härkomst" => "okänt", "namn" => "Petterson", "ålder" => 30);
    $this->assertEquals(array("Petterson"),$tryit->parseForm($req));
  }

  public function testStringParseFormNot()
  {
    $tryit = new StringAttributePub("djur", 'Art i djurriket');
    $req = array("härkomst" => "okänt", "namn" => "Petterson", "ålder" => 30);
    $this->assertEquals(null,$tryit->parseForm($req));
  }


}
?>
