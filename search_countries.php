<?php

$data = array( 
    " 93" => "Afghanistan",
    " 1264" => "Anguilla",
    " 1268" => "Antigua Barbuda",
    " 880" => "Bangladesh",
    " 1246" => "Barbados",
    " 229" => "Benin",
    " 591" => "Bolivia",
    " 55" => "Brazil",
    " 1284" => "BVI",
    " 257" => "Burundi",
    " 855" => "Cambodia",
    " 237" => "Cameroon",
    " 1345" => "Cayman Islands",
    " 236" => "CAR",
    " 56" => "Chile",
    " 86" => "China",
    " 57" => "Colombia",
    " 242" => "Congo",
    " 506" => "Costa Rica",
    " 53" => "Cuba",
    " 243" => "DRC",
    " 1767" => "Dominica",
    " 18" => "Dominican",
    " 593" => "Ecuador",
    " 20" => "Egypt",
    " 503" => "El Salvador",
    " 240" => "Equatorial Guinea",
    " 679" => "Fiji",
    " 233" => "Ghana",
    " 1473" => "Grenada",
    " 502" => "Guatemala",
    " 224" => "Guinea",
    " 592" => "Guyana",
    " 509" => "Haiti	",
    " 504" => "Honduras",
    " 91" => "India",
    " 62" => "Indonesia",
    " 964" => "Iraq",
    " 225" => "Ivory Coast",
    " 1876" => "Jamaica",
    " 962" => "Jordan",
    " 7" => "Kazakhstan",
    " 254" => "Kenya",
    " 856" => "Laos ",
    " 261" => "Madagascar",
    " 60" => "Malaysia",
    " 223" => "Mali",
    " 52" => "Mexico",
    " 1664" => "Montserrat",
    " 212" => "Morocco",
    " 977" => "Nepal",
    " 505" => "Nicaragua",
    " 227" => "Niger",
    " 234" => "Nigeria",
    " 92" => "Pakistan",
    " 970" => "Palestine",
    " 507" => "Panama",
    " 51" => "Peru",
    " 63" => "Philippines",
    " 48" => "Poland",
    " 40" => "Romania",
    " 7" => "Russia",
    " 250" => "Rwanda",
    " 1869" => "StKitts",
    " 1758" => "StLucia",
    " 1784" => "StVincent",
    " 221" => "Senegal",
    " 252" => "Somalia",
    " 94" => "Sri Lanka",
    " 249" => "Sudan",
    " 597" => "Suriname",
    " 963" => "Syria",
    " 255" => "Tanzania",
    " 66" => "Thailand",
    " 216" => "Tunisia",
    " 90" => "Turkey",
    " 1649" => "Turks",
    " 256" => "Uganda",
    " 380" => "Ukraine",
    " 58" => "Venezuela",
    " 84" => "Vietnam",
    " 967" => "Yemen",
    " 263" => "Zimbabwe"
);

$results = array();

function mySort($a, $b) {
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}
   
//uasort($data,"mySort");

asort($data);

function autocomplete_format($results) {
	foreach ($results as $result) {
	   echo $result[0] . '-' . $result[1] ."\n";
	}
}

//if (isset($_GET['q']) || isset($_GET['c'])) {
	$qu = strtolower(trim($_GET['q']));
	$q = " ".$qu;
	//$c = strtolower($_GET['c']);
	/*
	if ($q) {
	   foreach ($data as $key => $value) {
	       if (strpos(strtolower($key), $q) !== false) {
	           $results[] = array($key, $value);
	       }
	   }
	}
	*/
	
	if ($q) {
		foreach ($data as $key => $value) {
			$results[] = array($key, $value);
		}	
	}
//}

$output = 'autocomplete';
if (isset($_GET['output'])) {
	$output = strtolower($_GET['output']);
}

if ($output === 'json') {
	echo json_encode($results);
} 
else {
	echo autocomplete_format($results);
}

?>