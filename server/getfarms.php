<?php 
    session_start(); 
// connect to the database
$db = mysqli_connect('3.27.67.148', 'bip_root', 'Eric137456', 'bip_BIP');
// Check connection
if (!$db) {
    $db = mysqli_connect('localhost', 'root', '', 'BIP');
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