<?php
    session_start();
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
        include('getfarm.php');
        //include('getimus.php');
    }elseif($_SESSION['role'] == 0){
        $farmsetvalues = [];
    }else{
        $style = "style='display:none;'";
        $farmsetvalues = [];
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include('getfarms.php') ?>
<head>
    
<?php include('header.php')?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
.hiddenRow {
    padding: 0 !important;
}
.btn-xl {
    padding: 15px 10px;
    font-size: 15px;
    border-radius: 3px;
}
.offcanvas {
  width: 60%;
  background: #f5f7fb;
}
</style>
</head>

<script>
    function fillcanvas(id, score, theme){
        var c = document.getElementById(id);
        var ctx = c.getContext("2d");

        if (theme == 1){
            ctx.fillStyle = "#FF0000";
            ctx.fillRect(5, 5, 60, 30);
            ctx.fillStyle = "#FFFF00";
            ctx.fillRect(65, 5, 60, 30);
            ctx.fillStyle = "#00FF00";
            ctx.fillRect(125, 5, 60, 30);
        }else{
            ctx.fillStyle = "#B2BEB5";
            ctx.fillRect(5, 5, 60, 30);
            ctx.fillStyle = "#B2BEB5";
            ctx.fillRect(65, 5, 60, 30);
            ctx.fillStyle = "#B2BEB5";
            ctx.fillRect(125, 5, 60, 30);            
        }


        ctx.strokeStyle = 'Black';
        ctx.lineWidth = 3;

        // draw a red line
        ctx.beginPath();
        ctx.moveTo(score, 3);
        ctx.lineTo(score, 38);
        ctx.stroke(); 
    }                
    function createnewcard(farminfo,infor,score){
        const currentDiv = document.getElementById("item");
        let parentDiv = currentDiv.parentNode

        const newDiv1 = document.createElement("div");
        newDiv1.className = "card border border-dark  bg-light  mb-3 bg-light";
        
        const newDiv2 = document.createElement("div");
        newDiv2.setAttribute('data-toggle',"collapse");
        newDiv2.setAttribute('data-target',"#" + farminfo[0]);
        newDiv2.setAttribute('aria-expanded',"false");
        newDiv2.setAttribute('aria-controls',farminfo[0]);

        
        const newDiv3 = document.createElement("div");
        newDiv3.className = "card-body"; 

        const newDiv4 = document.createElement("div");
        newDiv4.className = "row";

        const col = document.createElement("div");
        col.className = "col-2";

        // textrow = document.createElement("div");   
        // textrow.className = "col-12 h2 mt-4 mb-4";
        // textrow.innerText = "Farm"; 
        // col.appendChild(textrow);      

        for (let i=0;i<1;i++){            
           
            const card = document.createElement("div");
            card.className = "card";
            const cardbody = document.createElement("div");
            cardbody.className = "card-body";
            const row = document.createElement("div");
            row.className = "row";
            const titlecol = document.createElement("div");
            titlecol.className = "col";
            const title = document.createElement("div");
            title.className = "card-title";
            title.innerText = infor[i];  
            titlecol.appendChild(title);
            row.appendChild(titlecol);          

            cardbody.appendChild(row);

            const text = document.createElement("h1");
            text.innerText = farminfo[i];
            cardbody.appendChild(text);

            var mb = document.createElement("div");
            mb.className = "mt-4 mb-0";
            var name = document.createElement("span");
            name.className = "h3 text-muted";
            name.innerText = infor[1] + ":";       
            var value = document.createElement("span");
            value.className = "h3 text-primary";
            value.innerText = farminfo[1]; 
            mb.appendChild(name);   
            mb.appendChild(value);         
            cardbody.appendChild(mb);

            

            mb = document.createElement("div");
            mb.className = "mt-4 mb-0";
            name = document.createElement("span");
            name.className = "h3 text-muted";
            name.innerText = infor[2] + ":";       
            value = document.createElement("span");
            value.className = "h3 text-primary";
            value.innerText = farminfo[2]; 
            mb.appendChild(name);   
            mb.appendChild(value);         
            cardbody.appendChild(mb);

            card.appendChild(cardbody);
            col.appendChild(card);
        } 

        for (let i=3;i<5;i++){            
            // const col = document.createElement("div");
            // col.className = "col-2";           
            const card = document.createElement("div");
            card.className = "card h";
            const cardbody = document.createElement("div");
            cardbody.className = "card-body";
            const row = document.createElement("div");
            row.className = "row";
            const titlecol = document.createElement("div");
            titlecol.className = "col";
            const title = document.createElement("div");
            title.className = "card-title";
            title.innerText = infor[i];  
            titlecol.appendChild(title);
            row.appendChild(titlecol);


            const colauto = document.createElement("div");
            colauto.className = "col-auto";
            const mb = document.createElement("div");
            mb.className = "h1";
            const badge = document.createElement("span");
            if (score[i] < 100){
                badge.className = "badge rounded-pill bg-success";
            }
            if (score[i] < 66){
                badge.className = "badge rounded-pill bg-warning ";
            } 
            if (score[i] < 33){
                badge.className = "badge rounded-pill bg-danger";
            }           
            badge.innerText = score[i];
            if (i > 0){
                mb.appendChild(badge);
                colauto.appendChild(mb);
                row.appendChild(colauto);
            }
            

            cardbody.appendChild(row);

            const text = document.createElement("h1");
            text.innerText = farminfo[i];
            cardbody.appendChild(text);


            card.appendChild(cardbody);
            col.appendChild(card);
        }       
        newDiv4.appendChild(col);    

        const col1 = document.createElement("div");
        col1.className = "col-5"; 
        var row1 = document.createElement("div");   
        row1.className = "row";

        textrow = document.createElement("div");   
        textrow.className = "col-12 h2 mt-4 mb-4";
        textrow.innerText = "Water"; 
        row1.appendChild(textrow);   

        const col1_1 = document.createElement("div");
        col1_1.className = "col-6";  

        for (let i=5;i<8;i++){  
      
            const card = document.createElement("div");
            card.className = "card";
            const cardbody = document.createElement("div");
            cardbody.className = "card-body";
            const row = document.createElement("div");
            row.className = "row";
            const titlecol = document.createElement("div");
            titlecol.className = "col";
            const title = document.createElement("div");
            title.className = "card-title";
            title.innerText = infor[i];  
            titlecol.appendChild(title);
            row.appendChild(titlecol);


            const colauto = document.createElement("div");
            colauto.className = "col-auto";
            const mb = document.createElement("div");
            mb.className = "h1";
            const badge = document.createElement("span");
            if (score[i] < 100){
                badge.className = "badge rounded-pill bg-success";
            }
            if (score[i] < 66){
                badge.className = "badge rounded-pill bg-warning ";
            } 
            if (score[i] < 33){
                badge.className = "badge rounded-pill bg-danger";
            }           
            badge.innerText = score[i];
            if (i > 0){
                mb.appendChild(badge);
                colauto.appendChild(mb);
                row.appendChild(colauto);
            }
            

            cardbody.appendChild(row);

            const text = document.createElement("h1");
            text.innerText = farminfo[i];
            cardbody.appendChild(text);


            card.appendChild(cardbody);
            col1_1.appendChild(card);  
        } 
        row1.appendChild(col1_1); 
        const col1_2 = document.createElement("div");
        col1_2.className = "col-6";     
        

        for (let i=8;i<11;i++){         
            const card = document.createElement("div");
            card.className = "card";
            const cardbody = document.createElement("div");
            cardbody.className = "card-body";
            const row = document.createElement("div");
            row.className = "row";
            const titlecol = document.createElement("div");
            titlecol.className = "col";
            const title = document.createElement("div");
            title.className = "card-title";
            title.innerText = infor[i];  
            titlecol.appendChild(title);
            row.appendChild(titlecol);


            const colauto = document.createElement("div");
            colauto.className = "col-auto";
            const mb = document.createElement("div");
            mb.className = "h1";
            const badge = document.createElement("span");
            if (score[i] < 100){
                badge.className = "badge rounded-pill bg-success";
            }
            if (score[i] < 66){
                badge.className = "badge rounded-pill bg-warning ";
            } 
            if (score[i] < 33){
                badge.className = "badge rounded-pill bg-danger";
            }           
            badge.innerText = score[i];
            if (i > 0){
                mb.appendChild(badge);
                colauto.appendChild(mb);
                row.appendChild(colauto);
            }
            

            cardbody.appendChild(row);

            const text = document.createElement("h1");
            text.innerText = farminfo[i];
            cardbody.appendChild(text);


            card.appendChild(cardbody);
            col1_2.appendChild(card);  
        }         
        row1.appendChild(col1_2);
        col1.appendChild(row1);
        newDiv4.appendChild(col1);    

        const col3 = document.createElement("div");
        col3.className = "col-5";      
        row1 = document.createElement("div");   
        row1.className = "row";

        textrow = document.createElement("div");   
        textrow.className = "col-12 h2 mt-4 mb-4";
        textrow.innerText = "Energy & Cost"; 
        row1.appendChild(textrow);      
        const col2_1 = document.createElement("div");
        col2_1.className = "col-6"; 

        for (let i=11;i<14;i++){     
            const card = document.createElement("div");
            card.className = "card";
            const cardbody = document.createElement("div");
            cardbody.className = "card-body";
            const row = document.createElement("div");
            row.className = "row";
            const titlecol = document.createElement("div");
            titlecol.className = "col";
            const title = document.createElement("div");
            title.className = "card-title";
            title.innerText = infor[i];  
            titlecol.appendChild(title);
            row.appendChild(titlecol);


            const colauto = document.createElement("div");
            colauto.className = "col-auto";
            const mb = document.createElement("div");
            mb.className = "h1";
            const badge = document.createElement("span");
            if (score[i] < 100){
                badge.className = "badge rounded-pill bg-success";
            }
            if (score[i] < 66){
                badge.className = "badge rounded-pill bg-warning ";
            } 
            if (score[i] < 33){
                badge.className = "badge rounded-pill bg-danger";
            }           
            badge.innerText = score[i];
            if (i > 0){
                mb.appendChild(badge);
                colauto.appendChild(mb);
                row.appendChild(colauto);
            }
            

            cardbody.appendChild(row);

            const text = document.createElement("h1");
            text.innerText = farminfo[i];
            cardbody.appendChild(text);


            card.appendChild(cardbody);
            col2_1.appendChild(card);  
        } 
        row1.appendChild(col2_1);
        const col2_2 = document.createElement("div");
        col2_2.className = "col-6";  
        for (let i=14;i<infor.length;i++){     
            const card = document.createElement("div");
            card.className = "card";
            const cardbody = document.createElement("div");
            cardbody.className = "card-body";
            const row = document.createElement("div");
            row.className = "row";
            const titlecol = document.createElement("div");
            titlecol.className = "col";
            const title = document.createElement("div");
            title.className = "card-title";
            title.innerText = infor[i];  
            titlecol.appendChild(title);
            row.appendChild(titlecol);


            const colauto = document.createElement("div");
            colauto.className = "col-auto";
            const mb = document.createElement("div");
            mb.className = "h1";
            const badge = document.createElement("span");
            if (score[i] < 100){
                badge.className = "badge rounded-pill bg-success";
            }
            if (score[i] < 66){
                badge.className = "badge rounded-pill bg-warning ";
            } 
            if (score[i] < 33){
                badge.className = "badge rounded-pill bg-danger";
            }           
            badge.innerText = score[i];
            if (i > 0){
                mb.appendChild(badge);
                colauto.appendChild(mb);
                row.appendChild(colauto);
            }
            

            cardbody.appendChild(row);

            const text = document.createElement("h1");
            text.innerText = farminfo[i];
            cardbody.appendChild(text);


            card.appendChild(cardbody);
            col2_2.appendChild(card);  
        }         
        row1.appendChild(col2_2);
        col3.appendChild(row1);
        newDiv4.appendChild(col3);           

        newDiv3.appendChild(newDiv4);    
        newDiv2.appendChild(newDiv3);
        newDiv1.appendChild(newDiv2);
        parentDiv.insertBefore(newDiv1, currentDiv); 
    }
    function createcard(farminfo,infor){
        const currentDiv = document.getElementById("item");
        let parentDiv = currentDiv.parentNode

        const newDiv1 = document.createElement("div");
        newDiv1.className = "card";
        
        const newDiv2 = document.createElement("div");
        newDiv2.setAttribute('data-toggle',"collapse");
        newDiv2.setAttribute('data-target',"#" + farminfo[0]);
        newDiv2.setAttribute('aria-expanded',"false");
        newDiv2.setAttribute('aria-controls',farminfo[0]);

        
        const newDiv3 = document.createElement("div");
        newDiv3.className = "card-body"; 
        // newDiv3.innerText = text;  

        const newDiv10 = document.createElement("div");
        newDiv10.className = "row";

        for (let i=0;i<infor.length;i++){
            
            const newDiv6 = document.createElement("div");
            newDiv6.className = "col-2";

            const newDiv7 = document.createElement("h5");
            newDiv7.className = "card-title";
            newDiv7.innerText = infor[i];  
            
            newDiv6.appendChild(newDiv7);
            newDiv10.appendChild(newDiv6);         
        } 



        for (let i=0;i<farminfo.length;i++){
            
            const newDiv4 = document.createElement("div");
            newDiv4.className = "col-2";

            if (i > 2){
                const newDiv5 = document.createElement("h2");
                
                const newDiv7 = document.createElement("span");
                newDiv7.className = "badge badge-primary-light";
                newDiv7.innerText = farminfo[i];
                newDiv5.appendChild(newDiv7);
                newDiv4.appendChild(newDiv5);
            }
            else{
                const newDiv5 = document.createElement("h2");
                newDiv5.className = "mt-1 mb-2";
                newDiv5.innerText = farminfo[i];
                newDiv4.appendChild(newDiv5);
            }

            newDiv10.appendChild(newDiv4);       
        } 

        newDiv3.appendChild(newDiv10);
        newDiv2.appendChild(newDiv3);
        newDiv1.appendChild(newDiv2);
        parentDiv.insertBefore(newDiv1, currentDiv); 
    }

    function createchildcard(set,infor,id){
        const currentDiv = document.getElementById("item");
        let parentDiv = currentDiv.parentNode



        const newDiv4 = document.createElement("div");
        newDiv4.className = "collapse"; 
        newDiv4.id = id; 
        // newDiv4.setAttribute('data-toggle',"collapse");
        // newDiv4.setAttribute('data-target',"#" + id + set[0]);
        // newDiv4.setAttribute('aria-expanded',"false");
        // newDiv4.setAttribute('aria-controls',id + set[0]);
        // newDiv4.setAttribute('data-parent',fatherid);
             
        const newDiv1 = document.createElement("div");
        newDiv1.className = "card";

        const newDiv5 = document.createElement("div");
        newDiv5.className = "card-body"; 
        const newDiv52 = document.createElement("div");
        newDiv52.className = "row";


        const newDiv51 = document.createElement("div");
        newDiv51.className = "col-10"; 

        // newDiv5.innerText = text;  
        const newDiv3 = document.createElement("div");
        newDiv3.className = "row";
        

        for (let i=0;i<infor.length;i++){
            
            const newDiv6 = document.createElement("div");
            if (i > 1){
                newDiv6.className = "col-2";
            }
            else{
                newDiv6.className = "col-1";
            }
            const newDiv7 = document.createElement("h5");
            newDiv7.className = "card-title";
            newDiv7.innerText = infor[i];  
            
            newDiv6.appendChild(newDiv7);
            newDiv3.appendChild(newDiv6);         
        } 

        for (let i=0;i<set.length;i++){
            
            const newDiv4 = document.createElement("div");
            if (i > 1){
                newDiv4.className = "col-2";
            }
            else{
                newDiv4.className = "col-1";
            }
            

            if (i > 3){
                const newDiv5 = document.createElement("h5");

                const newDiv7 = document.createElement("span");
                newDiv7.className = "badge badge-primary-light";
                newDiv7.innerText = set[i];
                newDiv5.appendChild(newDiv7);
                newDiv4.appendChild(newDiv5);
            }
            else{
                const newDiv5 = document.createElement("p");
                newDiv5.className = "card-text";
                newDiv5.innerText = set[i];
                newDiv4.appendChild(newDiv5);
            } 
            newDiv3.appendChild(newDiv4);       
        } 
        newDiv51.appendChild(newDiv3);     
 
        const newDiv41 = document.createElement("div");
        newDiv41.className = "col-1";  
        const newDiv42 = document.createElement("div");
        newDiv42.className = "row";

        const newbutton = document.createElement("button");
        newbutton.className = "btn btn-xl btn-primary";    
        newbutton.type = "button";    
        newbutton.innerText = "Irrigation";    
        newbutton.setAttribute('data-bs-toggle',"offcanvas");
        newbutton.setAttribute('href',"#offcanvasExample");
        newbutton.id = id + set[0];
        newDiv42.appendChild(newbutton);
        newDiv41.appendChild(newDiv42);
        


        newDiv52.appendChild(newDiv51);
        newDiv52.appendChild(newDiv41);
        newDiv5.appendChild(newDiv52);
        // newDiv5.appendChild(newDiv41);

        newDiv1.appendChild(newDiv5);
        newDiv4.appendChild(newDiv1);
        parentDiv.insertBefore(newDiv4, currentDiv); 
    }

    function creategrandchildcard(id,text){
        const currentDiv = document.getElementById("item");
        let parentDiv = currentDiv.parentNode


        const newDiv6 = document.createElement("div");
        newDiv6.className = "collapse"; 
        newDiv6.id = id; 

        const newDiv1 = document.createElement("div");
        newDiv1.className = "card";

        const newDiv7 = document.createElement("div");
        newDiv7.className = "card-body"; 
        // newDiv7.innerText = text;  

        const newDiv11 = document.createElement("div");
        newDiv11.className = "row";

        const newDiv8 = document.createElement("div");
        newDiv8.className = "col-2";
        newDiv8.id = id + "list"; 

        const newDiv9 = document.createElement("div");
        newDiv9.className = "col-10";
        newDiv9.id = id + "chart1"; 

        // const newDiv10 = document.createElement("div");
        // newDiv10.className = "col-5";
        // newDiv10.id = id + "chart2"; 

        newDiv11.appendChild(newDiv8);
        newDiv11.appendChild(newDiv9);
        // newDiv11.appendChild(newDiv10);
        newDiv7.appendChild(newDiv11);
        newDiv1.appendChild(newDiv7);
        newDiv6.appendChild(newDiv1);

        parentDiv.insertBefore(newDiv6, currentDiv); 
    }

    function updateirrigation(startdate,f, b){


        var oldrecord = JSON.parse($.ajax({
                url: 'getsetdata.php',
                type: 'post',
                data: {farm: f, block: b},
                dataType: 'html',
                context: document.body,
                global: false,
                async:false,								
                success: function(response){
                    return response;
                }
            }).responseText);	
            // console.log(oldrecord);	

            var irrigationdate = [];
            var irrigationstart = [];
            var irrigationend = [];
            var irrigationevent =[];
            

            for (let i=0;i<oldrecord.length;i++)
            {
                irrigationevent[i] =[];

                irrigationdate[i] = oldrecord[i][2].substring(0, 10);
                irrigationstart[i] = oldrecord[i][2];
                irrigationend[i] = oldrecord[i][3];

                irrigationevent[i][0] =irrigationstart[i];
                irrigationevent[i][1] =irrigationend[i];

            }	

            var irrigationdatenew = [];
            var irrigationarray = [];
            var irrigationarraytable = [];
            var index = 1;
            irrigationdatenew[0] = irrigationdate[0];
            for (let i=1;i<irrigationdate.length;i++)
            {
                if (irrigationdate[i] != irrigationdatenew[index-1])
                {
                    irrigationdatenew[index] = irrigationdate[i];
                    index ++;
                }
                
            }


            // console.log(irrigationdate);	
            // console.log(irrigationdatenew);	
            // console.log(irrigationstart);	
            // console.log(irrigationend);	

            createirrigationbar('irrigationbar',irrigationdatenew,irrigationstart,irrigationend);

            var element = document.getElementById("datatables-reponsive12");
            if (element != null){
                document.getElementById("irrigationevent").remove();
            }
            

            createtable("irrigationevent", ["Start Time","End Time"], irrigationevent,"datatables-reponsive12",0); 	
            if ( $.fn.dataTable.isDataTable( '#datatables-reponsive12' ) ) {
                table = $('#datatables-reponsive12').DataTable();
            }
            else {
                table = $('#datatables-reponsive12').DataTable( {
                    responsive: true
                } );
            }
            // table = $("#datatables-reponsive12").DataTable({
            //     responsive: true
            // });	   
            // table.destroy();
            

            for (let y = 0;y < irrigationdatenew.length; y++)
            {
                irrigationarray[y] = 0;
                irrigationarraytable[y] = [];
                for (let z = 0;z < irrigationstart.length; z++)
                {
                    // console.log(s[z].substring(0,10));
                    if (irrigationstart[z].substring(0,10) == irrigationdatenew[y])
                    {
                        if (irrigationstart[z].substring(0,10) == irrigationend[z].substring(0,10)){
                            irrigationarray[y] += new Date("01/01/2018 " + irrigationend[z].substring(11,13) + ":" + irrigationend[z].substring(14,16)).getHours() - 
                                new Date("01/01/2018 " + irrigationstart[z].substring(11,13) + ":" + irrigationstart[z].substring(14,16)).getHours();
                            // console.log( irrigationarray[y]);	
                        }else{
                            irrigationarray[y] += new Date("01/01/2018 " + "23:59").getHours() - 
                                new Date("01/01/2018 " + irrigationstart[z].substring(11,13) + ":" + irrigationstart[z].substring(14,16)).getHours();
                            irrigationarray[y+1] += new Date("01/01/2018 " + irrigationend[z].substring(11,13) + ":" + irrigationend[z].substring(14,16)).getHours() - 
                            new Date("01/01/2018 " + "00:00").getHours();           
                        }

                    }
                }
                irrigationarraytable[y][0] = [];

            }

            for (let y = 0;y < irrigationdatenew.length; y++)
            {
                irrigationarraytable[y] = [];
                irrigationarraytable[y][0] = irrigationdatenew[y];
                irrigationarraytable[y][1] = irrigationarray[y];
                irrigationarraytable[y][2] = irrigationarray[y];
            }


            // console.log(irrigationdatenew);	
            // console.log(irrigationarray);	

            var element = document.getElementById("datatables-irrigationamounttable");
            if (element != null){
                document.getElementById("irrigationamounttable").remove();
            }           

            createtable("irrigationamounttable", ["Date","Duration", "Amount"], irrigationarraytable,"datatables-irrigationamounttable",0); 	
            if ( $.fn.dataTable.isDataTable( '#datatables-irrigationamounttable' ) ) {
                table = $('#datatables-irrigationamounttable').DataTable();
            }
            else {
                table = $('#datatables-irrigationamounttable').DataTable( {
                    responsive: true
                } );
            }

            createtimecolumn('irrigationamount',irrigationdatenew,irrigationarray,irrigationdatenew.length,"",580,1);


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
            var datenumber = startdate;
            var index = 0;
            while (datenumber < enddate){
                datenumber = addDays(startdate, index+1);
                // datearray[index] = datenumber.getDate()  + "-" + (datenumber.getMonth()+1) + "-" + datenumber.getFullYear();
                datearray[index] = datenumber.getFullYear()  + "-" + String(datenumber.getMonth()+1).padStart(2, "0") + "-" + String(datenumber.getDate()).padStart(2, "0");
                index ++;
            }


            

            var s = String(datearray[0]);
            var e = String(datearray[datearray.length-1]);
            console.log(s);	
            console.log(e);						


            function loadirrigweb(){

                var oldrecord = JSON.parse($.ajax({
                    url: 'IrrigWeb.php',
                    type: 'post',
                    data: {start: s, end: e, farm: f, block: b, call: "rainfall"},
                    dataType: 'html',
                    context: document.body,
                    global: false,
                    async:false,								
                    success: function(response){
                        return response;
                    }
                }).responseText);	
                console.log(oldrecord);	
                console.log(oldrecord.Message);						

                var irrigwebdatearray = [];
                var rainarray = [];
                var SWD = [];
                var threshhold = [];
                var irrigationarray = [];


                if (oldrecord.Message == "Ok")
                {
                    for (let i=0;i<oldrecord.Data.length;i++)
                    {
                        irrigwebdatearray[i] = oldrecord.Data[i].GraphDate;
                        irrigationarray[i] = oldrecord.Data[i].NetApp;
                        rainarray[i] = oldrecord.Data[i].CumRain;
                        SWD[i] = oldrecord.Data[i].SoilDef;
                        threshhold[i] = -40;
                    }	
                    if (today < harvestdate)
                    {
                        createmixedbars('swdchart',irrigationarray,rainarray,datearray,datearray.length,"",610,threshhold,SWD);
                        // createtimecolumn('irrigationchart',datearray,irrigationarray,datearray.length,"",610, 30);
                    }else{
                        createmixedbars('swdchart',irrigationarray,rainarray,datearray,datearray.length - 42,text,610,threshhold,SWD);
                        // createtimecolumn('irrigationchart',datearray,irrigationarray,datearray.length - 42,text,610, 30);
                    }	

                }else{
                    document.getElementById("swdchart").innerText = "No Data for this block found on IrrigWeb!";
                    // document.getElementById("irrigationchart").innerText = "";;
                }


                }


            loadirrigweb();		

    }	
    function createtable(header, head, row, name, offset){
        const currentDiv = document.getElementById(header);
        let parentDiv = currentDiv.parentNode

        const tbl = document.createElement('table');
        tbl .className = "table table-striped";   
        tbl .id = name;
        tbl .style = "width:100%";

        const thead = document.createElement('thead');
        
        const tr = document.createElement('tr');
        for (let i=0;i<head.length-offset;i++){
            const th = document.createElement('th');
            th.appendChild(document.createTextNode(head[i]));
            tr.appendChild(th);
        }

        thead.appendChild(tr);
        tbl.appendChild(thead);

        const tbody = document.createElement('tbody');    
        for (let i=0;i<row.length;i++){
            const tr = document.createElement('tr');
            for (let j=0;j<row[i].length-offset;j++){
                const td = document.createElement('td');
                // if (j == 1){
                //     var a = document.createElement('a');
                //     a.setAttribute('href',"showeachset.php?id=" + row[i][0]);
                //     a.innerHTML = row[i][j];
                //     td.appendChild(a);
                // }else{
                //     td.appendChild(document.createTextNode(row[i][j]));
                // }             
                td.appendChild(document.createTextNode(row[i][j]));       
                tr.appendChild(td);
            }
            tbody.appendChild(tr);
        }          
        tbl.appendChild(tbody);

        parentDiv.insertBefore(tbl, currentDiv);  
    }
</script>
<body>
	<div class="wrapper">
    
		<div class="main">
        <?php include('nav.php')?>
			<main class="content">

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                        <div class="row">   
                        <div class="col-4">
                                <div class="card">
                                    <div class="card-body">
                                        Total Irrigation Amount
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-body">
                                        Total Irrigation Duration
                                    </div>
                                </div>                            
                            </div>  
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-body">
                                        Total Engery Cost
                                    </div>
                                </div>                            
                            </div>                          
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 >Irrigation Event</h4>
                                    </div>	
                                    <div class="card-body">
                                        <div class="row"> 
                                            <div class="col-4">
                                                <div id="irrigationevent"></div>
                                            </div>  
                                            <div class="col-8">
                                                <div id="irrigationbar"></div>
                                            </div> 
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 >Irrigation Amount</h4>
                                    </div>	
                                    <div class="card-body">
                                        <div class="row"> 
                                            <div class="col-4">
                                                <div id="irrigationamounttable"></div>
                                            </div>  
                                            <div class="col-8">
                                                <div id="irrigationamount"></div>
                                            </div> 
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>                                                                                 
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 >Water Balance</h4>
                                    </div>	
                                    <div class="card-body">
                                        <div class="row"> 
                                            <div class="col-12">
                                                <div id="swdchart"></div>
                                            </div> 
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>                                                                                                                
                        </div>
                </div>
            </div>
            <div class="row">            
                <div id="item"></div>             
            </div>
                


                
                <script>
                    var setnames = <?php echo json_encode($setnames); ?>;
                    var setvalues = <?php echo json_encode($setvalues); ?>;
                    var username = <?php echo json_encode($_SESSION['username'],JSON_INVALID_UTF8_IGNORE); ?>; 

                    var subset = [];
                    var ind = 0;
                    switch(username) {
                        case "BIP":
                            subset = setvalues;
                            break;
                        case "FARMACIST":
                            for (let i=0;i<setvalues.length;i++){                             
                                var nameArr = setvalues[i][2].split('_');
                                // console.log(nameArr[0]);
                                if (nameArr[0] == "FBIP"){
                                    subset[ind] = [];
                                    for (let j=0;j<setvalues[i].length;j++){
                                        subset[ind][j] = setvalues[i][j]; 
                                    }
                                    ind ++;
                                }
                            }         
                            break;
                        case "BPS":
                            for (let i=0;i<setvalues.length;i++){
                                var nameArr = setvalues[i][2].split('_');
                                // console.log(nameArr[0]);
                                if (nameArr[0] == "BPS"){
                                    subset[ind] = [];
                                    for (let j=0;j<setvalues[i].length;j++){
                                        subset[ind][j] = setvalues[i][j]; 
                                    }
                                    ind ++;
                                }
                            }         
                            break;   
                        case "ATS":
                            for (let i=0;i<setvalues.length;i++){
                                
                                var nameArr = setvalues[i][2].split('_');
                                // console.log(nameArr[0]);
                                if (nameArr[0] == "ATS"){
                                    subset[ind] = [];
                                    for (let j=0;j<setvalues[i].length;j++){
                                        subset[ind][j] = setvalues[i][j]; 
                                    }
                                    ind ++;
                                }
                            }         
                            break;                                
                        default:
                            // code block
                    }       
                    // console.log(subset);
                    var farms = [];
                    for (let i=0;i<subset.length;i++){
                        farms[i] = subset[i][2];  
                    }  

                    var counts = {};
                    for (const num of farms) {
                        counts[num] = counts[num] ? counts[num] + 1 : 1;
                    }    
                    const iterator = Object.entries(counts);
                    var infor = ["Grower ID","Total Area (ha)","No of Sets","Avg No Rows","Avg Row Length (m)","Avg Flow Rate (L/S)","Total Water Applied (ML)","Avg Water Applied (ML)","Avg Water Applied (mm)"
                    ,"Avg Crop Water Use (mm)","Avg Applied Efficiency","Total Energy (KWH)","Avg Energy (KWH)","Avg Energy per ML (KWH/ML)","Avg Energy per Hour (KWH/H)",
                    "Avg Energy Cost per ML ($/ML)","Avg Energy Cost per Irrig ($/ha/ML)"];
                    var setn = ["Set ID","Area","Crop Class","Date Planted","Total Water Applied (ML)","Total Energy (KWH)","Total Energy Cost per Irrig ($/ha/ML)"];
                    var index = [0,14,0,11,12,20,23,23,24,26,27,28,28,29,30,31,32];
                    var avg = [0,0,0,1,1,1,0,1,1,1,1,0,1,1,1,1,1];
                    var fixed = [0,1,0,0,0,1,1,1,1,1,2,1,1,1,1,1,1];
                    var theme = [0,0,0,0,0,0,1,1,1,1,1,1,1,1,1,1,1];
                    var farminfor = [];

                    var setinfor = [];
                    var score = ["",0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
                    var farmsummary = [];
                    for (let i=0;i<iterator.length;i++){
                        farmsummary[i] = [];
                        for (let j=1;j<17;j++){
                            farmsummary[i][j] = 0;
                        }                        

                        farmsummary[i][0] = Object.entries(counts)[i][0];

                        for (let j=0;j<subset.length;j++){
                            if (subset[j][2] == farmsummary[i][0]){
                                for (let z=1;z<17;z++){
                                    if (index[z] !== 0){
                                        farmsummary[i][z] += Number(subset[j][index[z]]);
                                    }else{
                                        farmsummary[i][z] ++;
                                    }
                                }                                  
                            }
                        }     

                        for (let j=1;j<17;j++){
                            if (avg[j] == 1){
                                farmsummary[i][j] = farmsummary[i][j]/farmsummary[i][1];
                            }
                            farmsummary[i][j] = farmsummary[i][j].toFixed(fixed[j]);  
                        }                        
                    }
                    //console.log(farmsummary);

                    for (let i=0;i<iterator.length;i++){
                        for (let j=1;j<17;j++){
                            farminfor[j] = 0;
                        }                        

                        farminfor[0] = Object.entries(counts)[i][0];

                        for (let j=0;j<subset.length;j++){
                            if (subset[j][2] == farminfor[0]){
                                for (let z=1;z<17;z++){
                                    if (index[z] !== 0){
                                        farminfor[z] += Number(subset[j][index[z]]);
                                    }else{
                                        farminfor[z] ++;
                                    }
                                }                                  
                            }
                        }     

                        for (let j=1;j<17;j++){
                            if (avg[j] == 1){
                                farminfor[j] = farminfor[j]/farminfor[1];
                            }
                            farminfor[j] = farminfor[j].toFixed(fixed[j]);  
                        }                        
                        var score = [];
                        for (let j=1;j<17;j++){
                            newarray = [];
                            for (let z=0;z<farmsummary.length;z++){
                                newarray[z] = Number(farmsummary[z][j]);
                            }
                            // console.log(newarray);
                            sortarray = newarray.sort(function(a, b){return a - b});
                            // console.log(farminfor[j]);
                            console.log(sortarray);
                            let index = sortarray.indexOf(Number(farminfor[j]));
                            // console.log(index);
                            // score[j] = ((index + 1) * 90 / newarray.length ) + 5;
                            score[j] = ((index + 1) * 100 / newarray.length).toFixed(0);
                        }  

                        createnewcard(farminfor,infor,score);


                        // for (let j=1;j<17;j++){
                        //     fillcanvas(infor[j] + "canvas" + farminfor[0], score[j], theme[j]);
                        // }                           
                        
                        for (let j=0;j<subset.length;j++){
                            if (subset[j][2] == farminfor[0]){
                                setinfor[0] = subset[j][5];
                                setinfor[1] = subset[j][14];
                                setinfor[2] = subset[j][9];
                                setinfor[3] = subset[j][10];
                                setinfor[4] = subset[j][23];
                                setinfor[5] = subset[j][28];
                                setinfor[6] = subset[j][33];
                                createchildcard(setinfor,setn,farminfor[0]);
                            }
                        }

                    }
                    

                    let btns = document.querySelectorAll('button');

                    for (i of btns) {
                    (function(i) {
                        i.addEventListener('click', function() {
                        // console.log(i.id);
                        updateirrigation("2020-04-16", i.id.substring(0, 6),i.id.substring(6, 10));  
                        });
                    })(i);
                    }
                </script>
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
			$("#datatables-reponsive").DataTable({
				responsive: true
			});            
		});
	</script> -->

<!-- <script type="text/javascript">
     jQuery.noConflict();
</script> -->

<script>
    // $(function () {
    //     $('nav li a').filter(function () {
    //         return this.href === location.href;
    //     }).addClass('active');
    // });


    // $(function() {
    // $(".collapse").on('shown.bs.collapse', function(e) {
    //     if ($(this).is(e.target)) {
    //         console.log(this.id.length);
    //         // console.log(this.id);
    //         if (this.id.length > 6){
    //             updateirrigation("2021-09-10", "ATS20310-1");
    //              //testcolumnchart(this.id + "chart1");
    //             // testcolumnchart(this.id + "chart2");
    //         }
    //     }
    // })
    // });

</script>

</body>

</html>