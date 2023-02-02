<style>
.nav-link
{
  font-size: 20px;
}

</style>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #25a2ac;">
    <a class="navbar-brand" href="home.php">
      <img src="img/logo_W1.png" alt="..." height="24">
    </a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>	
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		<ul class="navbar-nav ">
			<li class="nav-item">
				<a class="nav-link text-white" href="index.php">Dashboard</a>
			</li>				
			<li class="nav-item">
				<a class="nav-link text-white" href="datanalytics.php">Data Analytics</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" href="benchmark.php">Benchmark</a>
			</li>	
			<li class="nav-item">
				<a class="nav-link text-white" href="farmmanagement.php">Baseline</a>
			</li>					

		</ul>
		<ul class="navbar-nav navbar-align">

			<li class="nav-item dropdown">
				<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
					<i class="align-middle" data-feather="settings"></i>
				</a>				
				<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
					<img src=
					<?php 				    
					   echo "img/{$_SESSION['username']}.png";
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