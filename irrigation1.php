<!DOCTYPE html>
<html lang="en">
<?php include('getfarms.php') ?>
<head>
<?php include('header.php')?>
<style>
.hiddenRow {
    padding: 0 !important;
}
/* tr {
   line-height: 50px;
   min-height: 50px;
   height: 50px;
} */
</style>
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
        //include('getimus.php');
    }elseif($_SESSION['role'] == 0){
        $farmsetvalues = [];
    }else{
        $style = "style='display:none;'";
        $farmsetvalues = [];
    }
?>
<script>
function createcard(header, value, text){
    const currentDiv = document.getElementById(header);
    let parentDiv = currentDiv.parentNode
    
    //<h1 class="mt-2 mb-0">
    // let col7 = document.createElement('span');
    // col7.className = 'text-success';
    // let col8 = document.createElement('i');
    // col8.className = 'mdi mdi-arrow-bottom-right';
    // let col5 = document.createElement('h2');
    // col5.className = 'mt-0 mb-0';
    // col5.innerText = value + "          " + text;

    // let col6 = document.createElement('h2');
    // col6.className = 'mt-0 mb-0';
    // col6.innerText = text;

    //<h5 class="mt-1 mb-0">
    let col6 = document.createElement('h2');
    
    //<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>  </span>
    let col7 = document.createElement('span');
    //col7.className = 'text-success';
    //<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>  </span>
    let col8 = document.createElement('span');
    col8.innerText = value;
    //<span class="text-muted">BIP Total</span>
    let col9 = document.createElement('span');
    col9.className = 'h3 text-muted';
    col9.innerText = "      " + text;
    
    col7.appendChild(col8);
    
    
    col6.appendChild(col7);
    col6.appendChild(col9);
    
    //parentDiv.insertBefore(col5, currentDiv);  
    parentDiv.insertBefore(col6, currentDiv);  
    //parentDiv.insertBefore(col6, currentDiv);  		
};		

function addcard(header,size){
        const newDiv1 = document.createElement("div");
        newDiv1.className = "col-12 col-md-" + size + " col-xl-" + size;  
        newDiv1.id = header + "card";

        // const button = document.createElement("button");
        // button.type = "button";
        // button.class = "btn btn-primary btn-lg"
        // button.innerText = "Resize"


        const card = document.createElement("div");
        card.className = "card flex-fill w-100";
        
        const cardheader = document.createElement("div");
        cardheader.className = "card-header";

        const cardheadertext = document.createElement("h4");
        cardheadertext.innerText = header;

        cardheader.appendChild(cardheadertext);
        card.appendChild(cardheader);
        // card.appendChild(button);
        
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
</script>
<body>
	<div class="wrapper">
    
		<div class="main">
        <?php include('nav.php')?>
			<main class="content">
				<div class="container-fluid p-0">
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Level 2 & 3</strong> Farms</h3>
                        </div>
                        <div class="row">
                            <script>
                                var names = <?php echo json_encode($names); ?>;
                                var irrigfield = <?php echo json_encode($irrigfield); ?>; 
                                var setnames = <?php echo json_encode($setnames); ?>;
                                var setvalues = <?php echo json_encode($setvalues); ?>;
                            </script>  
                            <div class="col-12">
                                <div class="card flex-fill w-100">
                                    <div class="card-body">
                                        <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                <?php 
                                                    echo '<th></th>';
                                                    $col = 0;
                                                    foreach ($names as $row) {      
                                                        if ($col == 0 or $col == 1 or $col == 4 or $col == 8 or $col == 9) {
                                                            echo '<th>'.$row.'</th>'; 
                                                        }
                                                        $col ++;                                                                
                                                    }
                                                    echo '<th>Total Irrigation Volumn (ML)</th>'; 
                                                    echo '<th>Total Energy (KWH)</th>'; 
                                                    echo '<th>Total Duration (H)</th>';           
                                                ?>    
                                                </tr>
                                            </thead>
                                            <tbody>

                                         
                                                <?php 
                                                    $col = 0;  
                                                    foreach ($irrigfield as $row) { 
                                                        
                                                        echo '<tr data-toggle="collapse" data-target="#demo'.$col.'" class="accordion-toggle" style="height: 50px;font-size: 20px;">';   
                                                        echo '<td><i class="align-middle me-2" data-feather="plus-circle"></i> </td>';  
                                                        $col1 = 0;
                                                        foreach ($row as $value){
                                                            if ($col1 == 0 or $col1 == 1 or $col1 == 4 or $col1 == 8 or $col1 == 9) {
                                                                echo '<td>'.$value.'</td>'; 
                                                            }                                                                
                                                            $col1 ++; 
                                                        }   
                                                        echo '<td>1000</td>'; 
                                                        echo '<td>1000</td>'; 
                                                        echo '<td>1000</td>';   
                                                        echo '</tr>';  
                                                        
                                                        echo '<tr><td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="demo'.$col.'"><table class="table"><thead><tr class="info">';  
                                                        $col1 = 0;
                                                        foreach ($setnames as $row1) { 
                                                            if ($col1 == 0 or $col1 == 1 or $col1 == 2 or $col1 == 11 or $col1 == 12 or $col1 == 13 or $col1 == 14 or $col1 == 16) {
                                                                echo '<th>'.$row1.'</th>';
                                                            }
                                                              
                                                            $col1 ++;                                                                
                                                        } 
                                                        echo '</tr></thead><tbody>';
                                                        
                                                        foreach ($setvalues as $row2) { 
                                                            if ($row2[19] == $row[0]) {
                                                                echo '<tr>';     
                                                                $col1 = 0;
                                                                foreach ($row2 as $value){
                                                                    if ($col1 == 1){
                                                                        echo '<td><a href=showeachset.php?id=';
                                                                        echo $value;
                                                                        echo '>'.$value.'</a></td>'; 
                                                                    }
                                                                    else{
                                                                        if ($col1 == 0 or $col1 == 1 or $col1 == 2 or $col1 == 11 or $col1 == 12 or $col1 == 13 or $col1 == 14 or $col1 == 16) {
                                                                            echo '<td>'.$value.'</td>';
                                                                        }
                                                                          
                                                                    }
                                                                    $col1 ++;                                                                            
                                                                } 
                                                                echo '</tr>';
                                                            }
 
                                                        }

                                                        echo '</tbody></table></div></td></tr>';
                                                        $col ++;
                                                    }       
                                                ?>   
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> 
  
                            <!-- <div id="accordion">
                                <h5 class="mb-0">
                                    <div class="btn btn-link col-12" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <div id="head"></div>
                                    <script>
                                        addcard("header","3");
                                        createcard("headerbody", 1, "text");

                                    </script>  
                                    </div>

                                </h5>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                                </div>
                           
                            </div>                            
                        </div>                     -->
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