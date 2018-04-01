<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$view_name="Inicio";
		include("structure/head.php");
		$asset = "uploads/"; // Path where are storaged media files (img, video, etc)
	?>
</head>
<body>
	<?php $active="index"; include("structure/navbar.php") ?>

	<div id="home-carousel" class="carousel slide" data-ride="carousel">
	  <div class="carousel-inner">
	    <div class="carousel-item active" style="background-image:url('<?php echo $path.$asset.$row["banner_home_1"] ?>') !important;">
	      <!-- <img class="d-block w-100" src="http://placehold.it/1900x900.jpg?text=1900x900.jpg" alt="Cover"> -->
	      <div class="carousel-caption text-center">
	      	<div class="col-md-12 mb-3">
	      		<div class="row justify-content-center">
	      			<div class="col-md-3">
	      				<a id="scroll-contact" href="#" class="btn btn-yellow-light btn-block btn-noradius"><?php echo $row["banner_btn_home_text"]; ?></a>
	      			</div>
	      		</div>
	      	</div>
	      	<h1 class="text-white mb-3 mb-md-0">
				    <?php echo $row["banner_home_text"]; ?>
				  </h1>
	      </div>
	    </div>
	    <div class="carousel-item" style="background-image:url('<?php echo $path.$asset.$row["banner_home_2"] ?>') !important;">
	      <!-- <img class="d-block w-100" src="http://placehold.it/1900x900.jpg?text=02 1900x900.jpg" alt="Cover"> -->
	    </div>
	    <div class="carousel-item" style="background-image:url('<?php echo $path.$asset.$row["banner_home_3"] ?>') !important;">
	      <!-- <img class="d-block w-100" src="http://placehold.it/1900x900.jpg?text=03 1900x900.jpg" alt="Cover"> -->
	    </div>
	  </div>
	</div>

	<section class="pt-60 pb-60 bg-gray-light">
		<div class="container-custom">
			<div class="row">
				<div class="col-md-12">
					<h1 id="nosotros" class="mb-3 text-center"><strong><?php echo $row["title_aboutus"]; ?></strong></h1>
					<div class="text-justify">
						<?php echo $row["about_us"]; ?>
					</div>
					
					<div class="row justify-content-center align-items-center mb-45">
						<div class="col-md-2 mb-3 md-md-0">
							<img class="img-fluid d-block m-auto" src="<?php echo $path.$asset.$row["brand_1"] ?>" alt="<?php echo $row["brand_1"]; ?>">
						</div>
						<div class="col-md-2 mb-3 md-md-0">
							<img class="img-fluid d-block m-auto" src="<?php echo $path.$asset.$row["brand_2"] ?>" alt="<?php echo $row["brand_2"]; ?>">
						</div>
						<div class="col-md-2 mb-3 md-md-0">
							<img class="img-fluid d-block m-auto" src="<?php echo $path.$asset.$row["brand_3"] ?>" alt="<?php echo $row["brand_3"]; ?>">
						</div>
						<div class="col-md-2 mb-3 md-md-0">
							<img class="img-fluid d-block m-auto" src="<?php echo $path.$asset.$row["brand_4"] ?>" alt="<?php echo $row["brand_4"]; ?>">
						</div>
						<div class="col-md-2 mb-3 md-md-0">
							<img class="img-fluid d-block m-auto" src="<?php echo $path.$asset.$row["brand_5"] ?>" alt="<?php echo $row["brand_5"]; ?>">
						</div>
					</div>

					<h1 id="catalogo" class="mb-3 mb-md-5 text-center"><strong><?php echo $row["title_catalogue"]; ?></strong></h1>
					<div class="row justify-content-center">
						<div class="col-md-6 mb-3 mb-md-0">
							<a href="<?php echo $path ?>pedidos">
								<img class="img-fluid d-block m-auto" src="<?php echo $path.$asset.$row["lady_img"] ?>" alt="Lady">
							</a>
							<h4 class="text-center mt-3"><?php echo $row["lady_catalogue"]; ?></h4>
						</div>
						<div class="col-md-6 mb-3">
							<a href="<?php echo $path ?>pedidos">
								<img class="img-fluid d-block m-auto" src="<?php echo $path.$asset.$row["gentleman_img"] ?>" alt="Gentleman">
							</a>
							<h4 class="text-center mt-3"><?php echo $row["gentleman_catalogue"]; ?></h4>
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