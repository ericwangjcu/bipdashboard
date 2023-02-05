<?php include('comp/userauth.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php include('server/getfarms.php') ?>
<head>
    
<?php include('comp/header.php')?>
</head>

<script>   
    function createparentcard(farminfo,infor,score){
        const currentDiv = document.getElementById("item");
        let parentDiv = currentDiv.parentNode

        const newDiv1 = document.createElement("div");
        newDiv1.className = "card bg-light  mb-3  mt-3";


        const newDiv2 = document.createElement("div");
        newDiv2.setAttribute('data-toggle',"collapse");
        newDiv2.setAttribute('data-target',"#" + farminfo[0]);
        newDiv2.setAttribute('aria-expanded',"false");
        newDiv2.setAttribute('aria-controls',farminfo[0]);

        
        const newDiv3 = document.createElement("div");
        newDiv3.className = "card-body"; 
        const cardjeader = document.createElement("h1");
        cardjeader.className = "card-title h1";
        cardjeader.innerText = farminfo[0];
        newDiv3.appendChild(cardjeader);

        const newDiv4 = document.createElement("container");
        const newDiv5 = document.createElement("div");
        newDiv5.className = "row";

        for (let i=1;i<farminfo.length;i++){   
            if (i==1 || i==2 || i==6 || i ==7 || i== 11 || i== 12){         
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
                title.innerText = infor[i];  
                cardbody.appendChild(title);

                const text = document.createElement("h3");
                text.className = "mt-2";
                text.innerText = farminfo[i];
                titlecol.appendChild(text);
                row.appendChild(titlecol);
                
                const colauto = document.createElement("div");
                colauto.className = "col-auto";
                const mb = document.createElement("div");
                mb.className = "h1";
                const badge = document.createElement("span");


                if (score[i] < 100){
                badge.className = "badge rounded-pill bg-success";
                }
                if (score[i] < 66){
                    badge.className = "badge rounded-pill bg-warning ";
                } 
                if (score[i] < 33){
                    badge.className = "badge rounded-pill bg-danger";
                }           
                badge.innerText = score[i];
                mb.appendChild(badge);
                colauto.appendChild(mb);
                row.appendChild(colauto);
                

                cardbody.appendChild(row);

                card.appendChild(cardbody);
                col.appendChild(card);
                newDiv5.appendChild(col); 
            }
        }     
        newDiv4.appendChild(newDiv5);
           

        newDiv3.appendChild(newDiv4);
        newDiv2.appendChild(newDiv3);
        newDiv1.appendChild(newDiv2);
        parentDiv.insertBefore(newDiv1, currentDiv); 

    }   
    function createchildcard(set,infor,id){
        const currentDiv = document.getElementById("item");
        let parentDiv = currentDiv.parentNode

        const newDiv4 = document.createElement("div");
        newDiv4.className = "collapse"; 
        newDiv4.id = id; 
        const newDiv1 = document.createElement("div");
        newDiv1.className = "card";

        const newDiv5 = document.createElement("div");
        newDiv5.className = "card-body"; 
        const newDiv52 = document.createElement("div");
        newDiv52.className = "row";

        const newDiv51 = document.createElement("div");
        newDiv51.className = "col-10"; 

        const newDiv3 = document.createElement("div");
        newDiv3.className = "row";
        
        for (let i=0;i<infor.length;i++){
            
            const newDiv6 = document.createElement("div");
            if (i > 1){
                newDiv6.className = "col-2";
            }
            else{
                newDiv6.className = "col-1";
            }
            const newDiv7 = document.createElement("h5");
            newDiv7.className = "card-title";
            newDiv7.innerText = infor[i];  
            
            newDiv6.appendChild(newDiv7);
            newDiv3.appendChild(newDiv6);         
        } 

        for (let i=0;i<set.length;i++){
            
            const newDiv4 = document.createElement("div");
            if (i > 1){
                newDiv4.className = "col-2";
            }
            else{
                newDiv4.className = "col-1";
            }
            

            if (i > 3){
                const newDiv5 = document.createElement("h5");

                const newDiv7 = document.createElement("span");
                newDiv7.className = "badge badge-primary-light";
                newDiv7.innerText = set[i];
                newDiv5.appendChild(newDiv7);
                newDiv4.appendChild(newDiv5);
            }
            else{
                const newDiv5 = document.createElement("p");
                newDiv5.className = "card-text";
                newDiv5.innerText = set[i];
                newDiv4.appendChild(newDiv5);
            } 
            newDiv3.appendChild(newDiv4);       
        } 
        newDiv51.appendChild(newDiv3);     
 
        const newDiv41 = document.createElement("div");
        newDiv41.className = "col-1";  
        const newDiv42 = document.createElement("div");
        newDiv42.className = "row";

        const newbutton = document.createElement("button");
        newbutton.className = "btn btn-xl btn-primary";    
        newbutton.type = "button";    
        newbutton.innerText = "Irrigation";    
        newbutton.setAttribute('data-bs-toggle',"offcanvas");
        newbutton.setAttribute('href',"#offcanvasExample");
        newbutton.id = id + set[0];
        newDiv42.appendChild(newbutton);
        newDiv41.appendChild(newDiv42);
        


        newDiv52.appendChild(newDiv51);
        newDiv52.appendChild(newDiv41);
        newDiv5.appendChild(newDiv52);
        

        newDiv1.appendChild(newDiv5);
        newDiv4.appendChild(newDiv1);
        parentDiv.insertBefore(newDiv4, currentDiv); 
    }
</script>
<body>
	<div class="wrapper">  
		<div class="main">
        <?php include('comp/nav.php')?>
			<main class="content">
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
                    var infor = ["Grower ID","Total Area (ha)","No of Sets","Avg No Rows","Avg Row Length (m)","Avg Flow Rate (L/S)","Total Water Applied (ML)","Avg Water Applied (ML)","Avg Water Applied (mm)"
                    ,"Avg Crop Water Use (mm)","Avg Applied Efficiency","Total Energy (KWH)","Avg Energy (KWH)","Avg Energy per ML (KWH/ML)","Avg Energy per Hour (KWH/H)",
                    "Avg Energy Cost per ML ($/ML)","Avg Energy Cost per Irrig ($/ha/ML)"];
                    var setn = ["Set ID","Area","Crop Class","Date Planted","Total Water Applied (ML)","Total Energy (KWH)","Total Energy Cost per Irrig ($/ha/ML)"];
                    var index = [0,14,0,11,12,20,23,23,24,26,27,28,28,29,30,31,32];
                    var avg = [0,0,0,1,1,1,0,1,1,1,1,0,1,1,1,1,1];
                    var fixed = [0,1,0,0,0,1,1,1,1,1,2,1,1,1,1,1,1];
                    var theme = [0,0,0,0,0,0,1,1,1,1,1,1,1,1,1,1,1];
                    var farminfor = [];

                    var setinfor = [];
                    var score = ["",0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
                    var farmsummary = [];
                    for (let i=0;i<iterator.length;i++){
                        farmsummary[i] = [];
                        for (let j=1;j<17;j++){
                            farmsummary[i][j] = 0;
                        }                        

                        farmsummary[i][0] = Object.entries(counts)[i][0];

                        for (let j=0;j<subset.length;j++){
                            if (subset[j][2] == farmsummary[i][0]){
                                for (let z=1;z<17;z++){
                                    if (index[z] !== 0){
                                        farmsummary[i][z] += Number(subset[j][index[z]]);
                                    }else{
                                        farmsummary[i][z] ++;
                                    }
                                }                                  
                            }
                        }     

                        for (let j=1;j<17;j++){
                            if (avg[j] == 1){
                                farmsummary[i][j] = farmsummary[i][j]/farmsummary[i][1];
                            }
                            farmsummary[i][j] = farmsummary[i][j].toFixed(fixed[j]);  
                        }                        
                    }
                    

                    for (let i=0;i<iterator.length;i++){
                        for (let j=1;j<17;j++){
                            farminfor[j] = 0;
                        }                        

                        farminfor[0] = Object.entries(counts)[i][0];

                        for (let j=0;j<subset.length;j++){
                            if (subset[j][2] == farminfor[0]){
                                for (let z=1;z<17;z++){
                                    if (index[z] !== 0){
                                        farminfor[z] += Number(subset[j][index[z]]);
                                    }else{
                                        farminfor[z] ++;
                                    }
                                }                                  
                            }
                        }     

                        for (let j=1;j<17;j++){
                            if (avg[j] == 1){
                                farminfor[j] = farminfor[j]/farminfor[1];
                            }
                            farminfor[j] = farminfor[j].toFixed(fixed[j]);  
                        }                        
                        var score = [];
                        for (let j=1;j<17;j++){
                            newarray = [];
                            for (let z=0;z<farmsummary.length;z++){
                                newarray[z] = Number(farmsummary[z][j]);
                            }
                            
                            sortarray = newarray.sort(function(a, b){return a - b});
                            
                            // console.log(sortarray);
                            let index = sortarray.indexOf(Number(farminfor[j]));
                            
                            
                            score[j] = ((index + 1) * 100 / newarray.length).toFixed(0);
                        }  

                        createparentcard(farminfor,infor,score);

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