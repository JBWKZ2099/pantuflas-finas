<footer class="pt-3 pt-md-5 pb-3 pb-md-5 bg-black">
	<div class="container-custom">
		<div class="row">
			<div class="col-sm-12 text-center">
				<p class="text-white mb-3">
					Av. Tezozomoc 106 <span class="ml-3 mr-3">|</span> Col. San Miguel Amantla <span class="ml-3 mr-3">|</span> CDMX <span class="ml-3 mr-3">|</span> Municipio Azcapotzalco <span class="ml-3 mr-3">|</span> C.P. 02700
				</p>
				 <p class="text-white">
				 	Tel. <a href="tel:5552502999" class="text-white">(55) 52502999</a> Fax. (55)52541868
				 </p>
				 <p class="text-white mb-3">
				 	<a class="text-white" href="mailto:astahlr@prodigy.net.mx">astahlr@prodigy.net.mx</a> <a class="text-white" href="mailto:erobles32@gmail.com">erobles32@gmail.com</a>
				 </p>
				 <p class="text-white">
				 	FACTURACIÓN <span class="ml-3 mr-3">|</span> <a href="<?php echo $path ?>aviso-privacidad" class="text-white">AVISO DE PRIVACIDAD</a>
				 </p>
				
				<div class="social">
					<a href="https://fb.com" class="text-white mr-3" target="_blank">
						<i class="fab fa-facebook fa-2x"></i>
					</a>
					<a href="https://twitter.com" class="text-white" target="_blank">
						<i class="fab fa-twitter fa-2x"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</footer>
<script src="assets/js/foot.js"></script>


<?php if( !isset($_SESSION["old_password"]) && !empty($_SESSION["old_password"]) ) { ?>
	<?php print_r($_SESSION) ?>
	<!-- Modal -->
	<div class="modal fade" id="change-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Aviso</h5>
	      </div>
	      <div class="modal-body">
	      	<p class="mb-3">Tu contraseña actual es: <?php echo $_SESSION["old_password"]; ?></p>
	      	<p class="mb-3">Debes actualizar tu contraseña para poder continuar.</p>
	      	
	      	<form action="<?php echo $path ?>php/db/requests.php" method="POST">
	      		<input type="hidden" name="request" value="update-password">
	      		<input type="hidden" name="user" value="update-password">
	      		<div class="form-group">
		      		<input type="password" class="form-control" name="new-password" placeholder="Nueva contraseña." required>
		      	</div>

		      	<button type="submit" class="btn btn-success">Actualizar contraseña.</button>
	      	</form>
	      </div>
	    </div>
	  </div>
	</div>

	<script>
		$("#change-password").modal({
			show: true,
			keyboard: false,
			backdrop: "static"
		});
	</script>
<?php } ?>