<?php
ini_set("display_errors", "On");
	session_start();
	include("../php/db/conn.php");
	include("../php/db/auth.php");
	
	if( authCheck() && user()["permission"]==1 && userAccess()["users"]==1 ) {
		$mysqli = conectar_db();
		selecciona_db($mysqli);
		$sql = "SELECT * FROM web_information";
		$result = consulta_tb($mysqli,$sql);
		mysqli_set_charset("UTF8");
		$row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$title="Editar información web";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
	<script src="assets/js/datatables/jquery.js"></script>
	<script src="assets/js/datatables/jquery.dataTables.js"></script>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php
		$active_menu = "manteinance_mn";
		$collapse = "manteinance";
		$active_opt = "manteinance-edit";
		include("structure/navbar.php");
	?>

	<div class="content-wrapper">
		<div class="contianer-fluid">
			<div class="container-fluid">
				<div class="row mt-3">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header bg-blue text-white">
								<i class="fa fa-fw fa-pencil-square-o"></i>
								Editando información
							</div>
							<div class="card-body">
								<form action="../php/db/requests.php" method="POST">
									<input type="hidden" name="request" value="update-web">
									<?php
										$edit = true;
									?>
									<?php include("forms/manteinance-form.php") ?>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include("structure/footer.php") ?>

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fa fa-angle-up"></i>
	</a>
	<?php include("widgets/modal.php") ?>
</body>
</html>
<?php
	} else {
		header("Location: login");
	}
?>