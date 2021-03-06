<?php
	ini_set('display_errors', 'Off');
	/**
	 * Code to make absoulute paths (example: http://www.domain-name.com/assets/img/img_name.jpg);
	 */
	$path = (!empty($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'];
	/**
	 * Optimized code to work on local with virtualhosts or localhost or production server
	 */
	$path = (!empty($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'];

	$app_name = "base-b4";
	switch( $path ) {
		case "http://localhost":
			$path .= "/".$app_name."/";
			break;

		case "http://fabricadesoluciones.info":
			$path .= "/".$app_name."/";
			break;

		default:
			$path .= "/";
			break;
	}
  // $path = $_SERVER['HTTP_HOST'] == 'localhost:8888' ? '/fabricadesoluciones.com/' : '';
  session_start();
?>
<link rel="shortcut icon" href="http://placehold.it/64.png"/>
<meta charset="UTF-8">
<title> <?php echo $view_name; ?> | Pantuflas Finas </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<?php /* CSS Tags */ ?>
<?php /*Bootstrap css minified*/ ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
<?php /*Style custom*/ ?>
<link rel="stylesheet" href="<?php echo $path; ?>assets/css/custom.css">

<?php /* JS Tags */ ?>
<?php /*jQuery js minified*/ ?>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
<?php /*jQuery UI*/ ?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<?php /*Bootstrap js minified*/ ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
<?php /*Fontawesome*/ ?>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<?php /*Scroll reveal*/ ?>
<script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/3.0.8/jquery.elevatezoom.js"></script>
<?php /*Script custom*/ ?>
<script type="text/javascript" src="<?php echo $path; ?>assets/js/head.js" defer="defer"></script>

<script src="https://www.google.com/recaptcha/api.js?hl=es&onload=renderCaptcha&render=explicit" async="async" defer="defer"></script>
	<script>
		var recaptcha;
		var renderCaptcha = function() {
			recaptcha = grecaptcha.render('recaptcha', {
				'sitekey': '6LfhZE4UAAAAAGfSjcpK86Ci8WULqAx80vkdFRN8',
				'theme': 'dark'
			});
		};
	</script>

<?php 
	include("php/db/conn.php");
	$mysqli = conectar_db();
	selecciona_db($mysqli);
	$sql = "SELECT * FROM web_information";
	$result = consulta_tb($mysqli,$sql);

	$row = mysqli_fetch_array($result);

	// var_dump( mysqli_fetch_array($result) );
?>