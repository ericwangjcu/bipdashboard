<?php
session_start(); 

if (isset($_POST['call'])){
    if ($_POST['call'] == "device"){
        //get deivces
        $url = "https://sensecap.seeed.cc/openapi/list_devices?";
        // $url = "https://sensecap.seeed.cc/openapi/view_devices";
        $data = get_data($url);
        echo $data;    // For Print Value
    }elseif($_POST['call'] == "sensor"){
        //get history data
        $url = "https://sensecap.seeed.cc/openapi/list_telemetry_data?device_eui=2CF7F1693200001A";
        $data = get_data($url);
        echo $data;    // For Print Value
    }
    
}

function get_data($url) {
    $ch = curl_init($url);
    $timeout = 5;
    $username = 'IW4OCT39QBIQGM4B';        // Put Username 
    $password = 'A4666747CEE54BBB99D7BF1230F4B22B12964B7166334347AE80DE40A37B255C';                                        // Put Password
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");    // Add This Line
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function get_device_data($url) {
    $ch = curl_init($url);
    $timeout = 5;
    $username = 'IW4OCT39QBIQGM4B';        // Put Username 
    $password = 'A4666747CEE54BBB99D7BF1230F4B22B12964B7166334347AE80DE40A37B255C'; 
    
    $data = array("device_type" => "2","device_euis" => "2CF7F1693200001A");
    $data_string = urlencode(json_encode($data));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");    // Add This Line
    curl_setopt($ch, CURLOPT_POSTFIELDS, array("data"=>$data_string));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

    $result  = curl_exec($ch);
    curl_close($ch);
    return $result;
}

//get latest data
// $url = "https://sensecap.seeed.cc/openapi/view_latest_telemetry_data?device_eui=2CF7F1693200001A&measurement_id=4117&channel_index=10";
// $data = get_data($url);
// echo $data;    // For Print Value
?>