<section id="contacto" class="pt-60 pb-60 bg-yellow-light">
	<div class="container-custom">
		<div class="row mb-45">
			<div class="col-md-12">
				<form action="<?php echo $path; ?>php/mailer/mail.php" method="POST">
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
										<input type="email" class="form-control" name="email" value="" placeholder="E-Mail:" required>
									</div>
								</div>
								<div class="col-md-12 align-self-end">
									<input type="text" class="form-control" name="subject" value="" placeholder="Asunto:" required>
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
				<iframe class="w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1880.7475615259234!2d-99.20115754206199!3d19.477322796714716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d20287f64849a5%3A0x541b4d66befc455!2sDiccopel+S.A.+de+C.V.!5e0!3m2!1ses!2smx!4v1521777509620" width="600" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</section>