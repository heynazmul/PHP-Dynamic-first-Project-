
<?php  

	require_once('function/reviews.php');
	

	$reviews = [
					[
						'icon'=>'far fa-lightbulb',
						'number'=>'48',
						'title'=>'Project Done'
					],
					[
						'icon'=>'far fa-heart',
						'number'=>'40',
						'title'=>'Satisfied Client'
					],
					[
						'icon'=>'fas fa-magic',
						'number'=>'82',
						'title'=>'Awards'
					],
					[
						'icon'=>'far fa-smile-beam',
						'number'=>'75',
						'title'=>'Happy Client'
					],
					
				];

	$reviewContent = reviewContentFrontData()??$reviews;

?>



<!-- Review -->
<section id="review"  style="background-image: url(images/ph.jpg); background-attachment: fixed; background-repeat: no-repeat; background-size: cover;">
	<div class="container " >
		<div class="row">
			<!-- Review 01 -->
			<?php 
				foreach($reviewContent as $data){
					
			?>
			<!-- part  -->
			<div class="col-md-3 col-6 mb-4 text-center">
				<h2 class="text-warning mb-3"><i class="<?php echo ($data['icon'])?>"></i></h2>
				<h3 class="fw-bold text-white mb-4"><?php echo ($data['number'])?></h3>
				<h6 class="text-white"><?php echo ($data['title'])?></h6>
			</div>
			
			<?php
				}
			?>
		</div>
	</div>
</section>