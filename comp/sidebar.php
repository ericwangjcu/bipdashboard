<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.php">
            <img src="img/logo_W1.png" alt="..." height="48">
        </a>

        <div class="sidebar-user">
            <div class="d-flex justify-content-center">
                <div class="flex-shrink-0">
                    <img src=					
                    <?php 				    
					   echo "img/{$_SESSION['username']}.png";
					?>    class="avatar img-fluid rounded me-1" alt=
                    <?php 
                        echo $_SESSION['username'];
                    ?> 
                    />
                </div>
                <div class="flex-grow-1 ps-2 mt-2">
                    <a class="sidebar-user-title dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    <?php 
						echo $_SESSION['username'];
					?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-start">
					<a class="dropdown-item" href="changepassword.php">Change Password</a>
					<a class="dropdown-item" href="index.php?logout='1'">Log out</a>
                    </div>

                </div>
            </div>
        </div>

        <ul class="sidebar-nav">
            <!-- <li class="sidebar-header">
                Pages
            </li> -->
            <li class="sidebar-item">
                <a class="sidebar-link" href="home.php">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Home</span>
                </a>
            </li>
            <!-- <li class="sidebar-item">
                <a class="sidebar-link" href="index.php">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li> -->
            <li class="sidebar-item">
                <a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
                <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="index.html">Set</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="index.html">Irrigation</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="index.html">Cost</a></li>

                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="datanalytics.php">
                    <i class="align-middle" data-feather="pie-chart"></i> <span class="align-middle">Analytics</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="benchmark.php">
                    <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Benchmark</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="farmmanagement.php">
                    <i class="align-middle" data-feather="database"></i> <span class="align-middle">Data</span>
                </a>
            </li>
        </ul>


    </div>
</nav>