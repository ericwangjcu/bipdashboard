<?php 
session_start(); 
$db = mysqli_connect('3.27.67.148', 'bip_root', 'Eric137456', 'bip_BIP');
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

$keyword = '_%';
if ($_SESSION['username'] == "ATS"){
    $keyword = 'ATS_%';
    // echo "<script>console.log('ATS')</script>";
}
if ($_SESSION['username'] == "BPS"){
    $keyword = 'BPS_%';
}
if ($_SESSION['username'] == "FARMACIST"){
    $keyword = 'FBIP_%';
}
$sql = "SELECT district, COUNT(district), sum(area), SUM(setscount) FROM (SELECT district, grower_id, COUNT(grower_id) as setscount, sum(area) as area FROM irrigset WHERE grower_id like '$keyword' GROUP BY grower_id HAVING COUNT(grower_id) > 0) as foo GROUP BY district HAVING COUNT(district) > 0";
$result = mysqli_query($db, $sql);
$i = 0;
foreach ($result as $row) {
    $farmcount[$i][0] = $row['district'];  
    $farmcount[$i][1] = $row['COUNT(district)']; 
    $farmcount[$i][3] = $row['sum(area)'];  
    $farmcount[$i][2] = $row['SUM(setscount)'];  
    $i++;
}
mysqli_close($db);
?>