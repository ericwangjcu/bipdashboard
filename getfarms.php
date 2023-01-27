<?php 
    session_start(); 
    $db = mysqli_connect('localhost', 'root', '', 'BIP');
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
    

    $sql = "DESCRIBE irrigset";
    $result = mysqli_query($db, $sql);
    $i = 0;
    foreach ($result as $row) {
        $setnames[$i] = $row['Field'];      
        $i++;
    }
    
    $sql = "SELECT * FROM irrigset";
    $result = mysqli_query($db, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $j = 0;
        while($row = mysqli_fetch_assoc($result)) 
        {
            $i = 0;
            foreach ($setnames as $value) 
            { 
                $setvalues[$j][$i] = $row[$value]; 
                $i++;
            }
            $j++;
              
        }
    }

    mysqli_close($db);
?>