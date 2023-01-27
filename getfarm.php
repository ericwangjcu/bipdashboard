<?php 
    $db = mysqli_connect('localhost', 'root', '', 'BIP');
    // Check connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "DESCRIBE property";
    $result = mysqli_query($db, $sql);
    $i = 0;
    foreach ($result as $row) {
        $names[$i] = $row['Field'];  
        $i++;
    }

    $sql = "SELECT * FROM property where Owner = '{$_SESSION['username']}'";
    $result = mysqli_query($db, $sql);
    $farmvalues = [];

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $j = 0;
        while($row = mysqli_fetch_assoc($result)) 
        {
            $i = 0;
            foreach ($names as $value) 
            {         
                $farmvalues[$j][$i] = $row[$value]; 
                $farmname = $row["ID"]; 
                $farmwatersupply = $row["Water Supply Authority"];  
                $farmwatersource = $row["Water Source"];  
                $farmprodgroup = $row["FarmProductivityGroup"];  
                
                if ($i == 0){
                    $sql = "SELECT Area FROM irrigationset WHERE PropertyID = {$farmname}";
                    $result1 = mysqli_query($db, $sql);
                    $totalfarmarea = 0;
                    if (mysqli_num_rows($result1) > 0) {
                        while($row1 = mysqli_fetch_assoc($result1)) 
                        {
                            foreach ($row1 as $value1) 
                            {
                                $totalfarmarea = $totalfarmarea + $value1; 
                            }                                      
                        }                      
                    }

                    $sql = "SELECT COUNT(ID) AS NumberofIMUs FROM imu WHERE PropertyID = {$farmname}";
                    $temp = mysqli_fetch_assoc(mysqli_query($db, $sql));
                    $FarmIMUCount = $temp["NumberofIMUs"];    
                    
                    $sql = "SELECT COUNT(ID) AS NumberofPUMPs FROM pump WHERE PropertyID = {$farmname}";
                    $temp = mysqli_fetch_assoc(mysqli_query($db, $sql));
                    $FarmPUMPCount = $temp["NumberofPUMPs"];      

                    $sql = "SELECT SUM(MotorKW) AS TotalPUMPKW FROM pump WHERE PropertyID = {$farmname}";
                    $temp = mysqli_fetch_assoc(mysqli_query($db, $sql));
                    $FarmPUMPKW = $temp["TotalPUMPKW"];                       
                    
                    $sql = "SELECT COUNT(ID) AS NumberofSETs FROM irrigationset WHERE PropertyID = {$farmname}";
                    $temp = mysqli_fetch_assoc(mysqli_query($db, $sql));
                    $FarmSETCount = $temp["NumberofSETs"];                      
                }                 
                $i++;
            } 
            $j++;                
        }
    } else {
        echo "0 results";
    }


    $sql = "DESCRIBE pump";
    $result = mysqli_query($db, $sql);
    $i = 0;
    foreach ($result as $row) {
        $pumpnames[$i] = $row['Field'];  
        $i++;
    }


    $sql = "SELECT * FROM pump WHERE PropertyID = '{$farmname}'";
    $result = mysqli_query($db, $sql);
    $farmpumpvalues = [];
    if (mysqli_num_rows($result) > 0) {
        $j = 0;
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) 
        {
            $i = 0;
            foreach ($pumpnames as $value) 
            {                                 
                $farmpumpvalues[$j][$i] = $row[$value];                  
                $i++;
            } 
            $farmtariff[$j] = $row["Tariff"];
            $farmpumpkw[$j] = $row["MotorKW"];
            $farmpumptype[$j] = $row["Pump Type"];
            $farmVFD[$j] = $row["VFD"];
            $farmflowrate[$j] = $row["FlowRate"];
            $farmpumpname[$j] = $row["Pump Name"];
            $farmpumpID[$j] = $row["ID"];
            $farmpumpmake[$j] = $row["Pump Make"];
            $farmmotormake[$j] = $row["Motor Make"];
            $farmwatersource[$j] = $row["Water Source"];   
            if ($pumpvalues[$j][8] != 0){
                $farmpumpvalues[$j][$i+1] = 1000000 * $pumpvalues[$j][4] / ($pumpvalues[$j][8]*3600);
            }
                     
            $j++;
        }
    } else {
        echo "0 results";
    }    

    $sql = "DESCRIBE irrigationset";
    $result = mysqli_query($db, $sql);
    $i = 0;
    foreach ($result as $row) {
        $setnames[$i] = $row['Field'];  
        $i++;
    }

    $sql = "SELECT * FROM irrigationset WHERE PropertyID = '{$farmname}'";
    $result = mysqli_query($db, $sql);
    $farmsetvalues = [];
    if (mysqli_num_rows($result) > 0) {
        $j = 0;
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) 
        {
            $i = 0;
            foreach ($setnames as $value) 
            {                                 
                $farmsetvalues[$j][$i] = $row[$value];                  
                $i++;
            } 
            $farmsoilgroup[$j] = $row["SoilGroup"];
            $farmrowspacing[$j] = $row["RowSpacing"];
            $farmrowlength[$j] = $row["RowLength"];
            $farmvariety[$j] = $row["Variety"];
            $farmcropclass[$j] = $row["CropClass"];
            $farmarea[$j] = $row["Area"];
            $farmsetname[$j] = $row["SetID"];
            $farmsetID[$j] = $row["ID"];
            $j++;
        }
    } else {
        echo "0 results";
    }    


    $sql = "SELECT * FROM imu WHERE PropertyID = '{$farmname}'";
    $result = mysqli_query($db, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $j = 0;
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) 
        {
            $imuname[$j][0] = $row["IMU ID"];
            $sql = "SELECT * FROM pump WHERE PropertyID = '{$farmname}' AND IMUID = {$imuname[$j][0]}";
            $temp = mysqli_fetch_assoc(mysqli_query($db, $sql));
            $imuname[$j][1] = $temp["Pump Name"];
            $imuname[$j][2] = $temp["ID"];
            

            $sql = "SELECT COUNT(ID) AS NumberOfProducts FROM irrigationset WHERE PropertyID = '{$farmname}' AND IMUID = {$imuname[$j][0]}";
            $temp = mysqli_fetch_assoc(mysqli_query($db, $sql));
            $imuname[$j][3] = $temp["NumberOfProducts"];
            $imuname[$j][4] = $farmname;

            $sql = "SELECT SUM(Area) AS TotalArea FROM irrigationset WHERE PropertyID = '{$farmname}' AND IMUID = {$imuname[$j][0]}";
            $temp = mysqli_fetch_assoc(mysqli_query($db, $sql));
            $imuname[$j][5] = $temp["TotalArea"];

            $j++;                
        }
    } else {
        echo "0 results";
    }    

    mysqli_close($db);
?>