
var pieColors = (function () {
    var colors = [],
        base = Highcharts.getOptions().colors[7],
        i;

    for (i = 6; i > 0; i -= 1) {
        // Start out with a darkened base color (negative brighten), and end
        // up with a much brighter color
        colors.push(Highcharts.color(base).brighten((i - 4) / 6).get());
    }
    return colors;
}());    

function createpiechart(c, d, e ,f, t,s){

    // Make monochrome colors


    var counts = {};
    for (const num of d) {
      counts[num] = counts[num] ? counts[num] + 1 : 1;
    }    
    const iterator = Object.keys(counts);      
  
    var dataset = [];
    var index = 0;
    var loc = [];
    var count = [0,0,0,0,0,0,0,0];
    var anno = ['','','','','','','','','','','','']; 
    var more = 0;
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
      
      if (e){     
          if(Array.isArray(e)){
              for (let z = 0;z < e.length; z++){               
                  if (e[z] == key)
                  { 
                    loc[index] = index;
                    count[index] ++;
  
                    if (f){     
                      if(Array.isArray(f)){ 
                              if (anno[index].length < 10)
                              {
                                  anno[index] +=  f[z] + '<br/>';
                              }else{
                                  more ++;                       
                              }
                          }
                      }
                      else{
                          anno[index] = 'Your Farm';
                      }      
                  } 
              }                    
          }else{
              if (e == key)
              {
                loc[index] = index;
                count[index] = 1;
                anno[index] =  'Your Farm';              
              }
          }   
      }    
      if (more > 0)
      {
        anno[index] +=  'and ' + String(more) + ' more.';
      }    
      index ++;
    }  
    
  
  
    new Highcharts.chart(c, {
    chart: {
        type: 'pie',
      height: s,
      style: {
        fontFamily: 'Poppins'
    },      
        // marginLeft: -50,
        // margin: [0,160,0,0]
    },
    title: {
        text: "",
        style:{
          fontSize: '16px'
        }
    },
    // tooltip: {
    //     pointFormat: '{series.name}: <b>{point.percentage:.1f}%, {point.y}</b>'
    // },  
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    }, 
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            // size: 500,

            dataLabels: {
                enabled: true,
                //borderRadius: 8,
                //backgroundColor: 'rgba(252, 255, 197, 0.7)',
                //shadow: true,               
                //format: '{point.name}:<br>{point.percentage:.1f} %<br>Count: {point.y}',
                formatter: function(){
                    var sn = this.point.name.length > 10 ? this.point.name.substring(0, 10) + '..' : this.point.name;
                    return String(sn + "<br>" + this.point.percentage.toFixed(0) + "%" + "<br>" + text2 + ": " + this.point.y);
                    // for (let i=0;i<loc.length;i++){
                    //     if (this.point.index == loc[i]){
                    //         return String(anno[i]);
                    //     }
                    // }

                },
                //distance: 10,
                style:{
                  fontSize: '14px',
                  fontWeight: 'thin',
                },
            },
            showInLegend: true,
        },
        series: {
            colorByPoint: true,
            //colors: pieColors,
            animation: false
        }
    },
    // legend: {
    //     // align: 'right',
    //     // verticalAlign: 'middle',
    //     // layout: 'vertical',
    //     // x: 0,
    //     // y: 0,        
    //     enabled: true,
    //     useHTML: true,
    //     labelFormatter: function() {
    //         // console.log(this);
    //         var shortname = this.name.length > 10 ? this.name.substring(0, 10) + '...' : this.name;
    //         return  shortname + " " + t + ":" + (this.y * 100 / this.total).toFixed(0) + "%  Total:" + this.y;
    //     },
    //     itemStyle:{
    //         fontSize: "16px",
    //         fontWeight: 'thin',
    //     },
    // },
    legend: {
        layout: 'vertical',
        verticalAlign: 'middle',
        align: 'right',
        symbolRadius: 2,
        useHTML: true,
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
        innerSize: '50%',
        zMin: 0, 
        keys: ['name', 'y', 'z', 'id'],
        data: dataset
    },{
        center: [10000, 10000],
        data: [{
          name: "Total",
          y: d.length,
        }, ]
      },],
    credits: {
      enabled: false
      },
      exporting: {
          enabled: false
      },
      responsive: {
        rules: [{
            condition: {
                maxWidth: 600
            },
            chartOptions: {
                chart:{
                    height: 1.2*s,
                },
                legend: {
                    align: 'center',
                    verticalAlign: 'bottom',
                    layout: 'horizontal'
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
function createbasicbar(c, d, e, f, t, xt, s, dist){
    // console.log(d);
    var m1 = Math.max.apply(Math, d);
    var m2 = Math.min.apply(Math, d);
    var range = m1 - m2;
    var number = range / dist;
    var cat = [];
    var catstr = [];
    for (let i = 0; i < number+1; i++){
        cat[i] = m2 + dist * (i);
        if (i > 0){
            catstr[i-1] = cat[i-1].toFixed(0).toString().concat("-",cat[i].toFixed(0).toString());
        }   
    }

    

    var count = [];
    var loc = [];
    var cc = [0,0,0,0,0,0,0,0];   
    var anno = ['','','','','','','','','','','','']; 
    var more = 0;
    
    for (let i = 0; i < number; i++){
        count[i] = 0;
        for (let j = 0; j < d.length; j++){
            if (d[j] >= cat[i] && d[j] <= cat[i+1])
            {
                count[i] ++;
            }
        }
        if (e){     
            if(Array.isArray(e)){
                for (let z = 0;z < e.length; z++){
                    if (e[z] >= cat[i] && e[z] <= cat[i+1])
                    {
                        
                        loc[i] = i;
                        cc[i] ++;
                        if (f){     
                            if(Array.isArray(f)){ 
                                if (anno[i].length < 1)
                                {
                                    anno[i] +=  f[z] + ';';
                                }else{
                                    more ++;                       
                                }
                            }
                        }
                        else{
                            anno[i] = 'Your Farm';
                        }                     
                    } 
                }                    
            }else{
                if (e >= cat[i] && e <= cat[i+1])
                {
                    
                    loc[i] = i;
                    cc[i] = 1;
                    anno[i] =  'Your Farm';
                }
            }   
        } 
        if (more > 0)
        {
        anno[i] +=  'and ' + String(more) + ' more.';
        }                  
    }

    function calculate(array){
        high = Math.max.apply(null, array);
        low = Math.min.apply(null, array);
        const asc = arr => arr.sort((a, b) => a - b);
        const median = arr => {
            const mid = Math.floor(arr.length / 2),
                nums = [...arr].sort((a, b) => a - b);
            return arr.length % 2 !== 0 ? nums[mid] : (nums[mid - 1] + nums[mid]) / 2;
            };
        med = median(array);    
        const quantile = (arr, q) => {
            const sorted = asc(arr);
            const pos = (sorted.length - 1) * q;
            const base = Math.floor(pos);
            const rest = pos - base;
            if (sorted[base + 1] !== undefined) {
                return sorted[base] + rest * (sorted[base + 1] - sorted[base]);
            } else {
                return sorted[base];
            }
        };        
        lowqua = quantile(array,0.25);    
        upqua = quantile(array,0.75);                          
        return [low.toFixed(1),lowqua.toFixed(1),med.toFixed(1),upqua.toFixed(1),high.toFixed(1)];
    }

    var newd = [];
    for (let i = 0; i < d.length; i++){
        newd[i] = Number(d[i]);
    }
    var x = calculate(newd);
    var titles = "Low: " + x[0] + " , Low Quartile: " + x[1] + " , Median: " + x[2] + " , High Quartile: " + x[3] + " , High: " + x[4];


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
            text: titles,
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
                text: t,
                style: {
                    fontSize: '16px'
                }
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
            }            
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                pointWidth: 50,
                dataLabels: {
                    enabled: true,
                    // borderRadius: 8,
                    // backgroundColor: 'rgba(252, 255, 197, 0.7)',
                    shadow: true,                       
                    style: {
                        fontSize: '16px',
                        fontWeight: 'thin',
                    },
                    formatter: function(){
                        //console.log(loc);
                        //console.log(this.point.index);
                        if (loc.length > 0){
                            for (let i=0;i<loc.length;i++){
                                if (this.point.index == loc[i]){
                                    return String(anno[i]);
                                }
                                return String(count[i]);
                            }
                        }else{
                            return String(count[this.point.index]);
                        }

                    },
                },
                animation: false
            }
        },
        legend: {
            enabled: false
        },
        series: [{
            colorByPoint: true,
            //colors: pieColors,            
            name: '',
            keys: ['y', 'id'],
            data: count.map((v, i) => ([v, String(i)]))               
        },{
            name:'',
            type:'spline',
            visible: true,
            data:  count
            //color: 'rgba(204,204,255,.85)'
        }],
        exporting: {
            enabled: false
        },
        credits: {
            enabled: false
            },

    });
};
function createhistogram(c, data, header){

    var d = [];
    var ind = 0;
    for (let j = 0; j < data.length; j++){
        if (data[j] !== undefined)
        {
            d[ind] = Number(data[j]);
            ind ++;
        }
    }
    // console.log(d);

    Highcharts.chart(c, {
        title: {
            text: ''
        },
    
        xAxis: [{
            title: { text: header },
            alignTicks: true
        }, {
            title: { text: 'Count' },
            alignTicks: true,
            opposite: true
        }],
    
        yAxis: [{
            title: { text: header }
        }, {
            title: { text: 'Count' },
            opposite: true
        }],
    
        plotOptions: {
            histogram: {
                accessibility: {
                    point: {
                        valueDescriptionFormat: '{index}. {point.x:.3f} to {point.x2:.3f}, {point.y}.'
                    }
                }
            }
        },
    
        series: [{
            name: 'Count',
            type: 'histogram',
            xAxis: 1,
            yAxis: 1,
            baseSeries: 's1',
            zIndex: -1
        }, {
            name: header,
            type: 'scatter',
            data: d,
            id: 's1',
            marker: {
                radius: 1.5
            }
        }]
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
        //Set up a line
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
function createcomparison(c, x,xname, y, yname, z, zname, n, s, ss){    
    Highcharts.chart(c, {

        chart: {
            type: 'boxplot',
            style: {
                fontFamily: 'Poppins'
            },   
            height: ss, 
        },
    
        title: {
            text: s
        },
    
        legend: {
            enabled: false
        },
    
        xAxis: {
            categories: [s],
            labels: {
                style: {
                    fontSize: '16px'
                },
                enabled: false
            } 
        },
    
        yAxis: {
            title: {
                text: n,style: {
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
            },
        },        
        series: [{
            name: xname,
            data: [
                x
            ],
            animation: false
        },{
            name: yname,
            data: [
                y
            ],
            animation: false
        },{
            name: zname,
            data: [
                z
            ],
            animation: false
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
function createnewcomparison(c,x,y,yname,yunits,height){  
    var seriesdata = [];
    for (let i=0; i<x.length;i++){
        seriesdata[i] = {
            name: x[i],
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
    
    });
};
function createstackedbars(c,x,y,ss){
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
            text: "",
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
                stacking: 'percent'
            },
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
    });

}
