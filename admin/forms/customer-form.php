<div class="form-group">
	<input type="text" class="form-control" name="name" value="<?php echo $row["name"]; ?>" placeholder="Nombre" required>
</div>
<div class="form-group">
	<input type="text" class="form-control" name="first_name" value="<?php echo $row["first_name"]; ?>" placeholder="Apellido Paterno" required>
</div>
<div class="form-group">
	<input type="text" class="form-control" name="last_name" value="<?php echo $row["last_name"]; ?>" placeholder="Apellido Materno" required>
</div>
<div class="form-group">
	<input type="text" class="form-control" name="username" value="<?php echo $row["username"]; ?>" placeholder="Usuario" required>
</div>
<div class="form-group">
	<input type="email" class="form-control" name="email" value="<?php echo $row["email"]; ?>" placeholder="Correo Electrónico" required>
</div>

<?php if( !$login ) { ?>
	<div class="form-group">
		<input type="password" class="form-control" name="password" placeholder="Contraseña" <?php if( !isset($edit) ) echo 'required' ?>>
			<?php if( isset($row) ) { ?>
					<small class="help-block">Si no es deseas cambiar la contraseña, deja el campo en blanco.</small>
			<?php } ?>
	</div>
	<?php if( isset($row) ) { ?>
			<?php if( $row["id"]==user()["id"] ) { ?>
				<input type="hidden" name="permission" value="<?php echo $row["permission"]; ?>">
			<?php } else { ?>
					<div class="form-group">
						<select name="permission" id="permission" class="form-control">
							<?php
								if( mysqli_num_rows($sql_perm_res)>0 ) {
									while( $perm_row=mysqli_fetch_array($sql_perm_res) ) {
										if( $perm_row["id"]==$row["permission"] )
											$selected = "selected";
										else
											$selected = "";
										echo "<option value='".$perm_row["id"]."' ".$selected.">".$perm_row["name"]."</option>";
									}
								}
							?>
						</select>
					</div>
			<?php } ?>
	<?php } else { ?>
			<div class="form-group">
				<select name="permission" id="permission" class="form-control">
					<option value="null" selected hidden>Selecciona un permiso...</option>
					<?php
						if( mysqli_num_rows($u_result)>0 ) {
							while( $u_row=mysqli_fetch_array($u_result) ) {
								if( $u_row["id"]==$row["permission"] )
									$selected = "selected";
								else
									$selected = "";
								echo "<option value='".$u_row["id"]."' ".$selected.">".$u_row["name"]."</option>";
							}
						}
					?>
				</select>
			</div>
	<?php } ?>

	<?php if( isset($row) ) { ?>
		<?php if( $row["id"]==user()["id"] ) { ?>
			<input type="hidden" name="home" value="1">
			<input type="hidden" name="catalogue" value="1">
			<input type="hidden" name="_requestinput" value="1">
			<input type="hidden" name="manteinance" value="1">
			<input type="hidden" name="web_page" value="1">
			<input type="hidden" name="my_account" value="1">
			<input type="hidden" name="users" value="1">
		<?php } else { ?>
			<div class="form-group">
				<p><strong>Acceso a módulos</strong></p>
			</div>
			<?php
				// ini_set("display_errors", "On");
				$id_user = $row["id"];

				if( isset($access_row["home"]) && !empty($access_row["home"]) ) { $home="checked"; $home_val = 1; } else $home_val = 0;
				if( isset($access_row["catalogue"]) && !empty($access_row["catalogue"]) ) { $catalogue="checked"; $catalogue_val = 1; } else $catalogue_val = 0;
				if( isset($access_row["request"]) && !empty($access_row["request"]) ) { $request="checked"; $request_val = 1; } else $request_val = 0;
				if( isset($access_row["manteinance"]) && !empty($access_row["manteinance"]) ) { $manteinance="checked"; $manteinance_val = 1; } else $manteinance_val = 0;
				if( isset($access_row["web_page"]) && !empty($access_row["web_page"]) ) { $web_page="checked"; $web_page_val = 1; } else $web_page_val = 0;
				if( isset($access_row["my_account"]) && !empty($access_row["my_account"]) ) { $my_account="checked"; $my_account_val = 1; } else $my_account_val = 0;
				if( isset($access_row["users"]) && !empty($access_row["users"]) ) { $users="checked"; $users_val = 1; } else $users_val = 0;
			?>
			<div class="form-group" data-check="null">
				<label for="home">
					<input data-admin id="home" type="checkbox" name="home" <?php echo $home." value='".$home_val."'"; ?>> Inicio
				</label>
			</div>
			<div class="form-group">
				<label for="catalogue">
					<input data-admin id="catalogue" type="checkbox" name="catalogue" <?php echo $catalogue." value='".$catalogue_val."'"; ?>> Catálogo
				</label>
			</div>
			<div class="form-group">
				<label for="request">
					<input data-admin id="request" type="checkbox" name="_requestinput" <?php echo $request." value='".$request_val."'"; ?>> Solicitud
				</label>
			</div>
			<div class="form-group">
				<label for="manteinance">
					<input data-admin id="manteinance" type="checkbox" name="manteinance" <?php echo $manteinance." value='".$manteinance_val."'"; ?>> Mantenimiento
				</label>
			</div>
			<div class="form-group">
				<label for="web_page">
					<input data-admin id="web_page" type="checkbox" name="web_page" <?php echo $web_page." value='".$web_page_val."'"; ?>> Página Web
				</label>
			</div>
			<div class="form-group">
				<label for="my_account">
					<input data-admin id="my_account" type="checkbox" name="my_account" <?php echo $my_account." value='".$my_account_val."'"; ?>> Mi Cuenta
				</label>
			</div>
			<div class="form-group">
				<label for="users">
					<input data-admin id="users" type="checkbox" name="users" <?php echo $users." value='".$users_val."'"; ?>> Usuarios
				</label>
			</div>
			<input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
		<?php } ?>
	<?php } else { ?>
			<div class="form-group">
				<p><strong>Acceso a módulos</strong></p>
			</div>
			<div class="form-group" data-check="null">
				<label for="home">
					<input data-admin id="home" type="checkbox" name="home" value="0"> Inicio
				</label>
			</div>
			<div class="form-group">
				<label for="catalogue">
					<input data-admin id="catalogue" type="checkbox" name="catalogue" value="0"> Catálogo
				</label>
			</div>
			<div class="form-group">
				<label for="request">
					<input data-admin id="request" type="checkbox" name="_requestinput" value="0"> Solicitud
				</label>
			</div>
			<div class="form-group">
				<label for="manteinance">
					<input data-admin id="manteinance" type="checkbox" name="manteinance" value="0"> Mantenimiento
				</label>
			</div>
			<div class="form-group">
				<label for="web_page">
					<input data-admin id="web_page" type="checkbox" name="web_page" value="0"> Página Web
				</label>
			</div>
			<div class="form-group">
				<label for="my_account">
					<input data-admin id="my_account" type="checkbox" name="my_account" value="0"> Mi Cuenta
				</label>
			</div>
			<div class="form-group">
				<label for="users">
					<input data-admin id="users" type="checkbox" name="users" value="0"> Usuarios
				</label>
			</div>
	<?php } ?>
	<script>
		$("#permission").change(function(e){
			if( $(this).val()==1 ) {
				$("[data-admin]").each(function(index, el) {
					if( !$("#"+el.id).is(":checked") )
						$("#"+el.id).trigger("click");
						$("#"+el.id).attr("value","1")
				});
				$("[data-check]").attr("data-check","all");
			}
		});

		$("[data-admin]").click(function(e){
			var which = $(this).attr("id");

			if( $(this).val()==1 )
				$(this).val(0)
			else
				$(this).val(1)

			if( $("[data-check]").attr("data-check")=="all" ) {
				$("[data-check]").attr("data-check","semi");
				$("#permission").val("null");
			}
		});
	</script>
<?php } ?>