<!-- Header Part -->
<header>
	<!-- Name and Logo -->
	<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-transparent-dark" id="main-nav" >
		<a class="navbar-brand d-flex" href="#" >
			<img src="images/logo.png" alt="Company Logo" style=" height:60px; width:60px;">
			<h2 class="ms-3 my-auto">Nazmul Hossain</h2>
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbars" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon "></span>
		</button>

		<div class="collapse navbar-collapse"  id="navbars">
			<ul class="navbar-nav ms-auto me-4">
				<li class="nav-item"><a class="nav-link px-4 text-white active" aria-current="page" href="#home" >Home</a></li>
				<li class="nav-item"><a class="nav-link px-4 text-white" href="#about">About</a></li>
				<li class="nav-item"><a class="nav-link px-4 text-white" href="#service">Services</a></li>
				<li class="nav-item"><a class="nav-link px-4 text-white" href="#project">Projects</a></li>
				<li class="nav-item"><a class="nav-link px-4 text-white" href="#contact">contact</a></li>
				<!-- sign in modal -->
				<li class="nav-item">
				<?php
					if(isset($_SESSION['Hoise_to']) && $_SESSION['Hoise_to']) {
				?>
					<a type="button" class="nav-link text-white px-4 btn btn-warning rounded-lg" href="dashboard/index.php">Dashboard</a>
				<?php
					}else{
						
				?>
					<a type="button" class="nav-link text-white px-4 btn btn-primary rounded-0" href="#loginModal" data-bs-toggle="modal">Login</a>
				
				<?php
					}
				?>
					
				</li>
			</ul>
		</div>
	</nav>
	<?php include('sign-in-modal.php'); ?>
</header>