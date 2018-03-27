<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$view_name="Pedidos";
		include("structure/head.php");
		$asset = "assets/img/pedidos/"; // Path where are storaged media files (img, video, etc)
	?>
</head>
<body>
	<?php $active="pedidos"; include("structure/navbar.php") ?>

	<div id="pedidos-carousel" class="carousel" data-ride="carousel">
	  <div class="carousel-inner">
	    <div class="carousel-item active" style="background-image: url('<?php echo $path.$asset; ?>pedidos.png')">
	      <!-- <img class="d-block w-100" src="<?php echo $path.$asset; ?>pedidos.png" alt="Cover"> -->
	    </div>
	  </div>
	</div>

	<section class="bg-yellow-light pt-60 pb-60">
		<div class="container-custom">
			<div class="row">
				<div class="col-md-12">
					<?php include("alerts/errors.php"); ?>
					<?php include("alerts/success.php"); ?>
				</div>
				<?php for( $i=0; $i<=8; $i++ ) { ?>
					<a href="<?php echo $path ?>pedidos-detalles?id=<?php echo $i+1; ?>" class="col-md-4 mb-3">
						<img class="img-fluid d-block m-auto" src="http://placehold.it/600x360.jpg?text=600x360.jpg" alt="">
						<div class="product-name">
							Pantufla 00<?php echo $i; ?>
						</div>
					</a>
				<?php } ?>
			</div>
		</div>
	</section>


	<a href="https://api.whatsapp.com/send?phone=5500000000" class="whatsapp-contact p-2 p-md-3">
		<span class="d-none d-md-block">Envíanos un mensaje de Whatsapp</span>
		<i class="fab fa-whatsapp fa-2x d-block d-md-none"></i>
	</a>

	<?php include("widgets/frm-cont.php"); ?>

	<?php include("structure/footer.php") ?>

	<script>
		$("[data-id='test']").elevateZoom({
		  zoomType: "inner",
		  cursor: "crosshair",
		  scrollZoom: true
		});
	</script>
</body>
</html>