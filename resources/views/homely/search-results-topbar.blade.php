<div class="container-fluid">
	<div class="row">
		<div class="col">
			<h4>@{{'search.results.title' | translate}}</h4>
		</div>
		<div class="col">
			<form name="loginForm" ng-submit="searchPropertiesQuick()" novalidate>
				<div class="input-group">
					<input name="email" ng-model="search.searchString" class="form-control" placeholder="@{{'welcome.search.placeholder' | translate}}">
					<div class="input-group-append">
						<button class="btn btn-outline-primary" type="submit">@{{'welcome.search.button' | translate}}</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>