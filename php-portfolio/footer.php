 </main>
		<!-- Footer Part -->
		<?php include('home-footer.php'); ?>

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/isotope.min.js"></script>
        <script src="js/countUp.js"></script>
		<!-- Isotop -->
		<script>
			// external js: isotope.pkgd.js
			var elem = document.querySelector('.prid');
			// init Isotope
			var iso = new Isotope( elem, {
				itemSelector: '.prid-elm',
				layoutMode: 'fitRows'
			});
			// bind filter button click
			var filterBtns = document.querySelector('.filter-button-group');
			filterBtns.addEventListener('click', function(elm){
				//only work with btns
				if(!matchesSelector(elm.target, 'button' )){
					return;
				}
				var filterValue = elm.target.getAttribute('data-filter');
				iso.arrange({filter: filterValue});
				filterBtns.querySelector('.active').classList.remove('active');
				elm.target.classList.add('active');
			});
		</script>
		
		<script>
			const options = {
				decimalPlaces: 2,
				duration: 5,
			};
			let demo = new CountUp('myTargetElement', 7639, options);
			if (!demo.error) {
				demo.start();
			} else {
				console.error(demo.error);
			}
        </script>
       <!-- Modal -->
	   <script>
			<?php 
				if(isset($errors['modalError'])){
			?>
				new bootstrap.Modal(document.getElementById("<?php echo ($errors['modalError'] ??''); ?>")).show();
			<?php
			}
			?>
        </script>
    </body>
</html>