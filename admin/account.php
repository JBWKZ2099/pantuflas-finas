<?php
ini_set("display_errors", "On");
	session_start();
	include("../php/db/conn.php");
	include("../php/db/auth.php");
	
	if( authCheck() && user()["permission"]==1 ) {
		$table = "users";
		if( isset($_GET["id"]) ) {
			$id = (int)$_GET["id"];
			if( !validateData( $id, $table ) )
				header("Location: customers");
			else {
				$mysqli = conectar_db();
				selecciona_db($mysqli);
				$sql = "SELECT * FROM $table WHERE id=$id";
				$result = consulta_tb($mysqli,$sql);
			}
		} else {
			$id = user()["id"];
			$mysqli = conectar_db();
			selecciona_db($mysqli);
			$sql = "SELECT * FROM $table WHERE id=$id";
			$result = consulta_tb($mysqli,$sql);
		}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$title="Editar cuenta";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
	<script src="assets/js/datatables/jquery.js"></script>
	<script src="assets/js/datatables/jquery.dataTables.js"></script>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php
		$active_menu = "myaccount_mn";
		$collapse = "myaccount";
		$active_opt = "myaccount-edit";
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
								Editando cuenta
							</div>
							<div class="card-body">
								<?php
									include("../alerts/errors.php");
									include("../alerts/success.php");
								?>
								<form action="../php/db/requests.php" method="POST">
									<input type="hidden" name="request" value="edit-account">
									<input type="hidden" name="which" value="<?php if( isset($_GET["id"]) && !empty($_GET["id"]) ) echo $_GET["id"]; else echo $id; ?>">
									<?php
										$row = mysqli_fetch_array($result);
										$sql = null; $sql = "SELECT * FROM access WHERE id_user=".$row['id'];
										$u_result = consulta_tb($mysqli,$sql);
										$access_row = mysqli_fetch_array($u_result);
										$edit = true;
									?>
									<?php include("forms/customer-form.php") ?>
									<button type="submit" class="btn btn-success">Actualizar</button>
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