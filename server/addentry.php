
<?php
// connect to the database
$db = mysqli_connect('3.27.67.148', 'bip_root', 'Eric137456', 'bip_BIP');
// Check connection
if (!$db) {
    $db = mysqli_connect('localhost', 'root', '', 'BIP');
}

    $sql = "SELECT ID FROM irrigset ORDER BY id DESC LIMIT 1";
    $temp = mysqli_fetch_assoc(mysqli_query($db, $sql));
    $SetCount = $temp["ID"];    



    if (isset($_POST['import'])) {
        $set = json_decode($_POST['sets']);

        $index = 0;
        for ($i=0;$i<sizeof($set)-2;$i++){
            if($set[2+$i][0]){
                $idarray[$index] = $set[2+$i][0];
            }
            $index ++;
        }

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

                $result = mysqli_query($db, $sql);
            }
        } 
    }

?>  