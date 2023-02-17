piecolors = ["#d03161", "#178a94", "#bfd8d1", "#ee8080", "#2b374b", "#a6d75b", "#c9e52f", "#d0ee11", "#f4f100"];

barcolors = ["#C4C4C4", "#00A5E3", "#48b5c4", "#1984c5", "#a6d75b", "#c9e52f", "#d0ee11", "#f4f100"];

Highcharts.setOptions({ colors: barcolors });
function stackedcolumn(c,dataset){

    Highcharts.chart(c, {
        chart: {
            type: 'bar',
            height: 75,            
            margin: [0,0,0,0]
        },
        title: {
            text: null
        },
        xAxis: {
            visible: false
        },
        yAxis: {
            visible: false

        },
        legend: {
            enabled: false
        },
        tooltip: {
            enabled: false
        },
        plotOptions: {
            series: {               
                // stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    formatter: function(){
                        return String(this.series.name + ": " + this.point.y);
                    },
                    style:{
                        fontSize: '12px',
                    },
                },
                animation: false
            },
        },
        series: dataset,
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
});

};

function createpiechart(c, d, e ,f, t,s,id,leg){
    var counts = {};
    for (const num of d) {
      counts[num] = counts[num] ? counts[num] + 1 : 1;
    }    
    const iterator = Object.keys(counts);      
  
    var dataset = [];
    var index = 0;
    var text1 = "CNT";
    var text2 = "Count"
    if (f != ""){
        text1 = f;
        text2 = f;
    }
    for (const key of iterator) {
      dataset[index] = {name: key,
              y: counts[key],
              z: 80,
              id: index.toString()};  
      index ++;
    }  
    
    
    new Highcharts.chart(c, {
    chart: {
        type: 'pie',
        height: s,
        style: {
            fontFamily: 'Poppins'
        },      
      
    },
    title: {
        text: null,
    },
    
    tooltip: {
        useHTML: true,
        headerFormat: '<span class="tooltipHeader">{point.key}</span>',
        pointFormat: '<br/> <div class="tooltipPointWrapper">'
        +
        '<span class="tooltipPoint">{point.y}</span>'
        +
        '<span class="tooltipValueSuffix"> </span></div>'
        +
        '<span class="tooltipLine"></span> <br/>'
        +
        '<span style="color:{point.color}">\u25CF</span> {series.name}',
        style: {
          color: '#fff'
        },
        valueDecimals: 0,
        backgroundColor: '#000',
        borderColor: '#000',
        borderRadius: 10,
        borderWidth: 3,
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            borderWidth: 6,
			borderColor: '#fff',     
            colors: piecolors,    
            size:  '70%',
            dataLabels: {
                enabled: true,
                formatter: function(){
                    var sn = this.point.name.length > 10 ? this.point.name.substring(0, 10) + '..' : this.point.name;
                    return String(sn + "<br>" + this.point.percentage.toFixed(0) + "%" + "<br>" + text2 + ": " + this.point.y);
                },
                distance: 5 + leg * 50,

                style:{
                  fontSize: '18px',
                  fontWeight: 'thin',
                },
            },
            showInLegend: true,
        },
        series: {
            colorByPoint: true,
            animation: false,
            point: {
                events: {
                    click: function () {
                        var newnames = ["1","District","Grower ID","Block ID", t];
                        const myArray = t.split(" ");
                        var databasename = [];
                        console.log(myArray);
                        for (let i=0;i<myArray.length;i++){
                            if (i < myArray.length - 1){
                                databasename += myArray[i].toLowerCase() + "_";
                            }else{
                                databasename += myArray[i].toLowerCase();
                            }
                            
                        }
                        var newvalues = [];
                        var index = 0;
                        for (let j=0;j<subset.length;j++){
                            if (subset[j][id] == this.name){
                                newvalues[index] = [];
                                newvalues[index][0] = "1";
                                newvalues[index][1] = subset[j][1];
                                newvalues[index][2] = subset[j][2];
                                newvalues[index][3] = subset[j][3];
                                newvalues[index][4] = subset[j][id];
                                index ++;
                            }

                        }
                        var element = document.getElementById("datatables-reponsive");
                        var element1 = document.getElementById("datatables-reponsive_wrapper");
                        if (element){
                            element.remove(); 
                            element1.remove(); 
                        }

                        createtable("datatable", newnames,  newvalues,"datatables-reponsive",0);
                        $("#datatables-reponsive").DataTable({
                            responsive: true,
                            "pageLength": 5,
                            "lengthChange": false,
                            "searching": false,
                            "info": true, 
                        });
                        $("#myModal").modal('show');
                    }
                }
            }
        }
    },
   
    legend: {
        layout: 'vertical',
        verticalAlign: 'middle',
        align: 'right',
        symbolRadius: 2,
        useHTML: true,
        enabled: leg,
        labelFormatter: function() {
          var shortname = this.name.length > 10 ? this.name.substring(0, 10) + '..' : this.name;
          if (this.name === t) {
            return `<span style="min-width: 200px; display:inline-block; border-bottom: 1px solid #b2b2b2;">
                        <span style="float:left; font-size:16px;">${this.name}</span></span>
                    <span style="min-width: 80px; display:inline-block; border-bottom: 1px solid #b2b2b2;">
                        <span style="float:left; font-size:16px;">${text1}</span>
                        <span style="float:right; font-size:16px;">%</span>
                    </span>`
          }
          return `<span style="min-width: 200px; display:inline-block; border-bottom: 1px solid #ccc;">
          <span style="float:left; font-size:16px; font-weight:normal" >${shortname}</span></span>
          <span style="min-width: 80px; display:inline-block; border-bottom: 1px solid #ccc;">
          <span style="float:left; font-size:16px;">${this.y}</span>
          <span style="float:right; font-size:16px;">${(this.y * 100 / this.total).toFixed(0)}</span>
          </span>`
        }
      },
    
    series: [{
        
        center: [10000, 10000],
        data: [{
          name: t,
          y: 0,
        }, ]
      },{
        name: t,
        minPointSize: 10,
        innerSize: '60%',
        zMin: 0, 
        keys: ['name', 'y', 'z', 'id'],
        data: dataset
    },{
        center: [10000, 10000],
        data: [{
          name: "Total",
          y: d.length,
        }, ]
      }],
    credits: {
      enabled: false
      },
      exporting: {
          enabled: false
      },
      responsive: {
        rules: [{
            condition: {
                maxWidth: 300
            },
            chartOptions: {
                legend: {
                    enabled: leg,
                    layout: 'center',
                    verticalAlign: 'bottom',
                    align: 'center',
                    symbolRadius: 2,
                    useHTML: true,
                    enabled: true,
                    labelFormatter: function() {
                      var shortname = this.name.length > 10 ? this.name.substring(0, 10) + '..' : this.name;
                      if (this.name === t) {
                        return `<span style="min-width: 200px; display:inline-block; border-bottom: 1px solid #b2b2b2;">
                                    <span style="float:left; font-size:16px;">${this.name}</span></span>
                                <span style="min-width: 80px; display:inline-block; border-bottom: 1px solid #b2b2b2;">
                                    <span style="float:left; font-size:16px;">${text1}</span>
                                    <span style="float:right; font-size:16px;">%</span>
                                </span>`
                      }
                      return `<span style="min-width: 200px; display:inline-block; border-bottom: 1px solid #ccc;">
                      <span style="float:left; font-size:16px; font-weight:normal" >${shortname}</span></span>
                      <span style="min-width: 80px; display:inline-block; border-bottom: 1px solid #ccc;">
                      <span style="float:left; font-size:16px;">${this.y}</span>
                      <span style="float:right; font-size:16px;">${(this.y * 100 / this.total).toFixed(0)}</span>
                      </span>`
                    }
                  },
                yAxis: {
                    labels: {
                        align: 'left',
                        x: 0,
                        y: -5
                    },
                    title: {
                        text: null
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        borderWidth: 8,
                        borderColor: '#fff',    
                        dataLabels: {
                            enabled: false,
                            formatter: function(){
                                var sn = this.point.name.length > 10 ? this.point.name.substring(0, 10) + '..' : this.point.name;
                                return String(sn + "<br>" + this.point.percentage.toFixed(0) + "%" + "<br>" + text2 + ": " + this.point.y);
                            },

                            style:{
                              fontSize: '16px',
                              fontWeight: 'thin',
                            },
                        },
                        showInLegend: true,
                    },
                    series: {
                        colorByPoint: true,
                        animation: false
                    }
                },
                subtitle: {
                    text: null
                },
                credits: {
                    enabled: false
                }
            }
        }]
    }

  });
  
};
function createbarcharts(c, d, e ,f, t,s,id){
    var counts = {};
    for (const num of d) {
      counts[num] = counts[num] ? counts[num] + 1 : 1;
    }    
    const iterator = Object.keys(counts);      
  
    var dataset = [];
    var cat = [];
    var index = 0;

    keysSorted = Object.keys(counts).sort(function(a,b){return counts[b] - counts[a]})

    for (const key of keysSorted) {
        cat[index] = key;
        dataset[index] = counts[key];  
        index ++;
    }  

    var maxheight = Math.max.apply(Math, dataset);
    var minheight = Math.min.apply(Math, dataset);

    for (let i = 0; i < dataset.length; i++){
        if (dataset[i] == maxheight){
            dataset[i] = {y: dataset[i], color: '#45b6fe'};
        }
        if (dataset[i] == minheight){
            dataset[i] = {y: dataset[i], color: '#FF5768'};
        }
    }

    Highcharts.chart(c, {
        chart: {
            type: 'bar',
            height: s,
        },
        title: {
            text: null,
            align: 'left'
        },
    
        xAxis: {
            categories: cat,
            title: {
                text: null
            },
            labels: {
                style: {
                    fontSize: '16px'
                }
            }
           
        },
        yAxis: {
            title: {
                text: null,
                align: 'high'
            },
            visible: false
        }, 
        tooltip: {
            useHTML: true,
            headerFormat: '<span class="tooltipHeader">{point.key}</span>',
            pointFormat: '<br/> <div class="tooltipPointWrapper">'
            +
            '<span class="tooltipPoint">{point.y}</span>'
            +
            '<span class="tooltipValueSuffix"> </span></div>'
            +
            '<span class="tooltipLine"></span> <br/>'
            +
            '<span style="color:{point.color}">\u25CF</span> {series.name}',
            style: {
              color: '#fff'
            },
            valueDecimals: 0,
            backgroundColor: '#000',
            borderColor: '#000',
            borderRadius: 10,
            borderWidth: 3,
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true,
                    style: {
                        fontSize: '16px'
                    }
                },
                pointWidth: $(this).height() / (4*dataset.length),
                // pointWidth: [20,30,40,30,30,10],

            },
            series:{
                animation: false,
                point: {
                    events: {
                        click: function () {
                            var name = t;    
                            var newnames = ["1","District","Grower ID","Block ID", name];

                            var newvalues = [];                                                                                
                            var index = 0;
                            for (let j=0;j<subset.length;j++){  
                                // console.log(cat[this.x]);
                                if (subset[j][id] == cat[this.x]){
                                    console.log(subset[j][id]);
                                    console.log(j);
                                    newvalues[index] = [];
                                    newvalues[index][0] = "1";
                                    newvalues[index][1] = subset[j][1];
                                    newvalues[index][2] = subset[j][2];
                                    newvalues[index][3] = subset[j][3];
                                    newvalues[index][4] = subset[j][id];
                                    index ++;
                                }

                            }
                            console.log(newvalues);

                            var element = document.getElementById("datatables-reponsive");
                            var element1 = document.getElementById("datatables-reponsive_wrapper");
                            if (element){
                                element.remove(); 
                                element1.remove(); 
                            }    
                            createtable("datatable", newnames,  newvalues,"datatables-reponsive",0);
                            $("#datatables-reponsive").DataTable({
                                responsive: true,
                                "pageLength": 5,
                                "lengthChange": false,
                                "searching": false,
                                "info": true, 
                            });
                            $("#myModal").modal('show');
                        }
                    }
                }
            }
        },
        credits: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
        legend: {
            enabled: false
        },
        series: [{
            // dataSorting: {
            //     enabled: true
            // },
            data: dataset
        }]
    });

    
}
function createbasicbar(c, d, e, f, t, xt, s, id){
    var m1 = Math.max.apply(Math, d);
    var m2 = Math.min.apply(Math, d);
    var range = m1 - m2;
    var number = 10;
    var dist = range / number;
    var cat = [];
    var catstr = [];
    var fix = 0;
    if (xt == 0.1){
         fix = 1;
    }



    for (let i = 0; i < number; i++){
        cat[i] = m2 + dist * (i);     
    }

    var count = [];
    var index = 0;
    
    for (let i = 0; i < number; i++){
        var cc = 0;

        for (let j = 0; j < d.length; j++){
            if (d[j] > cat[index] && d[j] <= cat[index+1])
            {
                cc ++;
            }
        }    
        if (cc != 0){
            count[index] = cc;
            index ++;
        }         
    }
    console.log(count);

    for (let i = 0; i < cat.length; i++){
        // cat[i] = m2 + dist * (i);
        var text1 = "";
        var text2 = "";
        if (i > 0 && i <= 1){
            text1 = (cat[i-1]).toFixed(1).toString();
            text2 = cat[i].toFixed(1).toString();
        } 
        if (i > 1){
            text1 = (cat[i-1] + xt).toFixed(1).toString();
            text2 = cat[i].toFixed(1).toString();
        }   
        if (fix == 1){
            catstr[i-1] = text1 + "-" + text2;
        }
        if (fix == 0){
            catstr[i-1] = text1.substring(0,text1.length-2) + "-" + text2.substring(0,text2.length-2);
        }
    }

    var dataset = [];
    var maxheight = Math.max.apply(Math, count);
    var minheight = Math.min.apply(null, count.filter(Boolean));

    // var minheight = Math.min.apply(Math, count);

    for (let i = 0; i < count.length; i++){
        dataset[i] = count[i];
        if (count[i] == maxheight){
            dataset[i] = {y: count[i], color: '#45b6fe'};
        }
        if (count[i] == minheight){
            dataset[i] = {y: count[i], color: '#FF5768'};
        }
    }

    Highcharts.chart(c, {
        chart: {
            type: 'column',
            style: {
            fontSize: '16px'
            },
            style: {
                fontFamily: 'Poppins'
            },               
            height: s, 
        },
        title: {
            text: null,
            align: 'left',
            style: {
            fontSize: '20px'
        }
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: catstr,
            crosshair: true,
            title: {
                text: null,
                style: {
                    fontSize: '16px'
                },
            },            
            labels: {
                style: {
                    fontSize: '16px'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Count',
                style: {
                    fontSize: '16px'
                }
            },
            labels: {
                style: {
                    fontSize: '16px'
                }
            },
            visible: false           
        },
        tooltip: {
            useHTML: true,
            headerFormat: '<span class="tooltipHeader">{point.key}</span>',
            pointFormat: '<br/> <div class="tooltipPointWrapper">'
            +
            '<span class="tooltipPoint">{point.y}</span>'
            +
            '<span class="tooltipValueSuffix"> </span></div>'
            +
            '<span class="tooltipLine"></span> <br/>'
            +
            '<span style="color:{point.color}">\u25CF</span> {series.name}',
            style: {
              color: '#fff'
            },
            valueDecimals: 0,
            backgroundColor: '#000',
            borderColor: '#000',
            borderRadius: 10,
            borderWidth: 3,
        },        
        plotOptions: {
            series: {
                borderWidth: 0,
                pointWidth: $(this).height() / (35),
                colors: ['#B4B4B4'],  
                dataLabels: {
                    enabled: true,
                    shadow: true,                       
                    style: {
                        fontSize: '16px',
                        fontWeight: 'thin',
                    },                    
                },
                animation: false,
                point: {
                    events: {
                        click: function () {
                            var name = t;    
                            var newnames = ["1","District","Grower ID","Block ID", name];
                            const myArray = t.split(" ");
                            var databasename = [];                            
                            for (let i=0;i<myArray.length;i++){
                                if (i < myArray.length - 1){
                                    databasename += myArray[i].toLowerCase() + "_";
                                }else{
                                    databasename += myArray[i].toLowerCase();
                                }
                                
                            }    
                            var newvalues = [];                                                                                
                            var index = 0;
                            // console.log(id);
                            for (let j=0;j<subset.length;j++){ 
                                if (id == 27){
                                    subset[j][id] = Number(subset[j][id]) * 100;
                                    // console.log(subset[j][id]);
                                }
                                if (Number(subset[j][id]) >= cat[this.x] && Number(subset[j][id]) <= cat[this.x +1]){
                                    newvalues[index] = [];
                                    newvalues[index][0] = "1";
                                    newvalues[index][1] = subset[j][1];
                                    newvalues[index][2] = subset[j][2];
                                    newvalues[index][3] = subset[j][3];
                                    newvalues[index][4] = subset[j][id];
                                    index ++;
                                }

                            }
                            var element = document.getElementById("datatables-reponsive");
                            var element1 = document.getElementById("datatables-reponsive_wrapper");
                            if (element){
                                element.remove(); 
                                element1.remove(); 
                            }    
                            createtable("datatable", newnames,  newvalues,"datatables-reponsive",0);
                            $("#datatables-reponsive").DataTable({
                                responsive: true,
                                "pageLength": 5,
                                "lengthChange": false,
                                "searching": false,
                                "info": true, 
                            });
                            $("#myModal").modal('show');
                        }
                    }
                }
            },
        },
        legend: {
            enabled: false
        },
        series: [{
            colorByPoint: true,
            name: t,
            data: dataset              
        }],
        exporting: {
            enabled: false
        },
        credits: {
            enabled: false
        },
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    title: {
                        text: null,
                    },
                    yAxis: {
                        labels: {
                            enabled: true
                        },
                        title:{
                            text: null
                        }
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            pointWidth: 12,
                        }
                    },
                    xAxis: {
                        labels: {
                            style: {
                                fontSize: '20px'
                            }
                        } 
                    },
                }
            }]
        }

    });
};
function createline(c, x, y, xname, yname, yunits, s){

    var data = [];
    var dy = [];
    for (let i=0;i<y.length;i++){
        dy[i] = [];
    }
    
    for (let i=0;i<y.length;i++){
        data[i] = [];
        for (let j = 0; j < x.length; j++){
            data[i][j] = [x[j],y[i][j]];
        }
        
    }

    function regression(arrWeight, arrHeight) {
        let r, sy, sx, b, a, meanX, meanY;
        r = jStat.corrcoeff(arrHeight, arrWeight);
        sy = jStat.stdev(arrWeight);
        sx = jStat.stdev(arrHeight);
        meanY = jStat(arrWeight).mean();
        meanX = jStat(arrHeight).mean();
        b = r * (sy / sx);
        a = meanY - meanX * b;
        
        let y1, y2, x1, x2;
        x1 = jStat.min(arrHeight);
        x2 = jStat.max(arrHeight);
        y1 = a + b * x1;
        y2 = a + b * x2;
        return [
            [x1, y1],
            [x2, y2]
          ];
    };

    var seriesdata = [];
    for (let i=0;i<y.length;i++){
        seriesdata[i*2] = {type: 'scatter',
            name: yname[i],  
            data: data[i],
            yAxis: i,
            animation: false};
    }
    var line = [];
    for (let i=0;i<y.length;i++){
        line[i] = regression(y[i], x);

        seriesdata[i*2 + 1] = {type: 'line',
            name: yname[i] + " Regression",  
            data: line[i],
            yAxis: i,
            animation: false};
    }

    var axisdata = [];
    for (let i=0;i<y.length;i++){
        axisdata[i] = {
            title: { text: yunits[i],
            style: {
                fontSize: '16px'
            }},
            labels: {
                style: {
                    fontSize: '16px'
                }
            },
            top: (0.26 * i + 0.05) * s , 
            height: 0.26 * s,
            offset: 0,
        };
    }


    Highcharts.chart(c, {
        chart: {
            height: s, 
            style: {
                fontFamily: 'Poppins'
            },               
        },
        title: {
            text: ''
        },    
        series: seriesdata,
        yAxis: axisdata,
        xAxis: {
            title: { text: xname,
            style: {
                fontSize: '16px'
            }},
            labels: {
                style: {
                    fontSize: '16px'
                }
            }
        },
        exporting: {
            enabled: false
        },
        credits: {
            enabled: false
        }
      });
      
    
};
function createnewcomparison(c,x,y,yname,yunits,height){  
    var seriesdata = [];
    for (let i=0; i<x.length;i++){
        seriesdata[i] = {
            name: x[i],
            pointWidth: 40,
            data: [
                y[i]
            ],
            animation: false
        }
    }

    Highcharts.chart(c, {

        chart: {
            type: 'boxplot',
            style: {
                fontFamily: 'Poppins'
            },   
            height: height, 
        },
    
        title: {
            text: yname
        },
    
        legend: {
            enabled: false
        },
    
        xAxis: {
            categories: [""],
            labels: {
                style: {
                    fontSize: '16px'
                },
                enabled: false
            } 
        },
    
        yAxis: {
            title: {
                text: yunits,style: {
                    fontSize: '16px'
                }
            },labels: {
                style: {
                    fontSize: '16px'
                }
            } 
        },
        plotOptions: {
            boxplot: {
                lineWidth: 3,
                colors: barcolors,  

            },
        },      
        

        series: seriesdata,
        exporting: {
            enabled: false
        },
        credits: {
            enabled: false
        },
        legend: {
            enabled: true
        },
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    yAxis: {
                        labels: {
                            enabled: true
                        },
                        title:{
                            text: null
                        }
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            pointWidth: 12,
                        }
                    },
                    xAxis: {
                        labels: {
                            style: {
                                fontSize: '10px'
                            }
                        } 
                    },
                }
            }]
        }
    
    });
};
function createstackedbars(c,x,y,t,ss){
    var counts = {};
    for (const num of x) {
        counts[num] = counts[num] ? counts[num] + 1 : 1;
    }    
    const iterator = Object.keys(counts);
    
    var counts = {};
    for (const num of y) {
        counts[num] = counts[num] ? counts[num] + 1 : 1;
    }    
    const iterator1 = Object.keys(counts);

    var percentage = [];
    for (let i=0;i<iterator.length;i++){
        percentage[i] = [];
        for (let j=0;j<iterator1.length;j++){
            percentage[i][j] = 0;
            for (let k=0;k<x.length;k++){
                if (x[k] == iterator[i] && y[k] == iterator1[j]){
                    percentage[i][j] ++;
                }
            }
        }
    }

    var seriesdata = [];
    for (let j=0;j<iterator.length;j++){
        seriesdata[j] = {
            name: iterator[j],
            data: percentage[j]           
        }
    } 

    Highcharts.chart(c, {
        chart: {
            type: 'column',
            style: {
                fontFamily: 'Poppins'
            },   
            height: ss,     
        },
        title: {
            text: t,
        },
        xAxis: {
            categories: iterator1,
            labels: {
                style: {
                    fontSize: '16px'
                },
                enabled: true
            } 
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total',
                style:{
                    fontSize: '16px'
                  }
            },
            labels: {
                style: {
                    fontSize: '16px'
                },
                enabled: true
            } 
        },
        tooltip: {
            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
            shared: true
        },
        plotOptions: {
            column: {
                stacking: 'percent',
                

            },
            colors: barcolors,  
            dataLabels: {
                enabled: true,								
                color: 'white'
            }
        },
        series: seriesdata,
        exporting: {
            enabled: false
        },
        credits: {
            enabled: false
        },
        legend: {
            enabled: true
        },
        
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    yAxis: {
                        labels: {
                            enabled: true
                        },
                        title:{
                            text: null
                        }
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            pointWidth: 12,
                        }
                    },
                    xAxis: {
                        labels: {
                            style: {
                                fontSize: '10px'
                            }
                        } 
                    },
                }
            }]
        }
    });

};
function createtime(c,d,short,h, id){
    var counts = {};
    for (const num of d) {
      counts[num] = counts[num] ? counts[num] + 1 : 1;
    }    
    const iterator = Object.keys(counts);      
  
    var dataset = [];
    var index = 0;

    

    for (const key of iterator) {
    const myArray = key.split("-");
      dataset[index] = [Date.UTC(myArray[0], myArray[1], myArray[2]),counts[key]];  
      index ++;
    } 
    dataset.sort((a, b) => a[0] - b[0]);

    // console.log(dataset);

    Highcharts.chart(c, {


    
        chart:{
            height: h,
            type: 'column'
        },
        title: {
            text: null,
        },
        yAxis: {
            visible: false
        },
        xAxis: {
            type: 'datetime',
            title: {
                text: null,
            },
            labels: {
                style: {
                    fontSize: '20px',
                }
            }
        },  
        plotOptions: {
            series: {
                pointWidth: $(this).width() / (300),
                dataLabels: {
                    enabled: true,
                    style: {
                        fontSize: '16px'
                    }
                },
                marker: {
                    enabled: true,
                    states: {
                        hover: {
                            enabled: false
                        }
                    }
                }
            }
        },

        legend:{
            enabled: false
        },
        series: [{
            data: dataset,
            // dataSorting: {
            //     enabled: true,
            //     sortKey: 'value'
            // },
        }],
        exporting: {
            enabled: false
        },
        credits: {
            enabled: false
        },
    
    }); 
};
function createnewline(c,d,short,h, id){
    for (let i=0;i<d.length;i++){
        d[i] = Math.round(d[i]);
    }

    var counts = {};
    for (const num of d) {
      counts[num] = counts[num] ? counts[num] + 1 : 1;
    }    
    const iterator = Object.keys(counts);      
  
    var dataset = [];
    var index = 0;

    // var maxheight = Math.max.apply(Math, counts);
    // console.log(maxheight);
    // // for (let i = 0; i < dataset.length; i++){
    // //     if (dataset[i] == maxheight){
    // //         dataset[i] = {y: dataset[i], color: '#45b6fe'};
    // //     }
    // // }
    // keysSorted = Object.keys(counts).sort(function(a,b){return counts[b] - counts[a]})

    // console.log(dataset);

    for (const key of iterator) {
        dataset[index] = counts[key];  
        index ++;
    } 
    var maxheight = Math.max.apply(Math, dataset);

    var dataset = [];
    var index = 0;
    for (const key of iterator) {
        // var value = Math.floor(Number(key));
      dataset[index] = {x: Number(key),y: counts[key]};  
      if (counts[key] == maxheight){
            dataset[index] = {x: Number(key),y: counts[key], color: '#45b6fe'};  
        }
      index ++;
    } 

    Highcharts.chart(c, {


    
        chart:{
            height: h,
            type: 'spline'
        },
        title: {
            text: null,
        },
        yAxis: {
            title: {
                text: "No. of Sets",
                style: {
                    fontSize: '20px',
                }
            },
            labels: {
                style: {
                    fontSize: '16px',
                }
            },
            gridLineColor: 'transparent',
        },
        xAxis: {
            title: {
                text: short,
                style: {
                    fontSize: '20px',
                }
            },
            labels: {
                style: {
                    fontSize: '20px',
                }
            },
            tickInterval: 1
        },  
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    style: {
                        fontSize: '16px'
                    }
                },
                marker: {
                    enabled: true,
                    states: {
                        hover: {
                            enabled: false
                        }
                    }
                },
                animation: false,
                point: {
                    events: {
                        click: function () {
                            var name = short;    
                            var newnames = ["1","District","Grower ID","Block ID", name];

                            var newvalues = [];                                                                                
                            var index = 0;
                            for (let j=0;j<subset.length;j++){  
                                // console.log(cat[this.x]);
                                if (subset[j][id] == this.x){
                                    console.log(subset[j][id]);
                                    console.log(j);
                                    newvalues[index] = [];
                                    newvalues[index][0] = "1";
                                    newvalues[index][1] = subset[j][1];
                                    newvalues[index][2] = subset[j][2];
                                    newvalues[index][3] = subset[j][3];
                                    newvalues[index][4] = subset[j][id];
                                    index ++;
                                }

                            }
                            console.log(newvalues);

                            var element = document.getElementById("datatables-reponsive");
                            var element1 = document.getElementById("datatables-reponsive_wrapper");
                            if (element){
                                element.remove(); 
                                element1.remove(); 
                            }    
                            createtable("datatable", newnames,  newvalues,"datatables-reponsive",0);
                            $("#datatables-reponsive").DataTable({
                                responsive: true,
                                "pageLength": 5,
                                "lengthChange": false,
                                "searching": false,
                                "info": true, 
                            });
                            $("#myModal").modal('show');
                        }
                    }
                }
            }

        },
        tooltip: {
            useHTML: true,
            headerFormat: '<span class="tooltipHeader">{point.key}</span>',
            pointFormat: '<br/> <div class="tooltipPointWrapper">'
            +
            '<span class="tooltipPoint">{point.y}</span>'
            +
            '<span class="tooltipValueSuffix"> </span></div>'
            +
            '<span class="tooltipLine"></span> <br/>'
            +
            '<span style="color:{point.color}">\u25CF</span> {series.name}',
            style: {
              color: '#fff'
            },
            valueDecimals: 0,
            backgroundColor: '#000',
            borderColor: '#000',
            borderRadius: 10,
            borderWidth: 3,
        },   
        legend:{
            enabled: false
        },
        series: [{
            name: short,
            data: dataset,
            // dataSorting: {
            //     enabled: true,
            //     sortKey: 'value'
            // },
            marker: {
                radius: 6
            },
            lineWidth: 4
        }],
        exporting: {
            enabled: false
        },
        credits: {
            enabled: false
        },
    
    }); 
};
