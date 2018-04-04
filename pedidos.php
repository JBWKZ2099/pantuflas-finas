<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$view_name="Pedidos";
		include("structure/head.php");
		$asset = "uploads/"; // Path where are storaged media files (img, video, etc)

		if( isset($_GET["page"]) )
			$page = $_GET["page"];
		else
			$page = 1;

		$products = getProducts($mysqli,$page);
		// print_r($products);
	?>
</head>
<body>
	<?php $active="pedidos"; include("structure/navbar.php") ?>

	<div id="pedidos-carousel" class="carousel" data-ride="carousel">
	  <div class="carousel-inner">
	    <div class="carousel-item active" style="background-image: url('<?php echo $path.$asset.$row["banner_pedidos"]; ?>')">
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

				<?php foreach( $products as $product ) { ?>
					<a href="<?php echo $path ?>pedidos-detalles?id=<?php echo $product["id_item"]; ?>" class="col-md-4 mb-3">
						<?php
							$img = explode(",", $product["images"])[2];
							$folder_name = explode("_",$img)[0]."/";
						?>
						<img class="img-fluid d-block m-auto" src="<?php echo $path.$asset."assortment/".$folder_name.$img ?>" alt="<?php echo $img; ?>">
						<div class="product-name">
							<?php echo $product["name"]; ?>
						</div>
					</a>
				<?php } ?>

				<div class="col-md-12 mt-3 mt-md-5">
				  <ul class="pagination pagination-black justify-content-center">
				    <li class="page-item"><a class="page-link" href="<?php if($page>1) echo "?page=".($_GET["page"]-1); else echo "#"; ?>">Anterior</a></li>
				    <?php for( $i=1; $i<=$product["pages"]; $i++ ) { ?>
				    	<li class="page-item <?php if( $_GET["page"]==$i || $page==$i ) echo 'active' ?>">
				    		<a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
				    	</li>
				    <?php } ?>
				    <li class="page-item"><a class="page-link" href="<?php if( isset($_GET["page"]) ) {if( $_GET["page"]==$product["pages"] ) echo "#"; else echo "?page=".($page+1); } else echo "?page=".($page+1); ?>">Siguiente</a></li>
				  </ul>
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