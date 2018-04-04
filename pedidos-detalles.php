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
					CABALLEROS <span class="ml-3 mr-3">|</span> DAMAS
				</p>
			</div>

			<div class="row pt-30 align-items-center products-container">
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
						<strong>TALLAS:</strong> 26 al 30
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
							<form action="" method="POST">
								<input type="hidden" name="request" value="add-cart">
								<button type="button" class="btn btn-black btn-noradius">Agregar pedido</button>
							</form>
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
								scrollZoom: true
							}); 

							//pass the images to Fancybox
							$("#zoom-image").bind("click", function(e) {  
							  var ez =   $('#zoom-image').data('elevateZoom');	
								$.fancybox(ez.getGalleryList());
							  return false;
							});
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
<?php
	} else {
		session_start();
		$_SESSION["error"] = "<ul><li>El producto seleccionado no existe.</li></ul>";
		header("Location: ".$path."pedidos");
	}
?>