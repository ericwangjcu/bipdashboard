<?php include('comp/userauth.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php include('server/getwilam.php') ?>
<head>
<?php include('comp/header.php')?>
</head>
<script> 
function irrigchart1(c,irrig,rainfall){

    var index = 0;
    var d = [];
    for (let key in irrig) {
        d[index] = [];
        if (irrig.hasOwnProperty(key)) { // Check if the property belongs to the object itself
            d[index][0] = key;
            d[index][1] = irrig[key];
        }
        index ++;
    }

    var newirrig = [];
    newirrig = d.sort(function(a,b){
        return new Date(a[0]) - new Date(b[0]);
    });

    var dateAndTimeArray = [];
    var depth = [];
    for (let i=0;i<newirrig.length;i++){
        var datestring = new Date(newirrig[i][0]).getDate() + "/" + (new Date(newirrig[i][0]).getMonth() + 1) +
                                                 "/" + new Date(newirrig[i][0]).getFullYear();
        dateAndTimeArray[i] = datestring;
        depth[i] = newirrig[i][1];
    }        

    var index = 0;
    var startdate = new Date(newirrig[0][0]);
    var enddate = new Date(newirrig[newirrig.length-1][0]);
    // console.log(new Date(enddate));

    var newdateAndTimeArray = [];
    var newdateAndTimeArraystring = [];

    var newdepth = [];
    var newrainfall = [];
    
    for (let i=0;i<300;i++){
        newdateAndTimeArray[i] = new Date(startdate);
        newdateAndTimeArray[i].setDate(startdate.getDate() + i); 
        var datestring = newdateAndTimeArray[i].getDate() + "/" + (newdateAndTimeArray[i].getMonth() + 1) +
                                                 "/" + newdateAndTimeArray[i].getFullYear(); 
        newdateAndTimeArraystring[i] = datestring
        // console.log(newdateAndTimeArray[i]);
        if (newdateAndTimeArray[i].getTime() < new Date(enddate).getTime()){

            // console.log(newdateAndTimeArray[i]);
            newdepth[i] = 0;
            newrainfall[i] = 0;
            for (let j=0;j<newirrig.length;j++){
                // console.log(newdateAndTimeArray[i]);
                // console.log(new Date(newirrig[j][0]));
                if (newdateAndTimeArray[i].getTime() == new Date(newirrig[j][0]).getTime()){
                    newdepth[i] = newirrig[j][1];
                    // console.log(newirrig[j][1]);
                }
            } 
            for (let j=0;j<rainfall.length;j++){
                // console.log(rainfall[j][0]);
                // console.log(newdateAndTimeArray[i]);
                if (newdateAndTimeArray[i].getTime() == new Date(rainfall[j][0]).getTime()){
                    newrainfall[i] = rainfall[j][1];
                    // console.log(rainfall[j][1]);
                }
            } 
        }
    }
    // console.log(newrainfall);
    Highcharts.chart(c, {
        chart: {
            type: 'column',
        },
        title: {
            text: '',
        },
        yAxis:{
            title: {
                text: "mm",
            },
            visible: true,
        },
        xAxis: {
            title: {
                text: 'Date'
            },
            type: 'datetime',
            visible: true,
            categories: newdateAndTimeArraystring,
            tickInterval: 15,
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
            data: newrainfall,
        },{
            name: "Irrigation Amount (mm)",
            data: newdepth,
        }],


        });

}
// function irrigchart(c,irrig){
//     var d = [];
//     // var index = 0;
//     // console.log(irrig);
//     for (let i=0;i<irrig.length;i++){
//         d[i] = [irrig[i][0],Number(irrig[i][1]),Number(irrig[i][2].substring(0,2)) + Number(irrig[i][2].substring(3,5)/60),irrig[i][3]]; 
//     }

//     var newirrig = [];
//     newirrig = d.sort(function(a,b){
//         return new Date(a[0]) - new Date(b[0]);
//     });
//     // console.log(newirrig);

//     var dateAndTimeArray = [];
//     var data = [];
//     var duration = [];
//     for (let i=0;i<newirrig.length;i++){
//         var datestring = new Date(newirrig[i][0]).getDate() + "/" + (new Date(newirrig[i][0]).getMonth() + 1) +
//                                                  "/" + new Date(newirrig[i][0]).getFullYear() + " " + new Date(newirrig[i][0]).getHours() + ":" + new Date(newirrig[i][0]).getMinutes();        
//         dateAndTimeArray[i] = datestring;
//         data[i] = newirrig[i][1];
//         duration[i] = newirrig[i][2];
//     }    

