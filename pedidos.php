<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$view_name="Pedidos";
		include("structure/head.php");
		$asset = "assets/img/folder_name/"; // Path where are storaged media files (img, video, etc)
	?>
</head>
<body>
	<?php $active="pedidos"; include("structure/navbar.php") ?>

	<div id="pedidos-carousel" class="carousel" data-ride="carousel">
	  <div class="carousel-inner">
	    <div class="carousel-item active">
	      <img class="d-block w-100" src="http://placehold.it/1900x800.jpg?text=02 1900x800.jpg" alt="Cover">
	    </div>
	  </div>
	</div>

	<section class="bg-yellow-light pt-60 pb-60">
		<div class="container-custom">
			<div class="pedidos-title col-md-4">
		  	<h2 class="mb-3">CATÁLOGO <br class="d-none d-md-block"> DE PRODUCTOS</h2>
		  	<p>
		  		CABALLEROS <span class="ml-3 mr-3">|</span> DAMAS
		  	</p>
		  </div>

			<div class="row pt-30 products-container">
				<div class="col-md-6">
					<img class="img-fluid d-block m-auto" src="http://placehold.it/600x360.jpg?text=600x360.jpg" alt="">
				</div>
				<div class="col-md-6">
					<p><strong>DESCRIPCIÓN</strong></p>
					<p>
						<strong>PANTUFLA CON TALÓN 2</strong>
					</p>
					<p>
						<strong>ESTILO:</strong> 4517
					</p>
					<p>
						<strong>TALLAS:</strong> 26 al 30
					</p>
					<p>
						<strong>Colores:</strong> Café
					</p>
					<p>
						<strong>Descripción:</strong> Pantuflas con talón 2
					</p>
					<p>
						<strong>Suela:</strong> TR SS Caja Confort
					</p>
					<p>
						<strong>Forro:</strong> Baby lamb
					</p>
					<p>
						<strong>Categoría:</strong> Confort Caballero
					</p>

					<div class="row mt-3">
						<div class="col-md-4">
							<img class="img-fluid d-block m-auto" src="http://placehold.it/600x360.jpg?text=600x360.jpg" alt="">
						</div>
						<div class="col-md-4">
							<img class="img-fluid d-block m-auto" src="http://placehold.it/600x360.jpg?text=600x360.jpg" alt="">
						</div>
						<div class="col-md-4">
							<img class="img-fluid d-block m-auto" src="http://placehold.it/600x360.jpg?text=600x360.jpg" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<a href="https://api.whatsapp.com/send?phone=5500000000" class="whatsapp-contact p-2 p-md-3">
		<span class="d-none d-md-block">Envíanos un mensaje de Whatsapp</span>
		<i class="fab fa-whatsapp fa-2x d-block d-md-none"></i>
	</a>

	<?php include("widgets/frm-cont.php"); ?>

	<?php include("structure/footer.php") ?>
</body>
</html>