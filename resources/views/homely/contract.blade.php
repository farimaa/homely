@extends('layout.master')
@section('content')

<div class="container">
	<div class="row text-center">
		<div class="col-lg-2 offset-lg-5 col-sm-4 offset-sm-4">
			<img src="resources/img/home.png" class="img-fluid">
			<div class="spacer-2"></div>
			<h1 class="bold">
				contract
			</h1>
			<div class="spacer-4"></div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<div class="card shadow p-5">
				<div class="row">
					<div class="col">
						<h2 class="bold">
							Residental Tenancy Agreement
						</h2>
						<div class="spacer-2"></div>
						<p>
							Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text
							Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text
						</p>
						<div class="spacer-2"></div>
						<b>
							Sample Text Sample Text Sample Text Sample text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text
						</b>
						<div class="spacer-2"></div>
						<p>
							Sample Text Sample Text Sample Text Sample Text Sample Text
						</p>
						<div class="spacer-2"></div>
						<b>
						Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text 
						</b>
						<div class="spacer-2"></div>
						<p>
					<
						Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text 
						</p> 
						<div class="spacer-2"></div>
						<p class="text-orange bold">
						The property
						</p>
					</div>
				</div>
				<div class="spacer-2"></div>
			    <div class="row">
					<div class="col-12 col-sm-6">
						<div class="form-group">
							<label class="homely-form-label">Location</label>
							<input required type="text" autocomplete="no" name="email"
								class="homely-input"  
								ng-class="{ 'is-invalid' : loginForm.email.$invalid}"
								placeholder="Specify location">
						</div>
					</div>
					<div class="col-12 col-sm-6">
						<div class="form-group">
							<label class="homely-form-label">city</label>
							<input required type="text" name="displayName" 
								class="homely-input"
								placeholder="Specify city"
								>
						</div>
					</div>
				</div>
				<div class="spacer-2"></div>
				<div class="row">
					<div class="col">
						<div class="form-group form-check">
						    <label class="form-check-label bold">
						      	<input class="form-check-input" type="radio"> A FLAT
						    </label>
					  	</div>
					  	<div class="form-group form-check">
						    <label class="form-check-label bold">
						      	<input class="form-check-input" type="radio"> A SEPERATE ROOM
						    </label>
					  	</div>
					  	<div class="form-group form-check">
						    <label class="form-check-label bold">
						      	<input class="form-check-input" type="radio"> AN OWNER
						    </label>
					  	</div>
					</div>
				</div>
				<div class="spacer-3"></div>
				    <div class="row">
				    	<div class="col-12">
				    		<p class="text-orange bold">
				    			Landlourd
				    		</p>
				    	</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label class="homely-form-label">Landlourd name</label>
								<input required type="text" autocomplete="no" name="email"
									class="homely-input"  
									ng-class="{ 'is-invalid' : loginForm.email.$invalid}"
									placeholder="Specify first and last name">
							</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label class="homely-form-label">landlourd address</label>
								<input required type="text" name="displayName" 
									class="homely-input"
									placeholder="Specify street name, number and city "
									>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6">
							<div class="form-group">
								<label class="homely-form-label">VAT REGISTRATION NUMBER</label>
								<input required type="text" autocomplete="no" name="email"
									class="homely-input"  
									ng-class="{ 'is-invalid' : loginForm.email.$invalid}"
									placeholder="Specify VAT #">
							</div>
						</div>
				
					<div class="spacer-3"></div>
				    <div class="row">
				    	<div class="col-12">
				    		<p class="text-orange bold">
				    			Tenant
				    		</p>
				    	</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label class="homely-form-label">TENANT NAME</label>
								<input required type="text" autocomplete="no" name="email"
									class="homely-input"  
									ng-class="{ 'is-invalid' : loginForm.email.$invalid}"
									placeholder="Specify first and last name">
							</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label class="homely-form-label">TENANT ADDRESS</label>
								<input required type="text" name="displayName" 
									class="homely-input"
									placeholder="Specify street name, number and city "
									>
							</div>
						</div>
					</div>
						<div class="spacer-3"></div>
				    <div class="row">
				    	<div class="col-12">
				    		<p class="text-orange bold">
				    			Area of Property
				    		</p>

				    	</div>
				    	<div class="col-12">
				    	<p>
				    		simple text simple text simple text simple text simple text simple text simple text
				    	</p> 
				    	</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label class="homely-form-label">TOTAL GROSS FLOOR FOOTAGE(IN SQUARE MWTWRS</label>
								<input required type="text" autocomplete="no" name="email"
									class="homely-input"  
									ng-class="{ 'is-invalid' : loginForm.email.$invalid}"
									placeholder="Specify size in square meters">
							</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label class="homely-form-label">NO.OF ROOMS</label>
								<input required type="text" name="displayName" 
									class="homely-input"
									placeholder="Specify number of rooms "
									>
							</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label class="homely-form-label">BUSINESS PREMISES TOTAL GROSS FLOOR FOOTAGE</label>
								<input required type="text" autocomplete="no" name="email"
									class="homely-input"  
									ng-class="{ 'is-invalid' : loginForm.email.$invalid}"
									placeholder="Specify size in square meters">
							</div>
						</div>
						<div class="spacer-3"></div>
						<div class="row">
						<div class="col-12">
						<p class="text-orange bold">
							Right of use
						</p>
						<p>
							 simple text  simple text  simple text  simple text  simple text  simple text  simple text  simple text
						</p>
											 <form action="/action_page.php">
							<div class="form-check-inline">
							<label class="form-check-label" for="check1">
							<input type="checkbox" class="form-check-input" id="check1" name="vehicle1" value="something" checked>SHARED LUNADRETTE
							</label>
							</div>
							<div class="form-check-inline">
							<label class="form-check-label" for="check2">
							<input type="checkbox" class="form-check-input" id="check2" name="vehicle2" value="something">ATTIC/BASEMENT
							</label>
							</div>
							<div class="form-check-inline">
							<label class="form-check-label">
							<input type="checkbox" class="form-check-input" disabled>GARAGE
							</label>
							</div>
							<div class="form-check-inline">
							<label class="form-check-label" for="check2">
							<input type="checkbox" class="form-check-input" id="check2" name="vehicle2" value="something">SHARED YARD
							</label>
							</div>
							<div class="form-check-inline">
							<label class="form-check-label" for="check2">
							<input type="checkbox" class="form-check-input" id="check2" name="vehicle2" value="something">BICYCLE PARKING
							</label>
							</div>
							<div class="form-check-inline">
							<label class="form-check-label" for="check2">
							<input type="checkbox" class="form-check-input" id="check2" name="vehicle2" value="something">OTHER
							</label>
							</div>
							<div class="spacer-3"></div>
						<div class="row">
						<div class="col-12">
						<p class="text-orange bold">
							USe
						</p>
						<p>
							 simple text  simple text  simple text  simple text  simple text  simple text  simple text  simple text
						</p>
						<div class="spacer-3"></div>
						<div class="row">
						<div class="col-12">
						<p class="text-orange bold">
							Possession of Peroperty
						</p>
						<p>
							 Is the property refurbished at the commencement of the tenancy?(PLease tick approrriate answer)
						</p>
						<div class="form-check-inline">
							<label class="form-check-label" for="check2">
							<input type="checkbox" class="form-check-input" id="check2" name="vehicle2" value="something">YES
							</label>
							</div>
							<div class="form-check-inline">
							<label class="form-check-label" for="check2">
							<input type="checkbox" class="form-check-input" id="check2" name="vehicle2" value="something">NO
							</label>
							</div>
							<div class="spacer-3"></div>
							<p>
								Has it been agreed that the property shall also be refurbished when returned at the termination of the tenancy?(Please tick appropriate answer)
							</p>
							<div class="spacer-2"></div>
				<div class="row">
					<div class="col">
						<div class="form-group form-check">
						    <label class="form-check-label bold">
						      	<input class="form-check-input" type="radio">YES
						    </label>
					  	</div>
					  	<div class="form-group form-check">
						    <label class="form-check-label bold">
						      	<input class="form-check-input" type="radio"> NO
						    </label>
					  	</div>
					  	<div class="spacer-3"></div>
						<div class="row">
						<div class="col-12">
						<p class="text-orange bold">
							Inspection
						</p>
						<p>
							 At the  date of possession by the property shall be inspected by landlord and tenant , following which a report will be drawn up, stating the condition of the property at the commencement of the  tenancy?(Please tick appropriate answer)
						</p>
						 <form action="/action_page.php">
							<div class="form-check-inline">
							<label class="form-check-label" for="check1">
							<input type="checkbox" class="form-check-input" id="check1" name="vehicle1" value="something" checked>YES
							</label>
							</div>
							<div class="form-check-inline">
							<label class="form-check-label" for="check2">
							<input type="checkbox" class="form-check-input" id="check2" name="vehicle2" value="something">NO
							</label>
							</div>
												
						</div> 
						</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
<div>

@endsection