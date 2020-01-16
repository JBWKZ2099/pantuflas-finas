<?php
	session_start();
	// ini_set("display_errors", "On");
	include("../php/db/conn.php");
	include("../php/db/auth.php");
	
	if( authCheck() ) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$title="Inicio";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php include("structure/navbar.php") ?>
	
	<div class="content-wrapper">
		<div class="contianer-fluid">
			<div class="col-md-12">
				<?php
					include("../alerts/errors.php");
					include("../alerts/success.php");
				?>
			</div>
			<div class="col-md-12">
				Bienvenido
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