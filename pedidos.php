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

	<a href="https://api.whatsapp.com/send?phone=5500000000" class="whatsapp-contact p-2 p-md-3">
		<span class="d-none d-md-block">Envíanos un mensaje de Whatsapp</span>
		<i class="fab fa-whatsapp fa-2x d-block d-md-none"></i>
	</a>

	<?php include("widgets/frm-cont.php"); ?>

	<?php include("structure/footer.php") ?>
</body>
</html>