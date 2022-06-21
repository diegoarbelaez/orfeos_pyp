<?php
//Create the client object
$soapclient = new SoapClient('https://www.w3schools.com/xml/tempconvert.asmx?WSDL');

//Use the functions of the client, the params of the function are in
//the associative array
$params = array('Celsius' => '25');
$response = $soapclient->CelsiusToFahrenheit($params);

var_dump($response);

// Get the Celsius degrees from the Farenheit
$param = array('Fahrenheit' => '25');
$response = $soapclient->FahrenheitToCelsius($param);

var_dump($response);