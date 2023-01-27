<style>
.nav-link
{
  font-size: 20px;
}

</style>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #008091;">
    <a class="navbar-brand" href="dashboard.php">
      <img src="logo_W1.png" alt="..." height="24">
    </a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>	
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		<ul class="navbar-nav ">
			<li class="nav-item">
				<a class="nav-link" href="index.php">Dashboard</a>
			</li>				
			<!-- <li class="nav-item">
				<a class="nav-link" href="index.php" >Property</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="pumpsummary.php">Pump</a>
			</li>		
			<li class="nav-item dropdown">
				<a class="nav-link" href="paddocksummary.php">Paddock</a>
			</li> -->
			<!-- <li class="nav-item" <?php echo $style;?>>
				<a class="nav-link" href="irrigation.php">Irrigation</a>
			</li>	 -->
			<li class="nav-item">
				<a class="nav-link" href="baseline.php">Benchmark</a>
			</li>
			<!-- <li class="nav-item" <?php echo $style;?>>
				<a class="nav-link" href="waterquality.php">Water Quality</a>
			</li>		 -->
			<li class="nav-item">
				<a class="nav-link" href="farmmanagement.php">Management</a>
			</li>		
			<!-- <li class="nav-item dropdown" <?php echo $style;?>>
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Delivery Team
				</a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="#">ATS</a></li>
					<li><a class="dropdown-item" href="#">BPS</a></li>
					<li><a class="dropdown-item" href="#">FRC</a></li>
				</ul>
			</li>											 -->
		</ul>
		<ul class="navbar-nav navbar-align">

			<li class="nav-item dropdown">
				<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
					<i class="align-middle" data-feather="settings"></i>
				</a>				
				<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
					<img src=
					<?php 
						if($_SESSION['role'] == 0){	
							echo "man.png";
						}
						else
						{
							echo "farmer.png";
						}
					?>                                
					class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-light">
					<?php 
						echo $_SESSION['username'];
					?>
					</span>
				</a>
				<div class="dropdown-menu dropdown-menu-end">
					<a class="dropdown-item" href="changepassword.php">Change Password</a>
					<a class="dropdown-item" href="index.php?logout='1'">Log out</a>
				</div>			
			</li>
		</ul>
	</div>
</nav>