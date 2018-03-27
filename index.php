<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$view_name="Inicio";
		include("structure/head.php");
		$asset = "assets/img/home/"; // Path where are storaged media files (img, video, etc)
	?>
</head>
<body>
	<?php $active="index"; include("structure/navbar.php") ?>

	<div id="home-carousel" class="carousel slide" data-ride="carousel">
	  <div class="carousel-inner">
	    <div class="carousel-item active" style="background-image:url('<?php echo $path.$asset."01.jpg" ?>') !important;">
	      <!-- <img class="d-block w-100" src="http://placehold.it/1900x900.jpg?text=1900x900.jpg" alt="Cover"> -->
	      <div class="relativer h-100">
		      <div class="container-custom h-100">
		      	<div class="row">
				      <div class="c-caption pl-3 pr-3">
				      	<h1 class="text-white text-center text-md-left h1-bigger mb-3 mb-md-0">
				      		UNA VIDA <br class="d-none d-md-block">
				      		CONFORTABLE <br class="d-none d-md-block">
				      		ES UNA VIDA FELIZ
				      	</h1>
				      </div>
				     </div>
		      	
		      	<div class="row justify-content-center carousel-contact-btn">
		      		<div class="col-md-3">
		      			<a id="scroll-contact" href="#" class="btn btn-yellow-light btn-block btn-noradius">CONTACTO</a>
		      		</div>
		      	</div>
		      </div>
		     </div>
	    </div>
	    <div class="carousel-item" style="background-image:url('<?php echo $path.$asset."02.jpg" ?>') !important;">
	      <!-- <img class="d-block w-100" src="http://placehold.it/1900x900.jpg?text=02 1900x900.jpg" alt="Cover"> -->
	    </div>
	    <div class="carousel-item" style="background-image:url('<?php echo $path.$asset."03.jpg" ?>') !important;">
	      <!-- <img class="d-block w-100" src="http://placehold.it/1900x900.jpg?text=03 1900x900.jpg" alt="Cover"> -->
	    </div>
	  </div>
	</div>

	<section class="pt-60 pb-60 bg-gray-light">
		<div class="container-custom">
			<div class="row">
				<div class="col-md-12">
					<h1 id="nosotros" class="mb-3 text-center"><strong>NOSOTROS</strong></h1>
					<p class="text-justify mb-3">
						<strong>Nuestra Misión:</strong>
					</p>
					<p class="text-justify mb-3">
						Proporcionar a nuestros clientes locales y foráneos  una extensa variedad de pantuflas, con desempeño y servicio superiores al costo más competitivo para los usuarios (clientes).
					</p>
					
					<div class="row justify-content-center mb-45">
						<div class="col-md-2 mb-3 md-md-0">
							<img class="img-fluid d-block m-auto" src="<?php echo $path.$asset."liverpool.png" ?>" alt="liverpool.png">
						</div>
						<div class="col-md-2 mb-3 md-md-0">
							<img class="img-fluid d-block m-auto" src="<?php echo $path.$asset."palacio.png" ?>" alt="palacio.png">
						</div>
						<div class="col-md-2 mb-3 md-md-0">
							<img class="img-fluid d-block m-auto" src="<?php echo $path.$asset."sams.png" ?>" alt="sams.png">
						</div>
						<div class="col-md-2 mb-3 md-md-0">
							<img class="img-fluid d-block m-auto" src="<?php echo $path.$asset."sanborns.png" ?>" alt="sanborns.png">
						</div>
						<div class="col-md-2 mb-3 md-md-0">
							<img class="img-fluid d-block m-auto" src="<?php echo $path.$asset."sears.png" ?>" alt="sears.png">
						</div>
					</div>

					<h1 id="catalogo" class="mb-3 mb-md-5 text-center"><strong>CATÁLOGO</strong></h1>
					<div class="row justify-content-center">
						<div class="col-md-6 mb-3 mb-md-0">
							<a href="<?php echo $path ?>pedidos">
								<img class="img-fluid d-block m-auto" src="<?php echo $path.$asset."catalogo_dama.png" ?>" alt="Lady">
							</a>
							<h4 class="text-center mt-3">PANTUFLAS PARA DAMA</h4>
						</div>
						<div class="col-md-6 mb-3">
							<a href="<?php echo $path ?>pedidos">
								<img class="img-fluid d-block m-auto" src="<?php echo $path.$asset."catalogo_caballero.png" ?>" alt="Gentleman">
							</a>
							<h4 class="text-center mt-3">PANTUFLAS PARA CABALLERO</h4>
						</div>

						<div class="col-md-12">
							<p class="text-justify">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis quia ullam corrupti asperiores fugiat doloribus. Voluptatibus doloremque, dolorum hic perferendis in nostrum, debitis obcaecati quae, rem eius dolorem! Quisquam, provident. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis quia ullam corrupti asperiores fugiat doloribus. Voluptatibus doloremque, dolorum hic perferendis in nostrum, debitis obcaecati quae, rem eius dolorem! Quisquam, provident. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis quia ullam corrupti asperiores fugiat doloribus. Voluptatibus doloremque, dolorum hic perferendis in nostrum, debitis obcaecati quae, rem eius dolorem! Quisquam, provident.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="mt-3 mb-3"></section>

	<a href="https://api.whatsapp.com/send?phone=525545934135" class="whatsapp-contact p-2 p-md-3" target="_blank">
		<span class="d-none d-md-block">Envíanos un mensaje de Whatsapp</span>
		<i class="fab fa-whatsapp fa-2x d-block d-md-none"></i>
	</a>

	<?php include("widgets/frm-cont.php"); ?>

	<?php include("structure/footer.php") ?>
</body>
</html>