<?php include('comp/userauth.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php include('server/getwilam.php') ?>

<head>
<?php include('comp/header.php')?>
</head>
<script> 
function irrigchart(c,irrig){
    var d = [];
    var index = 0;
    for (let i=0;i<irrig.length;i++){
        dd = new Date(Date.UTC(irrig[i][0].substring(6,10),irrig[i][0].substring(3,5),irrig[i][0].substring(0,2),
        irrig[i][0].substring(11,13),irrig[i][0].substring(14,16)));
        var datestring= dd.toUTCString();
        if (isNaN(dd) == false){
            d[index] = [datestring,Number(irrig[i][1]),Number(irrig[i][2].substring(0,2)) + Number(irrig[i][2].substring(3,5)/60)]; 
            index ++;
        }

    }

    var newirrig = [];
    newirrig = d.sort(function(a,b){
        return new Date(a[0]) - new Date(b[0]);
    });

    var dateAndTimeArray = [];
    var data = [];
    var duration = [];
    for (let i=0;i<newirrig.length;i++){
        var datestring = new Date(newirrig[i][0]).getDate() + "/" + (new Date(newirrig[i][0]).getMonth() + 1) +
                                                 "/" + new Date(newirrig[i][0]).getFullYear() + " " + new Date(newirrig[i][0]).getHours() + ":" + new Date(newirrig[i][0]).getMinutes();        
        dateAndTimeArray[i] = datestring;
        data[i] = newirrig[i][1];
        duration[i] = newirrig[i][2];
    }    

    Highcharts.chart(c, {
        chart: {
            type: 'column',
        },
        title: {
            text: '',
        },
        yAxis: [
            {
                title: {
                    text: "Irrig Amount (mm)",
                },
                visible: true,
            },
            {
                title: {
                    text: "Duration (h)",
                },
                visible: true,
                opposite: true
            },
        ],
        xAxis: {
            title: {
                text: 'Date'
            },
            type: 'datetime',
            visible: true,
            categories: dateAndTimeArray,
            tickInterval: 4,
            labels: {
                formatter: function() {
                    return this.value.toString();
                },
            },
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
        legend:{
            enabled: true
        },
        series: [{
            name: "Irrigation Amount (mm)",
            data: data,
        },{
            name: "Duration (hour)",
            data: duration,
            yAxis: 1,
        }],


        });

}
function rainfallchart(c,rainfall){
    var dateAndTimeArray = [];
    var data = [];
    for (let i=0;i<rainfall.length;i++){
        dd = new Date(Date.UTC(rainfall[i][0].split("/")[2],rainfall[i][0].split("/")[0],rainfall[i][0].split("/")[1]));
        
        var utc= dd.toUTCString();
        var datestring = new Date(utc).getDate() + "/" + (new Date(utc).getMonth() + 1) +
                                                 "/" + new Date(utc).getFullYear();
        dateAndTimeArray[i] = datestring;
        data[i] = rainfall[i][1];
    }    
    Highcharts.chart(c, {
        chart: {
            type: 'column',
        },
        title: {
            text: '',
        },
        yAxis: [
            {
                title: {
                    text: "Rainfall (mm)",
                },
                visible: true,
            }
        ],
        xAxis: {
            title: {
                text: 'Date'
            },
            type: 'date',
            visible: true,
            categories: dateAndTimeArray,
            tickInterval: 4,
            labels: {
                formatter: function() {
                    return this.value.toString();
                },
            },
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
        legend:{
            enabled: true
        },
        series: [{
            name: "Rainfall (mm)",
            data: data,
        }],


        });

}
function sensorchart(c,sensor){
    var dateAndTimeArray = [];
    var data = [];
    var index = 0;
    for (let i=0;i<sensor.length;i++){
        if (sensor[i][1] != 0){
            year = sensor[i][0].split(" ")[0].split("/")[2];
            month = sensor[i][0].split(" ")[0].split("/")[0];
            date = sensor[i][0].split(" ")[0].split("/")[1];

            hour = sensor[i][0].split(" ")[1].split(":")[0];
            minute = sensor[i][0].split(" ")[1].split(":")[1];


            dd = new Date(Date.UTC(year,month,date,hour,minute));
            
            var utc= dd.toUTCString();
            var datestring = new Date(utc).getDate() + "/" + (new Date(utc).getMonth() + 1) +
                                                    "/" + new Date(utc).getFullYear()  + " " + new Date(utc).getHours() + ":" + new Date(utc).getMinutes();
            dateAndTimeArray[index] = datestring;
            data[index] = sensor[i][1];
            index ++;
        }
    }    
    Highcharts.chart(c, {
        chart: {
            type: 'line',
        },
        title: {
            text: '',
        },
        yAxis: [
            {
                title: {
                    text: "Sensor",
                },
                visible: true,
            }
        ],
        xAxis: {
            title: {
                text: 'Date'
            },
            type: 'date',
            visible: true,
            categories: dateAndTimeArray,
            tickInterval: 100,
            labels: {
                formatter: function() {
                    return this.value.toString();
                },
            },
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
        legend:{
            enabled: true
        },
        series: [{
            name: "Sensor",
            data: data,
        }],


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
                        // var wilmanames = <?php echo json_encode($wilmanames,JSON_INVALID_UTF8_IGNORE); ?>;
                        var valvenames = <?php echo json_encode($valvenames,JSON_INVALID_UTF8_IGNORE); ?>;
                        var valvevalues = <?php echo json_encode($valvevalues,JSON_INVALID_UTF8_IGNORE); ?>;
                        var rainfall = <?php echo json_encode($rainfall,JSON_INVALID_UTF8_IGNORE); ?>;
                        var sensor = <?php echo json_encode($sensor,JSON_INVALID_UTF8_IGNORE); ?>;
                        var sensornames = <?php echo json_encode($sensornames,JSON_INVALID_UTF8_IGNORE); ?>;
                        
                        var irrigation = [];
                        for (let i=0;i<valvevalues.length;i++){
                            irrigation[i] = [];
                            for (let j=0;j<Object.keys(valvevalues[i]).length;j++){
                                irrigation[i][j] = [];                               
                                irrigation[i][j][0] = Object.values(valvevalues[i])[j][1];
                                irrigation[i][j][1] = Object.values(valvevalues[i])[j][5];
                                irrigation[i][j][2] = Object.values(valvevalues[i])[j][3];
                            }
                        }               

                        var rainfalldata = [];
                        for (let i=0;i<rainfall.length;i++){
                            rainfalldata[i] = [];
                            rainfalldata[i][0] = rainfall[i][0];
                            rainfalldata[i][1] = Number(rainfall[i][1]);
                        } 
                        


                        for (let i=0;i<valvenames.length;i++){
                            addcard(valvenames[i],12,1);  
                            irrigchart(valvenames[i]+"body0",irrigation[i]);                
                        }  
                        addcard("rainfall",12,1);  
                        rainfallchart("rainfallbody0",rainfalldata); 
                        console.log(sensornames);
                        var sensordata = [];
                        
                        
                            
                        for (let j=2;j<sensornames.length;j++){
                            for (let i=0;i<sensor.length;i++){
                                sensordata[i] = [];
                                sensordata[i][0] = sensor[i][1];
                                sensordata[i][1] = Number(sensor[i][j]);
                            }
                            addcard(sensornames[j],12,1);  
                            sensorchart(sensornames[j] + "body0",sensordata); 
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