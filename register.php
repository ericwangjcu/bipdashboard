<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Register</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

	<style>
	body  {
	background-image: url("welcome.jpg");
	background-color: #cccccc;
	}
</style>	
</head>

<body>
<main class="bg">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">
					<div class="text-center mt-4">
						<img src="logo_W.png" width=40% />
							<h1 class="h2" style="color:white">Burdekin Irrigation Project</h1>
						</div>
						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">	 
									<form method="post" action="login.php">
										<?php include('errors.php'); ?>
										<div class="mb-3">
											<label class="form-label">Username</label>
											<input class="form-control form-control-lg" type="text" name="username" value="<?php echo $username; ?>" placeholder="Enter your username" />
										</div>
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" value="<?php echo $email; ?>" placeholder="Enter your username" />
										</div>													
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password_1" placeholder="Enter your password" />
										</div>			
										<div class="mb-3">
											<label class="form-label">Confirm password</label>
											<input class="form-control form-control-lg" type="password" name="password_2" placeholder="Enter your password" />
										</div>																					
										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary" name="reg_user">Register</button>
										</div>
										<p>
											Already a member? <a href="login.php">Sign in</a>
										</p>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
</body>
</html>
