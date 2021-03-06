<section id="contacto" class="pt-60 pb-60 bg-yellow-light">
	<div class="container-custom">
		<div class="row mb-45">
			<div class="col-md-12">
				<?php include("alerts/success.php"); ?>
				<?php include("alerts/errors.php"); ?>
			</div>
			<div class="col-md-12">
				<form action="<?php echo $path; ?>php/mailer/mail.php" method="POST">

					<input type="hidden" name="recaptcha" value="1">
					
					<div class="row">
						<div class="col-md-6 mb-3 mb-md-0">
							<div class="row h-100">
								<div class="col-md-12 align-self-start">
									<div class="form-group">
										<input type="text" class="form-control" name="name" value="" placeholder="Nombre:" required>
									</div>
								</div>
								<div class="col-md-12 align-self-center">
									<div class="form-group">
										<input type="text" class="form-control" name="phone" value="" placeholder="Teléfono:" required>
									</div>
								</div>
								<div class="col-md-12 align-self-center">
									<div class="form-group">
										<input type="email" class="form-control" name="email" value="" placeholder="E-Mail:" required>
									</div>
								</div>
								<div class="col-md-12 align-self-end">
									<input type="text" class="form-control" name="company" value="" placeholder="Empresa:" required>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<textarea class="form-control" name="msg" rows="5" placeholder="Mensaje:"></textarea>
							</div>

							<div class="row">
								<div class="col-md-6 mb-3 mb-md-3">
									<div id="recaptcha"></div>
								</div>
								<div class="col-md-6 align-self-end">
									<button type="submit" class="btn btn-black btn-noradius pl-5 pr-5 float-sm-right">Enviar</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<iframe class="w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3761.495005852977!2d-99.20225188515747!3d19.477327844296134!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d20287f0cbca8b%3A0x7c65928c63308ac!2sPantuflas+Finas!5e0!3m2!1ses-419!2smx!4v1522102690689" width="600" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</section>