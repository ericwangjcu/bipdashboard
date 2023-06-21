<?php
session_start(); 

if (isset($_POST['call'])){
    if ($_POST['call'] == "device"){
        //get deivces
        // $url = "https://sensecap.seeed.cc/openapi/list_devices?";
        // $url = "https://sensecap.seeed.cc/openapi/view_devices";
        $data = get_device_data();
        echo $data;    // For Print Value
    }elseif($_POST['call'] == "sensor"){
        //get history data

        $url = "https://sensecap.seeed.cc/openapi/list_telemetry_data?device_eui=2CF7F1693200001A";
        $data = get_data($url);
        // $db = mysqli_connect('3.27.67.148', 'bip_root', 'Eric137456', 'bip_BIP');
        // Check connection
        // if (!$db) {
        // $db = mysqli_connect('localhost', 'root', '', 'BIP');
        // // }
        // // foreach ($data as $value) {
        // //     echo "<script>console.log('{$value}')</script>";
        // // }
        // // $obj = var_dump(json_decode($data));
        // $obj = json_decode($data);
        // for ($i=0;$i<sizeof($obj->data->list[1][0]);$i++){
        //     $sql = "INSERT IGNORE INTO `waterlevel` VALUES ('{$obj->data->list[1][0][$i][1]}','{$obj->data->list[1][0][$i][0]}')";
        //     $result = mysqli_query($db, $sql);
        //     // print $result;
        //     // echo "<script>console.log('{$result}')</script>";
        // }
        echo $data;    // For Print Value
    }elseif($_POST['call'] == "running"){
        $data = get_device_running_data();
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



function get_device_data(){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://sensecap.seeed.cc/openapi/view_devices',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{"device_type":2, "device_euis":["2CF7F1693200001A"]}',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Basic SVc0T0NUMzlRQklRR000QjpBNDY2Njc0N0NFRTU0QkJCOTlEN0JGMTIzMEY0QjIyQjEyOTY0QjcxNjYzMzQzNDdBRTgwREU0MEEzN0IyNTVD'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
}

function get_device_running_data(){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://sensecap.seeed.cc/openapi/view_device_running_status',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{"device_type":2, "device_euis":["2CF7F1693200001A"]}',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Basic SVc0T0NUMzlRQklRR000QjpBNDY2Njc0N0NFRTU0QkJCOTlEN0JGMTIzMEY0QjIyQjEyOTY0QjcxNjYzMzQzNDdBRTgwREU0MEEzN0IyNTVD'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
}




//get latest data
// $url = "https://sensecap.seeed.cc/openapi/view_latest_telemetry_data?device_eui=2CF7F1693200001A&measurement_id=4117&channel_index=10";
// $data = get_data($url);
// echo $data;    // For Print Value
?>