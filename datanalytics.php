<?php include('comp/userauth.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php include('server/getfarms.php') ?>
<?php include('server/savedashboard.php') ?>
<head>
<?php include('comp/header.php')?>
</head>

<body>
    <div class="wrapper">   
        <div class="main">
            <?php include('comp/nav.php')?>
            <main class="content">     
                <div class="row">       
                    <div id="head"></div>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Set Table</h4>
                            </div>
                            <div class="modal-body">
                            <div id="datatable"></div>
                            </div>
                        </div>
                        </div>
                    </div>                    
                    <script>
                        var units = ["","","ha"]
                        var size = [4,4,4];        
                        var setnames = <?php echo json_encode($setnames,JSON_INVALID_UTF8_IGNORE); ?>;
                        var setvalues = <?php echo json_encode($setvalues,JSON_INVALID_UTF8_IGNORE); ?>;
                        var username = <?php echo json_encode($_SESSION['username'],JSON_INVALID_UTF8_IGNORE); ?>; 
                        var farmcount = <?php echo json_encode($farmcount,JSON_INVALID_UTF8_IGNORE); ?>;
                        var subset = findsubset(username,setvalues);
                        addtop();                                
                    </script>

                    <script>
                        setarray = ["Water Supply by District","Irrigation vs District","Irrigation vs Water Supply","Irrigation vs Area","Irrigation vs Row Length"];
                        types = [6,3,4,2,5];
                        intervals = [0,0,0,0,0];
                        gridsizes = [12,12,12,24,24];
                        number = [3,6,6,4,4];

                        for (let i=0;i<setarray.length;i++){
                            addcard(setarray[i],gridsizes[i],number[i]);                    
                            addchart(setarray[i], types[i], setarray[i],i+1, intervals[i]); 
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