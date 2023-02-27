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
  font-size: 1rem;
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
    function addtext(text,card){
        var textrow = document.createElement("div");   
        textrow.className = "col-12 h2 mt-3 mb-3";
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

        var cardsize = size / number;

        for (let i=0;i<number;i++){
            const newDiv2 = document.createElement("div");
            newDiv2.className = "col-12 col-sm-12" + " col-md" + cardsize + " col-xl-" + cardsize; 

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
            var index = arr.indexOf(value);
            if (index > -1) {
                arr.splice(index, 1);
            }
            return arr;
        }
        areasum = removeItemOnce(areasum, "0")
                
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
            for (let i = 0; i < indy.length; i++){
                createscatter(header + "body" + i,x,y[i],xname,ynames[i],indx,indy[i],500);
            }
                          

        }        
        if (type == 2){
            createsregression(14,[22,23,24,33],"Area (ha)",["Duration (h)","Water Applied (ML)","Water Applied (mm)","Cost per ha per irrigation ($/ha/irrig)"],["Duration (h)","Water Applied (ML)","Water Applied (mm)","Cost per ha per irrigation ($/ha/irrig)"]);      
        }
        if (type == 5){
            createsregression(12,[20,21,22,23],"Row Length (m)",["Total Flow Rate (L/S)",
                        "Per Cup Flow Rate (L/S/Cup)","Duration (hrs)","Total ML Applied (ML)"],["Total Flow Rate (L/S)",
                        "Per Cup Flow Rate (L/S/Cup)","Duration (hrs)","Total ML Applied (ML)"]);      
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
            function createstackedbarscomparison(indx,indy){
                var x = [];
                ind = 0;
                for (let i = 0; i < subset.length; i++) {
                    if (Number(subset[i][indx]) != 0){
                        x[ind] = subset[i][indx];
                        ind ++;                
                    }
                } 

                for (let j = 0; j < indy.length; j++){
                    var y = [];
                    ind = 0;
                    for (let i = 0; i < subset.length; i++) {
                        if (Number(subset[i][indy[j]]) != 0){
                            y[ind] = subset[i][indy[j]];
                            ind ++;                
                        }
                    }  
                                                
                    createstackedbars(header + "body" + j,x,y,setarray[indy[j]-1],400);
                }

            }
            createstackedbarscomparison(1,[15,16,17]);
        }                        
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
    <div class="wrapper">   
        <div class="main">
            <?php include('comp/nav.php')?>
            <main class="content">     
                <div class="row">       
                    </br>
                    </br>
                    </br>
                    <div id="head"></div>
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

                    <script>
                        setarray = ["Water Supply by District","Irrigation vs District","Irrigation vs Water Supply","Irrigation vs Area","Irrigation vs Row Length"];
                        types = [6,3,4,2,5];
                        intervals = [0,0,0,0,0];
                        gridsizes = [12,12,12,24,24];
                        number = [3,6,6,4,4];

                        for (let i=0;i<setarray.length;i++){
                            addcard(setarray[i],gridsizes[i],number[i]);                    
                            addchart(setarray[i], types[i], setarray[i],i+1, intervals[i]); 
                        }    
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