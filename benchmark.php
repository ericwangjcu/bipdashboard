<?php 
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    error_reporting(0);
    // echo $_GET['id'];
    $db = mysqli_connect('localhost', 'root', '', 'BIP');
    // Check connection
    if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
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

            $sql = "SELECT Owner FROM property WHERE ID = {$row["PropertyID"]}";
            $temp = mysqli_fetch_assoc(mysqli_query($db, $sql));
            $owner[$j] = $temp["Owner"];

            

            $j++;         
        }
    } else {
        echo "0 results";
    }   
    //echo "<script>console.log('{$benchmark}')</script>";

 
?>


