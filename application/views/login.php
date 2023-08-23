<?php $this->load->view('Layout/__header'); ?>

<div class="row m-0 vh-100 justify-content-center align-item-center">
	<div class="form-signin col-auto text-center">
		<form>
			<h1 class="h3 mb-3 fw-normal">Ingreso Al Sistema</h1>

			<div class="form-floating mb-3">
				<input type="email" class="form-control" id="floatingInput" placeholder="patricio@ejemplo.com">
				<label for="floatingInput">Correo</label>
			</div>
			<div class="form-floating mb-3">
				<input type="password" class="form-control" id="floatingPassword" placeholder="Password">
				<label for="floatingPassword">Contraseña</label>
			</div>

			<button class="btn btn-primary w-100 py-2 mb-2" type="submit">Ingresar</button>
			<a class="btn btn-primary w-100 py-2" href="<?= site_url('register'); ?>">Crear Nueva Cuenta</a>
		</form>
	</div>
</div>


<?php $this->load->view('Layout/__footer'); ?>


