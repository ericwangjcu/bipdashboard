<!DOCTYPE html>
<html lang="en">
<?php include('getset.php') ?>
<head>
<?php include('header.php')?>   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<?php
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
    }    
?>
<script>
	function addslider(max, min, text, id, step, value, name, labelid){

		const head = document.createElement("h3");
		head.innerText = text;


		const div1 = document.createElement("div");
		div1.className = "row";

		const divmin = document.createElement("div");
		divmin.className = "col-1";

		const divmintext = document.createElement("b");
		divmintext.innerText = min;

		divmin.appendChild(divmintext);
		div1.appendChild(divmin);

		const divrange = document.createElement("div");
		divrange.className = "col-9";

		const divrangeinput = document.createElement("input");
		divrangeinput.className = "form-range";
		divrangeinput.type = "range";
		divrangeinput.id = id;
		divrangeinput.min = min;
		divrangeinput.max = max;
		divrangeinput.step = step;
		divrangeinput.value = value;

		divrange.appendChild(divrangeinput);
		div1.appendChild(divrange);


		const divmax = document.createElement("div");
		divmax.className = "col-2";

		const divmaxtext = document.createElement("b");
		divmaxtext.innerText = max;	

		divmax.appendChild(divmaxtext);
		div1.appendChild(divmax);

		const divlabel = document.createElement("div");
		divlabel.className = "h2 text-center mt-4"

		const divoutput = document.createElement("output");
		divoutput.name = name;
		divoutput.id = labelid;

		divlabel.appendChild(divoutput);

		const currentDiv = document.getElementById("head");
        let parentDiv = currentDiv.parentNode

        parentDiv.insertBefore(head, currentDiv);   
		parentDiv.insertBefore(div1, currentDiv);   
        parentDiv.insertBefore(divlabel, currentDiv);   

	}	
