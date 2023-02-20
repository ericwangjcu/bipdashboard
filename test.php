<!DOCTYPE html>
<html lang="en">
<head>
<?php include('comp/header.php')?>
</head>
<script>
    function addgroup(rows,cols){
        var i = 0;
        while(i<cols.length){
            const col = document.createElement("div");
            col.className = "col-" + cols[i];  

            var sum = 2;
            var index = 0;
            while (sum > 0){                
                const card = document.createElement("div");
                card.className = "card  d-flex align-items-stretch";

                const cardbody = document.createElement("div");
                cardbody.className = "card-body";
                cardbody.id = i + index;

                card.appendChild(cardbody);
                col.appendChild(card);
           
                sum -= rows[i + index];
                console.log(sum);
                index ++;    
            }
            i += index;
            const currentDiv = document.getElementById("head");
            let parentDiv = currentDiv.parentNode
            parentDiv.insertBefore(col, currentDiv); 
        }          
        
    }  
</script>
<body>
<div class="main ">
    <main class="content">      
        <div class="row">
            <div id="head"></div>
        </div>
        
    </main>    
</div>   
    
<script>
    rows = [1,1,2,1,1,2,1];
    cols = [4,4,4,4,4,4,4];
    addgroup(rows,cols);
    for (let i=0;i<cols.length;i++){
        sammplechart(i.toString(), rows[i] * 200 + (rows[i] - 1)*62);
    }
    
</script>
</body>

</html>