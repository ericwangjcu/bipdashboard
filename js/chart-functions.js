piecolors = ["#d03161", "#178a94", "#bfd8d1", "#ee8080", "#2b374b", "#a6d75b", "#c9e52f", "#d0ee11", "#f4f100"];

barcolors = ["#C4C4C4", "#00A5E3", "#48b5c4", "#1984c5", "#a6d75b", "#c9e52f", "#d0ee11", "#f4f100"];

Highcharts.setOptions({ colors: barcolors });

function clickshowmodalscatter(tx, ty, compx, compy, idx, idy){
    var newnames = ["1","District","Grower ID","Grower Block ID", tx, ty];

    console.log(tx, ty, compx, compy, idx, idy);

    var newvalues = [];                                                                                
    var index = 0;
    for (let j=0;j<subset.length;j++){    
        if (Number(subset[j][idx]) == compx && Number(subset[j][idy]) == compy){
            newvalues[index] = [];
            newvalues[index][0] = "1";
            newvalues[index][1] = subset[j][1];
            newvalues[index][2] = subset[j][2];
            newvalues[index][3] = subset[j][4];
            newvalues[index][4] = subset[j][idx];
            newvalues[index][5] = subset[j][idy];
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
        "pageLength": 10,
        "lengthChange": false,
        "searching": false,
        "info": true, 
    });
    $("#myModal").modal('show');
};

