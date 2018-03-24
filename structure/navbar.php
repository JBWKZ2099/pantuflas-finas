<?php
	function act($item, $active) { echo $item == $active ? " active" : ""; }
	
	if( $active!="pedidos" ) {
		$items = json_decode(json_encode(array(
			array("active" => "none", "link" => "#", "word" => "NOSOTROS", "data_target" => "#nosotros"),
			array("active" => "none", "link" => "#", "word" => "CATÁLOGO", "data_target" => "#catalogo"),
			array("active" => "pedidos", "link" => "pedidos", "word" => "PEDIDOS", "data_target" => "no-parallax"),
			array("active" => "none", "link" => "#", "word" => "CONTACTO", "data_target" => "#contacto"),
		)), FALSE);
	} else {
		$items = json_decode(json_encode(array(
			array("active" => "none", "link" => "index#nosotros", "word" => "NOSOTROS", "data_target" => "no-parallax"),
			array("active" => "none", "link" => "index#catalogo", "word" => "CATÁLOGO", "data_target" => "no-parallax"),
			array("active" => "pedidos", "link" => "pedidos", "word" => "PEDIDOS", "data_target" => "no-parallax"),
			array("active" => "none", "link" => "index#contacto", "word" => "CONTACTO", "data_target" => "no-parallax"),
		)), FALSE);
	}
?>

<nav class="navbar navbar-expand-md navbar-light bg-light">
	<div class="absoluter bg-yellow-light bg-navbar-01 col-8 col-sm-4 h-100"></div>
	<div class="absoluter bg-black bg-navbar-02 col-4 col-sm-8 h-100"></div>
	<div class="container nb-container m-auto relativer">
		<a class="navbar-brand" href="<?php echo $path ?>">
			<!-- <img src="http://placehold.it/200x50.jpg&text=200x50" alt="Brand" class="img-responsive"> -->
			<h2>PANTUFLAS FINAS</h2>
		</a>
		<button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul id="parallax-navbar" class="navbar-nav mr-auto">
				<?php foreach($items as $item) { ?>
					<li class='nav-item<?php act($item->active, $active) ?>'>
						<a class='nav-link text-center text-white' href='<?php echo $path.$item->link; ?>' data-target="<?php echo $item->data_target; ?>"><?php echo $item->word ?></a>
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>