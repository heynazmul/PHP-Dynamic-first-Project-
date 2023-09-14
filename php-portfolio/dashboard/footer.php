</main>
  </div>
</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

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

<?php ob_flush(); ?>