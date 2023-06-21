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
      CURLOPT_URL => 'https://api.losant.com/applications/63fab73b1371ae2e6dc8f3c5/data/time-series-query',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{"end":0,"duration":150000000,"resolution":300000,"aggregation":"LAST","attributes":["level","battery"],"deviceIds":["641b98bb10a7dabe2bb1a4ab"]}',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiI2NDA1NTQxYmRjNTIxMzY3OWM2MTdlZGUiLCJzdWJ0eXBlIjoiZGV2aWNlIiwiYXBwIjoiNjNmYWI3M2IxMzcxYWUyZTZkYzhmM2M1IiwiZGV2aWNlQ2xhc3MiOiJzdGFuZGFsb25lIiwib3duZXJUeXBlIjoidXNlciIsInNjb3BlIjpbImFsbC5EZXZpY2UiXSwia2V5IjoiNjQwMDJjOTQ4YjA3YjcyOGEyOTRiZDZhIiwiaWF0IjoxNjc4NzQ2NzYxLCJpc3MiOiJhcGkuZ2V0c3RydWN0dXJlLmlvIn0.dkKQeTlIhEkOQo1moBMh3mHNZIcGs2RyilELuA6ct8U'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
}


?>