//     Highcharts.chart(c, {
//         chart: {
//             type: 'column',
//         },
//         title: {
//             text: '',
//         },
//         yAxis: [
//             {
//                 title: {
//                     text: "Irrig Amount (mm)",
//                 },
//                 visible: true,
//             },
//             {
//                 title: {
//                     text: "Duration (h)",
//                 },
//                 visible: true,
//                 opposite: true
//             },
//         ],
//         xAxis: {
//             title: {
//                 text: 'Date'
//             },
//             type: 'datetime',
//             visible: true,
//             categories: dateAndTimeArray,
//             tickInterval: 4,
//             labels: {
//                 formatter: function() {
//                     return this.value.toString();
//                 },
//             },
//         },
//         plotOptions: {
//             series: {               
//                 animation: false,
//                 dataLabels: {
//                     enabled: false,
//                     style:{
//                         fontSize: '18px',
//                         fontWeight: 'thin',
//                     },
                    
//                 },
//             },
//         },
//         legend:{
//             enabled: true
//         },
//         series: [{
//             name: "Irrigation Amount (mm)",
//             data: data,
//         },{
//             name: "Duration (hour)",
//             data: duration,
//             yAxis: 1,
//         }],


//         });

// }
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
                        // console.log(valvevalues);
                        var irrigation = [];
                        for (let i=0;i<valvevalues.length;i++){
                            irrigation[i] = [];
                            var index = 0;
                            for (let j=0;j<Object.keys(valvevalues[i]).length;j++){
                                irrigation[i][index] = [];           
                                var tt = Object.values(valvevalues[i])[j][1];                          
                                var ttdatetime = new Date(Date.UTC(tt.substring(6,10),tt.substring(3,5),tt.substring(0,2),tt.substring(11,13),tt.substring(14,16))); 
                                var ttdate = new Date(Date.UTC(tt.substring(6,10),tt.substring(3,5),tt.substring(0,2)));    
   
                                if (isNaN(ttdate) == false){
                                    irrigation[i][index][0] = ttdatetime.toUTCString();
                                    irrigation[i][index][1] = Object.values(valvevalues[i])[j][5];
                                    irrigation[i][index][2] = Object.values(valvevalues[i])[j][3];
                                    irrigation[i][index][3] = ttdate.toUTCString();
                                    index ++;
                                }                    
                            }
                        }         
                        // console.log(irrigation);

                        function sumSecondValuesByFirstValue(arr) {
                            var result = {};

                            // Iterate over the array
                            for (var i = 0; i < arr.length; i++) {
                                var currentArray = arr[i];
                                var firstValue = currentArray[3];
                                var secondValue = Number(currentArray[1]);

                                // Add the second value to the corresponding first value in the result object
                                if (result[firstValue] === undefined) {
                                    result[firstValue] = secondValue;
                                } else {
                                    result[firstValue] += secondValue;
                                }
                            }

                            return result;
                        }

                        var irrigdepth = [];
                        for (let i=0;i<irrigation.length;i++){
                            irrigdepth[i] = sumSecondValuesByFirstValue(irrigation[i]);
                        }    

                        var irrigduration = [];
                        for (let i=0;i<irrigation.length;i++){
                            irrigduration[i] = [];
                            for (let j=0;j<irrigation[i].length;j++){
                                irrigduration[i][j] = [];
                                irrigduration[i][j][0] = irrigation[i][j][0];
                                irrigduration[i][j][1] = irrigation[i][j][2];
                            }
                        }      

                        // console.log(irrigduration);
                        console.log(irrigdepth);
                        var rainfalldata = [];
                        for (let i=0;i<rainfall.length;i++){
                            rainfalldata[i] = [];
                            var dd = new Date(Date.UTC(rainfall[i][0].split("/")[2],rainfall[i][0].split("/")[0],rainfall[i][0].split("/")[1]));
                            rainfalldata[i][0] = dd;
                            rainfalldata[i][1] = Number(rainfall[i][1]);
                        } 
                        
                        // console.log(rainfalldata);

                        for (let i=0;i<valvenames.length;i++){
                            addcard(valvenames[i],12,1);  
                            irrigchart1(valvenames[i]+"body0",irrigdepth[i],rainfalldata);                
                        }  
                        // addcard("rainfall",12,1);  
                        // rainfallchart("rainfallbody0",rainfalldata); 
                        // console.log(sensornames);
                        var sensordata = [];
                        
                        
                            
                        for (let j=2;j<sensornames.length;j++){
                            for (let i=0;i<sensor.length;i++){
                                sensordata[i] = [];
                                sensordata[i][0] = sensor[i][1];
                                sensordata[i][1] = Number(sensor[i][j]);
                            }
                            // addcard(sensornames[j],12,1);  
                            // sensorchart(sensornames[j] + "body0",sensordata); 
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