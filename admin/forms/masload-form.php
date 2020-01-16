<!-- <div class="form-group">
	<input type="text" class="form-control" name="name" value="<?php echo $row["name"]; ?>" placeholder="Nombre" required>
</div>
<div class="form-group">
	<label for="pdf">Buscar Archivo</label>
	<input id="pdf" type="file" class="form-control-file" name="pdf" <?php if( !isset($edit) ) echo 'required'; ?>>
</div> -->
<div class="form-group">
	<p>Ejemplo de como armar el campo para la carga masiva:</p>
	<small><samp>
		[{<br>
		&nbsp;&nbsp;"id_item": "1914",<br>
		&nbsp;&nbsp;"name": "PANTUFLA PMTE.TEXTIL",<br>
		&nbsp;&nbsp;"price": "124.00",<br>
		&nbsp;&nbsp;"line": "CO",<br>
		&nbsp;&nbsp;"line_l": "CONFORT",<br>
		&nbsp;&nbsp;"origin": "NACIONAL",<br>
		&nbsp;&nbsp;"sizes": "0,0,0,0,0,0,0,0,0,25.5,0,0,27,0,0,28.5,0,0,30,0",<br>
		&nbsp;&nbsp;"category": "CABALLERO",<br>
		&nbsp;&nbsp;"colors": "CAFÉ, MARINO",<br>
		&nbsp;&nbsp;"images": "1914_1.JPG,1914_2.JPG,1914_3.JPG,1914_4.JPG",<br>
		&nbsp;&nbsp;"cloth": "microterry"<br>
		},{<br>
		&nbsp;&nbsp;"id_item": "3593",<br>
		&nbsp;&nbsp;...<br>
		}]<br>
	</samp></small>
	<textarea id="json-code" name="json-load" class="form-control fc-code"><?php if( isset($_POST["json-load"]) && !empty($_POST["json-load"]) ) echo htmlentities($_POST["json-load"]); ?></textarea>
</div>

<script>
	var editor = CodeMirror.fromTextArea(document.getElementById("json-code"), {
		lineNumbers: true,
		smartIdent: true,
		tabSize: 2,
		lint: true,
		mode: { name: "javascript", json: true }
	});
</script>

<?php
	$array = [
		[
			"style" => "Estilo",
			"name" => "Nombre",
			"season" => "Temporada",
			"sex" => "Sexo",
			"color" => "Color",
			"num" => "Números",
			"inf_price" => "100",
			"img_name" => "nombre_de_la_imagen.jpg",
		],
		[
			"style" => "Estilo",
			"name" => "Nombre",
			"season" => "Temporada",
			"sex" => "Sexo",
			"color" => "Color",
			"num" => "Números",
			"inf_price" => "100",
			"img_name" => "nombre_de_la_imagen.jpg",
		],
	];
	// echo json_encode($array);
?>