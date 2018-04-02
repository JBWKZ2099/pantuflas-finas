<?php
	function act($item, $active) { echo $item == $active ? " active" : ""; }
	
	if( $active!="pedidos" && $active!="privacy" ) {
		$items = json_decode(json_encode(array(
			array("active" => "none", "link" => "#", "word" => $row["navbar_title_1"], "data_target" => "#nosotros"),
			array("active" => "none", "link" => "#", "word" => $row["navbar_title_2"], "data_target" => "#catalogo"),
			array("active" => "pedidos", "link" => "pedidos", "word" => $row["navbar_title_3"], "data_target" => "no-parallax"),
			array("active" => "none", "link" => "#", "word" => $row["navbar_title_4"], "data_target" => "#contacto"),
		)), FALSE);
	} else {
		$items = json_decode(json_encode(array(
			array("active" => "none", "link" => "index#nosotros", "word" => $row["navbar_title_1"], "data_target" => "no-parallax"),
			array("active" => "none", "link" => "index#catalogo", "word" => $row["navbar_title_2"], "data_target" => "no-parallax"),
			array("active" => "pedidos", "link" => "pedidos", "word" => $row["navbar_title_3"], "data_target" => "no-parallax"),
			array("active" => "none", "link" => "index#contacto", "word" => $row["navbar_title_4"], "data_target" => "no-parallax"),
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