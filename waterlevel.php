<?php include('comp/userauth.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php include('server/getfarms.php') ?>
<?php include('server/savedashboard.php') ?>
<head>
<?php include('comp/header.php')?>
</head>
<script>
    const timezone = new Date().getTimezoneOffset()
    Highcharts.setOptions({
        time: {
            timezoneOffset: timezone
        }
    });

    function createtimeseries(c,d,device){
        Highcharts.chart(c, {
            chart: {
                type: 'area',
                height: 500
            },
            title: {
                text: "Device Name:" + device.data[0].device_name            
            },
            subtitle: {
                text: "Device ID:" + device.data[0].device_eui
            },
            xAxis: {
                type: 'datetime',
                title: {
                    text: 'Date'
                },
                visible: true
            },
            yAxis: {
                title: {
                    text: 'Water Level (mm)'
                },
                min: 0,
                visible: true
            },
            plotOptions: {
                series: {               
                    animation: false,
                    dataLabels: {
                        enabled: false,
                        style:{
                            fontSize: '18px',
                            fontWeight: 'thin',
                        },
                        
                    },
                },
            },
            series: [
                {
                    name: 'Water Level (mm)',
                    data: d
                },
            ]
        });
    };

    function addnewcard(header,size, number){
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
            newDiv2.className = "col-12"; 

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
    };  
    
    function sinewave(c,value,time){
        var d = [];
        var d2 = [];
        for (i=0;i<100;i++){
            d[i] = Math.sin(i/10)*5 + value;
            d2[i] = 500;
        }

        Highcharts.chart(c, {
            chart: {
                type: 'area',
                height: 500,
            },
            title: {
                text: value + " mm",
                style:{
                    fontSize: '24px',
                },           
            },
            subtitle: {
                text: time,
                style:{
                    fontSize: '18px',
                },
            },
            yAxis: {
                min: 0,
                max: 500,
            },
            tooltip:{
                enabled: false
            },
            plotOptions: {
                series: {               
                    dataLabels: {
                        enabled: false
                    },
                },
            },
            series: [{
                name: '',
                data: d2,
                color: 'rgba(198,198,198,0.1)'},
            {
                name: '',
                data: d,
                color: 'rgba(37,162,172,1)'
            },],
        });
    }
</script>
<body>
    <div class="wrapper">   
        <div class="main">
            <?php include('comp/nav.php')?>
            <main class="content">     
                <div class="row">       
                    <div id="head"></div>               
                    <script>   
                        var setnames = <?php echo json_encode($setnames,JSON_INVALID_UTF8_IGNORE); ?>;
                        var setvalues = <?php echo json_encode($setvalues,JSON_INVALID_UTF8_IGNORE); ?>;
                        var username = <?php echo json_encode($_SESSION['username'],JSON_INVALID_UTF8_IGNORE); ?>; 
                        var subset = findsubset(username,setvalues);
                    </script>

                    <script>                        
                        setarray = ["Water Level Indicator","Water Level History"];
                        gridsizes = [2,10];
                        number = [1,1];
                        var sensordata = JSON.parse($.ajax({
									url: 'server/sensecap.php',
									type: 'post',
									data: {call: "sensor"},
									dataType: 'html',
									context: document.body,
									global: false,
									async:false,								
									success: function(response){
										return response;
									}
                        }).responseText);	
                        console.log(sensordata);

                        var devicedata = JSON.parse($.ajax({
									url: 'server/sensecap.php',
									type: 'post',
									data: {call: "device"},
									dataType: 'html',
									context: document.body,
									global: false,
									async:false,								
									success: function(response){
										return response;
									}
                        }).responseText);	
                        console.log(devicedata);

                        var data = [];
                        var timestamp = [];
                        var norecords = sensordata.data.list[1][0].length;
                        for (let i=0;i<norecords;i++){
                            timestamp[i] = new Date(sensordata.data.list[1][0][norecords-i-1][1]).getTime();
                            data[i] = [timestamp[i],sensordata.data.list[1][0][norecords-i-1][0]*10];
                        }    
                        addnewcard(setarray[0],gridsizes[0],number[0]);  
                        addnewcard(setarray[1],gridsizes[1],number[1]);  
                        var tt = new Date(sensordata.data.list[1][0][0][1]).toLocaleString('en-US', { timeZone: 'Australia/Brisbane' })
                        sinewave(setarray[0] +  "body0",sensordata.data.list[1][0][0][0]*10, tt);
                        // indicator(setarray[0] +  "body0",sensordata.data.list[1][0][0][0]*10);                                               
                        createtimeseries(setarray[1] +  "body0",data,devicedata);
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