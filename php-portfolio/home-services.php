<!-- Services -->

<?php 
require_once('function/services.php');
$serviceHeadingData = sectionHeadingData();
$service=[
			[	'icon'=> 'fas fa-list-ul',
				'title'=>'Professional Code',
				'details'=> 'Lorem ipsum dolor, amet consecture lorem ipsum'
			
			],
			[	'icon'=> 'fas fa-list-ul',
				'title'=>'Professional Code',
				'details'=> 'Lorem ipsum dolor, amet consecture lorem ipsum'
			],
		
		];

$serviceContent = sectionContentFrontData()??$service;

		
?>


<section id="service" style="background-image: url(images/serve.jpg); background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
	<div class="container">
	
		<!-- service part 01 -->
		<div class="text-center ">
			<h6 class="text-primary mb-0 fw-normal wow fadeInLeftBig"><?php echo $serviceHeadingData['title']?? 'My Services'; ?></h6>
			<h1 class=" text-uppercase text-white mb-4 wow fadeInLeftBig"><?php echo $serviceHeadingData['details']?? 'What I Do'; ?></h1>
		</div>
		<!--  service part 02 -->
		<div class="row">
		<?php
		
		foreach($serviceContent as $data){
		?>	
		
			<!-- part 01 -->
			<div class="col-lg-4 col-sm-6 mb-3 ">
				<div class="card text-center text-white p-5 h-100 bg-opacity-25 bg-light hover-effect">
					<h2 class="text-warning mb-3"><i class="<?php echo ($data['icon']);?>"></i></h2>
					<h4 class="mb-4 text-uppercase "><?php echo ($data['title']);?></h4>
					<p class="px-2"> <?php echo ($data['details']);?></p>
				</div>
			</div>
		<?php
		}
		?>
		</div>
	</div>
</section>