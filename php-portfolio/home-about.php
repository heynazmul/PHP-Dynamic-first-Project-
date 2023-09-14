
<?php 
require_once('function/about.php');
$aboutData = aboutHeadingData();
$skills=[
			[	'title'=>'web design',
				'color'=> 'bg-danger',
				'percentage'=> '40'
			
			],
			[	'title'=>'web design',
				'color'=> 'bg-primary',
				'percentage'=> '90'
			
			],
		
		];

$abutContent = aboutContentFrontData()??$skills;

		
?>

<section id="about">
	<div class="container">
		<!-- About Me -->
		<div class="text-center ">
			<h6 class="text-primary mb-0 fw-normal wow lightSpeedInRight"><?php echo $aboutData['title']?? 'My Services'; ?></h6>
			<h1 class=" text-uppercase text-white mb-5 pb-3 wow lightSpeedInLeft"><?php echo $aboutData['short_title']?? 'Welcome To My Website'; ?></h1>
			<p class="text-white my-5 lh-lg"><?php echo $aboutData['details']?? 'Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, modi pariatur placeat consequatur voluptatem aperiam. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Temporibus ad magni placeat consectetur asperiores soluta doloribus provident modi accusamus porro Lorem ipsum dolor sit, amet consectetur adipisicing elit.Lorem ipsum dolor sit, amet consectetur adipisicing elit.Lorem ipsum dolor sit, amet consectetur adipisicing elit.Lorem ipsum dolor sit, amet consectetur adipisicing elit.Lorem ipsum dolor sit, amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis,'; ?> </p>
		</div>
		<!-- progress part -->
		<div class="row g-3 gy-4 justify-content-center  text-white wow zoomInUp">
			<?php
		
		foreach($abutContent as $skill){
		?>	
			<div class="col-4">
				<h6 class="mb-1"><?php echo ($skill['title']);?></h6>
				<div class="progress rounded-pill">
					<div class="progress-bar progress-bar-striped progress-bar-animated <?php echo ($skill['short_title']);?> rounded-pill" role="progressbar" style="width: <?php echo ($skill['details']);?>%">
					</div>
				</div>
			</div>
			<?php 
			
				}
			?>
		</div> 
	</div>
</section>