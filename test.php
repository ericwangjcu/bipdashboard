
<?php

$db = mysqli_connect('localhost', 'root', '', 'BIP');
// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// $sql = "SELECT ID FROM irrigset ORDER BY id DESC LIMIT 1";
// $temp = mysqli_fetch_assoc(mysqli_query($db, $sql));
// $PropertyCount = $temp["ID"];    
// // echo "<script>console.log($PropertyCount);</script>";

// $sql = "SELECT ID FROM pump ORDER BY id DESC LIMIT 1";
// $temp = mysqli_fetch_assoc(mysqli_query($db, $sql));
// $PumpCount = $temp["ID"];    
// // echo "<script>console.log($PumpCount);</script>";

// $sql = "SELECT ID FROM imu ORDER BY id DESC LIMIT 1";
// $temp = mysqli_fetch_assoc(mysqli_query($db, $sql));
// $IMUCount = $temp["ID"];    
// echo "<script>console.log($IMUCount);</script>";

$sql = "SELECT ID FROM irrigset ORDER BY id DESC LIMIT 1";
$temp = mysqli_fetch_assoc(mysqli_query($db, $sql));
$SetCount = $temp["ID"];    
echo "<script>console.log($SetCount);</script>";



if (isset($_POST['import'])) {
    // $property = json_decode($_POST['property']);
    $set = json_decode($_POST['sets']);

    //get imus array
    $index = 0;
    for ($i=0;$i<sizeof($set)-2;$i++){
        if($set[2+$i][0]){
            $idarray[$index] = $set[2+$i][0];
        }
        $index ++;
    }
    echo "<script>console.log($set[1]);</script>";

    //add Sets
    for ($i=0;$i<500;$i++){
        if(isset($set[2+$i][0])){
            $SetCount ++;
            $sql = "INSERT INTO `irrigset`(`id`, `district`, `grower_id`, `block_id`, `grower_block_id`, 
            `outlet_set_id`, `soil_type`, `soil_group`, `irrigweb_soil_type`, `crop_class`, `date_planted`, 
            `no_rows`, `row_length`, `row_spacing`, `area`, `water_supply`, `water_source`, `pump_type`, 
            `motor_kw`, `tariff`, `flow_rate`, `per_cup_flow_rate`, `duration`, `total_ML`, `total_mm`, 
            `days_between`, `crop_water_use`, `applied_efficiency`, `energy`, `energy_per_ML`, `energy_per_hour`, 
            `energy_cost`, `energy_cost_per_ML`, `energy_cost_per_irrig`) VALUES ('{$SetCount}','{$set[2+$i][0]}','{$set[2+$i][1]}',
            '{$set[2+$i][2]}','{$set[2+$i][3]}','{$set[2+$i][4]}','{$set[2+$i][5]}',
            '{$set[2+$i][6]}','{$set[2+$i][7]}','{$set[2+$i][8]}','{$set[2+$i][9]}',
            '{$set[2+$i][10]}','{$set[2+$i][11]}','{$set[2+$i][12]}',
            '{$set[2+$i][13]}','{$set[2+$i][14]}','{$set[2+$i][15]}',
            '{$set[2+$i][16]}','{$set[2+$i][17]}','{$set[2+$i][18]}',
            '{$set[2+$i][19]}','{$set[2+$i][20]}','{$set[2+$i][21]}',
            '{$set[2+$i][22]}','{$set[2+$i][23]}','{$set[2+$i][24]}',
            '{$set[2+$i][25]}','{$set[2+$i][26]}','{$set[2+$i][27]}',
            '{$set[2+$i][28]}','{$set[2+$i][29]}','{$set[2+$i][30]}',
            '{$set[2+$i][31]}','{$set[2+$i][32]}')"; 
             echo $sql;

            $result = mysqli_query($db, $sql);
            // if ($result < 1){
            //     echo "<script>window.alert('Paddocks have not been added successfully!');</script>";
            //     $sql = "DELETE FROM property WHERE ID = '{$PropertyCount}'";
            //     $result = mysqli_query($db, $sql);      
            //     $sql = "DELETE FROM pump WHERE PropertyID = '{$PropertyCount}'";
            //     $result = mysqli_query($db, $sql);     
            //     $sql = "DELETE FROM imu WHERE PropertyID = '{$PropertyCount}'";
            //     $result = mysqli_query($db, $sql);  
            //     $sql = "DELETE FROM irrigationset WHERE PropertyID = '{$PropertyCount}'";
            //     $result = mysqli_query($db, $sql);                 
            //     exit;
            // }  
        }
    } 
}

// if (isset($_POST['delete'])) {
//     $value = $_POST['delete'];
//     //echo $value;
//     //echo "<script>console.log('$value');</script>"; 
//     $sql = "DELETE FROM property WHERE ID = '{$value}'";
//     $result = mysqli_query($db, $sql);      
//     $sql = "DELETE FROM pump WHERE PropertyID = '{$value}'";
//     $result = mysqli_query($db, $sql);     
//     $sql = "DELETE FROM imu WHERE PropertyID = '{$value}'";
//     $result = mysqli_query($db, $sql);  
//     $sql = "DELETE FROM irrigationset WHERE PropertyID = '{$value}'";
//     $result = mysqli_query($db, $sql);    
//     //echo "<script>window.alert('Delete Successfully. Please Refresh This Page.');</script>"; 
// }
?>  