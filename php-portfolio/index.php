<?php
	session_start();
	if(isset($_GET['sub_contact'])){
		require ('test.php');
		$old = $_GET;
		//print_r($old);
		$contact = contactinfo();
		
		if( ($contact['status']) == 'error'){
			$error = $contact['message'];
		}
	}

?>

		<?php include('header.php'); ?>
            <!-- slide part -->
			<?php include('home-slider.php'); ?>
            <!-- About Me -->
            <?php include('home-about.php'); ?>
            <!-- Services Part-->
            <?php include('home-services.php'); ?>
            <!-- Projects/Portfolio -->
            <?php include('home-projects.php'); ?>
            <!-- Review -->
            <?php include('home-review.php'); ?>
            <!-- Contact Us -->
            <?php include('home-contact.php'); ?>                 
        <?php include('footer.php'); ?>                 
       