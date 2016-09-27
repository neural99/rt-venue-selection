<?php
require_once dirname(__FILE__) . '/../lib/bootstrap.php';

class TestUtil extends PHPUnit_Framework_TestCase
{
  private $test_id = 4711;
  private $test_str = "ntohu:tdi&ddhtth869";
  private $test_page = "blaha";  

  public function testH()
  {
    $this->assertEquals(htmlspecialchars($test_str),h($test_str));
  }
  
  public function testSanitizeAlphaNum()
  {
    $this->assertEquals($test_str,sanitizeAlphaNum($test_str));
  }

  public function testGetCurrentUser()
  {
    $this->assertEquals(getCurrentUser(),$_COOKIE['username']);
  }

  public function testtopLevelUrl()
  {
    $url = "http://" . $_SERVER['HTTP_HOST'] . preg_replace('/\/[^\/]*$/', '/' . $test_page, $_SERVER['SCRIPT_NAME']);
    $this->assertEquals($url,getTopLevelUrl($test_page));
  }

  public function testArrayify()
  {
    $arr=array(67,43,908,889);
    $this->assertEquals($arr,arrayify($arr));
  }

  public function testArrayifyEmpty()
  {
    $arr=array($test_id);
    $this->assertEquals($arr,arrayify($test_id));
  }
}
