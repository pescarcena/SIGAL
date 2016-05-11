@extends('panel')
@section('bodytag', 'ng-controller="inventarioController"')
@section('front-page')

	<div data-loading class="div_loader">
		<div id="img_loader" class="img_loader">
			<img src="{{asset('imagen/loader.gif')}}" alt="">
			<p> Cargando ...</p>
		</div>
	</div>

	<nav class="nav-ubication">
		<ul class="nav-enlaces">
			<li><span class="glyphicon glyphicon-th-list"></span> Inventario</li>
			<li class="nav-active"><span class="glyphicon glyphicon-equalizer"></span> Existencia</a></li>
		</ul>
	</nav>

	<br>
	<br>

	@if(Auth::user()->haspermission('inventarioH'))
		<div class="row">
			<div class="col-md-2" ng-hide="status">
				<div class="input-group-btn">
					<button class="btn btn-success dropdown-toggle" data-toggle="dropdown">
					<span class="glyphicon glyphicon-indent-right"></span> Reportes <span class="caret"></span></button>

					<ul class="dropdown-menu" role="menu">
						<li ng-click="parcialInventario()"><a href="#">Parcial</a></li>
						<li><a href="{{route('reporInv')}}?filter" target="_blank">Total Existente</a></li>
			          	<li><a href="{{route('reporInv')}}" target="_blank">Total Inventariado</a></li>
					</ul>
				</div>
			</div>

			<div class="col-md-4" ng-show="status">
				<button ng-class="thereIsSelect() ? 'active':'disabled'" ng-click="gerenarParcial()"class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span></button>
				<button ng-click="closeSelect()" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
			</div>
		</div>

		<br>
	@endif

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="input-group">
		  		<span class="input-group-addon btn-success text-white"><span class="glyphicon glyphicon-search"></span></span>
		  		<input type="text" class="form-control" ng-model="busqueda">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-1">
    		<label for="cantidad">Registros</label>
			<select id="cantidad" class="form-control" ng-model="cRegistro">
				<option value="5">5</option>
				<option value="10">10</option>
				<option value="20">20</option>
			</select>
		</div>
	</div>

	<br>
	<br>

	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th ng-show="status"class="col-md-1">
					<label class="checkbox-inline">
					<input type="checkbox" ng-checked="all" ng-model="all" ng-click="select()">
					Todos</label>
				</th>
				<th class="col-md-2">Codigo</th>
				<th>Descripción</th>
				<th class="col-md-1">Exist.</th>
				<th class="col-md-1">Kardex</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-click="selectInsumo(insumos.indexOf(insumo))" ng-class="insumo.color" dir-paginate="insumo in insumos | filter:busqueda | itemsPerPage:cRegistro">
				<td ng-show="status">
					<input type="checkbox" ng-checked="insumo.select">
				</td>
				<td>{#insumo.codigo#}</td>
				<td>{#insumo.descripcion#}</td>
				<td>{#insumo.existencia#}</td>
				<td><a class="btn btn-warning btn-sm" href="/inventario/kardex?insumo={#insumo.id#}&dateI={#dateI#}&dateF={#dateF#}">
					<span class="glyphicon glyphicon-eye-open"></span></a>
				</td>
			</tr>
		</tbody>
	</table>

	<div>
      <div class="text-center">
     	 <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="{{asset('/template/dirPagination.tpl.html')}}"></dir-pagination-controls>
      </div>
    </div>

@endsection
