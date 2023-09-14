
<?php  

	require_once('function/address.php');
	

	$address = [
					[
						'icon'=>'far fa-map',
						'title'=>'Address',
						'details'=>'Jatrabari Dhaka'
					],
					[
						'icon'=>'far fa-envelope',
						'title'=>'Email ',
						'details'=>'alamin@gmail.com'
					],
					[
						'icon'=>'fas fa-mobile-alt',
						'title'=>'Phone ',
						'details'=>'01575136768'
					],
				];

	$addressContent = addressContentFrontData()??$address;

?>

<!-- Contact Us -->
<section id="contact"  class="bg-light" style="background-image: url(images/background01.png); background-attachment: fixed; background-repeat: no-repeat; background-size: cover;">
	<div class="container">
		<div class="text-center">
			<h6 class="text-primary mb-0 fw-normal">Find Me</h6>
			<h1 class="text-uppercase text-dark mb-5 " >contact me now</h1>
		</div> 
		<form class="row" name="contactForm" >
			<div class="col-sm-6" >
				<div class="form-group mb-3">
					<input class="form-control bg-transparent border-dark py-2" type="text" name="name" placeholder="Enter Your Name" onfocus="Focus(this)"> 
					<span id="nameError"></span>
				</div>
				<div class="form-group py-2">
					<input class="form-control bg-transparent border-dark py-2"  type="email" name="email" placeholder="Enter Your Email" onfocus="Focus(this)"> 
					<span id="emailError"></span>
				</div>
				<div class="form-group my-3">
					<input class="form-control bg-transparent border-dark py-2"  type="text" name="phone"  placeholder="Enter Your Number" onfocus="Focus(this)">
					<span id="phoneError"></span>
				</div> 
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<textarea class="form-control bg-transparent border-dark" rows="6"  name="message" placeholder="Type Your Message" onfocus="Focus(this)"></textarea>
					<span id="messageError"></span>
				</div>
			</div>
			<div class="my-3 text-center w-100">
				<button type="submit" name="submitBtn" class="btn btn-lg btn-primary " id="sub-btn">submit</button>
			</div>
		</form>
		<!-- address -->
		<div class="row mt-5 text-center text-white" id="address">
			<?php 
				foreach($addressContent as $data){
					
			?>
			<div class="col-sm-4 col-">
				<h1 class="text-primary mb-3 " ><i class="<?php echo ($data['icon'])?>"></i></h1>
				<p class="text-black"><?php echo ($data['title'])?> <br> <?php echo ($data['details'])?></p>
			</div>
			<?php
				}
			?>
		
		</div>
	</div>
</section>