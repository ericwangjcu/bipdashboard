<?php
session_start(); 

function get_data($url) {
    $ch = curl_init();
    $timeout = 5;
    $username = 'IW4OCT39QBIQGM4B';        // Put Username 
    $password = 'A4666747CEE54BBB99D7BF1230F4B22B12964B7166334347AE80DE40A37B255C';                                        // Put Password
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");    // Add This Line
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
//get deivces
// $url = "https://sensecap.seeed.cc/openapi/list_devices?";
// $data = get_data($url);
// echo $data;    // For Print Value

//get history data
$url = "https://sensecap.seeed.cc/openapi/list_telemetry_data?device_eui=2CF7F1693200001A";
$data = get_data($url);
echo $data;    // For Print Value

//get latest data
// $url = "https://sensecap.seeed.cc/openapi/view_latest_telemetry_data?device_eui=2CF7F1693200001A&measurement_id=4117&channel_index=10";
// $data = get_data($url);
// echo $data;    // For Print Value
?>