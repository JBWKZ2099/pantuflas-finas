<?php
	ini_set("display_errors", "Off");
	include_once("data.php");

	function conectar_db(){
		$mysqli = mysqli_connect(SERVER, USER, PASSWORD) 	or die ('No se pudo establecer la conexión al servidor.');
		mysqli_query($mysqli, 'SET NAMES "utf8"');
		mysqli_set_charset($mysqli, "UTF8");
		return $mysqli;
	}

	function selecciona_db($mysqli){
		mysqli_select_db($mysqli, DATABASE) or die ('No se pudo establecer la conexión con la Base de Datos, error: '.mysqli_error($mysqli));
	}

	function registro_nuevo($tabla, $datos, $columna){
		$mysqli = conectar_db();
		selecciona_db($mysqli);

		$Consulta = "INSERT INTO $tabla VALUES (";
			for ($i=0; $i < count($datos); $i++) { 
				$Consulta = $Consulta.$datos[$i];
				if ($i != count($datos)-1)
					$Consulta.=",";
			}
			$Consulta.=")";

		$pConsulta = consulta_tb($mysqli, $Consulta);
		session_start();
		if (!$pConsulta) {
			$_SESSION["error"] = "Ocurrió un error: ".mysqli_error($mysqli);
		}
		else{
			$_SESSION["message"] = "Éxito al guardar.";
		}
		cerrar_db($mysqli);
	}

	function consulta_tb($mysqli, $Sql){
			global $resultado;
			$resultado = mysqli_query($mysqli, $Sql);
			if($resultado <> NULL){
				return $resultado;
			}else{
				return 0;
			}
			mysqli_close($mysqli);
	}
	function cerrar_db($mysqli) { mysqli_close($mysqli); }

	function validateData($id, $table) {
		$mysqli = conectar_db();
		selecciona_db($mysqli);
		$sql = "SELECT * FROM $table WHERE id=$id";
		$result = mysqli_query( $mysqli, $sql );

		if( mysqli_num_rows($result)>0 )
			return true;
		else {
			session_start();
			$_SESSION["error"] = "No hay datos con el id seleccionado.";
			return false;
		}
	}

	function deleteRecord($id, $table) {
		$mysqli = conectar_db();
		selecciona_db($mysqli);
		$deleted_at = setTimeStamp();
		$sql = "UPDATE $table SET deleted_at='$deleted_at' WHERE id=$id";
		mysqli_query($mysqli, $sql);
		session_start();
		$_SESSION["message"] = "El registro se eliminó correctamente";
		mysqli_close($mysqli);
	}

	function restoreRecord($id, $table) {
		$mysqli = conectar_db();
		selecciona_db($mysqli);
		$deleted_at = setTimeStamp();
		$sql = "UPDATE $table SET deleted_at=NULL WHERE id=$id";
		mysqli_query($mysqli, $sql);
		session_start();
		$_SESSION["message"] = "El registro se restauró correctamente";
		mysqli_close($mysqli);
	}

	function getCustomers() {
		header('Content-Type: application/json');
		$mysqli = conectar_db();
		selecciona_db($mysqli);
		$sql = "SELECT * FROM users WHERE permission=1 ORDER BY id";
		$result = mysqli_query( $mysqli, $sql );
		print_r($result);
		$arr = array();

		if( mysqli_num_rows($result)>0 ) {
			while( $row=mysqli_fetch_array($result,MYSQLI_ASSOC) )
				$arr[] = $row;
		} else {
			$arr[] = "no_data";
		}
		// return json_encode( $arr );
	}

	function massiveLoad( $post ) {
		// header('Content-Type: application/json');
		ini_set("display_errors","On");
		$json_clean = str_replace(" ", "", preg_replace("[\n|\r|\n\r]", "", $_POST["json-load"]));
		$json_clean = json_decode( $json_clean );
		
		$mysqli = conectar_db();
		selecciona_db($mysqli);

		$data = array();
		for( $i=0; $i<count($json_clean); $i++ ) {
			$data[$i] = array(
				"style" => $json_clean[$i]->style,
				"name" => $json_clean[$i]->name,
				"season" => $json_clean[$i]->season,
				"sex" => $json_clean[$i]->sex,
				"color" => $json_clean[$i]->color,
				"num" => $json_clean[$i]->num,
				"inf_price" => $json_clean[$i]->inf_price,
				"img_name" => $json_clean[$i]->img_name,
			);
		}
		var_dump($data);
		// var_dump( $json_clean );
		exit();
	}

	function dataTable($post, $columns, $col_clean, $sql_data) {
		$mysqli = conectar_db();
		selecciona_db($mysqli);
		// storing  request (ie, get/post) global array to a variable  
		$requestData= $post;

		// getting total number records without any search
		$sql = "SELECT $sql_data[0] ";
		$sql.=" FROM $sql_data[1]";
		$query=mysqli_query($mysqli, $sql);
		$totalData = mysqli_num_rows($query);
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


		$sql = "SELECT $sql_data[0] ";
		$sql.=" FROM $sql_data[1] ";
		if( isset($sql_data[2]) ) {
			$sql.=$sql_data[2];
		}
		if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
			$counter = 0;
			foreach( $columns as $column ) {
				if( $counter==0 )
					$sql.=" AND ( $column LIKE '%".$requestData['search']['value']."%' ";
				else
					$sql.=" OR $column LIKE '%".$requestData['search']['value']."%' ";
				$counter++;
			}
			$sql.=")";
		}
		$query=mysqli_query($mysqli, $sql);
		$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start'].", ".$requestData['length'];
		/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
		$query=mysqli_query($mysqli, $sql);

		$data = array();
		while( $row=mysqli_fetch_array($query) ) {  // preparing an array
			$nestedData=array();
			foreach( $col_clean as $column )
				$nestedData[] = $row[$column];

			$data[] = $nestedData;
		}
		$json_data = array(
			"draw" => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal" => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data" => $data   // total data array
		);

		echo json_encode($json_data);  // send data as json format
	}

	function updateData($id, $columns, $datas, $table) {
		$mysqli = conectar_db();
		selecciona_db($mysqli);

		$sql = "UPDATE $table SET ";
		for( $i=0; $i<count($columns); $i++ ) {
			$sql .= " $columns[$i]='$datas[$i]'";
			if( $i!=count($columnas)-1 )
				$sql .= ", ";
		}
		$sql = rtrim($sql,", ");
		$updated_at = setTimeStamp();
		$sql .= ", updated_at='$updated_at' WHERE id=$id";
		// var_dump($sql);
		// exit();
		
		session_start();
		if( mysqli_query( $mysqli, $sql ) )
			$_SESSION["message"] = "Los datos se actualizaron correctamente.";
		else
			$_SESSION["error"] = "Ocurrió un error: ".mysqli_error($mysqli);
	}

	function setTimeStamp() {
		date_default_timezone_set("UTC");
		date_default_timezone_set("America/Mexico_City");
		return date("Y-m-d H:i:s");
	}
?>