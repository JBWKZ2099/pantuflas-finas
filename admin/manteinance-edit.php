<?php
ini_set("display_errors", "On");
	session_start();
	include("../php/db/conn.php");
	include("../php/db/auth.php");
	
	if( authCheck() && user()["permission"]==1 && userAccess()["users"]==1 ) {
		$mysqli = conectar_db();
		selecciona_db($mysqli);
		$sql = "SELECT * FROM web_information";
		$result = consulta_tb($mysqli,$sql);
		mysqli_set_charset("UTF8");
		$row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$title="Editar información web";
		$copy_year = date("Y",strtotime("today"));
		include("structure/head.php");
	?>
	<script src="assets/js/datatables/jquery.js"></script>
	<script src="assets/js/datatables/jquery.dataTables.js"></script>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php
		$active_menu = "manteinance_mn";
		$collapse = "manteinance";
		$active_opt = "manteinance-edit";
		include("structure/navbar.php");
	?>

	<div class="content-wrapper">
		<div class="contianer-fluid">
			<div class="container-fluid">
				<div class="row mt-3">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header bg-blue text-white">
								<i class="fa fa-fw fa-pencil-square-o"></i>
								Editando información
							</div>
							<div class="card-body">
								<?php
									include("../alerts/errors.php");
									include("../alerts/success.php");
								?>
								<form action="../php/db/requests.php" method="POST" enctype="multipart/form-data">
									<input type="hidden" name="request" value="update-web">
									<?php
										$edit = true;
									?>
									<?php include("forms/manteinance-form.php") ?>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include("structure/footer.php") ?>

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fa fa-angle-up"></i>
	</a>
	<?php include("widgets/modal.php") ?>


	<script defer="defer">
		$(document).ready(function() {
	  	$("#next-btn").click(function(e){
	  		var current = $("[data-current]").attr("data-current");
	  		current = parseInt(current);
				var which = $("[data-order='"+(current+1)+"']").attr("href");

				$(".tab-pane.fade").removeClass("show").removeClass("active");
				$(".nav-link").removeClass("active");
				$(".nav-link[href='"+which+"']").addClass("active");
				$(which).addClass("show").addClass("active");
	  		$("[data-order='"+(current+1)+"']").trigger("click");
	  		$("#myTab").attr("data-current",(current+1));

	  		if( $("[data-current]").attr("data-current")=="7" ) {
	  			$(this).addClass("d-none");
	  			$("#submit").removeClass("d-none");
	  		}
	  	});

	  	$("#prev-btn").click(function(e){
	  		var current = $("[data-current]").attr("data-current");
	  		current = parseInt(current);
	  		if( current>1 ) {
	  			console.log("clicked");
					var which = $("[data-order='"+(current-1)+"']").attr("href");

					$(".tab-pane.fade").removeClass("show").removeClass("active");
					$(".nav-link").removeClass("active");
					$(".nav-link[href='"+which+"']").addClass("active");
					$(which).addClass("show").addClass("active");
		  		$("[data-order='"+(current-1)+"']").trigger("click");
		  		$("#myTab").attr("data-current",(current-1));

		  		if( $("[data-current]").attr("data-current")=="6" ) {
		  			$("#next-btn").removeClass("d-none");
		  			$("#submit").addClass("d-none");
		  		}
		  	}
	  	});

	  	$(".nav-link").click(function(e){
	  		var which = parseInt( $(this).attr("data-order") );
	  		$("[data-current]").attr("data-current",which)
	  		if( which<7 && which>0 ) {
	  			$("#submit").addClass("d-none");
		  		$("#next-btn").removeClass("d-none");
	  		}
	  		if( which==7 ) {
	  			$("#submit").removeClass("d-none");
		  		$("#next-btn").addClass("d-none");
	  		}
	  	});

			editor("ta1");
			editor("ta2");
			editor("ta3");

			function editor(id) {
				CodeMirror.fromTextArea(document.getElementById(id), {
					lineNumbers: true,
					tabSize: 2,
					htmMode: true,
					autofocus: true,
					mode: "text/html"
				});
			}
		});
	</script>
</body>
</html>
<?php
	} else {
		header("Location: login");
	}
?>