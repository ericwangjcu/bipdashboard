<?php 
    session_start(); 
    error_reporting(0);
    // echo $_GET['id'];
    $db = mysqli_connect('localhost', 'root', '', 'BIP');
    // Check connection
    if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "DESCRIBE irrigationset";
    $result = mysqli_query($db, $sql);
    $i = 0;
    foreach ($result as $row) {
        $names[$i] = $row['Field'];  
        $sql = "SELECT Min({$names[$i]}), Max({$names[$i]}), Avg({$names[$i]}) FROM irrigationset";
        $temp = mysqli_fetch_assoc(mysqli_query($db, $sql));

        
        $min[$i] = $temp["Min({$names[$i]})"];
        $max[$i] = $temp["Max({$names[$i]})"];
        $avg[$i] = $temp["Avg({$names[$i]})"];
        $i++;
    }

    $sql = "SELECT Area, HarvestDate, Duration, CycleDays, IMUID, PropertyID FROM irrigationset";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $j = 0;
        while($row = mysqli_fetch_assoc($result)) 
        {
            $setname[$j][0]=$row["Area"];
            $setname[$j][1]=$row["HarvestDate"];
            $setname[$j][2]=$row["Duration"];
            $setname[$j][3]=$row["CycleDays"];
            $setname[$j][4]=$row["FlowRate"];
            

            $sql = "SELECT * FROM pump WHERE PropertyID = {$row["PropertyID"]} AND IMUID = {$row["IMUID"]}";
            $temp = mysqli_fetch_assoc(mysqli_query($db, $sql));
            $setname[$j][4] = $temp["FlowRate"];
            $setname[$j][5] = $temp["MotorKW"];  

           
            $j++;         
        }
    } else {
        echo "0 results";
    }




    $sql = "SELECT * FROM irrigationset WHERE ID = '{$_GET['id']}'";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $j = 0;
        while($row = mysqli_fetch_assoc($result)) 
        {
            $i = 0;
            foreach ($names as $value) 
            {                                 
                $fieldname[$j][$i] = $row[$value]; 
                $_SESSION['farmname'] = $row["SetID"];                  
                $i++;
            } 

            $sql = "SELECT * FROM pump WHERE PropertyID = {$fieldname[$j][19]} AND IMUID = {$fieldname[$j][18]}";
            $temp = mysqli_fetch_assoc(mysqli_query($db, $sql));
            $flowrate = $temp["FlowRate"];
            $motorkw = $temp["MotorKW"];

        

            $fieldname[$j][15] = $flowrate;
            $fieldname[$j][16] = $fieldname[$j][15] * $fieldname[$j][13] * 3600 / 1000000;
            $fieldname[$j][17] = number_format((float)$fieldname[$j][16] * 100 / $fieldname[$j][2], 2, '.', '');
            
            $j++;                
        }
    } else {
        echo "0 results";
    }

    $sql = "SELECT ID, SetID FROM irrigationset WHERE PropertyID = {$fieldname[0][19]}";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $z = 0;
        while($row = mysqli_fetch_assoc($result)) 
        {
            $setids[$z][0] = $row["ID"];
            $setids[$z][1] = $row["SetID"]; 
            $z++;
                          
        }
    }    
    mysqli_close($db);   
?>


