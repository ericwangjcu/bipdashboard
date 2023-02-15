<?php include('comp/userauth.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php include('server/getfarms.php') ?>
<head>
    
<?php include('comp/header.php')?>
</head>

<script>   
    function addbenchmarkcard(infor, farminfo, score, pos, total){
        const col = document.createElement("div");
        col.className = "col-xl-2 col-md-4 col-sm-12  d-flex align-items-stretch";            
        
        const card = document.createElement("div");
        card.className = "card  w-100";
        const cardbody = document.createElement("div");
        cardbody.className = "card-body";

        const row = document.createElement("div");
        row.className = "row";
        const titlecol = document.createElement("div");
        titlecol.className = "col";

        const title = document.createElement("div");
        title.className = "card-title";
        title.innerText = infor;  
        cardbody.appendChild(title);

        const text = document.createElement("h3");
        text.className = "mt-2";
        text.innerText = farminfo;
        titlecol.appendChild(text);
        row.appendChild(titlecol);
        
        const colauto = document.createElement("div");
        colauto.className = "col-auto";
        const mb = document.createElement("div");
        mb.className = "h2";
        const badge = document.createElement("span");


        // if (score < 100){
        // badge.className = "badge badge bg-secondary";
        // }
        // if (score < 66){
        //     badge.className = "badge badge bg-secondary";
        // } 
        // if (score < 33){
        //     badge.className = "badge badge bg-secondary";
        // }           
        badge.className = "badge badge bg-secondary";
        badge.innerText = pos + "/" + total + "  (" + score + "%)";
        mb.appendChild(badge);
        colauto.appendChild(mb);
        row.appendChild(colauto);
        

        cardbody.appendChild(row);

        card.appendChild(cardbody);
        col.appendChild(card);

        return col;
    }
    function createparentcard(farminfo,infor,score,pos,total){
        const currentDiv = document.getElementById("item");
        let parentDiv = currentDiv.parentNode
        

        const newDiv2 = document.createElement("div");
        newDiv2.className = "card bg-light";
        newDiv2.setAttribute('data-toggle',"collapse");
        newDiv2.setAttribute('data-target',"#" + farminfo[0]);
        newDiv2.setAttribute('aria-expanded',"false");
        newDiv2.setAttribute('aria-controls',farminfo[0]);
     
        const newDiv3 = document.createElement("div");
        newDiv3.className = "card-body"; 
        const cardjeader = document.createElement("h1");
        // cardjeader.className = "card-title h1";
        cardjeader.innerText = farminfo[0];
        newDiv3.appendChild(cardjeader);

        const newDiv4 = document.createElement("container");
        const newDiv5 = document.createElement("div");
        newDiv5.className = "row";

        for (let i=1;i<farminfo.length;i++){   
            if (i==1 || i==3 || i== 8 || i == 9 || i== 13 || i== 14){         
                newDiv5.appendChild(addbenchmarkcard(infor[i],farminfo[i],score[i],pos[i],total[i])); 
            }
        }     
        newDiv4.appendChild(newDiv5);

        const text = document.createElement("h4");
        text.innerText = "Click to Expand";
            
         

        newDiv3.appendChild(newDiv4);
        newDiv3.appendChild(text);   
        newDiv2.appendChild(newDiv3);
        parentDiv.insertBefore(newDiv2, currentDiv); 

    }   
    function createchildcard(set,infor,id){
        const currentDiv = document.getElementById("item");
        let parentDiv = currentDiv.parentNode

        const newDiv2 = document.createElement("div");
        newDiv2.className = "card collapse"; 
        newDiv2.id = id; 

        const newDiv3 = document.createElement("div");
        newDiv3.className = "card-body"; 
 
        var newdiv4 = document.createElement("p");
        newdiv4.className = "mb-0 h2"; 
        newdiv4.innerText = "Irrigation Evaluation";
        newDiv3.appendChild(newdiv4);
        
        var br = document.createElement('br');
        newDiv3.appendChild(br);


        const newDiv5 = document.createElement("div");
        newDiv5.className = "row";

        var newDiv6 = document.createElement("div");
        newDiv6.className = "col-xl-6 col-sm-12";
        var newDiv7 = document.createElement("div");
        newDiv7.className = "row";
        var newDiv8 = document.createElement("div");
        newDiv8.className = "col-xl-6 col-sm-12";
        var newDiv9 = document.createElement("div");
        newDiv9.className = "chart-container";
        newDiv9.id = id + "container0";
        newDiv8.appendChild(newDiv9);
        newDiv7.appendChild(newDiv8);

        newDiv8 = document.createElement("div");
        newDiv8.className = "col-xl-6 col-sm-12";        
        newDiv9 = document.createElement("div");
        newDiv9.className = "chart-container";
        newDiv9.id = id + "container1";
        newDiv8.appendChild(newDiv9);
        newDiv7.appendChild(newDiv8);             
        newDiv6.appendChild(newDiv7);
        newDiv5.appendChild(newDiv6);
        
        newDiv6 = document.createElement("div");
        newDiv6.className = "col-xl-6 col-sm-12";
        newDiv7 = document.createElement("div");
        newDiv7.className = "row";

        newDiv8 = document.createElement("div");
        newDiv8.className = "col-xl-3 col-sm-12";
        newDiv9 = document.createElement("div");
        newDiv9.className = "chart-container";
        newDiv9.id = id + "container2";
        newDiv8.appendChild(newDiv9);
        newDiv7.appendChild(newDiv8);
        
        newDiv8 = document.createElement("div");
        newDiv8.className = "col-xl-3 col-sm-12";        
        newDiv9 = document.createElement("div");
        newDiv9.className = "chart-container";
        newDiv9.id = id + "container3";
        newDiv8.appendChild(newDiv9);
        newDiv7.appendChild(newDiv8);      

        newDiv8 = document.createElement("div");
        newDiv8.className = "col-xl-3 col-sm-12";        
        newDiv9 = document.createElement("div");
        newDiv9.className = "chart-container";
        newDiv9.id = id + "container4";
        newDiv8.appendChild(newDiv9);
        newDiv7.appendChild(newDiv8);  

        newDiv8 = document.createElement("div");
        newDiv8.className = "col-xl-3 col-sm-12";        
        newDiv9 = document.createElement("div");
        newDiv9.className = "chart-container";
        newDiv9.id = id + "container5";
        newDiv8.appendChild(newDiv9);
        newDiv7.appendChild(newDiv8);  


        newDiv6.appendChild(newDiv7);
        newDiv5.appendChild(newDiv6);
        newDiv3.appendChild(newDiv5);

        newDiv2.appendChild(newDiv3);
        parentDiv.insertBefore(newDiv2, currentDiv); 
    }
    function creategauge(c,type, score, title){
        var ticks = [];
        for (let i=0;i<100;i++){
            ticks[i] = i * 1;
        }

        if (type == 1){
            var ya =  {
                labels: {
                    enabled: false,
                },
                reversed: false,
                min: 0,
                max: 100,
                lineWidth: 0,
                tickLength: 60,
                tickWidth: 3,
                tickColor: 'white',
                tickPosition: 'inside',
                minorTickLength: 0,
                tickPositions: ticks,
                zIndex: 10,
                stops: [
                    [0.3, '#B4B4B4'], // red
                    [0.6, '#B4B4B4'], // yellow
                    [0.9, '#B4B4B4']                            
                ],
            };
            var distance = -40;   
            var titledistance = 250;                  
        }
        else{
            var ya =  {
                labels: {
                    enabled: false,
                },
                reversed: false,
                min: 0,
                max: 100,
                lineWidth: 0,
                tickLength: 60,
                tickWidth: 0,
                // tickColor: 'white',
                // tickPosition: 'inside',
                minorTickLength: 0,
                // tickPositions: ticks,
                zIndex: 10,
                stops: [
                    [0.3, '#B4B4B4'], // red
                    [0.6, '#B4B4B4'], // yellow
                    [0.9, '#B4B4B4']                            
                ],
            };
            var distance = 70;                     
            var titledistance = 10;                  
    
        }


        Highcharts.chart(c, {
            chart: {
                type: 'solidgauge',
                margin: [0, 0, 0, 0],
                height: 400,
            },

            title: {
                text: title,
                y: titledistance,
                style: {
                    fontFamily: 'Poppins',
                    fontSize: '18px'
                },   
    

            },
            tooltip: {
                enabled: false,
            },
            pane: {
                startAngle: -140,
                endAngle: 140,
                background: [{ // Track for Move
                    outerRadius: '100%',
                    innerRadius: '65%',
                    backgroundColor: 'rgba(160, 160, 160, 0.30)',
                    borderWidth: 0,
                    shape: 'arc'
                }]
            },

            yAxis: ya,   

            plotOptions: {
                solidgauge: {
                    innerRadius: '65%',
                    dataLabels: {
                        y: distance,
                        borderWidth: 0,
                        useHTML: true,
                        style: {
                            fontFamily: 'Poppins',
                            fontSize: '50px'
                        },   
                        format: '<span style="text-align:center; font-size:50px;">{y}</span><span style="text-align:center; font-size:25px;">/100</span>',
                    }
                }
            },

            series: [{
                name: 'Your Score',
                borderColor: Highcharts.getOptions().colors[0],
                data: [{
                    color: Highcharts.getOptions().colors[0],
                    y: score
                }]
            }],
            exporting: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            legend: {
                enabled: true
            },
        });
    };

    </script> 
</script>
<body>
	<div class="wrapper">  
		<div class="main">
        <?php include('comp/nav.php')?>
			<main class="content">
                <div class="card">
                    <div class="card-body">
                        <div class = "card-text h2">Irrigation and Energy Benchmark</div>
                        </br>
                        <div class = "card-text h4">This page is used to show the benchmark of the irrigation practice on a farm. It also display the benchmark of individual compoenents of an irrigation event, including area, flow rate, duration and total KWh, which can be used to observe the relationship bettween them and an irrigation event.</div>
                        </br>
                        <p class="mb-0 h4">The formulas used are shown below.</p>
                        </br>                
                        <p class="mb-0 h4 ">Total ML per Farm =  Sum of Total ML per Set.</p>
                        <p class="mb-0 h4">Total ML per Set =  Duration * Total Flow Rate * 3600 / 1000000.</p>
                        <p class="mb-0 h4">Total mm per Set =  Total ML per Set * 100 / Set Area.</p>
                        <p class="mb-0 h4">Avg mm =  Sum of Total mm per Set / Number of Sets.</p>
                        <p class="mb-0 h4">Avg area =  Sum of Total Set Area / Number of Sets.</p>
                        <p class="mb-0 h4">Avg Flow Rate =  Sum of Total Flow Rate / Number of Sets.</p>
                        <p class="mb-0 h4">Avg Duration =  Sum of Total Duration / Number of Sets.</p>
                    </div>  
                </div>  
                <div class="row">            
                    <div id="item"></div>             
                </div>  

                <script>
                    var setnames = <?php echo json_encode($setnames); ?>;
                    var setvalues = <?php echo json_encode($setvalues); ?>;
                    var username = <?php echo json_encode($_SESSION['username'],JSON_INVALID_UTF8_IGNORE); ?>; 

                    var subset = [];
                    var ind = 0;
                    switch(username) {
                        case "BIP":
                            subset = setvalues;
                            break;
                        case "SRA":
                            subset = setvalues;
                            break;             
                        case "FARMACIST":
                            for (let i=0;i<setvalues.length;i++){                             
                                var nameArr = setvalues[i][2].split('_');
                                
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
                            
                    }       
                    
                    var farms = [];
                    for (let i=0;i<subset.length;i++){
                        farms[i] = subset[i][2];  
                    }  

                    var counts = {};
                    for (const num of farms) {
                        counts[num] = counts[num] ? counts[num] + 1 : 1;
                    }    
                    const iterator = Object.entries(counts);
                    var infor = ["Grower ID","Total Area (ha)", "Avg Area (ha)", "No of Sets","Avg No Rows","Avg Row Length (m)","Avg Flow Rate (L/S)","Avg Duration (h)", "Total Water Applied (ML)","Avg Water Applied (ML)","Avg Water Applied (mm)"
                    ,"Avg Crop Water Use (mm)","Avg Applied Efficiency","Total Energy (KWH)","Avg Energy (KWH)","Avg Energy per ML (KWH/ML)","Avg Energy per Hour (KWH/H)",
                    "Avg Energy Cost per ML ($/ML)","Avg Energy Cost per Irrig ($/ha/ML)"];
                    // var setn = ["Set ID","Area","Crop Class","Date Planted","Total Water Applied (ML)","Total Energy (KWH)","Total Energy Cost per Irrig ($/ha/ML)"];
                    var index = [0,14,14,0,11,12,20,22,23,23,24,26,27,28,28,29,30,31,32];
                    var avg = [0,0,1,0,1,1,1,0,1,1,1,1,1,0,1,1,1,1,1];
                    var fixed = [0,1,1,0,0,0,1,1,1,1,1,2,1,1,1,1,1,1];
                    // var theme = [0,0,0,0,0,0,0,1,1,1,1,1,1,1,1,1,1,1];
                    var farminfor = [];

                    var setinfor = [];
                    var score = ["",0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
                    var farmsummary = [];
                    for (let i=0;i<iterator.length;i++){
                        farmsummary[i] = [];
                        for (let j=1;j<infor.length;j++){
                            farmsummary[i][j] = 0;
                        }                        

                        farmsummary[i][0] = Object.entries(counts)[i][0];

                        for (let j=0;j<subset.length;j++){
                            if (subset[j][2] == farmsummary[i][0]){
                                for (let z=1;z<infor.length;z++){
                                    if (index[z] !== 0){
                                        farmsummary[i][z] += Number(subset[j][index[z]]);
                                    }else{
                                        farmsummary[i][z] ++;
                                    }
                                }                                  
                            }
                        }     

                        for (let j=1;j<infor.length;j++){
                            if (avg[j] == 1){
                                farmsummary[i][j] = farmsummary[i][j]/farmsummary[i][1];
                            }
                            farmsummary[i][j] = farmsummary[i][j].toFixed(fixed[j]);  
                        }                        
                    }
                    

                    for (let i=0;i<iterator.length;i++){
                        for (let j=1;j<infor.length;j++){
                            farminfor[j] = 0;
                        }                        

                        farminfor[0] = Object.entries(counts)[i][0];

                        for (let j=0;j<subset.length;j++){
                            if (subset[j][2] == farminfor[0]){
                                for (let z=1;z<infor.length;z++){
                                    if (index[z] !== 0){
                                        farminfor[z] += Number(subset[j][index[z]]);
                                    }else{
                                        farminfor[z] ++;
                                    }
                                }                                  
                            }
                        }     

                        for (let j=1;j<infor.length;j++){
                            if (avg[j] == 1){
                                farminfor[j] = farminfor[j]/farminfor[1];
                            }
                            farminfor[j] = farminfor[j].toFixed(fixed[j]);  
                        }                        
                        var score = [];
                        var pos = [];
                        var total = [];
                        for (let j=1;j<infor.length;j++){
                            newarray = [];
                            for (let z=0;z<farmsummary.length;z++){
                                newarray[z] = Number(farmsummary[z][j]);
                            }
                            
                            sortarray = newarray.sort(function(a, b){return a - b});
                            
                            // console.log(sortarray);
                            let index = sortarray.indexOf(Number(farminfor[j]));
                            
                            
                            score[j] = ((index + 1) * 100 / newarray.length).toFixed(0);
                            pos[j] = index + 1;
                            total[j] = newarray.length;
                        }  
                        console.log(infor);
                        createparentcard(farminfor,infor,score,pos,total);
                        createchildcard('','',farminfor[0]);
                        creategauge(farminfor[0] + "container0",1,Number(score[8]),"Total ML");
                        creategauge(farminfor[0] + "container1",1,Number(score[10]),"Avg mm");
                        creategauge(farminfor[0] + "container2",2,Number(score[1]),"Total Area");
                        creategauge(farminfor[0] + "container3",2,Number(score[2]),"Avg Area");
                        creategauge(farminfor[0] + "container4",2,Number(score[6]),"Avg Flow Rate");
                        creategauge(farminfor[0] + "container5",2,Number(score[7]),"Avg Duration");
                        // for (let j=0;j<subset.length;j++){
                        //     if (subset[j][2] == farminfor[0]){
                        //         setinfor[0] = subset[j][5];
                        //         setinfor[1] = subset[j][14];
                        //         setinfor[2] = subset[j][9];
                        //         setinfor[3] = subset[j][10];
                        //         setinfor[4] = subset[j][23];
                        //         setinfor[5] = subset[j][28];
                        //         setinfor[6] = subset[j][33];
                        //         createchildcard(setinfor,setn,farminfor[0]);
                        //     }
                        // }

                    }
                    

                    // let btns = document.querySelectorAll('button');

                    // for (i of btns) {
                    // (function(i) {
                    //     i.addEventListener('click', function() {
                        
                    //     updateirrigation("2020-04-16", i.id.substring(0, 6),i.id.substring(6, 10));  
                    //     });
                    // })(i);
                    // }
                </script>
			</main>
            <?php include('comp/footer.php')?>
		</div>
	</div>
	<script src="js/app.js"></script>
	<script src="js/datatables.js"></script>
</body>

</html>