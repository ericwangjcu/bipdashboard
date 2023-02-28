Highcharts.setOptions({
    chart: {
        style: {
            fontFamily: 'Poppins'
        },       
    },
    colors: ["#C4C4C4", "#00A5E3", "#48b5c4", "#1984c5", "#a6d75b", "#c9e52f", "#d0ee11", "#f4f100"],
    title: {
        style: {
            fontSize: '18px'
        },
        text: null
    },
    xAxis: {
        title: {
            style: {
                fontSize: '18px'
            },
        },            
        labels: {
            style: {
                fontSize: '18px'
            },     
        },
        visible: false
    },
    yAxis: {
        title: {
            style: {
                fontSize: '18px'
            }
        },
        labels: {
            style: {
                fontSize: '18px'
            }
        },
        gridLineColor: 'transparent',
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
            animation: false,
            dataLabels: {
                enabled: true,
                style:{
                    fontSize: '18px',
                    fontWeight: 'thin',
                },
                
            },
        },
    },
    legend: {
        enabled: false
    },        
    exporting: {
        enabled: false
    },
    credits: {
        enabled: false
    },
});
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
        tooltip: {
            enabled: false
        },
        plotOptions: {
            series: {               
                dataLabels: {
                    formatter: function(){
                        return String(this.series.name + ": " + this.point.y.toFixed(0));
                    },
                    style:{
                        fontSize: '12px',
                    },
                },
            },
        },
        series: dataset,
});

};
function createnewpie(c,d,t,s,id){
    var dataset = [];
    for (let i=0;i<d.length;i++) {
      dataset[i] = {name: d[i][0],
              y: Number(d[i][2]),
              z: 80,
              id: i.toString()};  
    }      
    
    new Highcharts.chart(c, {
        colors: ['#01BAF2','#71BF45', '#FAA74B', '#B37CD2','#F8362E','#FFF200','#C4C4C4','#000000'],
        chart: {
            type: 'pie',
            height: s, 
        },
        legend: {
            enabled: true
        },       
        plotOptions: {
            pie: {
                size:  '70%',
                showInLegend: true,
            },
            series: {
                point: {
                    events: {
                        click: function () {
                            clickshowmodal(t,this.name,"",1,id);
                        }
                    }
                },
                dataLabels: {
                    format: '{point.name}: {point.percentage:.1f} %',
                },
            }
        },    
        series: [{
            name: t,
            minPointSize: 10,
            innerSize: '75%',
            zMin: 0, 
            keys: ['name', 'y', 'z', 'id'],
            data: dataset
        }],
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
        },
        legend: {
            enabled: true
        },       
        plotOptions: {
            pie: {
                size:  '70%',
                showInLegend: true,
            },
            series: {
                point: {
                    events: {
                        click: function () {
                            clickshowmodal(t,this.name,"",1,id);
                        }
                    }
                },
                dataLabels: {
                    format: '{point.name}: {point.percentage:.1f} %',
                },
            }
        },    
        series: [{
            name: t,
            minPointSize: 10,
            innerSize: '75%',
            zMin: 0, 
            keys: ['name', 'y', 'z', 'id'],
            data: dataset
        }],
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
        xAxis: {
            categories: cat,
            visible: true           
        },
        yAxis: [{
        }, {
            opposite: true,
        }],
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true,
                    style: {
                        fontSize: '18px',
                        fontWeight: 'thin',
                    },
                    formatter: function(){
                        return (this.y!=0)?this.y + " " + this.series.name.substring(this.series.name.length - 4):"";
                    },
                    allowOverlap: true
                },
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

    if (range < 20){
        fix = 1;
    }
    var number = 10;
    var dist = range / number;
    var cat = [];
    var catstr = [];
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
        
            dataset[index] = count[i];
            dataset1[index] = Number(area[i].toFixed(0));
            newcatstr[index] = catstr[i];
            index ++;
        

    }
    Highcharts.chart(c, {
        chart: {
            type: 'column',        
            height: s, 
        },
        xAxis: {
            categories: newcatstr,   
            visible: true       
        },
        yAxis: [{
            min: 0,
            title: {
                text: 'Count',
            },
        },{
            title: {
                text: 'Area (ha)',
            },
            opposite: true,
        },],
        plotOptions: {
            column: {
                shadow: false,
                borderWidth: 0
            },
            series: {
                borderWidth: 0,
                colors: ['#B4B4B4'],  
                dataLabels: {
                    formatter: function(){
                        var label = "";
                        if (this.series.index == 1)
                        {
                            label= "ha";
                        }
                        return (this.y!=0)?this.y + " " + label:"";
                    },
                    allowOverlap: true
                },
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
        },
        series: [{
            colorByPoint: false,
            color: 'rgba(200,200,200,.5)',
            name: "No. of Sets",
            data: dataset,
        },{
            colorByPoint: false,
            color: 'rgba(69,182,254,.9)',
            name: "Area (ha)",
            data: dataset1,
            yAxis: 1,
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    plotOptions: {
                        series: {
                            dataLabels: {                    
                                style: {
                                    fontSize: '6px',
                                    fontWeight: 'thin',
                                },   
                            },
                        }
                    },
                    xAxis: {
                        labels: {
                            style: {
                                fontSize: '6px'
                            }
                        } 
                    },
                }
            }]
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
            height: height, 
        },  
        title: {
            text: yname
        },
        xAxis: {
            categories: [""],
            labels: {
                enabled: false
            } 
        },
        yAxis: {
            title: {
                text: yunits,style: {
                    fontSize: '18px'
                }
            },
            labels: {
                style: {
                    fontSize: '18px'
                }
            },
            visible: true
        },
        plotOptions: {
            boxplot: {
                lineWidth: 3,
            },
        },      
        series: seriesdata,
        legend: {
            enabled: true
        },
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
            height: ss,     
        },
        title: {
            text: t,
        },
        xAxis: {
            categories: iterator1,
            visible: true             
        },
        tooltip: {
            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
            shared: true
        },
        plotOptions: {
            bar: {
                stacking: 'percent',
            },
            series: {               
                dataLabels: {
                    formatter: function(){
                        return String(this.series.name + ": " + this.point.percentage.toFixed(1) + "%");
                    },
                },
            },
        },
        series: seriesdata,        
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
        xAxis: {
            type: 'datetime',
            visible: true
        },  
        plotOptions: {
            series: {
                pointWidth: $(this).width() / (300),
            }
        },
        series: [{
            data: dataset,
        }],
    
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
            type: 'column'
        },
        title: {
            text: null,
        },
        yAxis: {
            title: {
                text: "No. of Sets",
            },
        },
        xAxis: {
            title: {
                text: short,
            },
            tickInterval: 1,
            visible: true
        },  
        plotOptions: {
            series: {
                point: {
                    events: {
                        click: function () {
                            clickshowmodal(short,this.x,'',1,id);
                        }
                    }
                }
            },
        },
        series: [{
            name: short,
            data: dataset,
        }],
    
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
    
    Highcharts.chart(c, {
        chart: {
            type: 'scatter',
            height: h,
        },
        xAxis: {
            title: {
                text: xname,
            },
            visible: true            
        },
        yAxis: {
            title: {
                text: yname,
            },
            visible: true            

        },
        plotOptions: {
            series: {
                dataLabels:{
                    enabled: false
                },
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
            marker: {
                symbol: 'triangle',
                radius: 8
            }
        }],
    });
};
