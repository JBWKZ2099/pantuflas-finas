<!-- /.content-wrapper-->
<footer class="sticky-footer <?php if( !authCheck() ) { ?> w-100 <?php } ?>">
	<div class="container">
		<div class="text-center">
			<small>Copyright &copy; <?php echo $company_name." ".$copy_year; ?></small>
		</div>
	</div>
<?php if( !validateActivation( user()["id"] ) ) { ?>
	<?php /*print_r($_SESSION)*/ ?>
	<!-- Modal -->
	<div class="modal fade" id="change-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Aviso</h5>
	      </div>
	      <div class="modal-body">
	      	<?php if( isset($_SESSION["old_password"]) && !empty($_SESSION["old_password"]) ) { ?>
	      		<p class="mb-3">Tu contraseña actual es: <?php echo $_SESSION["old_password"]; ?></p>
	      	<?php } ?>
	      	<p class="mb-3">Debes actualizar tu contraseña para poder continuar.</p>
	      	
	      	<form action="<?php echo $abs_path."/../" ?>php/db/requests.php" method="POST">
	      		<input type="hidden" name="request" value="update-password">
	      		<input type="hidden" name="mail-user" value="<?php echo user()["email"] ?>">
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