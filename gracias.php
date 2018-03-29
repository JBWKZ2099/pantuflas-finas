<?php
	session_start();
	if( !isset($_SESSION['thanks']) ) {
		// echo "<script> window.location.href = 'contacto.php' </script>";
		header("Location: index");
	}
		unset($_SESSION["thanks"]);
		unset($_SESSION["error"]);
	// echo $_SESSION["thanks"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$view_name="Gracias por contactarnos";
		include("structure/head.php");
		$asset = "assets/img/home/"; // Path where are storaged media files (img, video, etc)
	?>
</head>
<body>
	<?php $active="index"; include("structure/navbar.php") ?>

	<section class="container-custom thanks-page">
		<div class="row h-100 align-items-center">
			<div class="col-md-12 text-center">
				<h1 class="mb-3">GRACIAS POR CONTACTARNOS, PRONTO NOS PONDREMOS EN CONTACTO CONTIGO.</h1>

				<div class="row justify-content-center">
					<div class="col-md-3">
						<a href="<?php echo $path ?>" class="btn btn-yellow-light btn-block btn-noradius">Volver</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include("structure/footer.php") ?>
</body>
</html>