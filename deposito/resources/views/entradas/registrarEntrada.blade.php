@extends('panel')
@section('bodytag', 'ng-controller="registroEntradaController"')
@section('addscript')
<script src="{{asset('js/registroEntradaController.js')}}"></script>
@endsection

@section('front-page')

	<h5 class="text-muted">
		<span class="glyphicon glyphicon-transfer"></span> Tranferencias > 
		<span class="glyphicon glyphicon-circle-arrow-down"></span> Registro de Entrada
	</h5>

	<center>
		<h3 class="text-title-modal">Registro de Pro-Forma de entrada</h3>
	</center>
	
	<br>

	<alert ng-show="alert.type" type="{#alert.type#}" close="closeAlert()">{#alert.msg#}</alert>
	
	<ul class="nav nav-tabs">
		<li class="active" ng-click="restablecer()"><a data-toggle="tab" class="text-enlace" href="#orden">Orden</a></li>
		<li ng-click="restablecer()"><a data-toggle="tab" class="text-enlace" href="#donacion">Donacion</a></li>
	</ul>
	
	{{--Panel de registro de ordenes de compra--}}
	<div class="tab-content">
		<div id="orden" class="tab-pane fade in active">
			
			<br>

			<div class="row">
				<div class="col-md-2">
					<input class="form-control text-center" type="text" placeholder="N° Orden" ng-model="orden">
				</div>

				<div class="form-group col-md-3 text-title-modal">
						<select class="form-control" id="provedor" ng-model="provedor">
							<option value="" selected disabled>Proveedor</option>
							<option value="{#provedore.id#}" ng-repeat="provedore in provedores">{#provedore.nombre#}</option>
						</select>
				</div>
			</div>

			<br>

			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="input-group">

			      			<ui-select ng-model="insumoSelect.selected"
						             ng-disabled="disabled"
						             reset-search-input="true">
						    <ui-select-match placeholder="Ingrese descripción o codigo de un insumo">
						    {#$select.selected.descripcion#}</ui-select-match>
						    <ui-select-choices repeat="insumo in listInsumos track by $index"
						             refresh="refreshInsumos($select.search)"
						             refresh-delay="0">
						      <div ng-bind-html="insumo.descripcion | highlight: $select.search"></div>
						       <small ng-bind-html="insumo.codigo"></small>
						    </ui-select-choices>
						    </ui-select>

						<div class="input-group-btn">
						    <button class="btn btn-success" ng-click="agregarInsumos()"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button>
						</div>
					</div>
				</div>
			</div>

			<br>
			
			<div ng-show="thereInsumos()" >
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Codigo</th>
							<th>Descripción</th>
							<th>Cantidad</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="insumo in insumos">
							<td class="col-md-2">{#insumo.codigo#}</td>
							<td>{#insumo.descripcion#}</td>
							<td class="col-md-2">
								<input class="form-control text-center" type="number" ng-model="insumo.cantidad">
							</td>
							<td class="col-md-1">
								<button class="btn btn-danger" ng-click="eliminarInsumo(insumos.indexOf(insumo))"><span class="glyphicon glyphicon-remove"></span>
								</button>
							</td>
						</tr>
					</tbody>
				</table>

				<br>

				<center>
					<button class="btn btn-success" ng-click="registrar('orden')"><span class="glyphicon glyphicon-ok-sign"></span> Registar</button>
				</center>
			</div>
		</div>
		
	    {{--Panel de registro de donaciones--}}
		<div id="donacion" class="tab-pane fade">

			<br>

			<div class="row">
				<div class="form-group col-md-3 text-title-modal">
						<select class="form-control" id="provedor" ng-model="provedor">
							<option value="" selected disabled>Proveedor</option>
							<option value="{#provedore.id#}" ng-repeat="provedore in provedores">{#provedore.nombre#}</option>
						</select>
				</div>
			</div>

			<br>

			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="input-group">

			      			<ui-select ng-model="insumoSelect.selected"
						             ng-disabled="disabled"
						             reset-search-input="true">
						    <ui-select-match placeholder="Ingrese descripción o codigo de un insumo">
						    {#$select.selected.descripcion#}</ui-select-match>
						    <ui-select-choices repeat="insumo in listInsumos track by $index"
						             refresh="refreshInsumos($select.search)"
						             refresh-delay="0">
						      <div ng-bind-html="insumo.descripcion | highlight: $select.search"></div>
						       <small ng-bind-html="insumo.codigo"></small>
						    </ui-select-choices>
						    </ui-select>

						<div class="input-group-btn">
						    <button class="btn btn-success" ng-click="agregarInsumos()"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</button>
						</div>
					</div>
				</div>
			</div>

			<br>
			
			<div ng-show="thereInsumos(insumosDon)" >
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Codigo</th>
							<th>Descripción</th>
							<th>Cantidad</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="insumo in insumos">
							<td class="col-md-2">{#insumo.codigo#}</td>
							<td>{#insumo.descripcion#}</td>
							<td class="col-md-2">
								<input class="form-control text-center" type="number" ng-model="insumo.cantidad">
							</td>
							<td class="col-md-1">
								<button class="btn btn-danger" ng-click="eliminarInsumo(insumos.indexOf(insumo))"><span class="glyphicon glyphicon-remove"></span>
								</button>
							</td>
						</tr>
					</tbody>
				</table>

				<br>

				<center>
					<button class="btn btn-success" ng-click="registrar('donacion')"><span class="glyphicon glyphicon-ok-sign"></span> Registar</button>
				</center>
			</div>
			
		</div>
	
	</div>

	<script type="text/ng-template" id="successRegister.html">
        <div class="modal-header">
            <h3 class="modal-title text-title-modal">{#response.menssage#}</h3>
        </div>
        <div class="modal-body">
        	<center>
        		<h3>Codigo unico de la Entrada</h3>
        		<h2><mark>{#response.codigo#}</mark></h2>
        	</center>
        </div>
        <div class="modal-footer">
        	<center>
            	<button class="btn btn-success" type="button" ng-click="ok()"><span class="glyphicon glyphicon-ok-sign">
            	</span> OK</button>
           	</center>
        </div>
    </script>

@endsection
