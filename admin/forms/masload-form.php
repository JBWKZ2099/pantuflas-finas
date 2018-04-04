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
		[{ <br>
			&nbsp;&nbsp;"id_item": "3804", <br>
			&nbsp;&nbsp;"name": "PANTUFLA PMTE.TEXTIL", <br>
			&nbsp;&nbsp;"price": "999.00", <br>
			&nbsp;&nbsp;"line": "CO", <br>
			&nbsp;&nbsp;"line_l": "CONFORT", <br>
			&nbsp;&nbsp;"origin": "NACIONAL", <br>
			&nbsp;&nbsp;"sizes": "0,0,0,0,1,0,0,1,0,0,1,0,1,0,0,0,0,0,0,0", <br>
			&nbsp;&nbsp;"d3_c4": "3", <br>
			&nbsp;&nbsp;"colors": "LILA", <br>
			&nbsp;&nbsp;"images": "nombre_1.JPG,nombre_2.JPG,nombre_3.JPG,nombre_4.JPG" <br>
		}, <br>
		{ <br>
			&nbsp;&nbsp;"id_item": "3804", <br>
			&nbsp;&nbsp;... <br>
		}]
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