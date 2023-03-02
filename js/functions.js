function findsubset(uname, values){
    var name = "";
    switch(uname) {
        case "BIP":
            return values;
        case "SRA":
            return values;
        case "FARMACIST":
            name = "FBIP";
            break;
        case "BPS":
            name = "BPS";        
            break;   
        case "ATS":
            name = "ATS";        
            break;                                
        default:
    }
    var set = [];
    var ind = 0;
    for (let i=0;i<values.length;i++){                             
        var nameArr = values[i][2].split('_');
        if (nameArr[0] == name){
            set[ind] = [];
            for (let j=0;j<values[i].length;j++){
                set[ind][j] = values[i][j]; 
            }
            ind ++;
        }
    } 
    return set;     
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
        col7.className = 'h2 mt-4 mb-0';
        col7.innerText = cards[i] + ":               ";
        let col8 = document.createElement('span');
        col8.className = 'h3 text-primary mt-4 mb-0';
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
function addchart(header, type, short, index, interval,legend,height){
    var data = [];
    ind = 0;
    for (let i = 0; i < subset.length; i++) {
        if (Number(subset[i][index]) != 0){
            data[ind] = subset[i][index];
            ind ++;                
        }
    } 

    var oldrecord = JSON.parse($.ajax({
        url: 'server/getsetdata.php',
        type: 'post',
        data: {param: setnames[index]},
        dataType: 'html',
        context: document.body,
        global: false,
        async:false,								
        success: function(response){
            return response;
        }
    }).responseText);
    // console.log(oldrecord);


    if (type == 0){
        createpie(header + "body0", oldrecord, short,height,index);
    }
    if (type == 8){    
        createbar(header + "body0", oldrecord, short,height,index);
    }
    if (type == 1){
        // createhistogram(header + "body0", oldrecord, short,height,index);
        createbasicbar(header + "body0",data, '','',header,interval,height,index);
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
                createstackedbars(header + "body" + j,x,y,setarray1[indy[j]-1],400);
                
            }

        }
        createstackedbarscomparison(1,[15,16,17]);
    }    
                       
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
function addtop(){
    var value = [0,0,0];

    for (let i=0;i<farmcount.length;i++){
        value[0] += Number(farmcount[i][1]);  
        value[1] += Number(farmcount[i][2]); 
        value[2] +=  Number(farmcount[i][3]); 
    }  
    value[2] = value[2].toFixed(0);

    cards=["No. of Farms", "No. of Sets", "Total Area"];
    addgroup("test",12, cards, value, units);

    var dataset = [];
    for (let i=0;i<3;i++){
        dataset[i] = [];
        for (let j=0;j<2;j++){
            dataset[i][j] = {name: farmcount[j][0],
                data: [Number(farmcount[j][i+1])]};
        }
    }
    stackedcolumn("testNo. of Farms",dataset[0]);
    stackedcolumn("testNo. of Sets",dataset[1]);
    stackedcolumn("testTotal Area",dataset[2]);
}