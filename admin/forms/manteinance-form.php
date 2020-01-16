<ul class="nav nav-tabs mb-3" id="myTab" role="tablist" data-current="1" data-last="7">
  <li class="nav-item">
    <a data-order="1" class="nav-link active" id="aboutus-tab" data-toggle="tab" href="#aboutus" role="tab" aria-controls="aboutus" aria-selected="true">Nosotros</a>
  </li>
  <li class="nav-item">
    <a data-order="2" class="nav-link" id="brands-tab" data-toggle="tab" href="#brands" role="tab" aria-controls="brands" aria-selected="false">Brands</a>
  </li>
  <li class="nav-item">
    <a data-order="3" class="nav-link" id="catalogues-tab" data-toggle="tab" href="#catalogues" role="tab" aria-controls="catalogues" aria-selected="false">Catálogos</a>
  </li>
  <li class="nav-item">
    <a data-order="4" class="nav-link" id="menu-tab" data-toggle="tab" href="#menu" role="tab" aria-controls="menu" aria-selected="false">Menú (navbar)</a>
  </li>
  <li class="nav-item">
    <a data-order="5" class="nav-link" id="footer-tab" data-toggle="tab" href="#footer" role="tab" aria-controls="footer" aria-selected="false">Pie de página</a>
  </li>
  <li class="nav-item">
    <a data-order="6" class="nav-link" id="pedidos-tab" data-toggle="tab" href="#pedidos" role="tab" aria-controls="pedidos" aria-selected="false">Pedidos</a>
  </li>
  <li class="nav-item">
    <a data-order="7" class="nav-link" id="banners-tab" data-toggle="tab" href="#banners" role="tab" aria-controls="banners" aria-selected="false">Banners</a>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="aboutus" role="tabpanel" aria-labelledby="aboutus-tab">
  	<div class="form-group">
  		<label>Título Sección</label>
			<input type="text" class="form-control" name="title-aboutus" value="<?php echo $row["title_aboutus"]; ?>" placeholder="Título" required>
		</div>
		<div class="form-group">
  		<label>Contenido Sección</label>
			<textarea id="ta1" class="form-control" name="about-us" rows="5" placeholder="Nosotros..."><?php echo htmlentities($row["about_us"]) ?></textarea>
		</div>
  </div>

  <div class="tab-pane fade" id="brands" role="tabpanel" aria-labelledby="brands-tab">
		<div class="form-group">
			<label>Imágen 1</label>
			<input type="file" class="form-control-file" name="brands_1">
			<small>La imágen debe ser en formato jpg, png o svg y la resolución deberá ser 300 x 140 para su mejor funcionamiento. </small>
			<br>
		</div>
		<div class="form-group">
			<label>Preview</label>
			<div class="col-md-12">
				<div class="row">
					<img class="img-fluid" src="<?php echo $abs_path."/../uploads/".$row["brand_1"] ?>" alt="<?php echo $row["brand_1"] ?>">
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Imágen 2</label>
			<input type="file" class="form-control-file" name="brands_2">
			<small>La imágen debe ser en formato jpg, png o svg y la resolución deberá ser 300 x 140 para su mejor funcionamiento. </small>
			<br>
		</div>
		<div class="form-group">
			<label>Preview</label>
			<div class="col-md-12">
				<div class="row">
					<img class="img-fluid" src="<?php echo $abs_path."/../uploads/".$row["brand_2"] ?>" alt="<?php echo $row["brand_2"] ?>">
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Imágen 3</label>
			<input type="file" class="form-control-file" name="brands_3">
			<small>La imágen debe ser en formato jpg, png o svg y la resolución deberá ser 300 x 140 para su mejor funcionamiento. </small>
			<br>
		</div>
		<div class="form-group">
			<label>Preview</label>
			<div class="col-md-12">
				<div class="row">
					<img class="img-fluid" src="<?php echo $abs_path."/../uploads/".$row["brand_3"] ?>" alt="<?php echo $row["brand_3"] ?>">
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Imágen 4</label>
			<input type="file" class="form-control-file" name="brands_4">
			<small>La imágen debe ser en formato jpg, png o svg y la resolución deberá ser 300 x 140 para su mejor funcionamiento. </small>
			<br>
		</div>
		<div class="form-group">
			<label>Preview</label>
			<div class="col-md-12">
				<div class="row">
					<img class="img-fluid" src="<?php echo $abs_path."/../uploads/".$row["brand_4"] ?>" alt="<?php echo $row["brand_4"] ?>">
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Imágen 5</label>
			<input type="file" class="form-control-file" name="brands_5">
			<small>La imágen debe ser en formato jpg, png o svg y la resolución deberá ser 300 x 140 para su mejor funcionamiento. </small>
			<br>
		</div>
		<div class="form-group">
			<label>Preview</label>
			<div class="col-md-12">
				<div class="row">
					<img class="img-fluid" src="<?php echo $abs_path."/../uploads/".$row["brand_5"] ?>" alt="<?php echo $row["brand_5"] ?>">
				</div>
			</div>
		</div>
  </div>

  <div class="tab-pane fade" id="catalogues" role="tabpanel" aria-labelledby="catalogues-tab">
  	<div class="form-group">
  		<label>Título Sección</label>
			<input type="text" class="form-control" name="title-catalogue" value="<?php echo $row["title_catalogue"]; ?>" placeholder="Título" required>
		</div>
  	<div class="form-group">
  		<label>Texto catálogo 1:</label>
			<input type="text" class="form-control" name="gentleman-catalogue" value="<?php echo $row["gentleman_catalogue"]; ?>" placeholder="Título catálogo 1" required>
		</div>
		<div class="form-group">
			<label>Imágen Caballero:</label>
			<input type="file" class="form-control-file" name="gentleman_img">
			<small>La imágen debe ser en formato jpg, png o svg y la resolución deberá ser 300 x 140 para su mejor funcionamiento. </small>
			<br>
		</div>
		<div class="form-group">
			<label>Preview</label>
			<div class="col-md-12">
				<div class="row">
					<img class="img-fluid" src="<?php echo $abs_path."/../uploads/".$row["gentleman_img"] ?>" alt="<?php echo $row["gentleman_img"] ?>">
				</div>
			</div>
		</div>
  	<div class="form-group">
  		<label>Texto catálogo 2:</label>
			<input type="text" class="form-control" name="lady-catalogue" value="<?php echo $row["lady_catalogue"]; ?>" placeholder="Título catálogo 2" required>
		</div>
		<div class="form-group">
			<label>Imágen Dama:</label>
			<input type="file" class="form-control-file" name="lady_img">
			<small>La imágen debe ser en formato jpg, png o svg y la resolución deberá ser 300 x 140 para su mejor funcionamiento. </small>
			<br>
		</div>
		<div class="form-group">
			<label>Preview</label>
			<div class="col-md-12">
				<div class="row">
					<img class="img-fluid" src="<?php echo $abs_path."/../uploads/".$row["lady_img"] ?>" alt="<?php echo $row["lady_img"] ?>">
				</div>
			</div>
		</div>
  </div>

  <div class="tab-pane fade" id="menu" role="tabpanel" aria-labelledby="menu-tab">
  	<div class="form-group">
  		<label>Opción 1:</label>
			<input type="text" class="form-control" name="navbar-titles[]" value="<?php echo $row["navbar_title_1"]; ?>" placeholder="Menú opción 1" required>
		</div>
  	<div class="form-group">
  		<label>Opción 2:</label>
			<input type="text" class="form-control" name="navbar-titles[]" value="<?php echo $row["navbar_title_2"]; ?>" placeholder="Menú opción 2" required>
		</div>
  	<div class="form-group">
  		<label>Opción 3:</label>
			<input type="text" class="form-control" name="navbar-titles[]" value="<?php echo $row["navbar_title_3"]; ?>" placeholder="Menú opción 3" required>
		</div>
  	<div class="form-group">
  		<label>Opción 4:</label>
			<input type="text" class="form-control" name="navbar-titles[]" value="<?php echo $row["navbar_title_4"]; ?>" placeholder="Menú opción 4" required>
		</div>
  </div>

  <div class="tab-pane fade" id="footer" role="tabpanel" aria-labelledby="footer-tab">
  	<div class="form-group">
  		<label>Contenido:</label>
			<textarea id="ta2" rows="5" class="form-control" name="footer-content" placeholder="Contenido footer" required><?php echo $row["footer_content"]; ?></textarea>
			<small>Tenga cuidado al modificar la información de esta sección, ya que tiene estilos de Bootstrap 4 y si por algún motivo los elementos no tienen las clases adecuadas, los elementos podrían no mostrarse correctamente.</small>
		</div>
  	<div class="form-group">
  		<label>Link Facebook:</label>
			<input type="text" class="form-control" name="footer-links[]" value="<?php echo $row["facebook_link"]; ?>" placeholder="https://fb.com" required>
		</div>
  	<div class="form-group">
  		<label>Link Instagram:</label>
			<input type="text" class="form-control" name="footer-links[]" value="<?php echo $row["instagram_link"]; ?>" placeholder="https://instagram.com" required>
		</div>
  </div>

  <div class="tab-pane fade" id="pedidos" role="tabpanel" aria-labelledby="pedidos-tab">
  	<div class="form-group">
  		<label>Título:</label>
			<textarea id="ta3" type="text" class="form-control" name="pedidos-title" placeholder="Catálogo de productos" required><?php echo $row["pedidos_title"]; ?></textarea>
		</div>
  </div>
  
  <div class="tab-pane fade" id="banners" role="tabpanel" aria-labelledby="banners-tab">
  	<div class="form-group">
			<label>Banner 1 Home:</label>
			<input type="file" class="form-control-file" name="banners_home_1">
			<small>La imágen debe ser en formato jpg y la resolución deberá ser 1500 x 400 para su mejor funcionamiento. </small>
			<br>
		</div>
		<div class="form-group">
			<label>Preview</label>
			<div class="col-md-12">
				<div class="row">
					<img class="img-fluid" src="<?php echo $abs_path."/../uploads/".$row["banner_home_1"] ?>" alt="<?php echo $row["banner_home_1"]; ?>">
				</div>
			</div>
		</div>
  	<div class="form-group">
			<label>Banner 2 Home:</label>
			<input type="file" class="form-control-file" name="banners_home_2">
			<small>La imágen debe ser en formato jpg y la resolución deberá ser 1500 x 400 para su mejor funcionamiento. </small>
			<br>
		</div>
		<div class="form-group">
			<label>Preview</label>
			<div class="col-md-12">
				<div class="row">
					<img class="img-fluid" src="<?php echo $abs_path."/../uploads/".$row["banner_home_2"] ?>" alt="<?php echo $row["banner_home_2"]; ?>">
				</div>
			</div>
		</div>
  	<div class="form-group">
			<label>Banner 3 Home:</label>
			<input type="file" class="form-control-file" name="banners_home_3">
			<small>La imágen debe ser en formato jpg y la resolución deberá ser 1500 x 400 para su mejor funcionamiento. </small>
			<br>
		</div>
		<div class="form-group">
			<label>Preview</label>
			<div class="col-md-12">
				<div class="row">
					<img class="img-fluid" src="<?php echo $abs_path."/../uploads/".$row["banner_home_3"] ?>" alt="<?php echo $row["banner_home_3"]; ?>">
				</div>
			</div>
		</div>
  	<div class="form-group">
			<label>Texto banner Home:</label>
			<input type="text" class="form-control" name="banner-home-text" value="<?php echo $row["banner_home_text"]; ?>" required>
		</div>
  	<div class="form-group">
			<label>Texto botón banner Home:</label>
			<input type="text" class="form-control" name="banner-btn-home-text" value="<?php echo $row["banner_btn_home_text"]; ?>" required>
		</div>
  	<div class="form-group">
			<label>Banner Pedidos:</label>
			<input type="file" class="form-control-file" name="banner_pedidos">
			<small>La imágen debe ser en formato jpg y la resolución deberá ser 1500 x 400 para su mejor funcionamiento. </small>
			<br>
		</div>
		<div class="form-group">
			<label>Preview</label>
			<div class="col-md-12">
				<div class="row">
					<img class="img-fluid" src="<?php echo $abs_path."/../uploads/".$row["banner_pedidos"] ?>" alt="<?php echo $row["banner_pedidos"] ?>">
				</div>
			</div>
		</div>
  </div>

  <button id="prev-btn" type="button" class="btn btn-secondary float-left">Anterior</button>
  <button id="next-btn" type="button" class="btn btn-secondary float-right">Siguiente</button>
  <button id="submit" type="submit" class="btn btn-success float-right d-none">Actualizar</button>
</div>