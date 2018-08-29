<div ng-controller="RegisterLoginController" class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-sm-10 col-md-8 col-lg-6 center-text">
			<form name="loginForm" ng-submit="registerProfile()" novalidate>
				<div class="card shadow homely-card z-index-1050">
					<div class="homely-card-header">
						<h4 class="text-center text-black bold">@{{'sign.up.header' | translate}}</h4>
						<div class="col-6 offset-3">
							<img src="resources/img/home.png" class="img-fluid">
							<div class="spacer-3"></div>
						</div>
					</div>
					<div class="homely-card-body">
					
						<!-- <div class="form-group">
							<label>@{{'sign.up.profile.type.label' | translate}}</label>
							<select required name="profileType" class="form-control" 
								ng-class="{ 'is-invalid' : loginForm.profileType.$invalid }"
								ng-model="newProfile.profileType" 
								ng-options="profileType as 'sign.up.profile.type.'+profileType|translate for profileType in profileTypes">
							</select> 
						</div>
					 -->
						<div hidden="true">
							<input required name="profileType" ng-model="newProfile.profileType">
						</div>
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label class="homely-form-label">@{{'sign.up.profile.type.label' | translate}}</label>
								    <div class="homely-select-box">
									    <select class="homely-select" 
									    	ng-class="{ 'homely-select-danger' : loginForm.profileType.$invalid }"
									    	ng-model="newProfile.profileType">
									    	<option ng-repeat="profileType in profileTypes">
										    	@{{'sign.up.profile.type.' + profileType | translate}}
									    	</option>
								    	</select>					        
								    </div>
							    </div>
						    </div>
					    </div>
					    <div class="spacer-3"></div>
					    <div class="row">
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label class="homely-form-label">@{{'sign.up.email.label' | translate}}</label>
									<input required type="email" autocomplete="no" name="email"
										ng-model="newProfile.email" 	
										class="homely-input"  
										ng-class="{ 'is-invalid' : loginForm.email.$invalid}"
										ng-change="checkEmail(loginForm.email)"
										placeholder="@{{'sign.up.email.placeholder' | translate}}">
									<small ng-show="loginForm.email.$error.email || loginForm.email.$error.required" class="form-text text-muted">@{{'sign.up.email.error' | translate}}</small>
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label class="homely-form-label">@{{'sign.up.display.name.label' | translate}}</label>
									<input required type="text" name="displayName" 
										ng-model="newProfile.displayName" autocomplete="no"
										class="homely-input"
										ng-class="{ 'is-invalid' : loginForm.displayName.$invalid}"
										placeholder="@{{'sign.up.display.name.placeholder' | translate}}"
										>
									<small ng-show="loginForm.displayName.$error.required" class="form-text text-muted">@{{'sign.up.display.name.error' | translate}}</small>
								</div>
							</div>
						</div>
						<div class="spacer-2"></div>
					    <div class="row">
							<div class="col-12 col-sm-6">
								<div class="form-group" >
									<label class="homely-form-label">@{{'sign.up.password.label' | translate}}</label>
									<input required name="password" type="password" 
										ng-model="newProfile.password" 
										class="homely-input"
										ng-class="{ 'is-invalid' : loginForm.password.$invalid }"
										placeholder="@{{'sign.up.password.placeholder' | translate}}" 
										ng-pattern="passwordRegex" >
									<small ng-show="loginForm.password.$invalid" class="form-text text-muted">@{{'system.password.help' | translate}}</small>
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="form-group" ng-class="{ 'has-error' : loginForm.password2.$invalid && !loginForm.password2.$pristine }">
									<label class="homely-form-label">@{{'sign.up.password.repeat.label' | translate}}</label>
									<input required name="password2" type="password"
										compare-to="newProfile.password"  
										ng-model="newProfile.password2" 
										class="homely-input" 
										ng-class="{ 'is-invalid' : loginForm.password2.$invalid }"
										placeholder="@{{'sign.up.password.repeat.placeholder' | translate}}">
									<small ng-show="loginForm.password2.$invalid" class="form-text text-muted">@{{'sign.up.password.repeat.error' | translate}}</small>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer homely-card-footer no-decoration">
						<button ng-disabled="loginForm.$invalid" type="submit" class="homely-btn homely-btn-secondary">@{{'sign.up.sign.up' | translate}}</button>
						<button type="button" class="btn btn-link float-right gray-color bold" ng-click="navigate('/login')">@{{'sign.up.sign.in' | translate}}</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal-background" ng-click="navigate('/')"></div>