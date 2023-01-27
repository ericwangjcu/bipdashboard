<!DOCTYPE html>
<html lang="en">
<?php include('getfarms.php') ?>
<head>
<?php include('header.php')?>

</head>
<?php
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
    }elseif($_SESSION['role'] == 2){
        $style = "style='display:none;'";
        $farmpumpvalues = [];
    }else{
        $farmpumpvalues = [];
    }
?>
<script>
    function addcard(header,size){
        const newDiv1 = document.createElement("div");
        newDiv1.className = "col-12 col-md-" + size + " col-xl-" + size;  
        newDiv1.id = header + "card";
        
        const card = document.createElement("div");
        card.className = "card flex-fill w-100";
        
        const cardheader = document.createElement("div");
        cardheader.className = "card-header";

        const cardheadertext = document.createElement("h4");
        cardheadertext.innerText = header;

        cardheader.appendChild(cardheadertext);
        card.appendChild(cardheader);
        
        const cardbody = document.createElement("div");
        cardbody.className = "card-body";

        const container = document.createElement("div");
        container.id = header + "body";

        cardbody.appendChild(container);
        card.appendChild(cardbody);
        newDiv1.appendChild(card);

        const currentDiv = document.getElementById("head");
        let parentDiv = currentDiv.parentNode

        parentDiv.insertBefore(newDiv1, currentDiv);        
    } 

    function addchart(device, farmdevice, header, index, unit, type){
        if (type == 0){
            createbasicbar(header,device.map(d => d[index]),farmdevice.map(d => d[index]),farmdevice.map(d => d[1]), header.substring(0,header.length-4), unit, );  
        }else{
            createpiechart(header,device.map(d => d[index]),farmdevice.map(d => d[index]),farmdevice.map(d => d[1]),unit, );
        }
    }

    function createtable(header, head, row){
        const currentDiv = document.getElementById(header);
        let parentDiv = currentDiv.parentNode

        const tbl = document.createElement('table');
        tbl .className = "table table-striped";   
        tbl .id = "datatables-reponsive";
        tbl .style = "width:100%";

        const thead = document.createElement('thead');
        
        const tr = document.createElement('tr');
        for (let i=0;i<head.length-2;i++){
            const th = document.createElement('th');
            th.appendChild(document.createTextNode(head[i]));
            tr.appendChild(th);
        }

        thead.appendChild(tr);
        tbl.appendChild(thead);

        const tbody = document.createElement('tbody');    
        for (let i=0;i<row.length;i++){
            const tr = document.createElement('tr');
            for (let j=0;j<row[i].length-2;j++){
                const td = document.createElement('td');

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
				<div class="container-fluid p-0">
                    <div class="row mb-2 mb-xl-3">
                            <div class="col-auto d-none d-sm-block">
                                <h3><strong>Pump</strong> Overview</h3>
                            </div>
                    </div>	                    
                    <div class="row">  
                        <div id="head"></div> 
                        <script>
                            var role = <?php echo json_encode($_SESSION['role']); ?>;
                            var fieldname = <?php echo json_encode($fieldname); ?>; 
                            var pumpvalues = <?php echo json_encode($pumpvalues); ?>; 
                            var farmpumpvalues = <?php echo json_encode($farmpumpvalues); ?>;   
                            
                            var title = ["Pump Type", "Tariff", "VFD", "Pump Motor KW", "Pump Flow Rate", "Energy KWH per ML"];
                            var index = [5,9,7,4,8,14];
                            var size = [4,4,4,6,6,6];
                            var unit = ["Type","Tariff","VFD","KW","L/S", "KWH/ML"];
                            var type = [1,1,1,0,0,0];

                            for (let i=0;i<6;i++){
                                addcard(title[i],size[i]);
                                addchart(pumpvalues,farmpumpvalues, title[i] + "body", index[i], unit[i], type[i]);
                            }   
                            
                            addcard("Pump List","12");
                            var pumpnames = <?php echo json_encode($pumpnames); ?>; 
                            var pumpvalues = <?php echo json_encode($pumpvalues); ?>;
                            var newpumpvalues = [];
                            for (let i=0;i<pumpvalues.length;i++){
                                newpumpvalues[i] = [];
                                for (let j=0;j<Object.keys(pumpvalues[i]).length - 1;j++){
                                    newpumpvalues[i][j] = pumpvalues[i][j];
                                }
                            }

                            if (role == 1){
                                createtable("Pump Listbody", pumpnames, farmpumpvalues);                            
                            }else{
                                createtable("Pump Listbody", pumpnames, newpumpvalues);                            
                            }
                        </script>    
                    </div>  
                </div>
 			</main>
            <?php include('footer.php')?>
		</div>
	</div>
    
	<script src="js/app.js"></script>
    <script src="js/datatables.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datatables Responsive
            $("#datatables-reponsive").DataTable({
                responsive: true
            });
        });
    </script>
<script>
    $(function () {
        $('nav li a').filter(function () {
            return this.href === location.href;
        }).addClass('active');
    });
</script>    	
</body>

</html>