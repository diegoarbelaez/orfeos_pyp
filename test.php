<?php 
//Create the client object
$soapclient = new SoapClient('https://orfeo.minsalud.gov.co/orfeo/soap/wsdl_centro_contacto/radTramServ.php');

//Use the functions of the client, the params of the function are in 
//the associative array
$params = array(
    'cc_nombre_usuario' => 'usuario_otic', 
    'cc_usuario_password' => '3dC784Kejkeo=', 
    'nurad'=>'201909000120582', 
    'centroContacto'=>'0', 
    'cc_id_campania'=>'178', 
    'cc_datos_respuesta'=>'TESTING',
    'cc_usuario_agente'=>'usuario_otic');

//$headers = array('Content-Type' => 'text/plain');

$response = $soapclient->generateSalida($params);

//$soapclient->__setSoapHeaders($headers);

echo "REQUEST:\n" .htmlentities( $soapclient->__getLastRequest()) . "\n";

print_r($response);

//var_dump($response);

// Get the Cities By Country
//$param = array('CountryName' => 'Spain');
//$response = $soapclient->getCitiesByCountry($param);

var_dump($response);