<?php include('comp/userauth.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php include('server/getfarms.php') ?>
<head>
<?php include('comp/header.php')?>
<script src="https://unpkg.com/read-excel-file@5.x/bundle/read-excel-file.min.js"></script>
<style>
    #input
    {
      margin-top    : 20px;
      margin-bottom : 10px;
    }
    a
    {
      color: #fd8900;
    }
    .file-upload
    {
      text-transform: uppercase;
      letter-spacing: 1px;
      font-size: 0.75rem;
      color: #fd8900;
      border: 1px solid currentColor;
      border-radius: 4px;
      display: inline-block;
      padding: 6px 12px;
      cursor: pointer;
    }
    .btn-primary
    {
      text-transform: uppercase;
      letter-spacing: 1px;
      font-size: 0.75rem;
      color: #fd8900;
      border: 1px solid currentColor;
      border-radius: 4px;
      display: inline-block;
      padding: 6px 12px;
      cursor: pointer;
      background-color: #ffffff;
      
    }
    .file-upload:active
    {
      color: black;
      font-weight: bolder;
      background-color: #fd8900;
    }

    input[type="file"]
    {
      display: none;
    }

    #result-table table
			{
				width : 100%;
				border-collapse : collapse;
				margin-top    : 2.5em;
				margin-bottom : 2.5em;
				font-size     : 12px;
  		}

			#result-table table td
			{
				border : 1px solid black;
				padding : 0.5em;

				text-overflow : ellipsis;
				overflow      : hidden;
				max-width     : 10em;
				white-space   : nowrap;
			}
</style>
</head>

<script>
    function addElement (id, text, dv, tt, ss, index, interval) {
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

        newDiv1.appendChild(newDiv2);
        newDiv1.appendChild(t);
        newDiv1.appendChild(s);
        newDiv1.appendChild(idd);
        newDiv1.appendChild(int);

        const currentDiv = document.getElementById(dv);
        let parentDiv = currentDiv.parentNode

        parentDiv.insertBefore(newDiv1, currentDiv);
    }   
    function addgroup(header,size,cards){
        const newDiv1 = document.createElement("div");
        newDiv1.className = "col-12 col-md-" + size + " col-xl-" + size;
        newDiv1.id = header;

        for (let i=0;i<cards.length;i++){
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
            newDiv1.appendChild(card1);
        }

        const currentDiv = document.getElementById("head");
        let parentDiv = currentDiv.parentNode

        parentDiv.insertBefore(newDiv1, currentDiv);        
    }       
    function addcard(header,size){
        const newDiv1 = document.createElement("div");
        newDiv1.className = "col-12 col-md-" + size + " col-xl-" + size;  

        const card = document.createElement("div");
        card.className = "card";
        // card.id = header + "card";
        
        const cardheader = document.createElement("div");
        cardheader.className = "card-header h3";
        cardheader.innerText = header;

        // const cardheadertext = document.createElement("h4");
        // cardheadertext.innerText = header;

        // cardheader.appendChild(cardheadertext);
        card.appendChild(cardheader);
        
        const cardbody = document.createElement("div");
        cardbody.className = "card-body";

        const container = document.createElement("div");
        container.id = header + "body";

        cardbody.appendChild(container);
        card.appendChild(cardbody);
        newDiv1.appendChild(card);

        const currentDiv = document.getElementById("head");
        let parentDiv = currentDiv.parentNode

        parentDiv.insertBefore(newDiv1, currentDiv);        
    }      
    function addchart(header, type, short, index, interval){
        var setvalues = <?php echo json_encode($setvalues,JSON_INVALID_UTF8_IGNORE); ?>;            
        for (let i=0;i<setvalues.length;i++){
            setvalues[i][27] = Number(setvalues[i][27]) * 100; 
        }

        var tempdata = [];
        var unit = "";
        var t = 0;
   

        var data = [];
        // var t = 0;
        for (let i = 0; i < setvalues.length; i++) {
            data[i] = setvalues[i][index];
        } 

        if (type == 0){
            createpiechart(header + "body", data, tempdata,'',short,370);
        }else if (type == 1){
            createbasicbar(header + "body",data, tempdata,'',header,"",370,interval);
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
        <?php include('comp/nav.php')?>

			<main class="content">
				<div class="container-fluid p-0">
        <div id="head"></div>
        <script>
                var setnames = <?php echo json_encode($setnames,JSON_INVALID_UTF8_IGNORE); ?>;
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
                addcard("Data",12);
                createtable("Data"+"body", setnames, subset,"datatables-reponsive",0); 
            </script>
            <div class="row">  
            <h2 class="h4 mb-3"><strong>Import</strong> Property Data</h2> 
                <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">       
                  <label for="input" class="file-upload">
                    Choose an <code>*.xlsx</code> file
                  </label>
                  <input type="file" id="input" accept = ".xlsx">
                </div>   
                <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">    
                  <iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>            
                  <form method="post" action="test.php" target="dummyframe">
                    <!-- <div id="result-table" name="result"></div>						 -->
                    <button type="submit" class="btn-primary" name="import">Import</button>
                    <input id="result-table1" name="sets" type="text" style='display:none;'/>
                  </form>
                </div>  
            </div>
            
            <br>
            <br>
            
                

            <div class="row">
            <h1 class="h3 mb-3" style="display:none" id="head""><strong>Property</strong> Information</h1>

            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill">
                    <table class="table table-hover my-0  table-striped" id="settable" style="display:none">
                        <thead>
                            <tr>
                              <th>District</th>
                              <th>Grower ID</th>
                              <th>Wilmar Map Block ID</th>
                              <th>Grower Block Identifier</th>
                              <th>Outlet Set Identifier</th>
                              <th>Soil Type</th>
                              <th>Soil Group</th>
                              <th>IrrigWeb Soil Type</th>
                              <th>Crop Class</th>
                              <th>Date Planted</th>
                              <th>Number of Rows</th>
                              <th>Avg Row Length (m)</th>
                              <th>Row Spacing (m)</th>
                              <th>Area (ha)</th>
                              <th>Water Supply</th>
                              <th>Water Source</th>
                              <th>Pump Type</th>
                              <th>Measured Motor KW</th>
                              <th>Tariff</th>
                              <th>Total Flow Rate (L/S)</th>
                              <th>Per Cup Flow Rate (L/S/Cup)</th>
                              <th>Duration (hrs)</th>
                              <th>Total ML Applied (ML)</th>
                              <th>Depth Applied (mm)</th>
                              <th>Days Between Irrigation Duration</th>
                              <th>Crop Water Use Between Irrigations</th>
                              <th>Application Efficency (%)</th>
                              <th>Energy (KWH)</th>
                              <th>Energy per ML (kWh/ML)</th>
                              <th>Energy per Hour (kWh/h)</th>
                              <th>Energy Cost ($/kWh)</th>
                              <th>Energy Cost per ML ($/ML)</th>
                              <th>Energy Cost per Irrigation ($/ha/ML)</th>
                            </tr>
                        </thead>
                    </table>      
                </div>
            </div>

            <script>
              var input = document.getElementById('input');
              var importdata = [];
              input.addEventListener('change', function() {
                var x = document.getElementById("settable");
                x.style.display = "table";          


                readXlsxFile(input.files[0],{sheet: 1}).then(function(data) {   				
                importdata = data;
                document.getElementById('result-table1').value  = JSON.stringify(data);
                console.log(importdata);

                var table = document.getElementById("settable");
                for (let i=0;i<200;i++){
                  if (importdata[2+i][0]){
                    var row = table.insertRow(i+1);
                    for (let j=0;j<33;j++){
                      var cell = row.insertCell(j);
                      cell.innerHTML  = String(importdata[2+i][j]);                     
                    }
                  }
                }  
                
                })                
              })                       
            </script> 
           
            
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
			// Datatables Responsive
			$("#datatables-reponsive").DataTable({
				responsive: true,
			});
			$("#datatables-reponsive1").DataTable({
				responsive: true
			});	
			$("#datatables-reponsive2").DataTable({
				responsive: true
			});	
			$("#datatables-reponsive3").DataTable({
				responsive: true
			});					
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