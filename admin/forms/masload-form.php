<!-- <div class="form-group">
	<input type="text" class="form-control" name="name" value="<?php echo $row["name"]; ?>" placeholder="Nombre" required>
</div>
<div class="form-group">
	<label for="pdf">Buscar Archivo</label>
	<input id="pdf" type="file" class="form-control-file" name="pdf" <?php if( !isset($edit) ) echo 'required'; ?>>
</div> -->
<div class="form-group">
	<p>Ejemplo de como armar el campo para la carga masiva:</p>
	<small class=""><samp>
		[{ <br>
			&nbsp;&nbsp;"style":"Estilo", <br>
			&nbsp;&nbsp;"name":"Nombre", <br>
			&nbsp;&nbsp;"season":"Temporada", <br>
			&nbsp;&nbsp;"sex":"Sexo", <br>
			&nbsp;&nbsp;"color":"Color", <br>
			&nbsp;&nbsp;"num":"Números", <br>
			&nbsp;&nbsp;"inf_price":"100", <br>
			&nbsp;&nbsp;"img_name":"nombre_de_la_imagen.jpg" <br>
		}, <br>
		{ <br>
			&nbsp;&nbsp;"style": "Estilo", <br>
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