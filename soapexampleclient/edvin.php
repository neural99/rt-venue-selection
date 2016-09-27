<?php


$lan = array ();
$kommunILan = array ();

$textKommuner = array();// (kommunName => kommunId,....);

function loadLocationElements(){

    global $lan;
    global $kommunILan;
    global $textKommuner;

    $wsdl = 'http://194.71.244.146:8080/5_RiksteaternEntAppWeb/RepertoarWSService?wsdl';

    $client = new SoapClient($wsdl, array('trace' => 1, 'login' => 'webla', 'password' => 'HLlmfe7FlgB6'));

    //header('Content-type: text/plain');

    try {
	$result = $client->GetRepertoarFilterList();



        $rep = $result->return->retValRepertoarProvinceElement;

        foreach($rep as $repLan){
            //print_r($repLan);
            $lanId = $repLan->provinceId;
            $lanName = $repLan->provinceName;



            $kommuner = array ();

            // alla "kommuner" ligger i arrayer, utom i gottland, den är ett object
            if(is_array($repLan->retValRepertoarCountyElement)){
                foreach($repLan->retValRepertoarCountyElement as $repKommun){
                    //print_r($repKommun);
                    $kommunId = $repKommun->countyId;
                    $kommunName = $repKommun->countyName;

                    $kommuner[$kommunId] = $kommunName;
                    $textKommuner[$kommunName] = $kommunId;
// TEST; hmm, möjligt problem? t.ex. Id: 82 Name: Karlshamn; och Id: 82 Name: SÃ¤ter; båda har samma Id. 
                    //print("<br /><br />Id: ".$kommunId." Name: ".$kommunName);
                }
            }else{
                $repKommun = $repLan->retValRepertoarCountyElement;

                $kommunId = $repKommun->countyId;
                $kommunName = $repKommun->countyName;

                $kommuner[$kommunId] = $kommunName;
                $textKommuner[$kommunName] = $kommunId;
// TEST; hmm, möjligt problem? t.ex. Id: 82 Name: Karlshamn; och Id: 82 Name: SÃ¤ter; båda har samma Id. 
                //print("<br /><br />Id: ".$kommunId." Name: ".$kommunName);
            }


            $lan[$lanId] = $lanName;
            $kommunILan[$lanId] = $kommuner;
        }

// TEST, Shows whats in the arrays;
        //print_r($lan);
        //print_r($kommunILan);

// vi har problem här, flera kommuner har samma ID!
        print_r($textKommuner);
        foreach ($textKommuner as $kommun){
            print('['.$textKommuner[$kommun].']=>'.$kommun."<br />");
        }
    }
    catch(SoapFault $e)
    {
            die('Fault occurred using Web Service: '.$e->getMessage());
    }
    return true;
}
loadLocationElements();