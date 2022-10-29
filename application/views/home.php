<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php $this->load->view('header'); ?>

<!-- navbar -->
<nav class="navbar bg-dark">
	<div class="container-fluid">
		<span class="navbar-brand mb-0 h1 text-light">Tarea Junior</span>
	</div>
</nav>

<div class="container-fluid">
	<div class="row">
		<div class="col-9">
			<!-- Table with Data -->
			<table class="table striped m-4 w-75" id="dataShow">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nombre Indicador</th>
						<th scope="col">Codigo Indicador</th>
						<th scope="col">Unidad de Medida</th>
						<th scope="col">Valor Indicador</th>
						<th scope="col">Fecha Indicador</th>
						<th scope="col">Tiempo Indicador</th>
						<th scope="col">Origen indicador</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
		<div class="col-3 mt-3">
			<div class="form-control">
				<div class="input-group mb-3">
					<span class="input-group-text" id="inputGroup-sizing-default">Credentials</span>
					<input type="text" class="form-control" aria-label="Sizing example input"
						aria-describedby="inputGroup-sizing-default" id="credential">
				</div>
				<button class="btn btn-outline-secondary mb-1" id="token">Solicitar Token</button>
				<button class="btn btn-outline-secondary mb-1" id="indicadores">Solicitar Indicadores</button>
				<button class="btn btn-outline-secondary mb-1" id="insertData">Crear Registro</button>
				<button class="btn btn-outline-primary mb-1" id=seeGraf>Ver Grafico</button>

			</div>

		</div>

	</div>
</div>

<!-- Modal create new data -->
<div class="modal fade" id="indiceCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"></h5>
			</div>
			<form id="formIndices">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6">
							<div class="input-group mb-3">
								<span class="input-group-text" id="inputGroup-sizing-default">Nombre Indicador</span>
								<input type="text" class="form-control" aria-label="Sizing example input"
									aria-describedby="inputGroup-sizing-default" id="nombreindicador">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="input-group mb-3">
								<span class="input-group-text" id="inputGroup-sizing-default">Codigo Indicador</span>
								<input type="text" class="form-control" aria-label="Sizing example input"
									aria-describedby="inputGroup-sizing-default" id="codigoindicador">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="input-group mb-3">
								<span class="input-group-text" id="inputGroup-sizing-default">Unidad de Medida</span>
								<input type="text" class="form-control" aria-label="Sizing example input"
									aria-describedby="inputGroup-sizing-default" id="unidadmedidaindicador">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="input-group mb-3">
								<span class="input-group-text" id="inputGroup-sizing-default">Valor Indicador</span>
								<input type="text" class="form-control" aria-label="Sizing example input"
									aria-describedby="inputGroup-sizing-default" id="valorindicador">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="input-group mb-3">
								<span class="input-group-text" id="inputGroup-sizing-default">Fecha</span>
								<input type="date" class="form-control" aria-label="Sizing example input"
									aria-describedby="inputGroup-sizing-default" id="fechaindicador">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="input-group mb-3">
								<span class="input-group-text" id="inputGroup-sizing-default">Tiempo</span>
								<input type="text" class="form-control" aria-label="Sizing example input"
									aria-describedby="inputGroup-sizing-default" id="tiempoindicador">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="input-group mb-3">
								<span class="input-group-text" id="inputGroup-sizing-default">Origen</span>
								<input type="text" class="form-control" aria-label="Sizing example input"
									aria-describedby="inputGroup-sizing-default" id="origenindicador">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="btnSave" class="btn btn-dark">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- Modal Edit -->
<div class="modal fade" id="editCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"></h5>
			</div>
			<form id="editIndices">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6">
							<div class="input-group mb-3">
								<span class="input-group-text" id="inputGroup-sizing-default">Nombre Indicador</span>
								<input type="text" class="form-control" aria-label="Sizing example input"
									aria-describedby="inputGroup-sizing-default" id="enombreindicador">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="input-group mb-3">
								<span class="input-group-text" id="inputGroup-sizing-default">Codigo Indicador</span>
								<input type="text" class="form-control" aria-label="Sizing example input"
									aria-describedby="inputGroup-sizing-default" id="ecodigoindicador">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="input-group mb-3">
								<span class="input-group-text" id="inputGroup-sizing-default">Unidad de Medida</span>
								<input type="text" class="form-control" aria-label="Sizing example input"
									aria-describedby="inputGroup-sizing-default" id="eunidadmedidaindicador">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="input-group mb-3">
								<span class="input-group-text" id="inputGroup-sizing-default">Valor Indicador</span>
								<input type="text" class="form-control" aria-label="Sizing example input"
									aria-describedby="inputGroup-sizing-default" id="evalorindicador">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="input-group mb-3">
								<span class="input-group-text" id="inputGroup-sizing-default">Fecha</span>
								<input type="date" class="form-control" aria-label="Sizing example input"
									aria-describedby="inputGroup-sizing-default" id="efechaindicador">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="input-group mb-3">
								<span class="input-group-text" id="inputGroup-sizing-default">Tiempo</span>
								<input type="text" class="form-control" aria-label="Sizing example input"
									aria-describedby="inputGroup-sizing-default" id="etiempoindicador">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="input-group mb-3">
								<span class="input-group-text" id="inputGroup-sizing-default">Origen</span>
								<input type="text" class="form-control" aria-label="Sizing example input"
									aria-describedby="inputGroup-sizing-default" id="eorigenindicador">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="btnSaveEdit" class="btn btn-dark">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal Graphic -->
<div class="modal fade modal-lg" id="graf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content modal-lg">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"></h5>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<p>
							<label>Desde :</label>
							<input type="date" id="startFilter" value="2021-01-01" min="2019-01-01" max="2022-12-30">
						</p>
						<p>
							<label>Hasta :</label>
							<input type="date" id="endFilter" value="2021-01-30" min="2019-01-01" max="2022-12-30">
						</p>

						<canvas id="graphic">

						</canvas>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" id="exit" class="btn btn-dark">Volver</button>
			</div>
		</div>
	</div>
</div>





<?php $this->load->view('footer'); ?>