<?php 
    session_start(); 
    error_reporting(0);
    $db = mysqli_connect('3.27.67.148', 'bip_root', 'Eric137456', 'bip_BIP');
    if (!$db) {
        $db = mysqli_connect('localhost', 'root', '', 'BIP');
    }

    $param = isset($_POST['param']) ? $_POST['param'] : null;
    $sql = "SELECT $param, COUNT($param) * 100 / 399, COUNT($param), sum(area) FROM irrigset GROUP BY $param";
    $result = mysqli_query($db, $sql);    
    if (mysqli_num_rows($result) > 0) {
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


