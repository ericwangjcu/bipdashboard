<?php include('comp/userauth.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php include('server/getfarms.php') ?>
<?php include('server/savedashboard.php') ?>
<head>
<?php include('comp/header.php')?>
</head>
<body>
    <div class="wrapper "> 
        <div class="main ">
            <?php include('comp/nav.php')?>
            <main class="content" >      
                <div class="col-auto d-none d-sm-block ">
                    <h3><strong>Baseline</strong></h3>
                </div>    
                <div class="row"> 
                    <div id="head"></div>
                    <div class="col-12">
                        <div class="tab tab-light">
                            <ul class="nav nav-tabs nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-2" data-bs-toggle="tab" role="tab">
                                        <div class="bi-border-all text-center" style="font-size: 20px;"></div> 
                                        <div class="text-center">Set</div>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="#vertical-icon-tab-3" data-bs-toggle="tab" role="tab">
                                        <div class="bi-droplet-fill text-center" style="font-size: 20px;"></div> 
                                        <div class="text-center">Irrigation</div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#vertical-icon-tab-4" data-bs-toggle="tab" role="tab">
                                        <div class="bi-currency-dollar text-center" style="font-size: 20px;"></div> 
                                        <div class="text-center">Cost</div>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane" id="vertical-icon-tab-2" role="tabpanel">
                                    <div class="row"> 
                                        </br>
                                        </br>
                                        </br>
                                        <div id="head-1"></div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="vertical-icon-tab-3" role="tabpanel">
                                    <div class="row"> 
                                        </br>
                                        </br>
                                        </br>
                                        <div id="head-2"></div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="vertical-icon-tab-4" role="tabpanel">
                                    <div class="row"> 
                                    </br>
                                        </br>
                                        </br>
                                        <div id="head-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Set Table</h4>
                            </div>
                            <div class="modal-body">
                            <div id="datatable"></div>
                            </div>
                        </div>
                        
                        </div>
                    </div>
                    <script>
                        var units = ["","","ha"]
                        var size = [4,4,4];        
                        var value = []; 
                        var setnames = <?php echo json_encode($setnames,JSON_INVALID_UTF8_IGNORE); ?>;
                        var setvalues = <?php echo json_encode($setvalues,JSON_INVALID_UTF8_IGNORE); ?>;
                        var username = <?php echo json_encode($_SESSION['username'],JSON_INVALID_UTF8_IGNORE); ?>; 
                        var farmcount = <?php echo json_encode($farmcount,JSON_INVALID_UTF8_IGNORE); ?>;
                        var subset = findsubset(username,setvalues);

                        for (let i=0;i<subset.length;i++){
                            subset[i][27] = subset[i][27] * 100; 
                        }
                        addtop();                            
                    </script>
                    <script>
                        setarray = ["District","Grower ID","Wilmar Map Block ID",
                        "Grower Block Identifier","Outlet Set Identifier","Soil Type",
                        "Soil Group","IrrigWeb Soil Type","Crop Class",
                        "Date Planted","Number of Rows","Avg Row Length (m)",
                        "Row Spacing (m)","Area (ha)","Water Supply","Water Source",
                        "Pump Type","Measured Motor KW","Tariff","Total Flow Rate (L/S)",
                        "Per Cup Flow Rate (L/S/Cup)","Duration (hrs)","Total ML Applied (ML)",
                        "Depth Applied (mm)","Days Between Irrigation Duration","Crop Water Use Between Irrigations",
                        "Application Efficency (%)","Energy (kWh)","Energy per ML (kWh/ML)",
                        "Energy per Hour (kWh/h)","Energy Cost ($/kWh)","Energy Cost per ML ($/ML)","Energy Cost per Irrigation ($/ha/ML)","Area vs Irrigation", "Irrigation vs District","Irrigation vs Water Supply","District vs Water Supply"];
                        types = [5,2,2,2,2,0,8,8,0,9,1,1,8,1,0,0,8,1,0,1,1,10,1,1,10,1,1,1,1,1,0,1,1,2,3,4,6];
                        intervals = [5,2,2,2,2,0,7,8,0,9,1,1,8,0.1,0,8,8,1,0,1,0.1,1,0.1,1,1,1,1,1,1,1,0,1,1,2,3,4,6];
                        tabs = [0,5,5,5,5,1,1,1,1,1,1,1,1,1,2,2,2,2,2,2,2,2,2,2,2,2,2,3,3,3,3,3,3,5,5,5,5];
                        legends = [5,2,2,2,2,1,7,8,1,9,1,1,8,1,0,0,8,1,0,1,1,1,1,1,1,1,1,1,1,1,0,1,1,2,3,4,6];
                        
                        rows = [1,1,1,1,1, 2,2,3, 2,2,2, 2,2,2, 2,2,2, 2,2,2, 2,2,2, 2, 2,2,2, 2,2,2, 2,2,2, 2,2,2,2];
                        cols = [4,4,4,4,4, 6,6,12, 6,6,6, 6,6,6, 4,4,4, 4,3,5, 7,5,6, 6, 5,7,12, 6,6,8, 4,6,6, 4,4,4,4];



                        var height = [];
                        for (let i=0;i<rows.length;i++){
                            height[i] = rows[i] * 180 + (rows[i] - 1) * 122;               
                        }

                        function addgroup(dashboarditems,rows,cols,tabs){
                            var i = 5;
                            while(i<cols.length - 4){
                                const col = document.createElement("div");
                                col.className = "col-12 col-sm-12 col-md" + cols[i] + " col-xl-" + cols[i];

                                var sum = 2;
                                var index = 0;
                                while (sum > 0){                
                                    const card = document.createElement("div");
                                    card.className = "card  d-flex align-items-stretch";
                                    card.id = dashboarditems[i + index] + "card";

                                    const cardjeader = document.createElement("div");
                                    cardjeader.className = "card-header h4 text-dark";
                                    cardjeader.innerText = dashboarditems[i + index] + " (by Set)";
                                    card.appendChild(cardjeader);

                                    const cardbody = document.createElement("div");
                                    cardbody.className = "card-body";
                                    cardbody.id = dashboarditems[i + index] + "body0";

                                    card.appendChild(cardbody);
                                    col.appendChild(card);
                            
                                    sum -= rows[i + index];
                                    // console.log(sum);
                                    index ++;    
                                }
                                i += index;
                                
                                const currentDiv = document.getElementById("head-" + tabs[i - index]);
                                // const currentDiv = document.getElementById("head");

                                let parentDiv = currentDiv.parentNode
                                parentDiv.insertBefore(col, currentDiv); 
                            }          
                            
                        } 

                        addgroup(setarray,rows,cols,tabs);
                        for (let i=5;i<33;i++){
                            addchart(setarray[i], types[i], setarray[i],i+1, intervals[i],legends[i],height[i]);                        
                        } 

                        function activaTab(tab){
                            $('.nav-tabs a[href="#' + tab + '"]').tab('show');
                        };

                        activaTab('vertical-icon-tab-3');   
                    </script>
                </div>

            </main>
            <?php include('comp/footer.php')?>
        </div>
    </div>

	<script src="js/app.js"></script>
    <script src="js/datatables.js"></script>


</body>

</html>