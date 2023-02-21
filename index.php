<?php include('comp/userauth.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php include('server/getfarms.php') ?>
<?php include('server/savedashboard.php') ?>
<head>
<?php include('comp/header.php')?>
<style>





.tooltipHeader {
  float: center;
  font-size: 1rem;
}



.tooltipPointWrapper {
  display: block;
  text-align: center;
  padding: 10px 0;
}

.tooltipPoint {
  font-size: 2rem;
  padding-left: 5px;
 
}

.tooltipValueSuffix {
  padding-left: 5px;
  color: #1bc9a8;
}

.tooltipLine {
  display: block;
  opacity: 0.5;
  background-color: #fff;
  width: 100%;
  height: 1px;
  padding: 0;
  margin: 0;
}
.card {
      box-shadow: 8px 8px 15px 0 rgba(100, 100, 100, 0.26);
}


.nav-tabs .nav-item .nav-link {
  background-color: #C4C4C4;
  color: #FFF;
}

.nav-tabs .nav-item .nav-link.active {
  color: #000;
}
/* #btn-back-to-set {
    position: fixed;
    top: 40%;
    left: 5px;
    width : 20px;
}
.content { 
  width: 95%;
  margin: 0px 2.5%;
}
#btn-back-to-irrig {
    position: fixed;
    top: 50%;
    left: 5px;
    width : 20px;

}
#btn-back-to-cost {
    position: fixed;
    top: 60%;
    left: 5px;
    width : 20px;

} */
/* .btn {
    position: fixed;
    top: 57%;
    left: 5px;
  /* background-color: #04AA6D;
  border: none;
  color: white;
  padding: 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px; */
/* .btn {border-radius: 50%;} */
</style>

</head>

<!-- <button
        type="button"
        class="btn btn-primary btn-floating btn-lg"
        id="btn-back-to-set"
        >
        <div class="bi-border-all" style="font-size: 15px;"></div> 
        <div class="text-center">Set</div>
</button>
<button
        type="button"
        class="btn btn-primary btn-floating btn-lg"
        id="btn-back-to-irrig"
        >
        <div class="bi-droplet-fill" style="font-size: 15px;"></div> 
        <div class="text-center">Irrig</div>
</button>
<button
        type="button"
        class="btn btn-primary btn-floating btn-lg"
        id="btn-back-to-cost"
        >
        <div class="bi-currency-dollar" style="font-size: 15px;"></div> 
        <div class="text-center">Cost</div>
</button> -->
<script>  
            // let mybutton1 = document.getElementById("btn-back-to-set");
            // let mybutton2 = document.getElementById("btn-back-to-irrig");
            // let mybutton3 = document.getElementById("btn-back-to-cost");
            // mybutton1.style.display = "block";
            // mybutton1.addEventListener("click", backToTop1);
            // mybutton2.style.display = "block";
            // mybutton2.addEventListener("click", backToTop2);
            // mybutton3.style.display = "block";
            // mybutton3.addEventListener("click", backToTop3);

            // function backToTop1() {
            //     document.getElementById("Soil Typecard").scrollIntoView();
            //     // const element = document.getElementById("Soil Typebody0");
            //     // element.scrollTop += 10;
            // }
            // function backToTop2() {
            //     document.getElementById("Water Supplycard").scrollIntoView();
            // }
            // function backToTop3() {
            //     document.getElementById("Energy (kWh)card").scrollIntoView();
            // }   


    function addElement (id, text, dv, tt, ss, index, interval,number,tab) {
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
        const tabs = document.createElement("tab");
        tabs.id = tab;

        newDiv1.appendChild(newDiv2);
        newDiv1.appendChild(t);
        newDiv1.appendChild(s);
        newDiv1.appendChild(idd);
        newDiv1.appendChild(int);
        newDiv1.appendChild(num);
        newDiv1.appendChild(tabs);

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
    function addcard(header,size, number,tab){
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
            card.className = "card ";

            if (number <= 1){
                const cardjeader = document.createElement("div");
                cardjeader.className = "card-header h3 text-dark";
                cardjeader.innerText = header + " (by Set)";
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

        const currentDiv = document.getElementById("head-"+tab);
        let parentDiv = currentDiv.parentNode

        parentDiv.insertBefore(newDiv1, currentDiv);        
    }      
    function addchart(header, type, short, index, interval,legend,height){
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
                findsubset("FBIP");
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
            areasum[indexkey] = areasum[indexkey].toFixed(0);
            indexkey ++;
        }     
        function removeItemOnce(arr, value) {
            var id = arr.indexOf(value);
            if (id > -1) {
                arr.splice(index, 1);
            }
            return arr;
        }
        areasum = removeItemOnce(areasum, "0")

        if (type == 0){
            createpiechart(header + "body0", data, tempdata,'',short,height, index,legend);
            

        }
        if (type == 8){
            
            createbarcharts(header + "body0", data, tempdata,'',short,height, index);

        }
        if (type == 1){
            createbasicbar(header + "body0",data, tempdata,'',header,interval,height, index);
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
                                         
            createstackedbars(header + "body0",x,y,height);
            var y = [];
            ind = 0;
            for (let i = 0; i < subset.length; i++) {
                if (Number(subset[i][16]) != 0){
                    y[ind] = subset[i][16];
                    ind ++;                
                }
            }        
            createstackedbars(header + "body1",x,y,height);
        }   
        if (type == 9){
            var newdata = [];
            var index = 0;
            for (let i=0;i<data.length;i++){
                if (data[i] != "0000-00-00"){
                    newdata[index] = data[i];
                    index ++;
                }
            }
            createtime(header + "body0",newdata,short,height,index);
            
        }
        if (type == 10){
            
            
            
            
            
            
            

            createnewline(header + "body0",data,short,height,index);
            
        }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        if (type == 7){
            var counts = {};
            for (const num of data) {
                counts[num] = counts[num] ? counts[num] + 1 : 1;
            }    
            const iterator = Object.keys(counts);  

            keysSorted = Object.keys(counts).sort(function(a,b){return counts[b] - counts[a]})
            
            
            var dataset = [];
            var cat = [];
            var index = 0;

            for (const key of keysSorted) {
                cat[index] = key;
                dataset[index] = counts[key];  
                index ++;
            }  
            
            var head = ["1",short,"CNT","%"];
            var row = [];
            var sum = dataset.reduce((a, b) => {
                    return a + b;
                    }).toFixed(0);
            for (let i = 0; i < dataset.length; i++){
                row[i] = [];
                row[i][0] = "";
                row[i][1] = cat[i];
                row[i][2] = dataset[i];
                row[i][3] = (dataset[i]*100/sum).toFixed(0);
            }

            createtable(header + "body0", head, row, "", 0);
        }                     
    }
    function addgroup(header,size,cards,value,text){
        const newDiv1 = document.createElement("div");
        newDiv1.className = "col-12 col-md-12" + " col-xl-" + size;
        newDiv1.id = header;

        const newDiv0 = document.createElement("div");
        newDiv0.className = "row";

        for (let i=0;i<cards.length;i++){
            const newDiv2 = document.createElement("div");
            newDiv2.className = "col-12 col-md-12" + " col-xl-4";

            const card1 = document.createElement("div");
            card1.className = "card";        

 
            
            
            
            

            const cardbody = document.createElement("div");
            cardbody.className = "card-body";

            const row = document.createElement("div");
            row.className = "row";  

            const col = document.createElement("div");
            col.className = "col-5 mt-4"; 

            let col7 = document.createElement('span');
            col7.className = 'h4 mt-4 mb-0';
            col7.innerText = cards[i] + ":               ";
            let col8 = document.createElement('span');
            col8.className = 'h4 text-primary mt-4 mb-0';
            col8.innerText = value[i];
            let col9 = document.createElement('span');
            col9.className = 'h4 text-muted mt-4 mb-0';
            col9.innerText = "            " + text[i];


            const col1 = document.createElement("div");
            col1.className = "col-7";  

            let col10 = document.createElement('div');
            col10.id = header + cards[i];

            col.appendChild(col7)
            col.appendChild(col8);
            col.appendChild(col9);
            row.appendChild(col);


            col1.appendChild(col10);
            row.appendChild(col1);
            cardbody.appendChild(row);

            card1.appendChild(cardbody);
            newDiv2.appendChild(card1);
            newDiv0.appendChild(newDiv2);
        }
        newDiv1.appendChild(newDiv0);

        const currentDiv = document.getElementById("head");
        let parentDiv = currentDiv.parentNode

        parentDiv.insertBefore(newDiv1, currentDiv);        
    }  
    function createtable(header, head, row, name, offset){
        const currentDiv = document.getElementById(header);
        let parentDiv = currentDiv.parentNode

        const tbl = document.createElement('table');
        tbl .className = "table table-striped text-xsmall table-editable";   
        tbl .id = name;
        tbl .style = "width:100%";

        const thead = document.createElement('thead');
        
        const tr = document.createElement('tr');
        for (let i=1;i<head.length-offset;i++){
            const th = document.createElement('th');
            th.appendChild(document.createTextNode(head[i]));
            tr.appendChild(th);
        }

        thead.appendChild(tr);
        tbl.appendChild(thead);

        const tbody = document.createElement('tbody');    
        for (let i=0;i<row.length;i++){
            const tr = document.createElement('tr');
            for (let j=1;j<row[i].length-offset;j++){
                const td = document.createElement('td');
                td.className = "changeable";
                td.setAttribute('contenteditable',"true");
      
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
    <div class="wrapper "> 
        <div class="main ">
            <?php include('comp/nav.php')?>
            <main class="content" >      
                <div class="col-auto d-none d-sm-block ">
                    <h3><strong>Baseline</strong> Dashboard</h3>
                </div>    
                <div class="row">       
                    <div class="col-12" style='display:none;'>
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
                            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                            <h4 class="modal-title">Set Table</h4>
                            </div>
                            <div class="modal-body">
                            <!-- <p>Some text in the modal.</p> -->
                            <div id="datatable"></div>
                            </div>
                            <!-- <div class="modal-footer"> -->
                            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                            <!-- </div> -->
                        </div>
                        
                        </div>
                    </div>
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
                                findsubset("FBIP");
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
                        var iterator = Object.keys(counts);

                        value[0] = iterator.length;
                        value[1] = subset.length;
                        value[2] = sizes.reduce((a, b) => {
                            return a + b;
                            }).toFixed(0);
                        cards=["No. of Farms", "No. of Sets", "Total Area"];
                        addgroup("test",12, cards, value, units);

                        var data = [];
                        ind = 0;
                        for (let i = 0; i < subset.length; i++) {
                            if (Number(subset[i][1]) != 0){
                                data[ind] = subset[i][1];
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
                        iterator = Object.keys(counts);

                        var areasum = [];
                        var indexkey = 0;
                        for (const key of iterator) {
                            areasum[indexkey] = 0;
                            for (let i = 1; i < areas.length; i++) {
                                if (names[i] == key){
                                    areasum[indexkey] += Number(areas[i]);   
                                }
                            } 
                            areasum[indexkey] = areasum[indexkey].toFixed(0);
                            indexkey ++;
                        }     
                        function removeItemOnce(arr, value) {
                            var index = arr.indexOf(value);
                            if (index > -1) {
                                arr.splice(index, 1);
                            }
                            return arr;
                        }
                        areasum = removeItemOnce(areasum, "0")
                        var counts = {};
                        for (const num of data) {
                        counts[num] = counts[num] ? counts[num] + 1 : 1;
                        }    
                        iterator = Object.keys(counts);  

                        var dataset = [];
                        var index = 0;
                        for (const key of iterator) {
                            dataset[index] = {name: key,
                                data: [counts[key]]};
                            index ++;
                        }    

                        var counts1 = {};
                        for (const num of data1) {
                        counts1[num] = counts1[num] ? counts1[num] + 1 : 1;
                        }    
                        iterator1 = Object.keys(counts1);  

                        var dataset1 = [];
                        var index1 = 0;
                        for (const key of iterator1) {
                            dataset1[index1] = {name: key,
                                data: [counts1[key]]};
                            index1 ++;
                        }    

                        var  dataset2 = [];
                        var index2 = 0;
                        for (const key of iterator) {
                            dataset2[index2] = {name: key,
                                data: [Number(areasum[index2])]};
                            index2 ++;
                        }    
                        stackedcolumn("testNo. of Farms",dataset1);
                        stackedcolumn("testNo. of Sets",dataset);
                        stackedcolumn("testTotal Area",dataset2);
                                
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
                                                    types = [5,2,2,2,2,0,8,8,0,9,1,1,8,1,0,0,8,1,0,1,1,10,1,1,10,1,1,1,1,1,0,1,1,2,3,4,6];
                                                    intervals = [5,2,2,2,2,0,7,8,0,9,1,1,8,0.1,0,8,8,1,0,1,0.1,1,0.1,1,1,1,1,1,1,1,0,1,1,2,3,4,6];
                                                    tabs = [0,5,5,5,5,1,1,1,1,1,1,1,1,1,2,2,2,2,2,2,2,2,2,2,2,2,2,3,3,3,3,3,3,5,5,5,5];
                                                    gridsizes = [9,2,2,2,2,6,6,12,7,5,6,6,6,6,4,4,4,4,3,5,6,6,6,6,6,6,6,6,6,6,6,6,6,12,12,12,12];
                                                    legends = [5,2,2,2,2,1,7,8,1,9,1,1,8,1,0,0,8,1,0,1,1,1,1,1,1,1,1,1,1,1,0,1,1,2,3,4,6];
                                                    number = [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,6,6,2];
                                                    // height = [0,0,0,0,0,460,460,700,460,460,460,460,460,460,460,460,460,460,460,460,460,460,460,460,460,460,460,460,460,460,460,460,460,460,460,460,460];
                                                    newunits = ["","","","","","","","","","","","m","m","ha","","","","KW","","L/S","L/S/Cup","hrs","ML","mm","","mm","%","KWH","kWh/ML","kWh/h","$/kWh","$/ML","$/ha/ML",""];
                                                    
                                                    for (let i=0;i<33;i++){
                                                        if (i != 1 && i != 2 && i != 3 && i != 4){
                                                            addElement(setarray[i], setarray[i], "div3", types[i],setarray[i],i+1, intervals[i], number[i], tabs[i]); 
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
                                                        addElement(setarray[i], setarray[i], "div4", types[i],setarray[i],i+1, intervals[i],number[i],tabs[i]); 
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
    <script src="js/datatables.js"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
            var dashboarditems = <?php echo json_encode($dashboarditems); ?>; 
            var dashboardshown = <?php echo json_encode($dashboardshown); ?>; 


            rows = [1,1,1,1,1, 2,2,2, 2,2,2, 2,2,2, 2,2,2, 1.5,1,2.5, 2,2,2, 2, 2,2,2, 2,2,2, 2,2,2, 2,2,2,2];
            cols = [4,4,4,4,4, 6,6,12, 4,4,4, 4,4,4, 4,4,4, 4,4,8, 4,4,4, 4, 4,4,4, 4,4,4, 3,4,5, 4,4,4,4];

            var height = [];
            for (let i=0;i<rows.length;i++){
                height[i] = rows[i] * 150 + (rows[i] - 1) * 122;               
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
                    
                    // console.log(tabs[i - index]);
                    const currentDiv = document.getElementById("head-" + tabs[i - index]);
                    // const currentDiv = document.getElementById("head");

                    let parentDiv = currentDiv.parentNode
                    parentDiv.insertBefore(col, currentDiv); 
                }          
                
            } 

            addgroup(dashboarditems,rows,cols,tabs);

            // function adddashboarditem(i){
            //     if (dashboardshown[i] == 1){
            //         addcard(dashboarditems[i],gridsizes[i],number[i],tabs[i]);                    
            //         addchart(dashboarditems[i], types[i], dashboarditems[i],i+1, intervals[i],legends[i],height[i]); 
                    
            //         var checkbox = document.getElementById(dashboarditems[i]);
            //         checkbox.checked = true;
            //         document.getElementById('result-table').value  = document.getElementById('result-table').value + dashboarditems[i] + ";";
            //     }
            // }
            
            
            
            
            
            
                
            for (let i=5;i<33;i++){
                
                addchart(dashboarditems[i], types[i], dashboarditems[i],i+1, intervals[i],legends[i],height[i]);
                
                
                
                
                
                
                
                // if (i != 30){
                //     adddashboarditem(i);

                // }                                      
            } 
    
            function activaTab(tab){
                $('.nav-tabs a[href="#' + tab + '"]').tab('show');
            };

            activaTab('vertical-icon-tab-3');
            
            
		});

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
          
        
        
        
        
        
        
            
        


	</script>
    <script>
        $(function () {
            $('nav li a').filter(function () {
                return this.href === location.href;
            }).addClass('active');
        });

        var contents = $('.changeable').html();
        $('.changeable').blur(function() {
            if (contents!=$(this).html()){
                
                console.log(this);
            }
        });
    </script>

</body>

</html>