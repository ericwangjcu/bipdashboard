
<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
// error_reporting(E_ALL & ~E_NOTICE);
$db = mysqli_connect('3.27.67.148', 'bip_root', 'Eric137456', 'bip_BIP');
// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

$dashboarditems = [];
$dashboardshown = [];


$sql = "SELECT * FROM dashboard";
$result = mysqli_query($db, $sql);
$i = 0;
foreach ($result as $row) {
    $dashboarditems[$i] = $row['item'];  
    $dashboardshown[$i] = $row['shown'];  
    $i++;
    
}


if (isset($_POST['save'])) {
    $setarray = array("District","Grower ID","Wilmar Map Block ID",
    "Grower Block Identifier","Outlet Set Identifier","Soil Type",
    "Soil Group","IrrigWeb Soil Type","Crop Class",
    "Date Planted","Number of Rows","Avg Row Length (m)",
    "Row Spacing (m)","Area (ha)","Water Supply","Water Source",
    "Pump Type","Measured Motor KW","Tariff","Total Flow Rate (L/S)",
    "Per Cup Flow Rate (L/S/Cup)","Duration (hrs)","Total ML Applied (ML)",
    "Depth Applied (mm)","Days Between Irrigation Duration","Crop Water Use Between Irrigations",
    "Application Efficency (%)","Energy (KWH)","Energy per ML (kWh/ML)",
    "Energy per Hour (kWh/h)","Energy Cost ($/kWh)","Energy Cost per ML ($/ML)","Energy Cost per Irrigation ($/ha/ML)");

    for ($i=0;$i<sizeof($setarray);$i++){
        $sql = "UPDATE `dashboard` SET `shown`='0' WHERE `item`='{$setarray[$i]}'";
        $result = mysqli_query($db, $sql);
    }

    $dashboardtable = ($_POST['dashboardtable']);
    $names = explode(";", $dashboardtable);

    for ($j=0;$j<sizeof($names);$j++){
        $sql = "UPDATE `dashboard` SET `shown`='1' WHERE `item`='{$names[$j]}'";
        echo "<script>console.log('{$sql}')</script>";
        $result = mysqli_query($db, $sql);
    }
    
}

?>  