function clickshowmodal(t, comp, comp2, type, id){
    var newnames = ["1","District","Grower ID","Grower Block ID", "Area (ha)", t];

    console.log(t, comp, comp2, type, id);

    var newvalues = [];                                                                                
    var index = 0;
    for (let j=0;j<subset.length;j++){    
        var match = 0;
        if (type == 1){
            if (subset[j][id] == comp){
                match = 1;
            }
        }else{
            if (id == 27){
                subset[j][id] = Number(subset[j][id]) * 100;
            }
            if (Number(subset[j][id]) >= comp && Number(subset[j][id]) <= comp2){
                match = 1;
            }
        }
        if (match == 1){
            newvalues[index] = [];
            newvalues[index][0] = "1";
            newvalues[index][1] = subset[j][1];
            newvalues[index][2] = subset[j][2];
            newvalues[index][3] = subset[j][4];
            newvalues[index][4] = subset[j][14];
            newvalues[index][5] = subset[j][id];
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
        "pageLength": 10,
        "lengthChange": false,
        "searching": false,
        "info": true, 
    });
    $("#myModal").modal('show');
};
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
    var text1 = "No.";
    var text2 = "No."
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
        colors: ['#01BAF2','#71BF45', '#FAA74B', '#B37CD2','#F8362E','#FFF200','#C4C4C4','#000000'],
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
        '<span class="tooltipPoint">{point.y}/{point.percentage:.1f}%</span>'
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
            // colors: piecolors,    
            size:  '70%',
            dataLabels: {
                enabled: true,
                format: '{point.name}: {point.percentage:.1f} %',
                                style:{
                  fontSize: '14px',
                  fontWeight: 'thin',
                },
                // distance: 20 + leg * 50,
            },
            showInLegend: true,
            
            // dataLabels: {
            //     enabled: true,
            //     formatter: function(){
            //         var sn = this.point.name.length > 10 ? this.point.name.substring(0, 10) + '..' : this.point.name;
            //         return String(sn + "<br>" + this.point.percentage.toFixed(0) + "%" + "<br>" + text2 + ": " + this.point.y);
            //     },
            //     distance: 5 + leg * 50,

            //     style:{
            //       fontSize: '18px',
            //       fontWeight: 'thin',
            //     },
            // },
            // showInLegend: true,
        },
        series: {
            colorByPoint: true,
            animation: false,
            point: {
                events: {
                    click: function () {
                        clickshowmodal(t,this.name,"",1,id);
                    }
                }
            }
        }
    },
   
    // legend: {
    //     layout: 'vertical',
    //     verticalAlign: 'middle',
    //     align: 'right',
    //     symbolRadius: 2,
    //     useHTML: true,
    //     enabled: leg,
    //     labelFormatter: function() {
    //       var shortname = this.name.length > 10 ? this.name.substring(0, 10) + '..' : this.name;
    //       if (this.name === t) {
    //         return `<span style="min-width: 200px; display:inline-block; border-bottom: 1px solid #b2b2b2;">
    //                     <span style="float:left; font-size:16px;">${this.name}</span></span>
    //                 <span style="min-width: 80px; display:inline-block; border-bottom: 1px solid #b2b2b2;">
    //                     <span style="float:left; font-size:16px;">${text1}</span>
    //                     <span style="float:right; font-size:16px;">%</span>
    //                 </span>`
    //       }
    //       return `<span style="min-width: 200px; display:inline-block; border-bottom: 1px solid #ccc;">
    //       <span style="float:left; font-size:16px; font-weight:normal" >${shortname}</span></span>
    //       <span style="min-width: 80px; display:inline-block; border-bottom: 1px solid #ccc;">
    //       <span style="float:left; font-size:16px;">${this.y}</span>
    //       <span style="float:right; font-size:16px;">${(this.y * 100 / this.total).toFixed(0)}</span>
    //       </span>`
    //     }
    //   },
    
    series: [
    //     {
        
    //     center: [10000, 10000],
    //     data: [{
    //       name: t,
    //       y: 0,
    //     }, ]
    //   },
      {
        name: t,
        minPointSize: 10,
        innerSize: '75%',
        zMin: 0, 
        keys: ['name', 'y', 'z', 'id'],
        data: dataset
    },
    // {
    //     center: [10000, 10000],
    //     data: [{
    //       name: "Total",
    //       y: d.length,
    //     }, ]
    //   }
    ],
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
  
    var dataset = [];
    var dataset1 = [];

    var cat = [];
    var index = 0;

    keysSorted = Object.keys(counts).sort(function(a,b){return counts[b] - counts[a]})


    for (const key of keysSorted) {
        cat[index] = key;
        dataset[index] = counts[key];  
        var area = 0;
        for (let j=0;j<subset.length;j++){
            if (subset[j][id] == key){
                area += Number(subset[j][14]);
            }         
        }
        dataset1[index] = Number(area.toFixed(0));
        index ++;
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
        yAxis: [{
            title: {
                text: null,
                align: 'high'
            },
            visible: false
        }, {
            title: {
                text: null,
                align: 'high'
            },
            visible: false,
            opposite: true,
        }],
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
                        fontSize: '12px',
                        fontWeight: 'thin',
                    },
                    formatter: function(){
                        return (this.y!=0)?this.y + " " + this.series.name.substring(this.series.name.length - 4):"";
                    },
                    allowOverlap: true
                },
                // pointWidth: $(this).height() / (4*dataset.length),
                

            },
            series:{
                animation: false,
                point: {
                    events: {
                        click: function () {
                            clickshowmodal(t, cat[this.x],'',1,id);

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
            enabled: true
        },
        series: [{
            name: "No. of Sets",
            data: dataset
        },{
            name: "Area (ha)",
            data: dataset1,
            yAxis: 1,
        }]
    });

    
}
function createbasicbar(c, d, e, f, t, xt, s, id){
    var m1 = Math.max.apply(Math, d);
    var m2 = Math.min.apply(Math, d);
    var range = m1 - m2;
    var fix = 0;
    if (range < 10){
        fix = 1;
    }
    var number = 10;
    var dist = range / number;
    var cat = [];
    var catstr = [];
    // var fix = 0;
    // if (xt == 0.1){
    //      fix = 1;
    // }

    var count = [];
    var index = 0;
    
    for (let i = 0; i < number + 1; i++){
        cat[i] = m2 + dist * (i);
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

    for (let i = 0; i < number; i++){
        count[i] = 0;
        for (let j = 0; j < d.length; j++){
            if (d[j] > cat[i] && d[j] <= cat[i+1])
            {
                count[i] ++;
            }
        }    
        
    }
    var dataset = [];
    var dataset1 = [];
    
    var area = [];
    for (let i = 0; i < cat.length; i++){
        area[i] = 0;
        for (let j=0;j<subset.length;j++){ 
            if (id == 27){
                if (Number(subset[j][id]) >= cat[i]/100 && Number(subset[j][id]) < cat[i + 1]/100){
                    area[i] += Number(subset[j][14]);
                }
            }
            if (Number(subset[j][id]) >= cat[i] && Number(subset[j][id]) < cat[i + 1]){
                area[i] += Number(subset[j][14]);
            }
    
        }
    }
    var newcatstr = [];
    var index = 0;
    for (let i = 0; i < count.length; i++){
        // if (count[i] != 0){
            dataset[index] = count[i];
            dataset1[index] = Number(area[i].toFixed(0));
            newcatstr[index] = catstr[i];
            index ++;
        // }

    }
    Highcharts.chart(c, {
        chart: {
            type: 'column',
            style: {
            fontSize: '12px'
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
            fontSize: '12px'
        }
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: newcatstr,
            crosshair: true,
            title: {
                text: null,
                style: {
                    fontSize: '12px'
                },
            },            
            labels: {
                style: {
                    fontSize: '12px'
                },     
            }
        },
        yAxis: [{
            min: 0,
            title: {
                text: 'Count',
                style: {
                    fontSize: '12px'
                }
            },
            labels: {
                enabled: false,

                style: {
                    fontSize: '12px'
                }
            },
            visible: false ,
            gridLineColor: 'transparent',
         
        },{
            title: {
                text: 'Area (ha)',
                style: {
                    fontSize: '12px'
                }
            },
            labels: {
                enabled: false,
                style: {
                    fontSize: '12px'
                }
            },
            opposite: true,
            visible: false,
            gridLineColor: 'transparent',
          
        },],
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
            column: {
                shadow: false,
                borderWidth: 0
            },
            series: {
                borderWidth: 0,
                // pointWidth: $(this).height() / (35),
                colors: ['#B4B4B4'],  
                dataLabels: {
                    enabled: true,
                    shadow: true,                       
                    style: {
                        fontSize: '12px',
                        fontWeight: 'thin',
                    },   
                    formatter: function(){
                        var label = "";
                        if (this.series.index == 1)
                        {
                            label= "ha";
                        }
                        // console.log(this.series.index);
                        return (this.y!=0)?this.y + " " + label:"";
                    },
                    allowOverlap: true
                },
                animation: false,
                point: {
                    events: {
                        click: function () {
                            clickshowmodal(t, cat[this.x], cat[this.x + 1], 0, id)
                        }
                    }
                }
            },
        },
        legend: {
            enabled: true,
            itemStyle: {
                fontSize: '12px'
            }
        },
        series: [{
            colorByPoint: false,
            color: 'rgba(200,200,200,.5)',
            // pointPadding: 0.3,
            // pointPlacement: -0.2,
            name: "No. of Sets",
            data: dataset,
            // pointWidth: $(this).height() / (20),  
            // dataLabels:{
            //     x: -10,
            //     y: -10
            // }        
        },{
            colorByPoint: false,
            color: 'rgba(69,182,254,.9)',
            // pointPadding: 0.4,
            // pointPlacement: -0.2,
            name: "Area (ha)",
            data: dataset1,
            yAxis: 1,

            // pointWidth: $(this).height() / (30),     
            // dataLabels:{
            //     x: 10,
            //     y: 10
            // }     
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
                    yAxis: [{
                        labels: {
                            enabled: true
                        },
                        title:{
                            text: null
                        }
                    },{
                        labels: {
                            enabled: true
                        },
                        title:{
                            text: null
                        }
                    }],
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            pointWidth: 12,
                        }
                    },
                    xAxis: {
                        labels: {
                            style: {
                                fontSize: '12px'
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
                fontSize: '12px'
            }},
            labels: {
                style: {
                    fontSize: '12px'
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
                fontSize: '12px'
            }},
            labels: {
                style: {
                    fontSize: '12px'
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
                    fontSize: '12px'
                },
                enabled: false
            } 
        },
    
        yAxis: {
            title: {
                text: yunits,style: {
                    fontSize: '12px'
                }
            },labels: {
                style: {
                    fontSize: '12px'
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
                                fontSize: '12px'
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
            type: 'bar',
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
                    fontSize: '12px'
                },
                enabled: true
            } 
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total',
                style:{
                    fontSize: '12px'
                  }
            },
            labels: {
                style: {
                    fontSize: '12px'
                },
                enabled: true
            },
            visible: false
        },
        tooltip: {
            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
            shared: true
        },
        plotOptions: {
            bar: {
                stacking: 'percent',
                
                animation: false,

            },
            series: {               
                dataLabels: {
                    enabled: true,
                    formatter: function(){
                        return String(this.series.name + ": " + this.point.percentage.toFixed(1) + "%");
                    },
                    style:{
                        fontSize: '12px',
                    },
                },
            },
            // colors: barcolors,  
            // dataLabels: {
            //     enabled: true,		
            // },


        },
        series: seriesdata,
        exporting: {
            enabled: false
        },
        credits: {
            enabled: false
        },
        legend: {
            enabled: false
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
                                fontSize: '12px'
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
                    fontSize: '12px',
                }
            }
        },  
        plotOptions: {
            series: {
                pointWidth: $(this).width() / (300),
                dataLabels: {
                    enabled: true,
                    style: {
                        fontSize: '12px'
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

    for (const key of iterator) {
        dataset[index] = counts[key];  
        index ++;
    } 
    var maxheight = Math.max.apply(Math, dataset);

    var dataset = [];
    var index = 0;
    for (const key of iterator) {
        
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
                    fontSize: '12px',
                }
            },
            labels: {
                style: {
                    fontSize: '12px',
                }
            },
            gridLineColor: 'transparent',
        },
        xAxis: {
            title: {
                text: short,
                style: {
                    fontSize: '12px',
                }
            },
            labels: {
                style: {
                    fontSize: '12px',
                }
            },
            tickInterval: 1
        },  
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    style: {
                        fontSize: '12px'
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
                            clickshowmodal(short,this.x,'',1,id);
                        }
                    }
                }
            },
            // spline: {
            //     marker: {
            //         enable: false
            //     }
            // }

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
function createscatter(c,x,y,xname,yname, idx, idy,h){
    Highcharts.setOptions({
        colors: ['rgba(5,141,199,0.5)', 'rgba(80,180,50,0.5)', 'rgba(237,86,27,0.5)']
    });

    var seriesdata = [];
    for (let i=0;i<y.length;i++){
        seriesdata[i] = [x[i],y[i]];
    }
    // console.log(seriesdata);
    Highcharts.chart(c, {
        chart: {
            type: 'scatter',
            zoomType: 'xy',
            height: h,
            style: {
                fontFamily: 'Poppins'
            },    
        },
        title: {
            text: null,
        },
        xAxis: {
            title: {
                text: xname,
                style: {
                    fontSize: '12px',
                }
            },
            labels: {
                style: {
                    fontSize: '12px',
                }
            },
            
        },
        yAxis: {
            title: {
                text: yname,
                style: {
                    fontSize: '12px',
                }
            },
            labels: {
                style: {
                    fontSize: '12px',
                }
            },
            gridLineColor: 'transparent',
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                animation: false,
                point: {
                    events: {
                        click: function () {
                            clickshowmodalscatter(xname, yname, this.x, this.y, idx, idy);

                        }
                    }
                }
            },
        },

        series: [{
            data: seriesdata,
            name: yname,
        }],
        exporting: {
            enabled: false
        },
        credits: {
            enabled: false
        },
    });
};
