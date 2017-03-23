<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



try {
    $wsdl_url = 'http://www.elryan.com/index.php/api/v2_soap?wsdl=1';
    $username = 'demouser';
    $password = 'abcd1234';

    $cli = new SoapClient($wsdl_url);

//retreive session id from login
    $session_id = $cli->login($username, $password);

//call customer.list method
   // $result = $cli->salesOrderList($session_id);

    var_dump($session_id);
} catch (Exception $e) {
    echo "Exception occured: " . $e;
}

