<?php
   error_reporting(E_ALL ^ E_NOTICE); 

  session_start();
  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: login.php");
    }

    $style = "";
    if($_SESSION['role'] == 1){
        $style = "style='display:none;'";
    }else{
        $style = "style='display:none;'";
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include('getfarms.php') ?>
<?php include('savedashboard.php') ?>
<head>
<?php include('header.php')?>
<style>
.form-check-lg {
  font-size: 150%;
}

.offcanvas {
  width: 50%;
  background: #f5f7fb;
}
.modal {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: rgb(0 0 0 / 70%);
}

.modal .chart {
    height: 90%;
    width: 90%;
    max-width: none;
}
</style>

</head>


<script>
    
    function addElement (id, text, dv, tt, ss, index, interval,number) {
        const newDiv1 = document.createElement("div");
        newDiv1.className = "form-check form-switch form-check-lg";

        const newDiv = document.createElement("input");
        newDiv.className = "form-check-input";
        newDiv.type = "checkbox";
        newDiv.id = id;

        newDiv1.appendChild(newDiv);

        const newDiv2 = document.createElement("label");
        newDiv2.className = "form-check-label";
        newDiv2.for = id;
        newDiv2.innerText = text;


        const t = document.createElement("type");
        t.id = tt;

        const s = document.createElement("short");
        s.id = ss;

        const idd = document.createElement("index");
        idd.id = index;

        const int = document.createElement("interval");
        int.id = interval;
        const num = document.createElement("number");
        num.id = number;

        newDiv1.appendChild(newDiv2);
        newDiv1.appendChild(t);
        newDiv1.appendChild(s);
        newDiv1.appendChild(idd);
        newDiv1.appendChild(int);
        newDiv1.appendChild(num);

        const currentDiv = document.getElementById(dv);
        let parentDiv = currentDiv.parentNode

        parentDiv.insertBefore(newDiv1, currentDiv);
    }   
    function addgroup(header,size,cards){
        const newDiv1 = document.createElement("div");
        newDiv1.className = "col-12 col-md-" + size + " col-xl-" + size;
        newDiv1.id = header;

        const newDiv0 = document.createElement("div");
        newDiv0.className = "row";

        for (let i=0;i<cards.length;i++){
            const card0 = document.createElement("div");
            card0.className = "col-4";

            const card1 = document.createElement("div");
            card1.className = "card";        
            const cardheader1 = document.createElement("div");
            cardheader1.className = "card-header h3";
            cardheader1.innerText = cards[i];
            card1.appendChild(cardheader1);

            const cardbody = document.createElement("div");
            cardbody.className = "card-body";

            const container = document.createElement("div");
            container.id = header + cards[i] + "body";

            cardbody.appendChild(container);
            card1.appendChild(cardbody);
            card0.appendChild(card1);
            newDiv0.appendChild(card0);
        }
        newDiv1.appendChild(newDiv0);

        const currentDiv = document.getElementById("head");
        let parentDiv = currentDiv.parentNode

        parentDiv.insertBefore(newDiv1, currentDiv);        
    }       
    function addtext(text,card){
        var textrow = document.createElement("div");   
        textrow.className = "col-12 h2 mt-6 mb-6";
        textrow.innerText = text; 
        
        const currentDiv = document.getElementById("head");
        let parentDiv = currentDiv.parentNode

        parentDiv.insertBefore(textrow, currentDiv);             
    }
    function addcard(header,size, number){
        const newDiv1 = document.createElement("div");
        newDiv1.className = "col-12 col-md-" + size + " col-xl-" + size;  

        const card = document.createElement("div");
        card.className = "card";
        card.id = header + "chart";
        
        const cardheader = document.createElement("div");
        cardheader.className = "card-header h3";
        cardheader.innerText = header;

        // const cardheadertext = document.createElement("h4");
        // cardheadertext.innerText = header;

        // cardheader.appendChild(cardheadertext);
        card.appendChild(cardheader);

        const newDiv0 = document.createElement("div");
        newDiv0.className = "row"; 

        var size = 12 / number;

        for (let i=0;i<number;i++){
            const newDiv2 = document.createElement("div");
            newDiv2.className = "col-" + size; 

            const cardbody = document.createElement("div");
            cardbody.className = "card-body";
            cardbody.id = header + "body" + i;            

          
            
            newDiv2.appendChild(cardbody);
            newDiv0.appendChild(newDiv2);
        }
        card.appendChild(newDiv0);

        
        newDiv1.appendChild(card);

        const currentDiv = document.getElementById("head");
        let parentDiv = currentDiv.parentNode

        parentDiv.insertBefore(newDiv1, currentDiv);        
    }      
    function addchart(header, type, short, index, interval){
        var setvalues = <?php echo json_encode($setvalues,JSON_INVALID_UTF8_IGNORE); ?>;
        var username = <?php echo json_encode($_SESSION['username'],JSON_INVALID_UTF8_IGNORE); ?>; 

        var subset = [];
        var ind = 0;
        switch(username) {
            case "BIP":
                subset = setvalues;
                break;
            case "FARMACIST":
                for (let i=0;i<setvalues.length;i++){
                    
                    var nameArr = setvalues[i][2].split('_');
                    // console.log(nameArr[0]);
                    if (nameArr[0] == "FBIP"){
                        subset[ind] = [];
                        for (let j=0;j<setvalues[i].length;j++){
                            subset[ind][j] = setvalues[i][j]; 
                        }
                        ind ++;
                    }
                }         
                break;
            case "BPS":
                for (let i=0;i<setvalues.length;i++){
                    
                    var nameArr = setvalues[i][2].split('_');
                    // console.log(nameArr[0]);
                    if (nameArr[0] == "BPS"){
                        subset[ind] = [];
                        for (let j=0;j<setvalues[i].length;j++){
                            subset[ind][j] = setvalues[i][j]; 
                        }
                        ind ++;
                    }
                }         
                break;   
            case "ATS":
                for (let i=0;i<setvalues.length;i++){
                    var nameArr = setvalues[i][2].split('_');
                    // console.log(nameArr[0]);
                    if (nameArr[0] == "ATS"){
                        subset[ind] = [];
                        for (let j=0;j<setvalues[i].length;j++){
                            subset[ind][j] = setvalues[i][j]; 
                        }
                        ind ++;
                    }
                }         
                break;                                
            default:
                // code block
        }
        // console.log(subset);
        for (let i=0;i<subset.length;i++){
            subset[i][27] = Number(subset[i][27]) * 100; 
        }

        var tempdata = [];
        var unit = "";
        var t = 0;
   

        var data = [];
        // var t = 0;
        ind = 0;
        for (let i = 0; i < subset.length; i++) {
            if (Number(subset[i][index]) != 0){
                data[ind] = subset[i][index];
                ind ++;                
            }
        } 
        // console.log(data);
        if (type == 0){
            createpiechart(header + "body0", data, tempdata,'',short,500);
        }
        if (type == 1){
            createbasicbar(header + "body0",data, tempdata,'',header,"",500, interval);
        }
        function createsregression(indx, indy, xname, ynames, yunits){
            var x = [];
            var y = [];
            for (let i=0;i<indy.length;i++){
                y[i] = [];
            }
            for (let i = 0; i < subset.length; i++) {
                x[i] = Number(subset[i][indx]);
                for (let j=0;j<indy.length;j++){
                    y[j][i] = Number(subset[i][indy[j]]);
                }                    
            } 
            createline(header + "body0",x,y,xname, ynames,yunits, 500);                

        }        
        if (type == 2){
            createsregression(14,[22,23,33],"Area (ha)", ["Duration (h)","ML","$/Irrigation"],["h","ML","$/Irrigation"]);      
        }
        function comparisonchart(x,y, ynames,yunits){
            var sub = [];
            var ind = [];
            for (let i = 0; i < y.length; i++){
                sub[i] = [];
                ind[i] = [];
            }
            var newarray = [];
            for (let i = 0; i < subset.length; i++) {
                newarray[i] = subset[i][x];
            }
            var counts = {};
            for (const num of newarray) {
                counts[num] = counts[num] ? counts[num] + 1 : 1;
            }    
            const iterator = Object.keys(counts);

            
            for (let j = 0; j < iterator.length; j++) {
                ind[j] = 0;   
                sub[j] = [];             
                for (let i = 0; i < subset.length; i++) {
                    if (subset[i][x] == iterator[j]){
                        sub[j][ind[j]] = [];
                        for(let z=0;z<34;z++){
                            sub[j][ind[j]][z] = subset[i][z];
                        }
                        ind[j] ++; 
                    }

                }     
            }
            
            function calculate(array){
                high = Math.max.apply(null, array);
                low = Math.min.apply(null, array);
                const asc = arr => arr.sort((a, b) => a - b);
                const median = arr => {
                    const mid = Math.floor(arr.length / 2),
                        nums = [...arr].sort((a, b) => a - b);
                    return arr.length % 2 !== 0 ? nums[mid] : (nums[mid - 1] + nums[mid]) / 2;
                    };
                med = median(array);    
                const quantile = (arr, q) => {
                    const sorted = asc(arr);
                    const pos = (sorted.length - 1) * q;
                    const base = Math.floor(pos);
                    const rest = pos - base;
                    if (sorted[base + 1] !== undefined) {
                        return sorted[base] + rest * (sorted[base + 1] - sorted[base]);
                    } else {
                        return sorted[base];
                    }
                };        
                lowqua = quantile(array,0.25);    
                upqua = quantile(array,0.75);                          
                return [low,lowqua,med,upqua,high];
            }

            var comp = [];
            var x = [];
            for (let j = 0; j < y.length; j++) {
                comp[j] = [];
                x[j] = [];
                for (let i = 0; i < iterator.length; i++){
                    comp[j][i] = [];
                    for(let z=0;z<sub[i].length;z++){
                        comp[j][i][z] = Number(sub[i][z][y[j]]);
                    }
                    x[j][i] = calculate(comp[j][i]);  
                }
                
            }
            console.log(x); 
            for (let i = 0; i < y.length; i++){
                createnewcomparison(header + "body" + i,iterator,x[i],ynames[i],yunits[i],500)
            }

        }        
        if (type == 3){
            comparisonchart(1,[20,24,27,29,30,32],["Flow Rate","mm per Irrigation","Applied Efficiency","Energy per ML","Energy per Hour","Cost per ML"],
            ["L/S","mm","%","KWh/ML","KWh/h","$/ML"]);
        }  
        if (type == 4){
            comparisonchart(15,[20,24,27,29,30,32],["Flow Rate","mm per Irrigation","Applied Efficiency","Energy per ML","Energy per Hour","Cost per ML"],
            ["L/S","mm","%","KWh/ML","KWh/h","$/ML"]);
        }                       
    }
    function createcard(header, value, text){
        const currentDiv = document.getElementById(header);
        let parentDiv = currentDiv.parentNode

		let col6 = document.createElement('h1');
		let col8 = document.createElement('span');
        col8.className = 'h1 text-primary mt-2 mb-0';
		col8.innerText = value;
		let col9 = document.createElement('span');
		col9.className = 'h3 text-muted mt-2 mb-0';
		col9.innerText = "            " + text;
		
		
		
		col6.appendChild(col8);
		col6.appendChild(col9);
		
        parentDiv.insertBefore(col6, currentDiv);  
	};	
    function createsmallcard(header, value, text){
        const currentDiv = document.getElementById(header);
        let parentDiv = currentDiv.parentNode

		let col6 = document.createElement('h1');
		let col8 = document.createElement('span');
        col8.className = 'h1 text-primary mt-2 mb-0';
		col8.innerText = value;
		let col9 = document.createElement('span');
		col9.className = 'h3 text-muted mt-2 mb-0';
		col9.innerText = "            " + text;
		
		
		
		col6.appendChild(col8);
		col6.appendChild(col9);
		
        parentDiv.insertBefore(col6, currentDiv);  
	};
    function createtable(header, head, row, name, offset){
        const currentDiv = document.getElementById(header);
        let parentDiv = currentDiv.parentNode

        const tbl = document.createElement('table');
        tbl .className = "table table-striped";   
        tbl .id = name;
        tbl .style = "width:100%";

        const thead = document.createElement('thead');
        
        const tr = document.createElement('tr');
        for (let i=0;i<head.length-offset;i++){
            const th = document.createElement('th');
            th.appendChild(document.createTextNode(head[i]));
            tr.appendChild(th);
        }

        thead.appendChild(tr);
        tbl.appendChild(thead);

        const tbody = document.createElement('tbody');    
        for (let i=0;i<row.length;i++){
            const tr = document.createElement('tr');
            for (let j=0;j<row[i].length-offset;j++){
                const td = document.createElement('td');
                // if (j == 1){
                //     var a = document.createElement('a');
                //     a.setAttribute('href',"showeachset.php?id=" + row[i][0]);
                //     a.innerHTML = row[i][j];
                //     td.appendChild(a);
                // }else{
                //     td.appendChild(document.createTextNode(row[i][j]));
                // }             
                td.appendChild(document.createTextNode(row[i][j]));       
                tr.appendChild(td);
            }
            tbody.appendChild(tr);
        }          
        tbl.appendChild(tbody);

        parentDiv.insertBefore(tbl, currentDiv);  
    }
</script>


<body>
<div class="wrapper">   
    <div class="main">
        <?php include('nav.php')?>
        <main class="content">               
            <div class="row">       
                <div class="col-12">
                    <iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>     
                    <form method="post" action="savedashboard.php"  target="dummyframe" >
                        <a class="btn btn-outline-info my-1" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                            aria-controls="offcanvasExample">
                            Customise   
                        </a>
                        <button type="submit" class="btn btn-outline-info my-1" name="save">Save Layout</button>
                        <input id="result-table" name="dashboardtable" type="text"  style='display:none;'/>
                    </form>                                     
                </div> 
                </br>
                </br>
                </br>
                <div id="head"></div>
                
                <script>
                    var baselinearray = ["No. of Farms", "No. of Sets", "Total Area", "Total KW","Avg Area per Sets", "Avr. Motor KW",
                                        "Avg Flow Rate", "Avg ML Applied", "Avg Depth Applied", "Avg Crop Water Use between Irrigation",
                                        "Avg Application Efficiency","Avg Energy","Avg Energy per ML","Avg Energy per Hour","Avg Cost"
                                        ,"Avg Cost per ML","Avg Cost per irrigation"];
                    var units = ["","","ha","KW","ha","KW","L/S","ML","mm","mm","%","kwh","kwh/ML","kwh/h","$/kwh","$/ML","$/ha/ML"]
                    var size = [4,4,4,3,3,3,3,3, 4,4,4, 4,4,4, 4,4,4];        
                    var value = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]; 
                    var setnames = <?php echo json_encode($setnames,JSON_INVALID_UTF8_IGNORE); ?>;
                    var setvalues = <?php echo json_encode($setvalues,JSON_INVALID_UTF8_IGNORE); ?>;
                    var username = <?php echo json_encode($_SESSION['username'],JSON_INVALID_UTF8_IGNORE); ?>; 


                    var farms = [];
                    var sizes = [];
                    
                    var subset = [];
                    var ind = 0;
                    switch(username) {
                        case "BIP":
                            subset = setvalues;
                            break;
                        case "FARMACIST":
                            for (let i=0;i<setvalues.length;i++){                             
                                var nameArr = setvalues[i][2].split('_');
                                // console.log(nameArr[0]);
                                if (nameArr[0] == "FBIP"){
                                    subset[ind] = [];
                                    for (let j=0;j<setvalues[i].length;j++){
                                        subset[ind][j] = setvalues[i][j]; 
                                    }
                                    ind ++;
                                }
                            }         
                            break;
                        case "BPS":
                            for (let i=0;i<setvalues.length;i++){
                                var nameArr = setvalues[i][2].split('_');
                                // console.log(nameArr[0]);
                                if (nameArr[0] == "BPS"){
                                    subset[ind] = [];
                                    for (let j=0;j<setvalues[i].length;j++){
                                        subset[ind][j] = setvalues[i][j]; 
                                    }
                                    ind ++;
                                }
                            }         
                            break;   
                        case "ATS":
                            for (let i=0;i<setvalues.length;i++){
                                
                                var nameArr = setvalues[i][2].split('_');
                                // console.log(nameArr[0]);
                                if (nameArr[0] == "ATS"){
                                    subset[ind] = [];
                                    for (let j=0;j<setvalues[i].length;j++){
                                        subset[ind][j] = setvalues[i][j]; 
                                    }
                                    ind ++;
                                }
                            }         
                            break;                                
                        default:
                            // code block
                    }                    

                    for (let i=0;i<subset.length;i++){
                        farms[i] = subset[i][2];  
                        sizes[i] = Number(subset[i][14]);  
                    }  

                    var counts = {};
                    for (const num of farms) {
                        counts[num] = counts[num] ? counts[num] + 1 : 1;
                    }    
                    const iterator = Object.keys(counts);

                    value[0] = iterator.length;
                    value[1] = subset.length;
                    value[2] = sizes.reduce((a, b) => {
                        return a + b;
                        }).toFixed(0);

                    cards=["No. of Farms", "No. of Sets", "Total Area"];
                    addgroup("test",12, cards);
                    for (let i=0;i<3;i++){
                        createcard("test" + cards[i] +"body",value[i],units[i]); 
                    }  

                </script>
            </div>                 
            <div class="container-fluid p-0">
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h2 class="offcanvas-title" id="offcanvasLabel"><strong>Dashboard</strong> Configuration</h2>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="content">
                            <div class="row">`
                                <div class="col-12 col-md-12 col-lg-12 d-flex">
                                    <div class="card flex-fill w-100">
                                        <div class="card-header">
                                            <h4 >Irrigation Set</h4>
                                        </div>												
                                        <div class="card-body">
                                            <div id="div3"></div>
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
                                                "Energy per Hour (kWh/h)","Energy Cost ($/kWh)","Energy Cost per ML ($/ML)","Energy Cost per Irrigation ($/ha/ML)","Area vs Irrigation", "District Comparison","Water Supply Comparison"];
                                                types = [0,2,2,2,2,0,0,0,0,0,1,1,0,1,0,0,0,1,0,1,1,1,1,1,1,1,1,1,1,1,0,1,1,2,3,4];
                                                intervals = [0,2,2,2,2,0,0,0,0,0,10,100,0,1,0,0,0,10,0,10,1,2,1,20,1,10,10,100,20,10,0,10,5,0,0,0];
                                                gridsizes = [4,2,2,2,2,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,4,8,8];
                                                number = [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,6,6];
                                                newunits = ["","","","","","","","","","","","m","m","ha","","","","KW","","L/S","L/S/Cup","hrs","ML","mm","","mm","%","KWH","kWh/ML","kWh/h","$/kWh","$/ML","$/ha/ML",""];
                                                
                                                for (let i=0;i<setarray.length;i++){
                                                    if (i != 1 && i != 2 && i != 3 && i != 4 && i != 9){
                                                        addElement(setarray[i], setarray[i], "div3", types[i],setarray[i],i+1, intervals[i],number[i]); 
                                                    }                                                    
                                                }                                                                  
                                            </script>
                                        </div>
                                    </div> 
                                </div>                                                                                                                                               
                            </div>
                        </div>                            	
                    </div>
                </div>
            </div>  
        </main>
        <?php include('footer.php')?>
    </div>
</div>

	<script src="js/app.js"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
            var dashboarditems = <?php echo json_encode($dashboarditems); ?>; 
            var dashboardshown = <?php echo json_encode($dashboardshown); ?>; 

            for (let i=0;i<1;i++){
                                           
                if (dashboardshown[i] == 1){
                    addcard(dashboarditems[i],gridsizes[i],number[i]);                    
                    addchart(dashboarditems[i], types[i], dashboarditems[i],i+1, intervals[i]); 
                    
                    var checkbox = document.getElementById(dashboarditems[i]);
                    checkbox.checked = true;
                    document.getElementById('result-table').value  = document.getElementById('result-table').value + dashboarditems[i] + ";";
                }
            } 
            for (let i=34;i<35;i++){
                
                if (dashboardshown[i] == 1){
                    addcard(dashboarditems[i],gridsizes[i],number[i]);                    
                    addchart(dashboarditems[i], types[i], dashboarditems[i],i+1, intervals[i]); 
                    
                    var checkbox = document.getElementById(dashboarditems[i]);
                    checkbox.checked = true;
                    document.getElementById('result-table').value  = document.getElementById('result-table').value + dashboarditems[i] + ";";
                }
            }                          
            for (let i=33;i<34;i++){
                
                if (dashboardshown[i] == 1){
                    addcard(dashboarditems[i],gridsizes[i],number[i]);                    
                    addchart(dashboarditems[i], types[i], dashboarditems[i],i+1, intervals[i]); 
                    
                    var checkbox = document.getElementById(dashboarditems[i]);
                    checkbox.checked = true;
                    document.getElementById('result-table').value  = document.getElementById('result-table').value + dashboarditems[i] + ";";
                }
            }  
            for (let i=35;i<36;i++){
                
                if (dashboardshown[i] == 1){
                    addcard(dashboarditems[i],gridsizes[i],number[i]);                    
                    addchart(dashboarditems[i], types[i], dashboarditems[i],i+1, intervals[i]); 
                    
                    var checkbox = document.getElementById(dashboarditems[i]);
                    checkbox.checked = true;
                    document.getElementById('result-table').value  = document.getElementById('result-table').value + dashboarditems[i] + ";";
                }
            }                               
            for (let i=1;i<33;i++){
                if(i == 5 && dashboardshown[i] == 1){
                    addtext("Set");
                }
                if(i == 19 && dashboardshown[i] == 1){
                    addtext("Irrigation");
                } 
                if(i == 27 && dashboardshown[i] == 1){
                    addtext("Energy & Cost");
                }                                             
                if (dashboardshown[i] == 1){
                    addcard(dashboarditems[i],gridsizes[i],number[i]);                    
                    addchart(dashboarditems[i], types[i], dashboarditems[i],i+1, intervals[i]); 
                    
                    var checkbox = document.getElementById(dashboarditems[i]);
                    checkbox.checked = true;
                    document.getElementById('result-table').value  = document.getElementById('result-table').value + dashboarditems[i] + ";";
                }
            }        
               
		});

        $(document).on('change', '.form-check', function (e) {
            var header = this.getElementsByTagName("label")[0].innerText;
            var status = this.getElementsByTagName("input")[0].checked;
            var elementExists = document.getElementById(header + "card");
            var type = this.getElementsByTagName("type")[0].id;
            var short = this.getElementsByTagName("short")[0].id;
            var index = this.getElementsByTagName("index")[0].id;
            var interval = this.getElementsByTagName("interval")[0].id;
            var number = this.getElementsByTagName("number")[0].id;
            if (elementExists == null && status == true){

                if (types == 1){
                    addcard(header,"10",number);
                }
                else{
                    addcard(header,"6",number);
                }

                addchart(header, type, short, index,interval);

                // if (types == 1){
                //     // cards=["MAX", "MIN", "AVG","Median"];
                //     // addgroup(header + "card",2, cards);
                //     // dataarray = [];
                //     // v = [];
                //     // // console.log(i);
                //     // for (let z=0;z<setvalues.length;z++){
                //     //     // console.log(setvalues[z][i]);
                //     //     dataarray[z] = Number(setvalues[z][index]); 
                //     // }
                //     // // console.log(dataarray);
                    
                //     // v[0] = Math.max.apply(null, dataarray);
                //     // v[1] = Math.min.apply(null, dataarray);
                //     // const sum = dataarray.reduce((a, b) => a + b, 0);
                //     // v[2] = ((sum / dataarray.length) || 0).toFixed(1);    
                //     // const median = arr => {
                //     //     const mid = Math.floor(arr.length / 2),
                //     //         nums = [...arr].sort((a, b) => a - b);
                //     //     return arr.length % 2 !== 0 ? nums[mid] : (nums[mid - 1] + nums[mid]) / 2;
                //     //     };
                //     // v[3] = median(dataarray);                                       
                //     // for (let j=0;j<4;j++){
                //     //     createcard(header + "card" + cards[j] +"body",v[j],''); 
                //     // }  

                // }                
                document.getElementById('result-table').value  = document.getElementById('result-table').value + header + ";";
            }else{
                const element = document.getElementById(header+ "chart");
                // const element1 = document.getElementById(header+ "card");
                // console.log(element);
                // console.log(element1);
                element.remove();   
                // if (types == 1){
                //     element1.remove();      
                // }
                  
                document.getElementById('result-table').value  = document.getElementById('result-table').value.replace(header + ";", '');  
            }
            
        });    


	</script>
    <script>
        $(function () {
            $('nav li a').filter(function () {
                return this.href === location.href;
            }).addClass('active');
        });
    </script>
</body>

</html>