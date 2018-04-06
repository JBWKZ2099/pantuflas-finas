<?php
	if( isset($_GET["id"]) && !empty($_GET["id"]) ) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$view_name="Pedidos";
		include("structure/head.php");
		$asset = "uploads/"; // Path where are storaged media files (img, video, etc)

		$details = getProduct($mysqli,$_GET["id"]);
		// var_dump($details);
		// unset($_SESSION["cart"]);
	?>
</head>
<body>
	<?php $active="pedidos"; include("structure/navbar.php") ?>

	<div id="pedidos-carousel" class="carousel" data-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active" style="background-image: url('<?php echo $path.$asset.$row["banner_pedidos"]; ?>')">
				<!-- <img class="d-block w-100" src="http://placehold.it/1900x800.jpg?text=1900x800.jpg" alt="Cover"> -->
			</div>
		</div>
	</div>

	<section class="bg-yellow-light pt-60 pb-60">
		<div class="container-custom">
			<div class="pedidos-title col-md-4">
				<h2 class="mb-3">CATÁLOGO <br class="d-none d-md-block"> DE PRODUCTOS</h2>
				<p>
					<a class="text-black" href="<?php echo $path ?>pedidos?category=caballero">CABALLEROS</a>
					<span class="ml-3 mr-3">|</span>
					<a class="text-black" href="<?php echo $path ?>pedidos?category=dama">DAMAS</a>
				</p>
			</div>

			<form class="row pt-30 align-items-center products-container" action="<?php echo $path ?>php/db/requests.php" method="POST">
				<?php if( isset($details) && !empty($details) ) { ?>
					<div class="col-md-6 mb-3 mb-md-0 main-image-container">
						<?php
							$img_0 = explode(",", $details[0]["images"])[0];
							$img_1 = explode(",", $details[0]["images"])[1];
							$img_2 = explode(",", $details[0]["images"])[2];
							$img_3 = explode(",", $details[0]["images"])[3];
							$folder_name = explode("_",$img_1)[0]."/";
						?>
						<img id="zoom-image" class="img-fluid d-block m-auto" src="<?php echo $path.$asset."assortment/".$folder_name.$img_0 ?>"  data-zoom-image="<?php echo $path.$asset."assortment/".$folder_name.$img_0 ?>" alt="<?php echo $path.$asset."assortment/".$folder_name.$img_0 ?>">
					</div>
					<div class="col-md-6">
						<p><strong>DESCRIPCIÓN</strong></p>
						<p>
							<strong><?php echo $details[0]["name"] ?></strong>
						</p>
						<p>
							<strong>ESTILO:</strong> <?php echo $details[0]["id_item"] ?>
						</p>
						<p>
							<strong>TALLA:</strong>
							<select name="sizes">
							<?php
								$sizes = explode(",", $details[0]["sizes"]);
								foreach( $sizes as $size ) {
									if( $size!="0" ) { ?>
									<option value="<?php echo $size ?>"><?php echo $size ?></option>
							<?php
										$size;
									}
								}
							?>
							</select>
						</p>
						<p>
							<strong>Precio:</strong> $ <?php echo $details[0]["price"]; ?>
						</p>
						<p>
							<strong>Origen:</strong> <?php echo $details[0]["origin"]; ?>
						</p>
						<?php /*
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
						*/ ?>

						<div class="row mt-3 colors-container">
							<div class="col-md-12 mb-3">
								<?php /*
								<div class="row mb-3">
									<div class="col-md-6">
										<div class="input-group">
											<div class="input-group-prepend">
												<button id="minus-item" type="button" class="btn btn-outline-secondary">
													<i class="fas fa-minus-circle fa-lg"></i>
												</button>
											</div>
											<input id="qty-product" class="form-control text-center" name="qty" value="1" required readonly="">
											<div class="input-group-append">
												<button id="plus-item" type="button" class="btn btn-outline-secondary">
													<i class="fas fa-plus-circle fa-lg"></i>
												</button>
											</div>
										</div>
									</div>
								</div>
								*/ ?>
								<input type="hidden" name="request" value="add-cart">
								<input type="hidden" name="id_item" value="<?php echo $details[0]["id_item"] ?>">
								<button type="submit" class="btn btn-black btn-noradius">Agregar pedido</button>
							</div>
							<div class="col-md-12 mb-3">
								<p><strong>Colores disponibles:</strong></p>
							</div>

							<div class="col-md-12">
								<?php
									/*$colors = array(
										0 => "red",
										1 => "blue",
										2 => "green",
										3 => "yellow",
									);
									for( $i=1; $i<=3; $i++ ) {
									echo '<div class="available-color mb-3 mb-md-0" style="background-color: <?php echo $colors[$i]; ?>"></div>';
								}*/
								?>
								<?php echo $details[0]["colors"]; ?>
							</div>
						</div>

						<div class="col-md-12 mb-3">
							<p><strong>Telas:</strong></p>
						</div>

						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3 mb-3 mb-md-3">
									<img id="zoom_telas_01" class="img-fluid d-block m-auto" src="<?php echo $path ?>assets/img/Gamusina/cafe_mediano.jpg" data-zoom-image="<?php echo $path ?>assets/img/Gamusina/cafe_mediano.jpg">
								</div>
								<div class="col-md-3 mb-3 mb-md-3">
									<img id="zoom_telas_02" class="img-fluid d-block m-auto" src="<?php echo $path ?>assets/img/Gamusina/cafe.jpg" data-zoom-image="<?php echo $path ?>assets/img/Gamusina/cafe.jpg">
								</div>
								<div class="col-md-3 mb-3 mb-md-3">
									<img id="zoom_telas_03" class="img-fluid d-block m-auto" src="<?php echo $path ?>assets/img/Gamusina/marino.jpg" data-zoom-image="<?php echo $path ?>assets/img/Gamusina/marino.jpg">
								</div>
								<div class="col-md-3 mb-3 mb-md-3">
									<img id="zoom_telas_04" class="img-fluid d-block m-auto" src="<?php echo $path ?>assets/img/Gamusina/negro.jpg" data-zoom-image="<?php echo $path ?>assets/img/Gamusina/negro.jpg">
								</div>
								<div class="col-md-3 mb-3 mb-md-3">
									<img id="zoom_telas_05" class="img-fluid d-block m-auto" src="<?php echo $path ?>assets/img/Gamusina/rosa.jpg" data-zoom-image="<?php echo $path ?>assets/img/Gamusina/rosa.jpg">
								</div>
								<div class="col-md-3 mb-3 mb-md-3">
									<img id="zoom_telas_06" class="img-fluid d-block m-auto" src="<?php echo $path ?>assets/img/Gamusina/turquesa.jpg" data-zoom-image="<?php echo $path ?>assets/img/Gamusina/turquesa.jpg">
								</div>
								<div class="col-md-3 mb-3 mb-md-3">
									<img id="zoom_telas_07" class="img-fluid d-block m-auto" src="<?php echo $path ?>assets/img/Microterry/beige.jpg" data-zoom-image="<?php echo $path ?>assets/img/Microterry/beige.jpg">
								</div>
								<div class="col-md-3 mb-3 mb-md-3">
									<img id="zoom_telas_08" class="img-fluid d-block m-auto" src="<?php echo $path ?>assets/img/Microterry/blanco.jpg" data-zoom-image="<?php echo $path ?>assets/img/Microterry/blanco.jpg">
								</div>
							</div>
						</div>

						<div class="row mt-3" id="gallery_01">
							<div class="col-md-4 mb-3 mb-md-0">
								<a href="#" data-img="1" data-zoom-image="<?php echo $path.$asset."assortment/".$folder_name.$img_1 ?>" data-image="<?php echo $path.$asset."assortment/".$folder_name.$img_1 ?>">
									<img class="img-fluid d-block m-auto" src="<?php echo $path.$asset."assortment/".$folder_name.$img_1 ?>" alt="<?php echo $path.$asset."assortment/".$folder_name.$img_1 ?>">
								</a>
							</div>
							<div class="col-md-4 mb-3 mb-md-0">
								<a href="#" data-img="1" data-zoom-image="<?php echo $path.$asset."assortment/".$folder_name.$img_2 ?>" data-image="<?php echo $path.$asset."assortment/".$folder_name.$img_2 ?>">
									<img class="img-fluid d-block m-auto" src="<?php echo $path.$asset."assortment/".$folder_name.$img_2 ?>" alt="<?php echo $path.$asset."assortment/".$folder_name.$img_2 ?>">
								</a>
							</div>
							<div class="col-md-4 mb-3 mb-md-0">
								<a href="#" data-img="1" data-zoom-image="<?php echo $path.$asset."assortment/".$folder_name.$img_3 ?>" data-image="<?php echo $path.$asset."assortment/".$folder_name.$img_3 ?>">
									<img class="img-fluid d-block m-auto" src="<?php echo $path.$asset."assortment/".$folder_name.$img_3 ?>" alt="<?php echo $path.$asset."assortment/".$folder_name.$img_3 ?>">
								</a>
							</div>

							<script>
								//initiate the plugin and pass the id of the div containing gallery images
								$("#zoom-image").elevateZoom({
									gallery:'gallery_01',
									cursor: 'crosshair',
									galleryActiveClass: 'active',
									imageCrossfade: true,
									loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif',
									zoomType: "inner",
									lensSize: 100,
									scrollZoom: true
								}); 

								//pass the images to Fancybox
								$("#zoom-image").bind("click", function(e) {  
								  var ez =   $('#zoom-image').data('elevateZoom');	
									$.fancybox(ez.getGalleryList());
								  return false;
								});

								var ws = $(window).width();

								if( ws>767 ) {
									$("#zoom_telas_01").elevateZoom({tint:true, tintColour:'#F90', tintOpacity:0.5, zoomWindowWidth:500, zoomWindowHeight:500, zoomWindowPosition:6, responsive:true, scrollZoom:true});
									$("#zoom_telas_02").elevateZoom({tint:true, tintColour:'#F90', tintOpacity:0.5, zoomWindowWidth:500, zoomWindowHeight:500, zoomWindowPosition:6, responsive:true, scrollZoom:true});
									$("#zoom_telas_03").elevateZoom({tint:true, tintColour:'#F90', tintOpacity:0.5, zoomWindowWidth:500, zoomWindowHeight:500, zoomWindowPosition:6, responsive:true, scrollZoom:true});
									$("#zoom_telas_04").elevateZoom({tint:true, tintColour:'#F90', tintOpacity:0.5, zoomWindowWidth:500, zoomWindowHeight:500, zoomWindowPosition:6, responsive:true, scrollZoom:true});
									$("#zoom_telas_05").elevateZoom({tint:true, tintColour:'#F90', tintOpacity:0.5, zoomWindowWidth:500, zoomWindowHeight:500, zoomWindowPosition:6, responsive:true, scrollZoom:true});
									$("#zoom_telas_06").elevateZoom({tint:true, tintColour:'#F90', tintOpacity:0.5, zoomWindowWidth:500, zoomWindowHeight:500, zoomWindowPosition:6, responsive:true, scrollZoom:true});
									$("#zoom_telas_07").elevateZoom({tint:true, tintColour:'#F90', tintOpacity:0.5, zoomWindowWidth:500, zoomWindowHeight:500, zoomWindowPosition:6, responsive:true, scrollZoom:true});
									$("#zoom_telas_08").elevateZoom({tint:true, tintColour:'#F90', tintOpacity:0.5, zoomWindowWidth:500, zoomWindowHeight:500, zoomWindowPosition:6, responsive:true, scrollZoom:true});
								} else {
									$("#zoom_telas_01").elevateZoom({zoomWindowWidth:500, zoomWindowHeight:500, zoomType:"inner", responsive:true, scrollZoom:true});
									$("#zoom_telas_02").elevateZoom({zoomWindowWidth:500, zoomWindowHeight:500, zoomType:"inner", responsive:true, scrollZoom:true});
									$("#zoom_telas_03").elevateZoom({zoomWindowWidth:500, zoomWindowHeight:500, zoomType:"inner", responsive:true, scrollZoom:true});
									$("#zoom_telas_04").elevateZoom({zoomWindowWidth:500, zoomWindowHeight:500, zoomType:"inner", responsive:true, scrollZoom:true});
									$("#zoom_telas_05").elevateZoom({zoomWindowWidth:500, zoomWindowHeight:500, zoomType:"inner", responsive:true, scrollZoom:true});
									$("#zoom_telas_06").elevateZoom({zoomWindowWidth:500, zoomWindowHeight:500, zoomType:"inner", responsive:true, scrollZoom:true});
									$("#zoom_telas_07").elevateZoom({zoomWindowWidth:500, zoomWindowHeight:500, zoomType:"inner", responsive:true, scrollZoom:true});
									$("#zoom_telas_08").elevateZoom({zoomWindowWidth:500, zoomWindowHeight:500, zoomType:"inner", responsive:true, scrollZoom:true});
								}
								/*$("[data-img]").click(function(e){
									e.preventDefault();
									var which = $(this).attr("data-img");
									var img = $(this).find("img").attr("src");
									
									var prev = $("[data-id='test']").attr("src");
									$("[data-id='test']").attr("src",img);
									$("[data-id='test']").attr("data-zoom-image",img);
									$(this).find("img").attr("src",prev);

									$("script#zoom-elevate").each(function() {
										var old_src = $(this).attr('src');
										$(this).attr('src', '');
										setTimeout(function(){ $(this).attr('src', old_src + '?'+new Date()); }, 250);
									});
								});*/
							</script>
						</div>
					</div>
				<?php } else { ?>
					<div class="col-md-12 text-center">
						<h1><strong>El producto que estás buscando no existe.</strong></h1>
					</div>
				<?php } ?>
			</form>
		</div>
	</section>


	<a href="https://api.whatsapp.com/send?phone=525500000000" class="whatsapp-contact p-2 p-md-3">
		<span class="d-none d-md-block">Envíanos un mensaje de Whatsapp</span>
		<i class="fab fa-whatsapp fa-2x d-block d-md-none"></i>
	</a>

	<?php include("widgets/frm-cont.php"); ?>

	<?php include("structure/footer.php") ?>

	<script>
		$("#minus-item").click(function(e){
			if( parseInt( $("#qty-product").val() )>1 )
				$("#qty-product").val( parseInt( $("#qty-product").val() )-1 );
		});

		$("#plus-item").click(function(e){
				$("#qty-product").val( parseInt( $("#qty-product").val() )+1 );
		});
	</script>
</body>
</html>
<?php
	} else {
		session_start();
		$_SESSION["error"] = "<ul><li>El producto seleccionado no existe.</li></ul>";
		header("Location: ".$path."pedidos");
	}

	function str_lreplace($search, $replace, $subject) {
		$pos = strrpos($subject, $search);
		if($pos !== false)
			$subject = substr_replace($subject, $replace, $pos, strlen($search));

		return $subject;
	}
?>