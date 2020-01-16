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

	function registro_nuevo($tabla, $datos, $columna, $validate_user){
		$mysqli = conectar_db();
		selecciona_db($mysqli);

		if( isset($validate_user[0]) && !empty($validate_user[0]) && $validate_user[0] ) {
			$check_user = "SELECT * FROM users WHERE email=$datos[5]";

			$result = mysqli_query($mysqli, $check_user);
			if( mysqli_num_rows($result)>0 ) {
				session_start();
				$_SESSION["error"]="El correo con el que intentaste registrar ya está en uso, por favor intenta con otro";
				header( "Location: ".$validate_user[1] );
				exit();
			}
		}
		
		$Consulta = "INSERT INTO $tabla VALUES (";
			for ($i=0; $i < count($datos); $i++) { 
				$Consulta = $Consulta.$datos[$i];
				if ($i != count($datos)-1)
					$Consulta.=",";
			}
			$Consulta.=")";

		// var_dump($Consulta);
		// exit();
		$pConsulta = consulta_tb($mysqli, $Consulta);
		session_start();
		if (!$pConsulta) {
			$_SESSION["error"] = "Ocurrió un error: ".mysqli_error($mysqli)." query='".$Consulta."'";
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
		$json_clean = str_replace(" ", "", preg_replace("[\n|\r|\n\r]", "", $_POST["json-load"]));
		$json_clean = json_decode( $json_clean );
		
		$mysqli = conectar_db();
		selecciona_db($mysqli);

		$columns = array(
			"id",
			"id_item",
			"name",
			"price",
			"line",
			"line_l",
			"origin",
			"sizes",
			"category",
			"colors",
			"images",
			"cloth",
			"created_at",
			"updated_at",
		);
		for( $i=0; $i<count($json_clean); $i++ ) {
			$data = array(
				0 => "NULL",
				1 => "'".$json_clean[$i]->id_item."'",
				2 => "'".$json_clean[$i]->name."'",
				3 => "'".$json_clean[$i]->price."'",
				4 => "'".$json_clean[$i]->line."'",
				5 => "'".$json_clean[$i]->line_l."'",
				6 => "'".$json_clean[$i]->origin."'",
				7 => "'".$json_clean[$i]->sizes."'",
				8 => "'".$json_clean[$i]->category."'",
				9 => "'".$json_clean[$i]->colors."'",
				10 => "'".$json_clean[$i]->images."'",
				11 => "'".$json_clean[$i]->cloth."'",
				12 => "'".date("Y-m-d H:i:s")."'",
				13 => "NULL"
			);

			registro_nuevo("assortment", $data, $columns, null);
			// var_dump($data);
			// exit();
		}
		// var_dump($data);
		// var_dump( $json_clean );
		// exit();

		return true;
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

		if( $table!="access" && $table!="activations" )
			$sql .= ", updated_at='$updated_at'";

		if( $table!="access" && $table!="activations" )
			$sql .= " WHERE id=$id";
		else {
			$sql .= " WHERE id_user=$id";
			// var_dump($sql);
			// exit();
		}
		// echo "query: ".htmlentities($sql);
		// exit();
		
		session_start();
		if( mysqli_query( $mysqli, $sql ) )
			$_SESSION["message"] = "Los datos se actualizaron correctamente.";
		else
			$_SESSION["error"] = "Ocurrió un error: ".mysqli_error($mysqli)." query ='".$sql."'";
	}

	function setTimeStamp() {
		date_default_timezone_set("UTC");
		date_default_timezone_set("America/Mexico_City");
		return date("Y-m-d H:i:s");
	}

	function getProducts($mysqli,$page,$category) {
		// '$page' es la página actual ($_GET["page"])
    // '$total' es el total de registros y se ocupa para poder calcular el número de resultados por página
    // '$total_pages' guarda la cantidad total de páginas
    // '$limit_1' es la cantidad de resultados, utilizada como tipo variable global tanto para la consulta como para el parámetro '$limit_0'
    // '$limit_0' es la primer "página" de los resultados de la consulta sql
    $query = "SELECT COUNT(*) as num_rows FROM assortment WHERE category='$category' AND origin='NACIONAL'";
    $res = mysqli_query($mysqli, $query);
    $total = mysqli_fetch_array($res)["num_rows"];
    $limit_1 = 9;
    mysqli_free_result($res);

    $total_pages = $total / $limit_1;
    $total_pages = ceil($total_pages);

    $limit_0 = ($page*$limit_1)-$limit_1;

    $sql = "SELECT * FROM assortment WHERE category='$category' AND origin='NACIONAL' LIMIT $limit_0,$limit_1";
    $query = mysqli_query($mysqli,$sql);
    $datos = array();
    // $counter = 0;

    while( $row=mysqli_fetch_array($query) ) {
    	$datos[] = array(
    		"id" => $row["id"],
				"id_item" => $row["id_item"],
				"name" => $row["name"],
				"price" => $row["price"],
				"line" => $row["line"],
				"line_l" => $row["line_l"],
				"origin" => $row["origin"],
				"sizes" => $row["sizes"],
				"category" => $row["category"],
				"colors" => $row["colors"],
				"images" => $row["images"],
				"cloth" => $row["cloth"],
				"pages" => $total_pages,
    	);
    }

		return $datos;
		mysqli_close($mysqli);
	}

	function getProduct($mysqli,$id) {
		$sql = "SELECT * FROM assortment WHERE id_item=".$id;
		$res = mysqli_query($mysqli,$sql);

    while( $row=mysqli_fetch_array($res) ) {
    	$datos[] = array(
    		"id" => $row["id"],
				"id_item" => $row["id_item"],
				"name" => $row["name"],
				"price" => $row["price"],
				"line" => $row["line"],
				"line_l" => $row["line_l"],
				"origin" => $row["origin"],
				"sizes" => $row["sizes"],
				"category" => $row["category"],
				"colors" => $row["colors"],
				"images" => $row["images"],
				"cloth" => $row["cloth"],
    	);
    }

		return $datos;
		mysqli_close($mysqli);
	}

	function activationCode($type) {
		if( $type=="code" ) {
			$length = 32;
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++)
	      $randomString .= $characters[rand(0, $charactersLength - 1)];
		} else {
			$length = 8;
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++)
	      $randomString .= $characters[rand(0, $charactersLength - 1)];
		}
    return $randomString;
	}

	function mailNotification($to,$subject,$message) {
		$company = "Pantuflas Finas";
		$noreply = "info@pantuflasfinas.com.mx";

		$headers = "MIME-Version: 1.0"."\r\n".
									 "Content-type: text/html; charset=utf-8"."\r\n".
									 "From: Administrador - ".$company."<".$noreply.">\r\n".
									 "X-Mailer: PHP/".phpversion();

		$mail_usr = mail($to, $subject, $message, $headers);
	}
?>