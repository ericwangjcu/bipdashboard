<?php 
session_start(); 
$db = mysqli_connect('3.27.67.148', 'bip_root', 'Eric137456', 'bip_BIP');
if (!$db) {
    $db = mysqli_connect('localhost', 'root', '', 'BIP');
}

$sql = "DESCRIBE wilma";
$result = mysqli_query($db, $sql);
$i = 0;
foreach ($result as $row) {
    $wilmanames[$i] = $row['Field'];      
    $i++;
}
//echo "<script>console.log('{$wilmanames}')</script>";

$sql = "SELECT * FROM wilma";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    $j = 0;
    while($row = mysqli_fetch_assoc($result)) 
    {
        $i = 0;
        foreach ($wilmanames as $value) 
        { 
            $wilmavalues[$j][$i] = $row[$value]; 
            $i++;
        }
        $j++;
            
    }
}

//echo "<script>console.log('{$wilmavalues}')</script>";

//$sql = "SELECT ANY_VALUE(ID) AS ID, ANY_VALUE(Date) AS Date, ANY_VALUE(Valve) AS Valve, ANY_VALUE(Event) AS Event, ANY_VALUE(Runtime) AS Runtime, ANY_VALUE(Flow) AS Flow, ANY_VALUE(Depth) AS Depth FROM wilma GROUP BY Valve";

$sql = "SELECT * FROM wilma GROUP BY Valve";
$result = mysqli_query($db, $sql);
$i = 0;
foreach ($result as $row) {
    $sql = "SELECT * FROM wilma WHERE Valve = '{$row['Valve']}'";
    $result1 = mysqli_query($db, $sql);
    foreach ($result1 as $row1) {
        $valvevalues[$i][$j][0] = $row1['Valve']; 
        $valvevalues[$i][$j][1] = $row1['Date']; 
        $valvevalues[$i][$j][2] = $row1['Event'];      
        $valvevalues[$i][$j][3] = $row1['Runtime'];      
        $valvevalues[$i][$j][4] = $row1['Flow'];      
        $valvevalues[$i][$j][5] = $row1['Depth'];           
        $j++;
    }  
    $valvenames[$i] = $row['Valve'];
    $i++;
}
//echo "<script>console.log('{$valvevalues}')</script>";
//echo "<script>console.log('{$valvenames}')</script>";


$sql = "SELECT data, SUM(rainfall) FROM rainfall GROUP BY data";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    $j = 0;
    while($row = mysqli_fetch_assoc($result)) 
    {
        $i = 0;
        foreach ($row as $value) 
        {                                 
            $rainfall[$j][$i] = $value; 
            $i++;
        }
        $j++;                
    }
} else {
    echo "0 results";
}  
//echo "<script>console.log('{$rainfall}')</script>";

$sql = "DESCRIBE sensor";
$result = mysqli_query($db, $sql);
$i = 0;
foreach ($result as $row) {
    $sensornames[$i] = $row['Field'];      
    $i++;
}
//echo "<script>console.log('{$sensornames}')</script>";

$sql = "SELECT * FROM sensor";
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0) {
   $j = 0;
   while($row = mysqli_fetch_assoc($result)) 
   {
       $i = 0;
       foreach ($row as $value) 
       {                                 
           $sensor[$j][$i] = $value; 
           $i++;
       }
       $j++;                
   }
} else {
   echo "0 results";
}  
// echo "<script>console.log('{$sensor}')</script>";

mysqli_close($db);
?>