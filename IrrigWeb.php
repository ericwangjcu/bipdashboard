<?php
session_start(); 
// $_SESSION['username'] = "ATS203";
// $_SESSION['farmname'] = "10-1";

//error_reporting(E_ALL & ~E_NOTICE);

if (isset($_POST['call'])){
    if ($_POST['call'] == "rainfall"){
        getrainfall();
    }elseif($_POST['call'] == "irrigapp"){
        uploadirrigation();
    }
}

function uploadirrigation(){
    $IrrigDate = isset($_POST['IrrigDate']) ? $_POST['IrrigDate'] : null;
    $IrrigAmount = isset($_POST['IrrigAmount']) ? $_POST['IrrigAmount'] : null;

    $username = 'eric.wang@jcu.edu.au';
    $password = "Pwd81"; 
    $endpoint = "http://20.53.114.184:81/api/Block/Irrigation";

    $params =array("UserName"=>"eric.wang@jcu.edu.au", "FarmName"=>$_SESSION['username'], "BlockName"=>$_SESSION['farmname'], "IrrigDate"=>strval($IrrigDate), "IrrigAmount"=>strval($IrrigAmount));

    $data = http_build_query($params);
    $URL = $endpoint."?".$data;
    $curl = curl_init($URL);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);  // CURLOPT_RETURNTRANSFER - TRUE Sets the transfer as a string when curl_exec() instead of outputting it out directly.

    $authorization = "Authorization: Bearer ".getIrrigWebAPIToken(); // Prepare the authorisation token
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header

    $result=curl_exec($curl);
    curl_close($curl);
    echo $result;    
}

function getrainfall(){

    $start = isset($_POST['start']) ? $_POST['start'] : null;
    $end = isset($_POST['end']) ? $_POST['end'] : null;
    $farm = isset($_POST['farm']) ? $_POST['farm'] : null;
    $block = isset($_POST['block']) ? $_POST['block'] : null;

    $username = 'eric.wang@jcu.edu.au';
    $password = "Pwd81"; 
    $endpoint = "http://20.53.114.184:81/api/Block/GetBlockDateRange";
    // TODO: setup params with Post Variables
    // $params =array("Username"=>"aalinton@bigpond.com", "CurrentDate"=>"2022-03-11");

    $params =array("Username"=>"eric.wang@jcu.edu.au", "FarmName"=>strval($farm), "BlockName"=>strval($block), "StartDate"=>strval($start), "EndDate"=>strval($end));
        
    $data = http_build_query($params);

    $URL = $endpoint."?".$data;
    $curl = curl_init($URL);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);  // CURLOPT_RETURNTRANSFER - TRUE Sets the transfer as a string when curl_exec() instead of outputting it out directly.

    $authorization = "Authorization: Bearer ".getIrrigWebAPIToken(); // Prepare the authorisation token
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
    $result=curl_exec($curl);
    curl_close($curl);
    $jsonData = json_decode($result);
    echo $result;
}

function getIrrigWebAPIToken(){
    $endpoint  = "http://20.53.114.184:81/api/token";

    $data = array('username'=>"JCU", "password"=>"7[A9p.K_wgu+?E^C", "grant_type"=>"password");

    $curl = curl_init($endpoint);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);  // CURLOPT_RETURNTRANSFER - TRUE Sets the transfer as a string when curl_exec() instead of outputting it out directly.

    curl_setopt($curl, CURLOPT_POST, true);
    // Set body postfields as url encoded string (the data will be as application/x-www-form-urlencoded) format.
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    $result = curl_exec($curl);
    curl_close($curl);

    $jsonData = json_decode($result);
    // print_r($jsonData);
    // for($i=0; $i < count($jsonData->DeviceLogs); ++$i){
    //     print_r
    //     }

    // Check if curl returns a token
    if(isset($jsonData->access_token)){
        // echo "<script>console.log('$jsonData->access_token')</script>";
        return $jsonData->access_token;
    } else{
        echo "Error no Token found";
    }
}




?>