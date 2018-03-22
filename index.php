<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		/*
		* Cambiar los valores de $up_dir dependiendo de en que nivel se encuentre
		* la vista que se agregó, por ejemplo:
		*	proyecto/
		*	├── assets/
		*	├── structure/
		* ├── otra_carpeta/
		* │   └── Subcarpeta/
		* │   		├── archivo01.php -> En este caso $up_dir debe ser igual a 2
		* │   		└── archivo02.php
		*	└── carpeta_donde_hay_vistas/
		*	    ├── archivo01.php -> En este caso $up_dir debe ser igual a 1
		*	    ├── archivo02.php
		*	    ├── archivo03.php
		*	    ├── archivo04.php
		*	    └── archivo05.php
		*/
		$up_dir = 0; for( $i01=1; $i01<=$up_dir; $i01++ ) { $dir.="../"; }
	?>
	<?php
		$view_name="Inicio";
		include(/*$dir.*/"structure/head.php");
		$asset = "assets/img/folder_name/"; // Path where are storaged media files (img, video, etc)
	?>
</head>
<body>
	<?php $active="index"; include(/*$dir.*/"structure/navbar.php") ?>

	<div id="home-carousel" class="carousel slide" data-ride="carousel">
	  <div class="carousel-inner">
	    <div class="carousel-item relativer active">
	      <img class="d-block w-100" src="http://placehold.it/1900x900.jpg?ytext=1900x900.jpg" alt="Cover">
	      
	      <div class="container-custom h-100">
	      	<div class="row">
			      <div class="c-caption">
			      	<h1 class="text-white text-center text-md-left h1-bigger">
			      		UNA VIDA <br class="d-none d-md-block">
			      		CONFORTABLE <br class="d-none d-md-block">
			      		ES UNA VIDA FELIZ
			      	</h1>
			      </div>
			     </div>
	      	
	      	<div class="row justify-content-center carousel-contact-btn">
	      		<div class="col-md-3">
	      			<a href="#" class="btn btn-yellow-light btn-block btn-noradius">CONTACTO</a>
	      		</div>
	      	</div>
	      </div>
	    </div>
	  </div>
	</div>

	<?php include(/*$dir.*/"structure/footer.php") ?>
</body>
</html>