<?php include('comp/userauth.php') ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('comp/header.php')?>
    </head>  
    <body>
        <div class="wrapper">   
            <div class="main">
                <?php include('comp/nav.php')?>
                <div class="p-5 text-center bg-image rounded-3" style="
                    background-image: url('img/thumb.jpg');
                    height: 400px;">
                    <div class="row">
                        <div class="d-flex justify-content-center align-items-center h-100">
                            <img src="img/bip_logo.png" class="img-responsive" alt="Responsive image" height="240">
                        </div>    
                        <div></br></div>                         
                        <div class="text-white h1 col-12 col-md-8 col-lg-4 mx-auto bg-dark p-2" style="--bs-bg-opacity: .5;">Making irrigation work for you</div>
                    </div>
   
        
                </div>
                
                <main class="content">  
                    <div class="row">
                        <script>
                        createinfocard("", "text", "link", "image");
                        </script>
                        <div class="col-12 col-md-12 col-lg-3 d-flex align-items-stretch">
                            <div class="card">
                                <img class="card-img-top" src="img/baseline.png" alt="Unsplash">
                                <div class="card-header">
                                    <h2 class="mb-0">Dashboard</h2>
                                </div>
                                <div class="card-body">
                                    <p class="card-text h4">View the aggregated information collated on all BIP farms, such as soil, crop, area, row spacing.</p>
                                </div>
                                <a href="index.php" class="btn btn-primary btn-lg">View dashboard</a>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-12 col-lg-3 d-flex align-items-stretch">
                            <div class="card">
                                <img class="card-img-top" src="img/dataanalytics.png" alt="Unsplash">
                                <h2 class="card-header mb-0">Data Analytics</h2>
                                <div class="card-body">
                                    <p class="card-text h4">View the comparison and patterns of the irrigation information on all BIP farms.</p>
                                </div>
                                <a href="datanalytics.php" class="btn btn-primary">View analytics</a>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 col-lg-3 d-flex align-items-stretch">
                            <div class="card">
                                <img class="card-img-top" src="img/benchmark.png" alt="Unsplash">
                                <div class="card-header">
                                    <h2 class="mb-0">Benchmark</h2>
                                </div>
                                <div class="card-body">
                                    <p class="card-text h4">Benchmark the irrigation of indiviudal farm.</p>
                                </div>
                                <a href="benchmark.php" class="btn btn-primary btn-lg">View benchmark</a>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 col-lg-3 d-flex align-items-stretch">
                            <div class="card">
                                <img class="card-img-top" src="img/data.png" alt="Unsplash">
                                <div class="card-header">
                                    <h2 class="mb-0">Baseline Data</h2>
                                </div>
                                <div class="card-body">
                                    <p class="card-text h4">View the raw baseline data  .</p>
                                </div>
                                <a href="farmmanagement.php" class="btn btn-primary btn-lg">View raw baseline data</a>
                            </div>
                        </div>

                        <hr />
                        <div class="text-center my-4">
                            <h1 class="card-text h1 text-danger">Frequently asked questions</h1>
                        </div>


                        <div class="row">
                            <div class="col-md-5 col-sm-6 ms-auto d-flex align-items-stretch">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-text h3 text-primary">What’s the Burdekin Irrigation Project (BIP) all about?</h4>
                                        <p class="mb-0 h4">The BIP team will support Lower Burdekin sugarcane farmers to transition to more efficient irrigation systems and practices in order to reduce on-farm irrigation expenses, run–off and deep drainage losses and improved productivity and profitability.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-6 me-auto d-flex align-items-stretch">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="h3 card-text text-primary">Who is running the BIP?</h5>
                                        <p class="mb-0 h4">The BIP is a collaborative initiative of Sugar Research Australia (SRA), Farmacist, Burdekin Productivity Services (BPS), AgriTech Solutions, BBIFMAC, James Cook University, the Queensland Department of Agriculture and Fisheries and NQ Dry Tropics. Together this group is known as the consortium.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-6 ms-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="h3 card-text text-primary">How long will the BIP run?</h5>
                                        <p class="mb-0 h4">The project will run for three and a half years, from February 2021 to June 2024.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-6 me-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="h3 card-text text-primary">Where will the BIP be rolled out?</h5>
                                        <p class="mb-0 h4">The project will run across the lower Burdekin region.</p>
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-5 col-sm-6 ms-auto">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="h3 card-text text-primary">What are the aims of the BIP?</h5>
                                            <p class="mb-0 h4">The BIP aims to help growers save energy, water and money while improving productivity and profitability from irrigated sugarcane. </p>
                                            </br>
                                            </br>
                                            </br>
                                            </br>
                                            </br>
                                            </br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-6 me-auto d-flex align-items-stretch">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="h3 card-text text-primary">How will sugarcane growers in the Burdekin benefit from the project?</h5>
                                            <p class="mb-0 h4">BIP farmers will:</p>
                                            <li class="mb-0 h4">receive one-on-one support to strategically improve irrigation systems </li>
                                            <li class="mb-0 h4">identify opportunities to save on energy and irrigation costs/li>
                                            <li class="mb-0 h4">investigate potential water use efficiencies</li>
                                            <li class="mb-0 h4">improve productivity and profitability</li>
                                            <li class="mb-0 h4">develop a plan for irrigation improvement which may also support a case for third party financial incentives, if and when they are offered to the lower Burdekin region</li>
                                        </div>
                                    </div>
                                </div>

                            <div class="col-md-5 col-sm-6 ms-auto d-flex align-items-stretch">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="h3 card-text text-primary">BIP co-benefits</h5>
                                        <p class="mb-0 h4">Co-benefits of the BIP include:</p>
                                        <li class="mb-0 h4">reduced water loss from the farm as run-off or deep drainage</li>
                                        <li class="mb-0 h4">improved environmental outcomes.</li>
                                        <li class="mb-0 h4">investigate potential water use efficiencies</li>
                                        <li class="mb-0 h4">improve productivity and profitability</li>
                                        <li class="mb-0 h4">develop a plan for irrigation improvement which may also support a case for third party financial incentives, if and when they are offered to the lower Burdekin region</li>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-6 me-auto d-flex align-items-stretch">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="h3 card-text text-primary">How will the project work?</h5>
                                        <p class="mb-0 h4">The BIP team is made up of four extension officers (representing SRA, BPS, Farmacist and AgriTech Solutions) who will work one-on-one with farmers to:</p>
                                        <li class="mb-0 h4">measure existing water and energy use and identify inefficiencies or potential losses</li>
                                        <li class="mb-0 h4">help farmers identify new irrigation techniques, tools and technologies to improve on-farm water and energy efficiencies</li>
                                        <li class="mb-0 h4">develop a tailored irrigation improvement plan.</li>
                                        <p class="mb-0 h4">The project will also feature demonstration farms where growers can see smart practice in action and hold field days to enable networking, information sharing and updates from the project team.</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-10 col-sm-10 mx-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="h3 card-text text-primary ">Where can I find out more about the BIP?</h5>
                                        <p class="mb-0 h4">Contact Terry Granshaw on 0457 650 181 or email tgranshaw@sugarresearch.com.au Armin Wessel on 0436 937 555 or email awessel@sugarresearch.com.au </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </main>
                <?php include('comp/footer.php')?>
            </div>
        </div>
        <script src="js/app.js"></script>
    </body>

</html>