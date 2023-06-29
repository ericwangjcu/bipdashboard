<?php
session_start(); 

if (isset($_POST['call'])){
    if ($_POST['call'] == "ultrasonic device"){
        // $data = get_device_data();
        // echo $data;    // For Print Value
    }elseif($_POST['call'] == "ultrasonic sensor"){
        $data = get_data();
        echo $data;    // For Print Value
    }elseif($_POST['call'] == "ultrasonic running"){
        // $data = get_device_running_data();
        // echo $data;    // For Print Value        
    }
    
}

function get_data() {

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.losant.com/applications/64753b182dc62b6ef4c6095b/data/time-series-query',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{"end":0,"duration":1500000000,"resolution":300000,"aggregation":"LAST","attributes":["bat","distance","RSSI"],"deviceIds":["6475407f796607dff7d3f5b8"]}',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiI2NDljZDI0YjUzOGExN2VhYzBiYjkyN2MiLCJzdWJ0eXBlIjoiYXBpVG9rZW4iLCJzY29wZSI6WyJhbGwuVXNlciJdLCJpYXQiOjE2ODc5OTkwNTEsImlzcyI6ImFwaS5nZXRzdHJ1Y3R1cmUuaW8ifQ.Cn8iw0EkhR1kmbJ1excomRBxyw02WTKBl2wk1tlpImI'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
}


?>