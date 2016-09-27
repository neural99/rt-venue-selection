<?php
/**
 * This is just some static data we use for testing purposes until
 * the web service exists.
 */

$lan = array(
        '01' => 'Stockholms län',
        '03' => 'Uppsala län',
        '04' => 'Södermanlands län',
        '05' => 'Östergötlands län',
        '06' => 'Jönköpings län',
        '07' => 'Kronobergs län',
        '08' => 'Kalmar län',
        '09' => 'Gotlands län',
        '10' => 'Blekinge län',
        '12' => 'Skåne län',
        '13' => 'Hallands län',
        '14' => 'Västra Götalands län',
        '17' => 'Värmlands län',
        '18' => 'Örebro län',
        '19' => 'Västmanlands län',
        '20' => 'Dalarnas län',
        '21' => 'Gävleborgs län',
        '22' => 'Västernorrlands län',
        '23' => 'Jämtlands län',
        '24' => 'Västerbottens län',
        '25' => 'Norrbottens län',
    );
	
$kommunILan = array(
	'01' => array("Botkyrka",
		"Danderyd",
		"Ekerö",
		"Haninge",
		"Huddinge",
		"Järfälla",
		"Lidingö",
		"Nacka",
		"Norrtälje",
		"Nykvarn",
		"Nynäshamn",
		"Salem",
		"Sigtuna",
		"Sollentuna",
		"Solna",
		"Stockholm",
		"Sundbyberg",
		"Södertälje",
		"Tyresö",
		"Täby",
		"Upplands Väsby",
		"Upplands-Bro",
		"Vallentuna",
		"Vaxholm",
		"Värmdö",
		"Österåker"),
    '03' => array("Enköping",
		"Heby",
		"Håbo",
		"Knivsta",
		"Tierp",
		"Uppsala",
		"Älvkarleby",
		"Östhammar"),
    '04' => array("Eskilstuna",
		"Flen",
		"Gnesta",
		"Katrineholm",
		"Nyköping",
		"Oxelösund",
		"Strängnäs",
		"Trosa",
		"Vingåker"),
    '05' => array("Boxholm",
		"Finspång",
		"Kinda",
		"Linköping",
		"Mjölby",
		"Motala",
		"Norrköping",
		"Söderköping",
		"Vadstena",
		"Valdemarsvik",
		"Ydre",
		"Åtvidaberg",
		"Ödeshög"),
    '06' => array("Aneby",
		"Eksjö",
		"Gislaved",
		"Gnosjö",
		"Habo",
		"Jönköping",
		"Mullsjö",
		"Nässjö",
		"Sävsjö",
		"Tranås",
		"Vaggeryd",
		"Vetlanda",
		"Värnamo"),
    '07' => array("Alvesta",
		"Lessebo",
		"Ljungby",
		"Markaryd",
		"Tingsryd",
		"Uppvidinge",
		"Växjö",
		"Älmhult"),
    '08' => array("Borgholm",
		"Emmaboda",
		"Hultsfred",
		"Högsby",
		"Kalmar",
		"Mönsterås",
		"Mörbylånga",
		"Nybro",
		"Oskarshamn",
		"Torsås",
		"Vimmerby",
		"Västervik"),
    '09' => array("Gotland"),
    '10' => array("Karlshamn",
		"Karlskrona",
		"Olofström",
		"Ronneby",
		"Sölvesborg"),
    '12' => array("Bjuv",
		"Bromölla",
		"Burlöv",
		"Båstad",
		"Eslöv",
		"Helsingborg",
		"Hässleholm",
		"Höganäs",
		"Hörby",
		"Höör",
		"Klippan",
		"Kristianstad",
		"Kävlinge",
		"Landskrona",
		"Lomma",
		"Lund",
		"Malmö",
		"Osby",
		"Perstorp",
		"Simrishamn",
		"Sjöbo",
		"Skurup",
		"Staffanstorp",
		"Svalöv",
		"Svedala",
		"Tomelilla",
		"Trelleborg",
		"Vellinge",
		"Ystad",
		"Åstorp",
		"Ängelholm",
		"Örkelljunga",
		"Östra Göinge"),
    '13' => array("Falkenberg",
		"Halmstad",
		"Hylte",
		"Kungsbacka",
		"Laholm",
		"Varberg"),
    '14' => array("Ale",
		"Alingsås",
		"Bengtsfors",
		"Bollebygd",
		"Borås",
		"Dals-Ed",
		"Essunga",
		"Falköping",
		"Färgelanda",
		"Grästorp",
		"Gullspång",
		"Göteborg",
		"Götene",
		"Herrljunga",
		"Hjo",
		"Härryda",
		"Karlsborg",
		"Kungälv",
		"Lerum",
		"Lidköping",
		"Lilla Edet",
		"Lysekil",
		"Mariestad",
		"Mark",
		"Mellerud",
		"Munkedal",
		"Mölndal",
		"Orust",
		"Partille",
		"Skara",
		"Skövde",
		"Sotenäs",
		"Stenungsund",
		"Strömstad",
		"Svenljunga",
		"Tanum",
		"Tibro",
		"Tidaholm",
		"Tjörn",
		"Tranemo",
		"Trollhättan",
		"Töreboda",
		"Uddevalla",
		"Ulricehamn",
		"Vara",
		"Vårgårda",
		"Vänersborg",
		"Åmål",
		"Öckerö"),
    '17' => array("Arvika",
		"Eda",
		"Filipstad",
		"Forshaga",
		"Grums",
		"Hagfors",
		"Hammarö",
		"Karlstad",
		"Kil",
		"Kristinehamn",
		"Munkfors",
		"Storfors",
		"Sunne",
		"Säffle",
		"Torsby",
		"Årjäng"),
    '18' => array("Askersund",
		"Degerfors",
		"Hallsberg",
		"Hällefors",
		"Karlskoga",
		"Kumla",
		"Laxå",
		"Lekeberg",
		"Lindesberg",
		"Ljusnarsberg",
		"Nora",
		"Örebro"),
    '19' => array("Arboga",
		"Fagersta",
		"Hallstahammar",
		"Kungsör",
		"Köping",
		"Norberg",
		"Sala",
		"Skinnskatteberg",
		"Surahammar",
		"Västerås"),
    '20' => array("Avesta",
		"Borlänge",
		"Falun",
		"Gagnef",
		"Hedemora",
		"Leksand",
		"Ludvika",
		"Malung-Sälen",
		"Mora",
		"Orsa",
		"Rättvik",
		"Smedjebacken",
		"Säter",
		"Vansbro",
		"Älvdalen"),
    '21' => array("Bollnäs",
		"Gävle",
		"Hofors",
		"Hudiksvall",
		"Ljusdal",
		"Nordanstig",
		"Ockelbo",
		"Ovanåker",
		"Sandviken",
		"Söderhamn"),
    '22' => array("Härnösand",
		"Kramfors",
		"Sollefteå",
		"Sundsvall",
		"Timrå",
		"Ånge",
		"Örnsköldsvik"),
    '23' => array("Berg",
		"Bräcke",
		"Härjedalen",
		"Krokom",
		"Ragunda",
		"Strömsund",
		"Åre",
		"Östersund"),
    '24' => array("Bjurholm",
		"Dorotea",
		"Lycksele",
		"Malå",
		"Nordmaling",
		"Norsjö",
		"Robertsfors",
		"Skellefteå",
		"Sorsele",
		"Storuman",
		"Umeå",
		"Vilhelmina",
		"Vindeln",
		"Vännäs",
		"Åsele"),
    '25' => array("Arjeplog",
		"Arvidsjaur",
		"Boden",
		"Gällivare",
		"Haparanda",
		"Jokkmokk",
		"Kalix",
		"Kiruna",
		"Luleå",
		"Pajala",
		"Piteå",
		"Älvsbyn",
		"Överkalix",
		"Övertorneå"),
);