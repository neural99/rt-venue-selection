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
      
      
      
      if($_POST['search']) {
      
          $sendarray = array();
          $nr = 0;
            foreach($listofparameters as $x => $type) {
                switch ($type) {
                  case "Integer":
                      $sendarray["args$nr"] = (int)$_POST[$x];
                  break;
                  case "String":
                      $sendarray["args$nr"] = $_POST[$x];
                  break;
                  case "Double":
                      $sendarray["args$nr"] = (double)$_POST[$x];
                  break;       
                  }
                  $nr = $nr + 1;
                }
               $searchreturn = $client->search($sendarray);
      }
      
      
      
      
    print("<table border='1'><tr>");
  
      foreach($listofparameters as $x => $type) {
          print("<th>$x</th>");
      }

      print("</tr>");
    
      foreach((array)$searchreturn as $x) {
           foreach ($x as $y) { 
              print("<tr>");
              foreach ($y as $value) {
                  print("<td>$value</td>");
                  
              }
              print("</tr>");
           }
      }
      
  print("</table>");
      

?>