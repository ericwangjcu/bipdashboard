<!DOCTYPE html>
<html lang="en">
<?php include('getfarms.php') ?>
<head>
<?php include('header.php')?>
<style>
.hiddenRow {
    padding: 0 !important;
}
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

            if (i > 3){
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
        newDiv4.setAttribute('data-toggle',"collapse");
        newDiv4.setAttribute('data-target',"#" + id + set[0]);
        newDiv4.setAttribute('aria-expanded',"false");
        newDiv4.setAttribute('aria-controls',id + set[0]);
        // newDiv4.setAttribute('data-parent',fatherid);
             
        const newDiv1 = document.createElement("div");
        newDiv1.className = "card";

        const newDiv5 = document.createElement("div");
        newDiv5.className = "card-body"; 
        // newDiv5.innerText = text;  
        const newDiv3 = document.createElement("div");
        newDiv3.className = "row";

        for (let i=0;i<infor.length;i++){
            
            const newDiv6 = document.createElement("div");
            newDiv6.className = "col-2";

            const newDiv7 = document.createElement("h5");
            newDiv7.className = "card-title";
            newDiv7.innerText = infor[i];  
            
            newDiv6.appendChild(newDiv7);
            newDiv3.appendChild(newDiv6);         
        } 

        for (let i=0;i<set.length;i++){
            
            const newDiv4 = document.createElement("div");
            newDiv4.className = "col-2";

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

        newDiv5.appendChild(newDiv3);
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
        newDiv7.innerText = text;  

        newDiv1.appendChild(newDiv7);
        newDiv6.appendChild(newDiv1);
        parentDiv.insertBefore(newDiv6, currentDiv); 
    }
</script>
<body>
	<div class="wrapper">
    
		<div class="main">
        <?php include('nav.php')?>
			<main class="content">
                <div id="item"></div>
                <script>
                    // createcard("child","Root");
                    // createchildcard("child","grandchild","child");
                    // creategrandchildcard("grandchild","grandchild");

                    var names = <?php echo json_encode($names); ?>;
                    var irrigfield = <?php echo json_encode($irrigfield); ?>; 
                    var setnames = <?php echo json_encode($setnames); ?>;
                    var setvalues = <?php echo json_encode($setvalues); ?>;

                    console.log(irrigfield);

                    var farminfor = [];
                    var infor = ["Owner","Area","DT","Level","Irrigation Amount (ML)","Energy (KWH)"];
                    var setn = ["Set ID","Area","Harvest Date","Cycle Days","Irrigation Amount (ML)","Energy (KWH)"];
                    for (let i=0;i<irrigfield.length;i++){
                        farminfor[0] = irrigfield[i][1];
                        farminfor[1] = irrigfield[i][4];
                        farminfor[2] = irrigfield[i][8];
                        farminfor[3] = irrigfield[i][9];
                        farminfor[4] = 1000;
                        farminfor[5] = 1000;
                        createcard(farminfor,infor);
                        
                        // var tableid = "datatables-reponsive" + parseInt(i);
                        // var setinfor = [];
                        // // var count = 0;
                        // for (let j=0;j<setvalues.length;j++){
                        //     if (setvalues[j][19] == irrigfield[i][0]){
                        //         setinfor[0] = setvalues[j][1];
                        //         setinfor[1] = setvalues[j][2];
                        //         setinfor[2] = setvalues[j][12];
                        //         setinfor[3] = setvalues[j][13];
                        //         setinfor[4] = 1000;
                        //         setinfor[5] = 1000;

                        //         createchildcard(setinfor,setn,farminfor[0]);
                        //         creategrandchildcard(farminfor[0] + setinfor[0],setinfor[0]);
                        //         // creategrandchildcard(setinfor[0] + farminfor[0],setinfor[0]);
                        //         //adddsetcard(setinfor[0]);
                        //         // count ++;
                        //     }
                        // }
            
                        // createtable("item", setnames, newset,tableid,0,farminfor[0]); 
                        // tableid = "#" + tableid;
                        // $(tableid).DataTable({
                        //     responsive: true
                        // });	   
                    }

                </script>
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