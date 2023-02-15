<?php include('comp/userauth.php') ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('comp/header.php')?>
    </head>  
    <body>
        <div class="wrapper">   
            <div class="main">
                <?php include('comp/nav.php')?>

                
                <main class="content">  
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class = "card-text h2">Irrigation Evaluation</div>
                                    </br>
                                    <div class = "card-text h4">This page is used to show the benchmark of the irrigation practice from the water perspective on a farm. It also display the benchmark of individual compoenents of an irrigation event, including area, flow rate and duration, which can be used to observe the relationship bettween them and an irrigation event.</div>
                                    <!-- <hr style="height:2px; width:50%"> -->
                                    </br>
                                    <p class="mb-0 h4">The formulas used are shown below.</p>
                                    </br>
                                    <div class = "row">
                                        <div class="col-12">
                                            <p class="mb-0 h4 ">Total ML per Farm =  Sum of Total ML per Set.</p>
                                            <p class="mb-0 h4">Total ML per Set =  Duration * Total Flow Rate * 3600 / 1000000.</p>
                                            <p class="mb-0 h4">Total mm per Set =  Total ML per Set * 100 / Set Area.</p>
                                            <p class="mb-0 h4">Avg mm =  Sum of Total mm per Set / Number of Sets.</p>
                                            <p class="mb-0 h4">Avg area =  Sum of Total Set Area / Number of Sets.</p>
                                            <p class="mb-0 h4">Avg Flow Rate =  Sum of Total Flow Rate / Number of Sets.</p>
                                            <p class="mb-0 h4">Avg Duration =  Sum of Total Duration / Number of Sets.</p>
                                        </div>  
                                        <div class="col-6">
                                            <div class = "row">
                                                <div class="col-6">
                                                    <div id="container-speed" class="chart-container"></div>
                                                </div>
                                                <div class="col-6">
                                                    <div id="container-speed0" class="chart-container"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class = "row">
                                                <div class="col-3">
                                                    <div id="container-speed1" class="chart-container"></div>
                                                </div>
                                                <div class="col-3">
                                                    <div id="container-speed2" class="chart-container"></div>
                                                </div>
                                                <div class="col-3">
                                                    <div id="container-speed3" class="chart-container"></div>
                                                </div>
                                                <div class="col-3">
                                                    <div id="container-speed4" class="chart-container"></div>
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
        <script>
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
                            [0.3, '#DF5353'], // red
                            [0.6, '#DDDF0D'], // yellow
                            [0.9, '#55BF3B']                            
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
                            [0.3, '#DF5353'], // red
                            [0.6, '#DDDF0D'], // yellow
                            [0.9, '#55BF3B']                            
                        ],
                    };
                    var distance = 50;                     
                    var titledistance = 80;                  
         
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
                            backgroundColor: Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0.2).get(),
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
            creategauge("container-speed",1,20,"Total ML");
            creategauge("container-speed0",1,30,"Avg mm");
            creategauge("container-speed1",2,40,"Total Area");
            creategauge("container-speed2",2,40,"Avg Area");
            creategauge("container-speed3",2,50,"Avg Flow Rate");
            creategauge("container-speed4",2,60,"Avg Duration");
        </script> 
    </body>

</html>