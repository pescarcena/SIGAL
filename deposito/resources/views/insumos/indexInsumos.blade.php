@extends('panel')
@section('bodytag', 'ng-controller="insumosController"')
@section('addscript')
<script src="{{asset('js/insumosController.js')}}"></script>
@endsection

@section('front-page')
	
	<h5 class="text-muted">
		<span class="glyphicon glyphicon-cog"></span> Administración > 
		<span class="glyphicon glyphicon-th"></span> Insumos
	</h5>
	<br>
			
	<button class="btn btn-success" ng-click="registrarInsumo()"><span class="glyphicon glyphicon-plus"></span> Nuevo Insumo</button>
	<br>
	<br>
	<br>

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="input-group">
		  		<span class="input-group-addon btn-success text-white"><span class="glyphicon glyphicon-search"></span></span>
		  		<input type="text" class="form-control" ng-model="busqueda">
			</div>
		</div>
	</div>

	<br>
	<br>

	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Presentacion</th>
				<th>Codigo</th>
				<th>Descripcion</th>
				<th>Deposito</th>
				<th>Ubicacion</th>
				<th colspan="2" class="table-edit">Editar</th>
			</tr>
		</thead>
		<tbody>
			<tr dir-paginate="insumo in insumos | filter:busqueda | itemsPerPage:5">
				<td><img src="files/insumos/{#insumo.imagen#}" class="img-thumbnail"  width="100" height="236"></td>
				<td>{#insumo.codigo#}</td>
				<td>{#insumo.descripcion#}</td>
				<td>{#insumo.deposito#}</td>
				<td>{#insumo.ubicacion#}</td>
				<td class="table-edit"><button class="btn btn-warning" ng-click="editarInsumo(insumo.id)"><span class="glyphicon glyphicon-pencil"></span> Editar</button></td>
				<td class="table-edit"><button class="btn btn-danger"  ng-click="elimInsumo(insumo.id)"><span class="glyphicon glyphicon-remove"></span> Eliminar</button></td>
			</tr>
		</tbody>
	</table>

	<div>
      <div class="text-center">
     	 <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="{{asset('/template/dirPagination.tpl.html')}}"></dir-pagination-controls>
      </div>
    </div>


@endsection
