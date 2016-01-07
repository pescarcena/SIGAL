<div class="modal-header">
    <h3 style="color:#54AF54;" class="modal-title"><span class="glyphicon glyphicon-pencil"></span> Editar Usuario</h3>
</div>
<div class="modal-body">

	<alert ng-repeat="alert in alerts" type="{#alert.type#}" close="closeAlert($index)">{#alert.msg#}</alert>
	
	<center>
		<h3 class="text-title-modal">Usuario</h3>
		<h3><strong class="text-muted">{#data.email#}</strong><h3>
	</center>
	<br>
	
	<div class="row">
		<div class="col-md-4">
			<div class="col-md-7 col-md-offset-4">
				<div class="form-group">
					<label class="text-muted" for="cedula">Cedula</label>
					<input class="form-control" id="cedula" type="text" placeholder="Cedula" ng-model="data.cedula">
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="col-md-10 col-md-offset-1">
				<div class="form-group">
					<label  class="text-muted" for="nombre">Nombre</label>
					<input class="form-control" id="nombre" type="text" placeholder="Nombre" ng-model="data.nombre">
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="col-md-10 col-md-offset-1">
				<div class="form-group">
					<label class="text-muted" for="apellido">Apellido</label>
					<input class="form-control" id="apellido" type="text" placeholder="Apellido" ng-model="data.apellido">
				</div>
			</div>
		</div>
	</div>

	<br>
	
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="col-md-10 col-md-offset-1">
				<label class="text-muted" for="pass">Contraseña</label>
				<input class="form-control" id="pass"type="password" placeholder="Contraseña" ng-model="data.password">
			</div>
		</div>

		<div class="col-md-4">
			<div class="col-md-10 col-md-offset-1">
				<div class="form-group">
					<label class="text-muted" for="rpass">Repetir contraseña</label>
					<input class="form-control" id="rpass" type="password" placeholder="Repetir contraseña" ng-model="data.password_confirmation">	
				</div>
			</div>
		</div>
	</div>


	<br>

	<center><h3 class="text-title-modal">Privilegios</h3></center>
	
	<br>

	<div class="row">
		<div class="col-md-4">
			<div class="col-md-5 col-md-offset-4">
				<h4 class="text-muted">Usuarios</h4>
				<label class="checkbox-inline"><input type="checkbox" ng-click="usuarioActive()" ng-checked="data.pUsuario" ng-model="data.pUsuario">Usuarios</label>

				<div ng-show="data.pUsuario">
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pUsuarioR" ng-model="data.pUsuarioR">Registrar</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pUsuarioM" ng-model="data.pUsuarioM">Editar</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pUsuarioE" ng-model="data.pUsuarioE">Eliminar</label>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="col-md-5 col-md-offset-4">
				<h4 class="text-muted">Proveedores</h4>
				<label class="checkbox-inline"><input type="checkbox" ng-click="provedorActive()" ng-model="data.pProvedor">Proveedores</label>
				<div ng-show="data.pProvedor">
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pProvedorR" ng-model="data.pProvedorR">Registrar</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pProvedorM" ng-model="data.pProvedorM">Editar</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pProvedorE" ng-model="data.pProvedorE">Eliminar</label>
						</div>
					</div>
				</div>
			</div>
		</div>

		
		<div class="col-md-4">
			<div class="col-md-5 col-md-offset-4">
				<h4 class="text-muted">Departamentos</h4>
				<label class="checkbox-inline"><input type="checkbox" ng-click="departamentoActive()" ng-checked="data.pDepartamento" ng-model="data.pDepartamento">Departamentos</label>
				<div ng-show="data.pDepartamento">
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pDepartamentoR" ng-model="data.pDepartamentoR">Registrar</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pDepartamentoM" ng-model="data.pDepartamentoM">Editar</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pDepartamentoE" ng-model="data.pDepartamentoE">Eliminar</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br>
	
	<div class="row">
		<div class="col-md-4">
			<div class="col-md-5 col-md-offset-4">
				<h4 class="text-muted">Insumos</h4>
				<label class="checkbox-inline"><input type="checkbox" ng-click="insumoActive()" ng-checked="data.pInsumo" ng-model="data.pInsumo">Insumos</label>
				<div ng-show="data.pInsumo">
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pInsumoR" ng-model="data.pInsumoR">Registrar</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pInsumoM" ng-model="data.pInsumoM">Editar</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pInsumoE" ng-model="data.pInsumoE">Eliminar</label>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="col-md-5 col-md-offset-4">
				<h4 class="text-muted">Inventario</h4>
				<label class="checkbox-inline"><input type="checkbox" ng-click="inventarioActive()" ng-model="data.pInventario">Inventario</label>
				<div ng-show="data.pInventario">
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pInventarioH" ng-model="data.pInventarioH">Herramientas</label>
						</div>
					</div>
				</div>
			</div>
		</div>

		
		<div class="col-md-4">
			<div class="col-md-5 col-md-offset-4">
				<h4 class="text-muted">Modificaciones</h4>
				<label class="checkbox-inline"><input type="checkbox" ng-model="data.pModificacion">Modificaciones</label>
			</div>
		</div>
	</div>
	
	<br>
	
	<div class="row">
		<div class="col-md-4">
			<div class="col-md-5 col-md-offset-4">
				<h4 class="text-muted">Entradas</h4>
				<label class="checkbox-inline"><input type="checkbox" ng-click="entradaActive()" ng-checked="data.pEntrada" ng-model="data.pEntrada">Entradas</label>
				<div ng-show="data.pEntrada">
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pEntradaR" ng-model="data.pEntradaR">Registrar</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pEntradaV" ng-model="data.pEntradaV">Auditar</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="col-md-5 col-md-offset-4">
				<h4 class="text-muted">Salidas</h4>
				<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pSalida" ng-click="salidaActive()" ng-model="data.pSalida">Salidas</label>
				<div ng-show="data.pSalida">
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pSalidaR" ng-model="data.pSalidaR">Registrar</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pSalidaV" ng-model="data.pSalidaV">Auditar</label>
						</div>
					</div>
				</div>
			</div>	
		</div>

		<div class="col-md-4">
			<div class="col-md-5 col-md-offset-4">
				<h4 class="text-muted">Estadisticas</h4>
				<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pEstadistica" ng-model="data.pEstadistica">Estadisticas</label>
			</div>
		</div>
	</div>

	<br>

	<div class="row">
		<div class="col-md-4">
			<div class="col-md-5 col-md-offset-4">
				<h4 class="text-muted">Depositos</h4>
				<label class="checkbox-inline"><input type="checkbox" ng-click="depositoActive()" ng-model="data.pDeposito">Depositos</label>
				<div ng-show="data.pDeposito">
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pDepositoR" ng-model="data.pDepositoR">Registrar</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pDepositoM" ng-model="data.pDepositoM">Editar</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<label class="checkbox-inline"><input type="checkbox" ng-checked="data.pDepositoE" ng-model="data.pDepositoE">Eliminar</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<br>
</div>
<div class="modal-footer">
     <button class="btn btn-success" ng-show="btnVisivilidad" ng-click="modificar()"><span class="glyphicon glyphicon-ok-sign"></span> Modificar</button>
    <button class="btn btn-warning" ng-show="btnVisivilidad" ng-click="cancelar()"><span class="glyphicon glyphicon-remove-sign"></span> Cancelar</button>
    <button class="btn btn-success" ng-hide="btnVisivilidad" ng-click="cancelar()"><span class="glyphicon glyphicon-ok-sign"></span> Ok</button>
</div>