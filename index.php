<?php include('comp/userauth.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php include('server/getfarms.php') ?>
<?php include('server/savedashboard.php') ?>
<head>
<?php include('comp/header.php')?>
<style>
.form-check-lg {
  font-size: 150%;
}

.offcanvas {
  width: 60%;
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
        newDiv1.className = "col-12 col-sm-12 col-md" + size + " col-xl-" + size;  
        
        if (number > 1){
            addtext(header);
        }

        const newDiv0 = document.createElement("div");
        newDiv0.className = "row"; 

        var size = 12 / number;

        for (let i=0;i<number;i++){
            const newDiv2 = document.createElement("div");
            newDiv2.className = "col-12 col-sm-" + size * 2 + " col-md" + size + " col-xl-" + size; 

            const card = document.createElement("div");
            card.className = "card";

            if (number <= 1){
                const cardjeader = document.createElement("div");
                cardjeader.className = "card-header h3";
                cardjeader.innerText = header;
                card.appendChild(cardjeader);
            }


            const cardbody = document.createElement("div");
            cardbody.className = "card-body";
            cardbody.id = header + "body" + i;            

          
            card.appendChild(cardbody);
            newDiv2.appendChild(card);
            newDiv0.appendChild(newDiv2);
        }
       
        newDiv1.appendChild(newDiv0);

        const currentDiv = document.getElementById("head");
        let parentDiv = currentDiv.parentNode

        parentDiv.insertBefore(newDiv1, currentDiv);        
    }      
    function addchart(header, type, short, index, interval){
        var setvalues = <?php echo json_encode($setvalues,JSON_INVALID_UTF8_IGNORE); ?>;
        var username = <?php echo json_encode($_SESSION['username'],JSON_INVALID_UTF8_IGNORE); ?>; 

        var subset = [];
        var ind = 0;
        function findsubset(name){
            for (let i=0;i<setvalues.length;i++){                             
                var nameArr = setvalues[i][2].split('_');
                if (nameArr[0] == name){
                    subset[ind] = [];
                    for (let j=0;j<setvalues[i].length;j++){
                        subset[ind][j] = setvalues[i][j]; 
                    }
                    ind ++;
                }
            }      
        }
        switch(username) {
            case "BIP":
                subset = setvalues;
                break;
            case "SRA":
                subset = setvalues;
                break;             
            case "FARMACIST":
                findsubset("FARMACIST");
                break;
            case "BPS":
                findsubset("BPS");        
                break;   
            case "ATS":
                findsubset("ATS");          
                break;                                
            default:
                
        }
        for (let i=0;i<subset.length;i++){
            subset[i][27] = Number(subset[i][27]) * 100; 
        }

        var tempdata = [];
        var unit = "";
        var t = 0;
   

        var data = [];
        ind = 0;
        for (let i = 0; i < subset.length; i++) {
            if (Number(subset[i][index]) != 0){
                data[ind] = subset[i][index];
                ind ++;                
            }
        } 

        var data1 = [];
        var ind1 = 0;
        
        
        for (let i = 1; i < subset.length; i++) {
            var count = 0;
            for (let j = 1; j < i; j++) {
                if (subset[i][2] != subset[j][2]){
                    count ++;
                }
            }
            if (count == i-1){
                data1[ind1] = subset[i][1];
                ind1 ++;    
            }
        }        
        
        var names = [];
        var areas = [];
        for (let i = 1; i < subset.length; i++) {
            names[i] = subset[i][1];
            areas[i] = subset[i][14];
        }       

        var counts = {};
        for (const num of names) {
        counts[num] = counts[num] ? counts[num] + 1 : 1;
        }    
        const iterator = Object.keys(counts);
        
        var areasum = [];
        var indexkey = 0;
        for (const key of iterator) {
            areasum[indexkey] = 0;
            for (let i = 1; i < areas.length; i++) {
                if (names[i] == key){
                    areasum[indexkey] += Number(areas[i]);   
                }
            } 
            indexkey ++;
        }         
        console.log(areasum);

        if (type == 0){
            createpiechart(header + "body0", data, tempdata,'',short,500);
            // createtreemap(header + "body0", data, tempdata,'',short,500);
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
            createline(header + "body0",x,y,xname, ynames,yunits, 600);                

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
        if (type == 5){
            createnestedpiechart(header + "body0", data,  data1,  tempdata,"Sets","Farms",short,500);
            // createpiechart(header + "body0", data, tempdata,"Sets",short,500);
            // createpiechart(header + "body1", data1, tempdata,"Farms",short,500);
        }  
        if (type == 6){
            var x = [];
            ind = 0;
            for (let i = 0; i < subset.length; i++) {
                if (Number(subset[i][1]) != 0){
                    x[ind] = subset[i][1];
                    ind ++;                
                }
            } 
            var y = [];
            ind = 0;
            for (let i = 0; i < subset.length; i++) {
                if (Number(subset[i][15]) != 0){
                    y[ind] = subset[i][15];
                    ind ++;                
                }
            }  
                                         
            createstackedbars(header + "body0",x,y,500);
            var y = [];
            ind = 0;
            for (let i = 0; i < subset.length; i++) {
                if (Number(subset[i][16]) != 0){
                    y[ind] = subset[i][16];
                    ind ++;                
                }
            }        
            createstackedbars(header + "body1",x,y,500);
        }                        
    }
    function addgroup(header,size,cards){
        const newDiv1 = document.createElement("div");
        newDiv1.className = "col-12 col-md-12" + " col-xl-" + size + " d-flex align-items-stretch";
        newDiv1.id = header;

        const newDiv0 = document.createElement("div");
        newDiv0.className = "row";

        for (let i=0;i<cards.length;i++){
            const card1 = document.createElement("div");
            card1.className = "card";        
            const cardheader1 = document.createElement("div");
            cardheader1.className = "card-header h1";
            cardheader1.innerText = cards[i];
            card1.appendChild(cardheader1);

            const cardbody = document.createElement("div");
            cardbody.className = "card-body";

            const container = document.createElement("div");
            container.id = header + cards[i] + "body";

            cardbody.appendChild(container);
            card1.appendChild(cardbody);
            newDiv0.appendChild(card1);
        }
        newDiv1.appendChild(newDiv0);

        const currentDiv = document.getElementById("head");
        let parentDiv = currentDiv.parentNode

        parentDiv.insertBefore(newDiv1, currentDiv);        
    }  
    function addstatcard(header, value, text){
        const newDiv1 = document.createElement("div");
        newDiv1.className = "col-xl-12 col-md-12 col-sm-12";
        newDiv1.id = header;

        const card1 = document.createElement("div");
        card1.className = "card";        
        const cardheader1 = document.createElement("div");
        cardheader1.className = "card-header h3";
        cardheader1.innerText = header;
        card1.appendChild(cardheader1);

        const cardbody = document.createElement("div");
        cardbody.className = "card-body";

        let col6 = document.createElement('h1');
        let col8 = document.createElement('span');
        col8.className = 'h1 text-primary mt-2 mb-0';
        col8.innerText = value;
        let col9 = document.createElement('span');
        col9.className = 'h3 text-muted mt-2 mb-0';
        col9.innerText = "            " + text;

        cardbody.appendChild(col8);
        cardbody.appendChild(col9);

        card1.appendChild(cardbody);
        
        newDiv1.appendChild(card1);

        const currentDiv = document.getElementById("head");
        let parentDiv = currentDiv.parentNode

        parentDiv.insertBefore(newDiv1, currentDiv); 
	};	
    function createcard(header, value, text){
        const currentDiv = document.getElementById(header);
        let parentDiv = currentDiv.parentNode

		let col6 = document.createElement('h1');
		let col8 = document.createElement('span');
        col8.className = 'h1 text-primary mt-2 mb-0';
		col8.innerText = value;
		let col9 = document.createElement('span');
		col9.className = 'h1 text-muted mt-2 mb-0';
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
            <?php include('comp/nav.php')?>
            <main class="content">          
                <div class="card">
                    <div class="card-body">
                        <div class = "card-text h2">Baseline Dashboard</div>
                        </br>
                        <div class = "card-text h4">This page is simply showing the aggregated baseline information collected by the delivery teams on all BIP farms </div>
                        </br>
                    </div>  
                </div>             
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
                        function findsubset(name){
                            for (let i=0;i<setvalues.length;i++){                             
                                var nameArr = setvalues[i][2].split('_');
                                if (nameArr[0] == name){
                                    subset[ind] = [];
                                    for (let j=0;j<setvalues[i].length;j++){
                                        subset[ind][j] = setvalues[i][j]; 
                                    }
                                    ind ++;
                                }
                            }      
                        }
                        switch(username) {
                            case "BIP":
                                subset = setvalues;
                                break;
                            case "SRA":
                                subset = setvalues;
                                break;                            
                            case "FARMACIST":
                                findsubset("FARMACIST");
                                break;
                            case "BPS":
                                findsubset("BPS");        
                                break;   
                            case "ATS":
                                findsubset("ATS");          
                                break;                                
                            default:
                                
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

                        // cards=["No. of Farms", "No. of Sets", "Total Area"];
                        
                        // for (let i=0;i<3;i++){                            
                        //     addstatcard(cards[i], value[i],units[i])
                        // }  
                        cards=["No. of Farms", "No. of Sets", "Total Area"];
                        addgroup("test",3, cards);
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
                                <div class="row">
                                    <div class="col-6">
                                        <div class="card flex-fill w-100">
                                            <div class="card-header">
                                                <h2 >Baseline</h2>
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
                                                    "Energy per Hour (kWh/h)","Energy Cost ($/kWh)","Energy Cost per ML ($/ML)","Energy Cost per Irrigation ($/ha/ML)","Area vs Irrigation", "Irrigation vs District","Irrigation vs Water Supply","District vs Water Supply"];
                                                    types = [5,2,2,2,2,0,0,0,0,0,1,1,0,1,0,0,0,1,0,1,1,1,1,1,1,1,1,1,1,1,0,1,1,2,3,4,6];
                                                    intervals = [0,2,2,2,2,0,0,0,0,0,10,100,0,1,0,0,0,10,0,10,1,2,1,20,1,10,10,100,20,10,0,10,5,0,0,0,0];
                                                    gridsizes = [9,2,2,2,2,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,12,12,12,12,12,12];
                                                    number = [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,6,6,2];
                                                    newunits = ["","","","","","","","","","","","m","m","ha","","","","KW","","L/S","L/S/Cup","hrs","ML","mm","","mm","%","KWH","kWh/ML","kWh/h","$/kWh","$/ML","$/ha/ML",""];
                                                    
                                                    for (let i=0;i<33;i++){
                                                        if (i != 1 && i != 2 && i != 3 && i != 4 && i != 9){
                                                            addElement(setarray[i], setarray[i], "div3", types[i],setarray[i],i+1, intervals[i],number[i]); 
                                                        }                                                    
                                                    }     
                                                </script>
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="col-6">
                                        <div class="card flex-fill w-100">
                                            <div class="card-header">
                                                <h2 >Analytics</h2>
                                            </div>												
                                            <div class="card-body">
                                                <div id="div4"></div>
                                                <script>                                               
                                                    for (let i=33;i<setarray.length;i++){
                                                        addElement(setarray[i], setarray[i], "div4", types[i],setarray[i],i+1, intervals[i],number[i]); 
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
            <?php include('comp/footer.php')?>
        </div>
    </div>

	<script src="js/app.js"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
            var dashboarditems = <?php echo json_encode($dashboarditems); ?>; 
            var dashboardshown = <?php echo json_encode($dashboardshown); ?>; 

            function adddashboarditem(i){
                if (dashboardshown[i] == 1){
                    addcard(dashboarditems[i],gridsizes[i],number[i]);                    
                    addchart(dashboarditems[i], types[i], dashboarditems[i],i+1, intervals[i]); 
                    
                    var checkbox = document.getElementById(dashboarditems[i]);
                    checkbox.checked = true;
                    document.getElementById('result-table').value  = document.getElementById('result-table').value + dashboarditems[i] + ";";
                }
            }
            adddashboarditem(0);
            // adddashboarditem(36);
            // adddashboarditem(33);
            // adddashboarditem(34);
            // adddashboarditem(35);
            
                
            for (let i=1;i<33;i++){
                if(i == 5 && dashboardshown[i] == 1){
                    addtext("Baseline");
                }
                if(i == 19 && dashboardshown[i] == 1){
                    addtext("Irrigation");
                } 
                if(i == 27 && dashboardshown[i] == 1){
                    addtext("Energy & Cost");
                }                                             
                adddashboarditem(i);
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
          
                document.getElementById('result-table').value  = document.getElementById('result-table').value + header + ";";
            }else{
                const element = document.getElementById(header+ "chart");
                element.remove();                     
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