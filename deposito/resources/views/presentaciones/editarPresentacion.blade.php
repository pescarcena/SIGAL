<div class="modal-header">
    <h3 style="color:#54AF54;" class="modal-title"><span class="glyphicon glyphicon-pencil"></span> Editar Presentación</h3>
</div>
<div class="modal-body">

	<alert ng-repeat="alert in alerts" type="{#alert.type#}" close="closeAlert($index)">{#alert.msg#}</alert>
	
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<input class="form-control" type="text" placeholder="Nombre" ng-model="nombre">
		</div>
	</div>
</div>
<div class="modal-footer">
	<button class="btn btn-success" ng-show="btnVisivilidad" ng-click="modificar()"><span class="glyphicon glyphicon-ok-sign"></span> modificar</button>
    <button class="btn btn-warning" ng-show="btnVisivilidad" ng-click="cancelar()"><span class="glyphicon glyphicon-remove-sign"></span> Cancelar</button>
    <button class="btn btn-success" ng-hide="btnVisivilidad" ng-click="cancelar()"><span class="glyphicon glyphicon-ok-sign"></span> Ok</button>
</div>