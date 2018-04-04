<?php
	ini_set("display_errors", "Off");
	include("data.php");
	include("conn.php");
	include("auth.php");
	$up_dir = "../../";


	if( isset($_POST["request"]) || isset($_GET["req"]) ) {
		if( $_SERVER["REQUEST_METHOD"]==="POST" ) {
			if( isset($_GET["req"]) )
				$request = $_GET["req"];
			else
				$request = $_POST["request"];

			if( isset($_GET["user_id"]) )
				$user_id = $_GET["user_id"];
		} else
			$request = $_GET["req"];

		switch( $request ) {
			case "login":
				$usr = $_POST["username"];
				$pswd = $_POST["password"];
				$validate = validateLogin( $usr, $pswd );

				if( $validate ) {
					header("Location: ".$up_dir."admin/");
				} else {
					$_SESSION["error"] = "<ul><li>Usuario y/o contraseña incorrectos.</li></ul>";
					header("Location: ".$up_dir."admin/login");
				}
				break;

			case "logout":
				logout();
				break;

			case "customer":
				$tbl = "`users`";
				$tbl2 = "`permissions`";
				$columns = array( 
					0 => "$tbl.id",
					1 => "$tbl.name",
					2 => "$tbl.first_name",
					3 => "$tbl.last_name",
					4 => "$tbl.username",
					5 => "$tbl.email",
					6 => "$tbl.permission",
				);
				$col_clean = array( 
					0 => "id",
					1 => "name",
					2 => "first_name",
					3 => "last_name",
					4 => "username",
					5 => "email",
					6 => "permission",
				);
				$sql_data = array(
					0 => "$tbl.`id`, $tbl.`name`, $tbl.`first_name`, $tbl.`last_name`, $tbl.`username`, $tbl.`email`, $tbl.`permission`, $tbl2.`name` AS 'permission' ",
					1 => $tbl,
					2 => "INNER JOIN $tbl2 ON $tbl.`permission`=$tbl2.`id` WHERE $tbl.`deleted_at` IS NULL "
				);
				echo dataTable($_POST, $columns, $col_clean, $sql_data);
				break;

			case "update-customer":
				$password = null;
				if( isset($_POST["password"]) && !empty($_POST["password"]) )
					$password = $_POST["password"];

				$columns = array(
					0 => "name",
					1 => "first_name",
					2 => "last_name",
					3 => "username",
					4 => "email",
				);
				if( isset($password) )
					$columns[] = "password";

				$columns[] = "permission";

				$data = array(
					0 => $_POST["name"],
					1 => $_POST["first_name"],
					2 => $_POST["last_name"],
					3 => $_POST["username"],
					4 => $_POST["email"],
				);
				if( isset($password) )
					$data[] = cryptBlowfish($password);

				$data[] = $_POST["permission"];
				$tbl = "users";
				// var_dump($data); exit();
				updateData($_POST["which"], $columns, $data, $tbl);

				$columns2 = array(
					0 => "home",
					1 => "catalogue",
					2 => "request",
					3 => "manteinance",
					4 => "web_page",
					5 => "my_account",
					6 => "users",
				);

				if( $_POST["home"]==null ) $home = "0";
				else $home = $_POST["home"];

				if( $_POST["catalogue"]==null ) $catalogue = "0";
				else $catalogue = $_POST["catalogue"];

				if( $_POST["_requestinput"]==null ) $_requestinput = "0";
				else $_requestinput = $_POST["_requestinput"];

				if( $_POST["manteinance"]==null ) $manteinance = "0";
				else $manteinance = $_POST["manteinance"];

				if( $_POST["web_page"]==null ) $web_page = "0";
				else $web_page = $_POST["web_page"];

				if( $_POST["my_account"]==null ) $my_account = "0";
				else $my_account = $_POST["my_account"];

				if( $_POST["users"]==null ) $users = "0";
				else $users = $_POST["users"];


				$data2 = array(
					0 => $home,
					1 => $catalogue,
					2 => $_requestinput,
					3 => $manteinance,
					4 => $web_page,
					5 => $my_account,
					6 => $users,
				);
				// var_dump($data2); exit();
				updateData($_POST["id_user"], $columns2, $data2, "access");
				header("Location: ".$up_dir."admin/customers");
				break;

			case "create-customer":
				$tbl = $_POST["table"];
				$columns = array(
					0 => "id",
					1 => "name",
					2 => "first_name",
					3 => "last_name",
					4 => "username",
					5 => "email",
					6 => "password",
					7 => "permission",
					8 => "remember_token",
					9 => "created_at",
					10 => "update_at",
					11 => "deleted_at",
				);

				if( !isset($_POST["page"]) && empty($_POST["page"]) ) {
					$password = cryptBlowfish($_POST["password"]);
					$permission = $_POST["permission"];
				} else {
					session_start();
					$_SESSION["old_password"] = activationCode("password");
					$password = cryptBlowfish( $_SESSION["old_password"] );
					$permission = 2;
				}

    		$name = $_POST["name"];
    		$last_n = $_POST["first_name"];

    		include("../slug.lib.php");
    		$last_n = slugger($last_n);

    		$username = strtolower( substr($name, 0, 1) ).$last_n.".".rand(0,9999);

				$data = array(
					0 => 'NULL',
					1 => "'".$_POST["name"]."'",
					2 => "'".$_POST["first_name"]."'",
					3 => "'".$_POST["last_name"]."'",
					4 => "'".$username."'",
					5 => "'".$_POST["email"]."'",
					6 => "'".$password."'",
					7 => "'".$permission."'",
					8 => "''",
					9 => "'".setTimeStamp()."'",
					10 => 'NULL',
					11 => 'NULL',
				);
				$validate_user = array(
					0 => true,
					1 => null,
				);

				if( !isset($_POST["page"]) && empty($_POST["page"]) )
					$validate_user[1] = $up_dir."admin/customers-create";
				else
					$validate_user[1] = $up_dir."admin/login";

				// var_dump($validate_user);
				// var_dump($columns);
				// var_dump($data);
				// die();

				registro_nuevo($tbl, $data, $columns, $validate_user);

				$mysqli = conectar_db();
				selecciona_db($mysqli);
				$get_user = "SELECT id FROM users WHERE username='".$username."'";
				$gu_result = mysqli_query($mysqli, $get_user);
				$id_user = mysqli_fetch_array($gu_result)["id"];

				if( !isset($_POST["page"]) && empty($_POST["page"]) ) {
					$mysqli = conectar_db();
					selecciona_db($mysqli);
					$get_user = "SELECT id FROM users WHERE username='".$_POST["username"]."'";
					$gu_result = mysqli_query($mysqli, $get_user);
					$id_user = mysqli_fetch_array($gu_result)["id"];

					$columns2 = array(
						0 => "id",
						1 => "id_user",
						2 => "home",
						3 => "catalogue",
						4 => "request",
						5 => "manteinance",
						6 => "web_page",
						7 => "my_account",
						8 => "users",
					);

					if( $_POST["home"]==null ) $home = "0";
					else $home = $_POST["home"];

					if( $_POST["catalogue"]==null ) $catalogue = "0";
					else $catalogue = $_POST["catalogue"];

					if( $_POST["_requestinput"]==null ) $_requestinput = "0";
					else $_requestinput = $_POST["_requestinput"];

					if( $_POST["manteinance"]==null ) $manteinance = "0";
					else $manteinance = $_POST["manteinance"];

					if( $_POST["web_page"]==null ) $web_page = "0";
					else $web_page = $_POST["web_page"];

					if( $_POST["my_account"]==null ) $my_account = "0";
					else $my_account = $_POST["my_account"];

					if( $_POST["users"]==null ) $users = "0";
					else $users = $_POST["users"];

					$data2 = array(
						0 => 'NULL',
						1 => $id_user,
						2 => $home,
						3 => $catalogue,
						4 => $_requestinput,
						5 => $manteinance,
						6 => $web_page,
						7 => $my_account,
						8 => $users,
					);
					// var_dump($columns2);
					// var_dump($data2);
					// exit();
					registro_nuevo("access", $data2, $columns2);
					header("Location: ".$up_dir."admin/customers-create");
				} else {
					// From register page (LOGIN)
					$columns = array(
						0 => "id",
						1 => "id_user",
						2 => "token",
						3 => "pswd_changed",
					);

					// $token = activationCode("code");

					$data = array(
						0 => 'NULL',
						1 => $id_user,
						2 => "'empty'",
						3 => 0,
					);
					// var_dump($columns);
					// var_dump($data);
					// die();
					registro_nuevo("activations", $data, $columns);

					$reg_access = array(
						0 => 'NULL',
						1 => $id_user,
						2 => "1",
						3 => "0",
						4 => "0",
						5 => "0",
						6 => "0",
						7 => "1",
						8 => "0",
					);
					registro_nuevo("access", $reg_access, $columns);

					$body = "
						<p>Hola ".$_POST["name"]." ".$_POST["first_name"]."</p>
						<p>Tu nombre de usuario es: ".$username."</p>
						<p>Y tu contraseña es: ".$_SESSION["old_password"]."</p> <br>
						<p>Te recomendamos ampliamente que la actualices en cuanto inicies sesión.</p>
					";
					// mailNotification($_POST["email"],$subject,$body);
					loginAfterReg($username);

					// print_r($_SESSION); exit();
					header("Location: ".$up_dir."admin/");
				}
				break;

			case "customer-restore":
				$tbl = "`users`";
				$tbl2 = "`permissions`";
				$columns = array( 
					0 => "$tbl.id",
					1 => "$tbl.name",
					2 => "$tbl.first_name",
					3 => "$tbl.last_name",
					4 => "$tbl.username",
					5 => "$tbl.email",
					6 => "$tbl.permission",
				);
				$col_clean = array( 
					0 => "id",
					1 => "name",
					2 => "first_name",
					3 => "last_name",
					4 => "username",
					5 => "email",
					6 => "permission",
				);
				$sql_data = array(
					0 => "$tbl.`id`, $tbl.`name`, $tbl.`first_name`, $tbl.`last_name`, $tbl.`username`, $tbl.`email`, $tbl.`permission`, $tbl2.`name` AS 'permission' ",
					1 => $tbl,
					2 => "INNER JOIN $tbl2 ON $tbl.`permission`=$tbl2.`id` WHERE $tbl.`deleted_at` IS NOT NULL "
				);
				echo dataTable($_POST, $columns, $col_clean, $sql_data);
				break;

			case "update-password":
				$password = cryptBlowfish($_POST["new-password"]);
				$token = activationCode("code");

				$columns = array( "password" );
				$data = array( $password );

				$mysqli = conectar_db();
				selecciona_db($mysqli);
				$get_user = "SELECT id FROM users WHERE email='".$_POST["mail-user"]."'";
				$gu_result = mysqli_query($mysqli, $get_user);
				$id_user = mysqli_fetch_array($gu_result)["id"];

				// var_dump( $columns );
				// var_dump( $data );
				// exit();
				updateData($id_user, $columns, $data, "users");

				$columns2 = array( "token", "pswd_changed" );
				$data2 = array( $token, "1" );
				updateData($id_user, $columns2, $data2, "activations");
				header("Location: ".$up_dir."admin/");
				break;

			case "edit-account":
				$password = null;
				if( isset($_POST["password"]) && !empty($_POST["password"]) )
					$password = $_POST["password"];

				$columns = array(
					0 => "name",
					1 => "first_name",
					2 => "last_name",
					3 => "username",
					4 => "email",
				);
				if( isset($password) )
					$columns[] = "password";

				$columns[] = "permission";

				$data = array(
					0 => $_POST["name"],
					1 => $_POST["first_name"],
					2 => $_POST["last_name"],
					3 => $_POST["username"],
					4 => $_POST["email"],
				);
				if( isset($password) )
					$data[] = cryptBlowfish($password);

				$data[] = $_POST["permission"];
				$tbl = "users";
				// var_dump($data); exit();
				updateData($_POST["which"], $columns, $data, $tbl);
				header("Location: ".$up_dir."admin/account");
				break;

			case "create-masload":
				massiveLoad($_POST);
				header("Location: ".$up_dir."admin/massive-load-create");
				break;

			case "update-web":
				$columns = array();
				$data = array();

				$columns[] = "title_aboutus";
				$columns[] = "about_us";
				if( isset($_FILES["brands_1"]["name"]) && !empty($_FILES["brands_1"]["name"]) )
					$columns[] = "brand_1";
				if( isset($_FILES["brands_2"]["name"]) && !empty($_FILES["brands_2"]["name"]) )
					$columns[] = "brand_2";
				if( isset($_FILES["brands_3"]["name"]) && !empty($_FILES["brands_3"]["name"]) )
					$columns[] = "brand_3";
				if( isset($_FILES["brands_4"]["name"]) && !empty($_FILES["brands_4"]["name"]) )
					$columns[] = "brand_4";
				if( isset($_FILES["brands_5"]["name"]) && !empty($_FILES["brands_5"]["name"]) )
					$columns[] = "brand_5";

				$columns[] = "title_catalogue";
				$columns[] = "gentleman_catalogue";
				$columns[] = "lady_catalogue";

				if( isset($_FILES["gentleman_img"]["name"]) && !empty($_FILES["gentleman_img"]["name"]) )
					$columns[] = "gentleman_img";
				if( isset($_FILES["lady_img"]["name"]) && !empty($_FILES["lady_img"]["name"]) )
					$columns[] = "lady_img";

				$columns[] = "navbar_title_1";
				$columns[] = "navbar_title_2";
				$columns[] = "navbar_title_3";
				$columns[] = "navbar_title_4";
				$columns[] = "footer_content";
				$columns[] = "facebook_link";
				$columns[] = "instagram_link";
				$columns[] = "pedidos_title";
				$i=1;
				foreach( $_POST["banners_home"] as $b_home ) {
					if( isset($b_home) && !empty($b_home) ) {
						$columns[] = "banner_home_".$i;
					}
					$i++;
				}
				$columns[] = "banner_home_text";
				$columns[] = "banner_btn_home_text";
				if( isset($_POST["banner_pedidos"]) && !empty($_POST["banner_pedidos"]) ) {
					$columns[] = "banner_pedidos";
				}

				$data[] = $_POST["title-aboutus"];
				$data[] = $_POST["about-us"];
				$upload_path = "../../uploads/";
				if( isset($_FILES["brands_1"]["name"]) && !empty($_FILES["brands_1"]["name"]) ) {
					$brands_1_name = date("Y-m-d_His")."_".$_FILES["brands_1"]["name"];
					$data[] = $brands_1_name;
					$dir_subida = $upload_path.$brands_1_name;
					move_uploaded_file($_FILES["brands_1"]["tmp_name"], $dir_subida);
				}
				if( isset($_FILES["brands_2"]["name"]) && !empty($_FILES["brands_2"]["name"]) ) {
					$brands_2_name = date("Y-m-d_His")."_".$_FILES["brands_2"]["name"];
					$data[] = $brands_2_name;
					$dir_subida = $upload_path.$brands_2_name;
					move_uploaded_file($_FILES["brands_2"]["tmp_name"], $dir_subida);
				}
				if( isset($_FILES["brands_3"]["name"]) && !empty($_FILES["brands_3"]["name"]) ) {
					$brands_3_name = date("Y-m-d_His")."_".$_FILES["brands_3"]["name"];
					$data[] = $brands_3_name;
					$dir_subida = $upload_path.$brands_3_name;
					move_uploaded_file($_FILES["brands_3"]["tmp_name"], $dir_subida);
				}
				if( isset($_FILES["brands_4"]["name"]) && !empty($_FILES["brands_4"]["name"]) ) {
					$brands_4_name = date("Y-m-d_His")."_".$_FILES["brands_4"]["name"];
					$data[] = $brands_4_name;
					$dir_subida = $upload_path.$brands_4_name;
					move_uploaded_file($_FILES["brands_4"]["tmp_name"], $dir_subida);
				}
				if( isset($_FILES["brands_5"]["name"]) && !empty($_FILES["brands_5"]["name"]) ) {
					$brands_5_name = date("Y-m-d_His")."_".$_FILES["brands_5"]["name"];
					$data[] = $brands_5_name;
					$dir_subida = $upload_path.$brands_5_name;
					move_uploaded_file($_FILES["brands_5"]["tmp_name"], $dir_subida);
				}
				$data[] = $_POST["title-catalogue"];
				$data[] = $_POST["gentleman-catalogue"];
				$data[] = $_POST["lady-catalogue"];
				if( isset($_FILES["gentleman_img"]["name"]) && !empty($_FILES["gentleman_img"]["name"]) ) {
					$gentleman_name = date("Y-m-d_His")."_".$_FILES["gentleman_img"]["name"];
					$data[] = $gentleman_name;
					$dir_subida = $upload_path.$gentleman_name;
					move_uploaded_file($_FILES["gentleman_img"]["tmp_name"], $dir_subida);
				}
				if( isset($_FILES["lady_img"]["name"]) && !empty($_FILES["lady_img"]["name"]) ) {
					$lady_name = date("Y-m-d_His")."_".$_FILES["lady_img"]["name"];
					$data[] = $lady_name;
					$dir_subida = $upload_path.$lady_name;
					move_uploaded_file($_FILES["lady_img"]["tmp_name"], $dir_subida);
				}
				foreach( $_POST["navbar-titles"] as $nb_title ) {
					if( isset($nb_title) && !empty($nb_title) )
						$data[] = $nb_title;
				}
				$data[] = $_POST["footer-content"];
				foreach( $_POST["footer-links"] as $f_links ) {
					if( isset($f_links) && !empty($f_links) )
						$data[] = $f_links;
				}
				$data[] = $_POST["pedidos-title"];
				if( isset($_FILES["banners_home_1"]["name"]) && !empty($_FILES["banners_home_1"]["name"]) ) {
					$banner_home_1_img = date("Y-m-d_His")."_".$_FILES["banners_home_1"]["name"];
					$data[] = $banner_home_1_img;
					$dir_subida = $upload_path.$banner_home_1_img;
					move_uploaded_file($_FILES["banners_home_1"]["tmp_name"], $dir_subida);
				}
				if( isset($_FILES["banners_home_2"]["name"]) && !empty($_FILES["banners_home_2"]["name"]) ) {
					$banner_home_2_img = date("Y-m-d_His")."_".$_FILES["banners_home_2"]["name"];
					$data[] = $banner_home_2_img;
					$dir_subida = $upload_path.$banner_home_2_img;
					move_uploaded_file($_FILES["banners_home_2"]["tmp_name"], $dir_subida);
				}
				if( isset($_FILES["banners_home_3"]["name"]) && !empty($_FILES["banners_home_3"]["name"]) ) {
					$banner_home_3_img = date("Y-m-d_His")."_".$_FILES["banners_home_3"]["name"];
					$data[] = $banner_home_3_img;
					$dir_subida = $upload_path.$banner_home_3_img;
					move_uploaded_file($_FILES["banners_home_3"]["tmp_name"], $dir_subida);
				}
				$data[] = $_POST["banner-home-text"];
				$data[] = $_POST["banner-btn-home-text"];
				if( isset($_FILES["banner_pedidos"]["name"]) && !empty($_FILES["banner_pedidos"]["name"]) ) {
					$banner_pedidos_img = date("Y-m-d_His")."_".$_FILES["banner_pedidos"]["name"];
					$data[] = date("Y-m-d_His")."_".$_FILES["banner_pedidos"]["name"];
					$dir_subida = $upload_path.$banner_pedidos_img;
					move_uploaded_file($_FILES["banner_pedidos"]["tmp_name"], $dir_subida);
				}

				// var_dump($columns);
				// echo "<br><br><br>";
				// var_dump($data);
				// exit();
				updateData("1", $columns, $data, "web_information");
				header("Location: ".$up_dir."admin/manteinance-edit");
				break;

			case "delete":
				$id = $_POST["id"];
				$tbl = $_POST["table"];
				$path = $_POST["path"];

				deleteRecord($id, $tbl);
				header("Location: ".$up_dir."admin/".$path);
				break;

			case "restore":
				$id = $_POST["id"];
				$tbl = $_POST["table"];
				$path = $_POST["path"];
				
				restoreRecord($id, $tbl);
				header("Location: ".$up_dir."admin/".$path);
				break;
			
			default:
				break;
		}
	}
?>