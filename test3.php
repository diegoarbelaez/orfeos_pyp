<?php 
 //Data, connection, auth
 //$dataFromTheForm = $_POST['fieldName']; // request data from the form
 $soapUrl = "https://orfeo.minsalud.gov.co/orfeo/soap/wsdl_centro_contacto/radTramServ.php"; // asmx URL of WSDL
 $soapUser = "username";  //  username
 $soapPassword = "password"; // password


 $texto = "Aquí está la prueba de las no soporta cosas que estamos haciendi bien !";

 // xml post structure

 $xml_post_string = '<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsdl="https://orfeo.minsalud.gov.co/orfeo/soap/wsdl_centro_contacto/">
 <soapenv:Header/>
 <soapenv:Body>
    <wsdl:generateSalida soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
       <cc_nombre_usuario xsi:type="xsd:string">usuario_otic</cc_nombre_usuario>
       <cc_usuario_password xsi:type="xsd:string">3dC784Kejkeo=</cc_usuario_password>
       <nurad xsi:type="xsd:string">201909000120612</nurad>
       <centroContacto xsi:type="xsd:string">0</centroContacto>
       <cc_id_campania xsi:type="xsd:string">Certificado Digital Asunto!!</cc_id_campania>
       <cc_datos_respuesta xsi:type="xsd:string">'.$texto.'</cc_datos_respuesta>
       <cc_usuario_agente xsi:type="xsd:string">Diego Fernando Arbeláez</cc_usuario_agente>
    </wsdl:generateSalida>
 </soapenv:Body>
</soapenv:Envelope>';   // data from the form, e.g. some ID number

    $headers = array(
                 "Content-type: text/plain;charset=\"utf-8\"",
                 "Accept: text/xml",
                 "Cache-Control: no-cache",
                 "Pragma: no-cache",
                 "SOAPAction: http://connecting.website.com/WSDL_Service/GetPrice", 
             ); //SOAPAction: your op URL

     $url = $soapUrl;

     // PHP cURL  for https connection with auth
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     //curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
     //curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
     curl_setopt($ch, CURLOPT_TIMEOUT, 10);
     curl_setopt($ch, CURLOPT_POST, true);
     curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

     // converting
     $response = curl_exec($ch); 
     curl_close($ch);

     // converting
     $response1 = str_replace("<soap:Body>","",$response);
     $response2 = str_replace("</soap:Body>","",$response1);

     // convertingc to XML
     $parser = simplexml_load_string($response2);
     // user $parser to get your data out of XML response and to display it. 

     var_dump($response);
     echo $parser;
 ?>