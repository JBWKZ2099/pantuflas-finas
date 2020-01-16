<?php
	session_start();
	include("../php/db/conn.php");
	include("../php/db/auth.php");

	if( !authCheck() ) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$title="Login";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
</head>
<body class="bg-dark" id="page-top">

	<?php if( authCheck() ) { ?>
		<?php include("structure/navbar.php") ?>
	<?php } ?>

	
	<div class="container-fluid bg-white">
		<div class="row">
			<div class="jumbotron-container col-md-12">
				<div class="row h-100 align-items-center justify-content-center">
				  <div class="jumbotron col-md-4">
				    <div class="card card-login">
							<div class="card-header fill-white">
								<a href="/">
									<img src="http://placehold.it/200x50.svg?text=BrandLogo" alt="RDMLogo" class="img-fluid svg d-block m-auto">
								</a>
							</div>
							<div class="card-body">
								<?php include("../alerts/errors.php") ?>
								<form id="needs-validation" action="../php/db/requests.php" method="POST" autocomplete="off" novalidate>
									<input type="hidden" name="request" value="login">
									<div class="form-group">
										<label for="username">Usuario</label>
										<input type="text" class="form-control" name="username" placeholder="Usuario" required="">
										<div class="invalid-feedback">
							        El campo 'usuario' no debe de estar vacío.
							      </div>
									</div>
									<div class="form-group">
										<label for="password">Contraseña</label>
										<input type="password" class="form-control" name="password" placeholder="Contraseña" required="">
										<div class="invalid-feedback">
							        El campo 'contraseña' no debe de estar vacío.
							      </div>
									</div>

									<div class="form-group">
										<small>
											<a href="#" data-toggle="modal" data-target="#register">Registrarme</a>
										</small>
										<br>
										<small>
											<a href="#" data-toggle="modal" data-target="#restore-pass">Recuperar contraseña</a>
										</small>
									</div>

									<button class="btn btn-orange btn-block">Entrar</button>
								</form>
							</div>
						</div>
				  </div>
				 </div>
			</div>
		</div>
	</div>

	<?php include("structure/footer.php") ?>

	<!-- Modal -->
	<div class="modal fade" id="restore-pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Recuperar contraseña</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        ...
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Registrarme</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<form action="<?php echo $abs_path."/"; ?>../php/db/requests.php" method="POST">
						<input type="hidden" name="request" value="create-customer">
						<input type="hidden" name="page" value="register">
						<input type="hidden" name="table" value="users">
	        	<?php $login=true; include("forms/customer-form.php"); ?>
	        	<button type="submit" class="btn btn-success float-right">Registrar</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fa fa-angle-up"></i>
	</a>

	<?php include("widgets/modal.php") ?>
	<script src="assets/js/plugins/novalidate.js"></script>
</body>
</html>
<?php
	} else header("Location: index");
?>