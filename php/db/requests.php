<?php
	ini_set("display_errors", "On");
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
				// exit();
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
				$password = cryptBlowfish($_POST["password"]);
				$data = array(
					0 => 'NULL',
					1 => "'".$_POST["name"]."'",
					2 => "'".$_POST["first_name"]."'",
					3 => "'".$_POST["last_name"]."'",
					4 => "'".$_POST["username"]."'",
					5 => "'".$_POST["email"]."'",
					6 => "'".$password."'",
					7 => "'".$_POST["permission"]."'",
					8 => "''",
					9 => "'".setTimeStamp()."'",
					10 => 'NULL',
					11 => 'NULL',
				);
				// var_dump($data);
				// exit();

				registro_nuevo($tbl, $data, $columns);
				header("Location: ".$up_dir."admin/customers-create");
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

			case "create-masload":
				massiveLoad($_POST);
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