<div ng-controller="RegisterLoginController" class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-sm-10 col-md-8 col-lg-6 center-text">
			<form name="loginForm" ng-submit="authenticate()" novalidate>
				<div class="card shadow homely-card z-index-1050">
					<div class="homely-card-header">
						<h4 class="text-center text-black bold">@{{'sign.in.header' | translate}}</h4>
						<div class="col-6 offset-3">
							<img src="resources/img/home.png" class="img-fluid">
							<div class="spacer-3"></div>
						</div>
					</div>
					<div class="homely-card-body">

						<div class="form-group">
							<label class="homely-form-label" for="InputEmail">@{{'sign.in.email.label' | translate}}</label>
							<input required type="email" id="InputEmail" 
								ng-model="loginData.email" 
								class="homely-input" 
								aria-describedby="emailHelp" 
								placeholder="@{{'sign.in.email.placeholder' | translate}}">
							<!-- 							<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
						</div>
						<div class="spacer-1"></div>
						<div class="form-group no-decoration">
							<label class="homely-form-label" for="InputPassword">@{{'sign.in.password.label' | translate}}</label>
							<button type="button" class="btn btn-link float-right text-orange bold no-padding" ng-click="navigate('/recover-password')">@{{'sign.in.password.recover' | translate}}</button>
							<input required type="password" id="InputPassword" 
								ng-model="loginData.password" 
								class="homely-input" 
								placeholder="@{{'sign.in.password.placeholder' | translate}}">
						</div>
						<!-- 						<div class="form-check"> -->
						<!-- 							<input type="checkbox" class="form-check-input" id="RememberMeCheck"> -->
						<!-- 							<label class="form-check-label" for="RememberMeCheck">@{{'sign.in.remember.me' | translate}}</label> -->
						<!-- 						</div> -->

					</div>
					<div class="card-footer homely-card-footer no-decoration">
						<button ng-disabled="loginForm.$invalid" type="submit" class="homely-btn homely-btn-secondary">@{{'sign.in.sign.in' | translate}}</button>
						<button type="button" class="btn btn-link float-right gray-color bold" ng-click="navigate('/register')">@{{'sign.in.go.register' | translate}}</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal-background" ng-click="navigate('/')"></div>