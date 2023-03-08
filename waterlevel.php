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

    function createtimeseries(c,d){
        Highcharts.chart(c, {
        chart: {
            type: 'spline'
        },
        title: {
            text: null
        },
        xAxis: {
            type: 'datetime',
            // dateTimeLabelFormats: { // don't display the year
            //     month: '%e. %b',
            //     year: '%b'
            // },
            title: {
                text: 'Date'
            },
            visible: true
        },
        yAxis: {
            title: {
                text: 'Water Level (cm)'
            },
            min: 0,
            visible: true
        },


        plotOptions: {
            series: {
                marker: {
                    enabled: true,
                    radius: 2.5
                }
            }
        },

        series: [
            {
                name: 'Water Level',
                data: d
            },
        ]
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
                        var units = ["","","ha"]
                        var size = [4,4,4];        
                        var setnames = <?php echo json_encode($setnames,JSON_INVALID_UTF8_IGNORE); ?>;
                        var setvalues = <?php echo json_encode($setvalues,JSON_INVALID_UTF8_IGNORE); ?>;
                        var username = <?php echo json_encode($_SESSION['username'],JSON_INVALID_UTF8_IGNORE); ?>; 
                        var farmcount = <?php echo json_encode($farmcount,JSON_INVALID_UTF8_IGNORE); ?>;
                        var subset = findsubset(username,setvalues);
                    </script>

                    <script>
                        
                        setarray = ["Water Level"];
                        types = [12];
                        gridsizes = [12];
                        number = [1];



                        var oldrecord = JSON.parse($.ajax({
									url: 'server/sensecap.php',
									type: 'post',
									data: {},
									dataType: 'html',
									context: document.body,
									global: false,
									async:false,								
									success: function(response){
										return response;
									}
                        }).responseText);	
                        console.log(oldrecord.data.list[1][0]);
                        // var value = [];
                        // var time = [];
                        var data = [];
                        var norecords = oldrecord.data.list[1][0].length;
                        for (let i=0;i<norecords;i++){
                            var timestamp = new Date(oldrecord.data.list[1][0][norecords-i-1][1]).getTime();
                            data[i] = [timestamp,oldrecord.data.list[1][0][norecords-i-1][0]];
                        }    
                        // console.log(value,time);
                        for (let i=0;i<setarray.length;i++){
                            addcard(setarray[i],gridsizes[i],number[i]);  
                            createtimeseries(setarray[i] +  "body0",data);                  
                            // addchart(setarray[i], types[i], setarray[i],i+1, intervals[i]); 
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