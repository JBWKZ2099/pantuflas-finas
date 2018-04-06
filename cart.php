<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		session_start();
		$view_name="Carrito de pedidos";
		include("structure/head.php");
		$asset = "uploads/"; // Path where are storaged media files (img, video, etc)
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

	<section class="pt-60 pb-60">
		<div class="container-custom">
			<div class="row align-items-center">
				<?php
					if( isset($_SESSION["cart"]) || !empty($_SESSION["cart"]) ) {
						// unset($_SESSION["cart"]);
						// print_r($_SESSION);
				?>
					<?php foreach( $_SESSION["cart"] as $key => $item ) { ?>
						<?php $details = getProduct($mysqli,$key); /*print_r($details);*/ ?>
						<div class="col-md-12" style="border-bottom: 2px solid #b2b2b2;">
							<div class="row h-100 cart-container">
								<div class="col-md-4">
									<?php
										$img_0 = explode(",", $details[0]["images"])[1];
										$folder_name = explode("_",$img_0)[0]."/";
									?>
									<img class="img-fluid d-block m-auto" src="<?php echo $path.$asset."assortment/".$folder_name.$img_0; ?>">
									<form action="<?php echo $path; ?>php/db/requests.php" method="POST">
										<input type="hidden" name="request" value="delete-item">
										<input type="hidden" name="id_item" value="<?php echo $details[0]["id_item"]; ?>">
										<button type="submit" class="btn btn-link text-danger">
											ELIMINAR DEL CARRITO <i class="fas fa-times"></i>
										</button>
									</form>
								</div>

								<div class="col-md-4">
									<div class="row align-items-center h-100">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-12 mb-3">
													<h3><strong><?php echo $details[0]["name"] ?></strong></h3>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-4 h-100">
									<div class="row h-100 align-items-center">
										<div class="col-md-12 text-center">
											<h3 class="mb-3">Precio</h3>
											<h4> $ <span data-price><?php echo $details[0]["price"]; ?></span> </h4>
											<?php $cart_total+=$details[0]["price"]; ?>
										</div>
									</div>	
								</div>
							</div>
						</div>
					<?php } ?>
				<?php } else { ?>
				<div class="col-md-12 text-center">
					<h1 class="mb-3"><strong>No hay productos en el carrito.</strong></h1>
					<a href="<?php echo $path; ?>pedidos" class="btn btn-black">VOLVER</a>
				</div>
				<?php } ?>
			</div>
			<?php if( isset($_SESSION["cart"]) || !empty($_SESSION["cart"]) ) { ?>
			<div class="row mt-45">
				<div class="col-md-4">
					<a href="<?php echo $path ?>pedidos" class="btn btn-yellow-light btn-noradius btn-block">Agregar más productos</a>
				</div>

				<div class="col-md-4 ml-auto bg-yellow-light pt-60 pb-60">
					<div class="row align-items-center h-100">
						<div class="col-md-12 text-center">
							<h1 class="mb-3"><strong>TOTAL</strong></h1>
							<h3> $ <span data-total> <?php echo $cart_total; ?> </span> </h3>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-45">
				<div class="col-md-12">
					<h3 class="mb-3">Enviar pedido.</h3>
					<form action="<?php echo $path; ?>php/mailer/mail.php" method="POST">
						<input type="hidden" name="request" value="pedidos">
						<input type="hidden" name="recaptcha" value="1">
						<div class="row">
							<div class="col-md-6 mb-3 mb-md-0">
								<div class="row h-100">
									<div class="col-md-12 align-self-start">
										<div class="form-group">
											<input type="text" class="form-control" name="name" value="" placeholder="Nombre:" required>
										</div>
									</div>
									<div class="col-md-12 align-self-center">
										<div class="form-group">
											<input type="text" class="form-control" name="phone" value="" placeholder="Teléfono:" required>
										</div>
									</div>
									<div class="col-md-12 align-self-center">
										<div class="form-group">
											<input type="email" class="form-control" name="email" value="" placeholder="E-Mail:" required>
										</div>
									</div>
									<div class="col-md-12 align-self-end">
										<input type="text" class="form-control" name="company" value="" placeholder="Empresa:" required>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<textarea class="form-control" name="msg" rows="5" placeholder="Mensaje:"></textarea>
								</div>

								<div class="row">
									<div class="col-md-6 mb-3 mb-md-3">
										<div id="recaptcha"></div>
									</div>
									<div class="col-md-6 align-self-end">
										<button type="submit" class="btn btn-black btn-noradius pl-5 pr-5 float-sm-right">Enviar</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php } ?>
		</div>
	</section>


	<a href="https://api.whatsapp.com/send?phone=525500000000" class="whatsapp-contact p-2 p-md-3">
		<span class="d-none d-md-block">Envíanos un mensaje de Whatsapp</span>
		<i class="fab fa-whatsapp fa-2x d-block d-md-none"></i>
	</a>

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