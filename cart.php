<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$view_name="Carrito de pedidos";
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

	<section class="pt-60 pb-60">
		<div class="container-custom">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="row h-100 cart-container">
						<div class="col-md-4">
							<img class="img-fluid d-block m-auto" src="http://placehold.it/600x360.jpg?text=600x360.jpg">
							<form acction="" method="POST">
								<input type="hidden" name="request" value="delete-item">
								<button type="button" class="btn btn-link text-danger">
									ELIMINAR DEL CARRITO <i class="fas fa-times"></i>
								</button>
							</form>
						</div>

						<div class="col-md-4">
							<div class="row align-items-center h-100">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-12 mb-3">
											<h3><strong>Nombre de la pantufla</strong></h3>
										</div>
										<div class="col-md-12">
											<h4 class="mb-3">Cantidad</h4>
											<div class="row">
												<div class="col-md-6">
													<div class="input-group">
														<div class="input-group-prepend">
															<button class="btn btn-outline-secondary">
																<i class="fas fa-plus-circle fa-lg"></i>
															</button>
														</div>
														<input data-id="qty-product" class="form-control text-center" value="0" readonly>
														<div class="input-group-append">
															<button class="btn btn-outline-secondary">
																<i class="fas fa-minus-circle fa-lg"></i>
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-4 h-100">
							<div class="row h-100 align-items-center">
								<div class="col-md-12 text-center">
									<h3 class="mb-3">Precio</h3>
									<h4> $ <span data-price>120</span> </h4>
									<br>
									<h3 class="mb-3">Subtotal</h3>
									<h4> $ <span data-subtotal> 120</span> </h4>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>

			<div class="row mt-45">
				<div class="col-md-4">
					<a href="<?php echo $path ?>pedidos" class="btn btn-yellow-light btn-noradius btn-block">Agregar más productos</a>
				</div>

				<div class="col-md-4 ml-auto bg-yellow-light pt-60 pb-60">
					<div class="row align-items-center h-100">
						<div class="col-md-12 text-center">
							<h1 class="mb-3"><strong>TOTAL</strong></h1>
							<h3> $ <span data-total> 120 </span> </h3>
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

	<script>
		$("[data-id='test']").elevateZoom({
		  zoomType: "inner",
		  cursor: "crosshair",
		  scrollZoom: true
		});
	</script>
</body>
</html>