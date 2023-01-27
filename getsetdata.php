<?php 
    session_start(); 
    // error_reporting(0);
    // echo $_GET['id'];
    $db = mysqli_connect('localhost', 'root', '', 'BIP');
    // Check connection
    if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
    }

    $farm = isset($_POST['farm']) ? $_POST['farm'] : null;
    $block = isset($_POST['block']) ? $_POST['block'] : null;

    // echo $farm; 
    // echo $block; 

    $sql = "SELECT * FROM `setdata` WHERE DeviceN = 'D1' AND Farm = 'ATS207'";
    $result = mysqli_query($db, $sql);    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $j = 0;
        while($row = mysqli_fetch_assoc($result)) 
        {
            $i = 0;
            foreach ($row as $value) 
            {                                 
                $setdata[$j][$i] = $value; 
                $i++;
            }
            $j++;                
        }
    } else {
        echo "0 results";
    }        
    echo json_encode($setdata); 

?>


