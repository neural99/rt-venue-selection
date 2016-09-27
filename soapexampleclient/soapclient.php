<?php

$client = new SoapClient("http://localhost:8080/axis2/services/dummyVenueSearch?wsdl");

      
      $paramreturn = $client->__soapCall("getParameters", array());


      $listofparameters = array();
      foreach ($paramreturn as $x) {
  
          foreach ($x as $y) {   
              foreach ($y as $z) {
                  
                  $listofparameters[$z[0]] = $z[1];      
              }
          }
      }
      print("<form method ='post' action='results.php'>");

      foreach($listofparameters as $x => $type) {
        print($x);
        print("<br><input type = 'Text' value = '' name = '$x'><br><br>");
  
      }
  

  print("<input type='submit' name='search' value='Search'>
</form>");



      
?> 