</script>	
<body>
	
	<div class="wrapper">
    
		<div class="main">
        <?php include('nav.php')?>
			<main class="content">
		
				<div class="container-fluid p-0">
					<div class="row">
						<div class="col-1">
								<h1 class="h3 mt-2"><strong><?php echo $fieldname[0][1] ?> </strong> </h1>
						</div> 
						<div class="col-2">
							<a class="btn btn-outline-info my-1" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
								aria-controls="offcanvasExample">
								Other Sets
							</a>
						</div> 
					</div> 
                    <div class="col-12 col-lg-12">
						<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                                <div class="offcanvas-header">
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
									<?php 
										foreach ($setids as $row) { 							 
											echo '<a class="h4 nav-link" href=showeachset.php?id=';
											echo $row[0];
											echo '>'.$row[1].'</a>'; 
										}     
									?> 									
                                </div>
                            </div>
						</div>  	
						</br>				
						<div class="row">
							<div class="col-12">
								<div class="card flex-fill w-100">
									<div class="card-body">
										<table id="datatables-reponsive" class="table table-striped" style="width:100%">
											<thead>
												<tr>
												<?php 
													$col = 0;  
													foreach ($names as $row) {  
														if($col < 18 && $col > 0){
																echo '<th>'.$row.'</th>';                                                                 
														
													}     
													$col ++;
												}     
												?>      
												</tr>
											</thead>
											<tbody>                                     
												<?php 
												foreach ($fieldname as $row) { 
													echo '<tr>';     
													$col = 0;  
													foreach ($row as $value){
														if($col < 18 && $col > 0){
															echo '<td>'.$value.'</td>';       
															
														}
														$col ++;
													}   
													echo '</tr>';     
												}       
												?>     
											</tbody>
										</table>
									</div>
								</div>
							</div> 

						<!-- <div class="row" id="card-container"></div>					
						<script>
							var names = <?php echo json_encode($names); ?>; 
							var fieldname = <?php echo json_encode($fieldname); ?>; 
							var tasks = [];
							var size = [0,2,0.75,2,0.75,0.75,5,2,1,4,1,2,5,.75,.75,.75,.75,0.75,1,1];
							var text = [0,0,1,0,1,1,0,0,0,0,0,0,0,1,1,1,1,1,0,0];	
							var seq = [0,1,3,6,7,8,9,10,11,12,2,4,5,13,14,15,16,17,18];		
							var min = <?php echo json_encode($min); ?>;
							var max = <?php echo json_encode($max); ?>;
							var avg = <?php echo json_encode($avg); ?>;	
							
							for(let i=1;i<names.length-2;i++){
								if (text[seq[i]] == 1){
									tasks[seq[i]] = {"title": names[seq[i]],
									"value": fieldname[0][seq[i]],
									"avr": Number(avg[seq[i]]).toFixed(1),
									"min": Number(min[seq[i]]).toFixed(1),
									"max": Number(max[seq[i]]).toFixed(1),
									"avrt": "AVR",
									"mint": "MIN",
									"maxt": "MAX",		
									"id": "",							
									"size": "col-12 col-sm-12 col-md-12 col-l-"+ String(size[seq[i]]*8) + " col-xl-" + String(size[seq[i]]*4)};
									createbenchmarkcard(tasks[seq[i]],"card-container");
								}else{
									tasks[seq[i]] = {"title": names[seq[i]],
									"value": fieldname[0][seq[i]],
									"benchmark": "",
									"text": "",					
									"id": "",		
									"size": "col-12 col-sm-12 col-md-12 col-l-"+ String(size[seq[i]]*4) + " col-xl-" + String(size[seq[i]])};
									createcard(tasks[seq[i]],"card-container");
								}

							}
						</script> -->

						<h1 class="h1 mb-4 mt-4"></h1>		

						<h1 class="h3 mb-3"><strong>Irrigation</strong> Overview</h1>	
						<div class="col-9">	
							<div class="row" id="card-container1"></div>  
						</div> 

						<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 d-flex">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h4 >Overall  Benchmark</h4>
								</div>												
								<div class="card-body">
									<div class="row" id="container-Benchmark"></div>
								</div>
							</div> 
						</div> 						  
						<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 d-flex">
							<div class="card flex-fill w-100">
								<div class="card-body">
									<h1 class="h3 mb-3"><strong>Irrigation</strong> Settings</h1>
									<div id="head"></div> 
									<script>
										addslider("24", "0", "Duration (h)", "customRange1", "1", "14","ageOutputName1", "ageOutputId1");
										document.getElementById("customRange1").oninput = function() {ageOutputId1.value = customRange1.value};
										addslider("28", "0", "Cycle Days (d)", "customRange2", "7", "14","ageOutputName2", "ageOutputId2");
										document.getElementById("customRange2").oninput = function() {ageOutputId2.value = customRange2.value};
										addslider("100", "0", "Flow Rate (L/S)", "customRange3", "1", "14","ageOutputName3", "ageOutputId3");
										document.getElementById("customRange3").oninput = function() {ageOutputId3.value = customRange3.value};
									</script>
									<!-- <br>
									<h3>Duration (h)</h3>
									<br>
									<div class="row">
										<div class="col-1" >
											<b>0</b> 
										</div>
										<div class="col-9">
											<input type="range" class="form-range" id="customRange1" min="0" max="24" step="1" value="14" oninput="ageOutputId1.value = customRange1.value">   
										</div>
										<div class="col-2">
											<b>24</b>  
										</div>	
									</div>	
									<div class="h2 text-center mt-4">																	
										<output name="ageOutputName1" id="ageOutputId1"></output>
									</div>	 -->
									
									
									<!-- <br>
									<h3 >Cycle Days (d)</h3>
									<br>
									<div class="row">
										<div class="col-1" >
											<b>0</b> 
										</div>
										<div class="col-9">
											<input type="range" class="form-range" id="customRange2" min="0" max="28" step="7" value="14" oninput="ageOutputId2.value = customRange2.value">   
										</div>
										<div class="col-2">
											<b>28</b>  
										</div>	
									</div>										
									<div class="h2 text-center mt-4">																	
										<output name="ageOutputName2" id="ageOutputId2"></output>
									</div>	 -->
									
									<!-- <br>
									<h3 >Flow Rate (L/S)</h3>
									<br>
									<div class="row">
										<div class="col-1" >
											<b>0</b> 
										</div>
										<div class="col-9">
											<input type="range" class="form-range" id="customRange3" min="0" max="100" step="1" value="14" oninput="ageOutputId3.value = customRange3.value">   
										</div>
										<div class="col-2">
											<b>100</b>  
										</div>	
									</div>										
									<div class="h2 text-center mt-4">																	
										<output name="ageOutputName3" id="ageOutputId3"></output>
									</div> -->
									
									<!-- <br>
									<br> -->
									<div class="d-grid gap-4">
										<button class="btn btn-success p-3 btn-block" onclick="myFunction()"><i class="fas fa-check"></i>UPDATE</button>
									</div>
								</div>
							</div>
						</div>   
						<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9">
							<div class="card flex-fill w-100">
								<div class="card-body">
									<div id="container-irrigation"></div>                                 
								</div>
							</div>	
							<div class="card flex-fill w-100">
								<div class="card-body">
									<div id="container-IrrigWeb" style="display:none"></div> 
									<div class="text-center">
										<div class="spinner-border" role="status" style="display:true" id = "spinner" ></div>
									</div>								
								</div>
							</div>								
						</div>	
						
						<script>
						//update irrigation based on the default duration, cycle, flow rate or with the new irrigation setttings.
						//startdate: crop start date
						//duration: irrigation duration in hours
						//cycle: irrigation cylce days
						//flow: pump flow rates
						var setname = <?php echo json_encode($setname); ?>; 						
						var array = [];
						var benchmark = [];
						for (let j=0;j<8;j++){
							benchmark[j] = [];
							for(let i=0;i<setname.length;i++){
								array[i] = calculateirrigation(setname[i]);	
								benchmark[j][i] = array[i][j];				
							}							
							
						}			
						var benchmarkvalue = [];
						for (let j=0;j<8;j++){
							benchmarkvalue[j] = [];
							benchmarkvalue[j][0] = Math.max.apply(Math, benchmark[j]);
							benchmarkvalue[j][1] = Math.min.apply(Math, benchmark[j]);
							benchmarkvalue[j][2] = benchmark[j].reduce((a,b) => a + b, 0)/benchmark[j].length;
						}	

						function calculateirrigation(set){
							var startdate = new Date(set[1]);
							var today = new Date();
							var harvestdate = Date.parse((startdate.getFullYear()+1) + "-" + (startdate.getMonth()+2) + "-" + startdate.getDate());
							if (today < harvestdate){
								var enddate = today;
							}else{
								var enddate = harvestdate;
							}
							

							function addDays(date, days) {
								var result = new Date(date);
								result.setDate(result.getDate() + days);
								return result;
							}

							var dryoffdate = addDays(harvestdate, -42);
							var text = "Dryoff: " + dryoffdate.getDate()  + "-" + (dryoffdate.getMonth()+1) + "-" + dryoffdate.getFullYear();

							var datearray = [];
							var irrigationarray = [];
							var datenumber = startdate;
							var index = 0;
							while (datenumber < enddate){
								datenumber = addDays(startdate, index+1);
								// datearray[index] = datenumber.getDate()  + "-" + (datenumber.getMonth()+1) + "-" + datenumber.getFullYear();
								datearray[index] = datenumber.getFullYear()  + "-" + String(datenumber.getMonth()+1).padStart(2, "0") + "-" + String(datenumber.getDate()).padStart(2, "0");
								irrigationarray[index] = 0;
								if (index%set[3] == 0 && datenumber < dryoffdate){
									irrigationarray[index] = set[2] * set[4] * 3600 / (10000 * set[0]);
								}
								index ++;
							}

							var sum1 = 0;
							var energy1 = 0;
							for (let i=0;i<irrigationarray.length;i++){
								sum1 += irrigationarray[i];
								if (irrigationarray[i] != 0){
									energy1 += set[2] * set[5];
								}
								
							}

							var totalirrig = sum1;
							var irrigperha = sum1/set[0];
							var totalamount = sum1*set[0]/100;
							var amountperha = sum1/100;
							var totalenergy = energy1;
							var energyperha = energy1/set[0];
							var totalcost = energy1*0.2481;
							var costperha = energy1*0.2481 / set[0];

							return [totalirrig, irrigperha, totalamount, amountperha, totalenergy, energyperha, totalcost, costperha];

						}

						function updateirrigation(startdate,duration,cycle,flow,area,type){
							var motorkw = <?php echo json_encode($motorkw); ?>; 
							var startdate = new Date(startdate);
							var today = new Date();
							
							function addDays(date, days) {
								var result = new Date(date);
								result.setDate(result.getDate() + days);
								return result;
							}

							// var today = addDays(today, -365);
							var harvestdate = Date.parse((startdate.getFullYear()+1) + "-" + (startdate.getMonth()+2) + "-" + startdate.getDate());
							if (today < harvestdate){
								var enddate = today;
							}else{
								var enddate = harvestdate;
							}
							


							var dryoffdate = addDays(harvestdate, -42);
							var text = "Dryoff: " + dryoffdate.getDate()  + "-" + (dryoffdate.getMonth()+1) + "-" + dryoffdate.getFullYear();

							var datearray = [];
							var irrigationarray = [];
							var datenumber = startdate;
							var index = 0;
							while (datenumber < enddate){
								datenumber = addDays(startdate, index+1);
								// datearray[index] = datenumber.getDate()  + "-" + (datenumber.getMonth()+1) + "-" + datenumber.getFullYear();
								datearray[index] = datenumber.getFullYear()  + "-" + String(datenumber.getMonth()+1).padStart(2, "0") + "-" + String(datenumber.getDate()).padStart(2, "0");
								irrigationarray[index] = 0;
								if (index%cycle == 0 && datenumber < dryoffdate){
									irrigationarray[index] = flow * duration * 3600 / (10000 * area);
								}
								index ++;
							}

							var sum = 0;
							var energy = 0;		

							for (let i=0;i<irrigationarray.length;i++){
								sum += irrigationarray[i];
								if (irrigationarray[i] != 0){
									energy += duration * motorkw;
								}
								
							}

							

							var s = String(datearray[0]);
							var e = String(datearray[datearray.length-1]);
							console.log(s);
							console.log(e);

							function loadirrigweb(){

								var oldrecord = JSON.parse($.ajax({
									url: 'IrrigWeb.php',
									type: 'post',
									data: {start: s, end: e, call: "rainfall"},
									dataType: 'html',
									context: document.body,
									global: false,
									async:false,								
									success: function(response){
										return response;
									}
								}).responseText);	
								console.log(oldrecord);						

								for (let i=0;i<irrigationarray.length;i++){
									if (irrigationarray[i] != oldrecord.Data[i].NetApp){
										var result = JSON.parse($.ajax({
										url: 'IrrigWeb.php',
										type: 'post',
										data: {IrrigDate: String(datearray[i]), IrrigAmount: String(irrigationarray[i]), call: "irrigapp"},
										dataType: 'html',
										context: document.body,
										global: false,
										async:false,								
										success: function(response){
											console.log(response);
											return response;
										}
										}).responseText); 
										if (result.Message = "OK"){
											continue;
										}
									}		
								}
								var newrecord = JSON.parse($.ajax({
									url: 'IrrigWeb.php',
									type: 'post',
									data: {start: s, end: e, call: "rainfall"},
									dataType: 'html',
									context: document.body,
									global: false,
									async:false,								
									success: function(response){
										return response;
									}
								}).responseText);   							// your code here

								var irrigwebdatearray = [];
								var rainarray = [];
								var SWD = [];
								var threshhold = [];

								for (let i=0;i<newrecord.Data.length;i++){
									irrigwebdatearray[i] = newrecord.Data[i].GraphDate;
									rainarray[i] = newrecord.Data[i].CumRain;
									SWD[i] = newrecord.Data[i].SoilDef;
									threshhold[i] = -40;
								}	
							
								document.getElementById('spinner').style  = "display:none";
								document.getElementById('container-IrrigWeb').style  = "display:true";
								
								if (today < harvestdate){
									createmixedbars('container-IrrigWeb',irrigationarray,rainarray,datearray,datearray.length,"",610,threshhold,SWD);
								}else{
									createmixedbars('container-IrrigWeb',irrigationarray,rainarray,datearray,datearray.length - 42,text,610,threshhold,SWD);
								}	

							}


							if (type == 1){
								document.getElementById('spinner').style  = "display:true";
								document.getElementById('container-IrrigWeb').style  = "display:none";	
								loadirrigweb();
							}

							document.addEventListener("DOMContentLoaded", function(event){
								loadirrigweb();						
							});

							if (today < harvestdate){
								createtimecolumn('container-irrigation',datearray,irrigationarray,datearray.length,"",300);
							}else{
								createtimecolumn('container-irrigation',datearray,irrigationarray,datearray.length - 42,text,300);
							}	

							return [sum, energy];
						}	
						</script>							
						<script>								
							var fieldname = <?php echo json_encode($fieldname); ?>; 

							var array = updateirrigation(fieldname[0][12],fieldname[0][13],fieldname[0][14],fieldname[0][15],fieldname[0][2]);
							var sum = array[0];
							var energy = array[1];

							document.getElementById('customRange1').value  = (fieldname[0][13]);
							document.getElementById('customRange2').value  = (fieldname[0][14]);
							document.getElementById('customRange3').value  = (fieldname[0][15]);
							document.getElementById('ageOutputId1').value  = (fieldname[0][13]);
							document.getElementById('ageOutputId2').value  = (fieldname[0][14]);
							document.getElementById('ageOutputId3').value  = (fieldname[0][15]);	

							var titles = ["Total Irrigation (mm)","Irrigation per ha (mm)","Total Amount (ML)","Amount per ha (ML)","Total Energy (KWH)","Energy per ha (KWH)",
							"Irrigation Cost (AUD)","Cost per ha (AUD)"];
							var ids = ["totalirrig","irrigperha","totalamount","amountperha","totalenergy","energyperha","totalcost", "costperha"];
							var idcs = ["totalirrigc","irrigperhac","totalamountc","amountperhac","totalenergyc","energyperhac","totalcostc", "costperhac"];
							var unit = ["mm","mm","ML","ML","KWH","KWH","AUD","AUD"];
							var values = [sum.toFixed(2),(sum/fieldname[0][2]).toFixed(2),(sum*fieldname[0][2]/100).toFixed(2),(sum/100).toFixed(2),energy.toFixed(2),
							(energy/fieldname[0][2]).toFixed(2),(energy*0.2481).toFixed(2),(energy*0.2481/fieldname[0][2]).toFixed(2)];

							var task = [];
							var d = [];
							for (let i=0;i<8;i++){
								task[i] = {"title":titles[i],"value":values[i],"avr":benchmarkvalue[i][2].toFixed(2),"min":benchmarkvalue[i][1].toFixed(2),"max":benchmarkvalue[i][0].toFixed(2)
									,"avrt":"AVR","mint":"MIN","maxt":"MAX","id": ids[i],"idc": idcs[i],"size": "col-12 col-sm-12 col-md-12 col-l-6 col-xl-4 col-xxl-3"};
								createbenchmarkcard(task[i],"card-container1");	
								createnewgauge(task[i].idc,benchmarkvalue[i][1],benchmarkvalue[i][0],Number(values[i]),unit[i]);
								d[i] = values[i] * 100 / benchmarkvalue[i][0];
							}
							
							createpolarchart("container-Benchmark",d);

							function myFunction() {		
								var sum = 0;
								var energy = 0;		

								var cycle = Number(document.getElementById('ageOutputId2').value);
								var duration = Number(document.getElementById('ageOutputId1').value);
								var flowrate = Number(document.getElementById('ageOutputId3').value);

								var array =  updateirrigation(fieldname[0][12],duration,cycle,flowrate,fieldname[0][2],1);
								var sum = array[0];
								var energy = array[1];

								values = [sum.toFixed(2),(sum/fieldname[0][2]).toFixed(2),(sum*fieldname[0][2]/100).toFixed(2),(sum/100).toFixed(2),energy.toFixed(2),
								(energy/fieldname[0][2]).toFixed(2),(energy*0.2481).toFixed(2),(energy*0.2481/fieldname[0][2]).toFixed(2)];

								for (let i=0;i<8;i++){
									document.getElementById(ids[i]).innerHTML  = values[i];
									createnewgauge(task[i].idc,benchmarkvalue[i][1],benchmarkvalue[i][0],Number(values[i]));
									d[i] = values[i] * 100 / benchmarkvalue[i][0];
								}
							
								createpolarchart("container-Benchmark",d);
							}					
						</script>													
					</div> 
				</div>
			</main>

			<?php include('footer.php')?>
		</div>
	</div>

	<script src="js/app.js"></script>

	<script src="js/datatables.js"></script>

	<!-- <script>
		document.addEventListener("DOMContentLoaded", function() {
			// Datatables Responsive
			$("#datatables-reponsive").DataTable({
				responsive: true
			});			
		});
	</script>	 -->

</body>

</html>