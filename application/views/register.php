<?php $this->load->view('Layout/__header'); ?>

<div class="row m-0 vh-100 justify-content-center align-item-center">
	<div class="form-signin col-4 text-center">
		<form>
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="nombre" placeholder="Nombre">
				<label for="floatingInput">Nombre</label>
			</div>
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="paterno" placeholder="Apellido Paterno">
				<label for="floatingInput">Apellido Paterno</label>
			</div>
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="materno" placeholder="Apellido Materno">
				<label for="floatingInput">Apellido Materno</label>
			</div>
			<div class="form-floating mb-3">
				<input type="email" class="form-control" id="correo" placeholder="Correo" required>
				<label for="floatingInput">Correo</label>
			</div>
			<div class="form-floating mb-3">
				<input type="number" class="form-control" id="telefono" placeholder="Telefono" required>
				<label for="floatingInput">Telefono</label>
			</div>
			<div class="form-floating">
				<input type="password" class="form-control" id="password" placeholder="Password">
				<label for="floatingPassword">Contraseña</label>
			</div>
			<div class="form-floating mt-3">
				<button class="btn btn-primary w-100 py-2 mb-2" type="submit" id="ingresar">Ingresar</button>
			</div>
			<div class="form-floating mt-3">
				<p>Recuerde que para el inicio de session se necesita el correo registrado y su contraseña</p>
			</div>
		</form>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function() {

		$('#ingresar').click(function (e) {
			e.preventDefault();
			let nombre = $('#nombre').val();
			let paterno = $('#paterno').val();
			let materno = $('#materno').val();
			let correo = $('#correo').val();
			let telefono = $('#telefono').val();
			let password = $('#password').val();

			$.ajax({
				url: "<?php echo base_url(); ?>ApiMiddle/loginUser",
				method: "POST",
				data: {
					nombre: nombre,
					paterno: paterno,
					materno: materno,
					correo: correo,
					telefono: telefono,
					password: password,
					flag: loginUser
				},
				dataType: "JSON",
				success: function(returnData){
					console.log(returnData)
					//redireccionar al inicio
				}
			});
		});

	});
</script>

<?php $this->load->view('Layout/__footer'); ?>


