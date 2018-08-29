			

<div ng-controller="GalleryController" ng-init="getSlides()" class="ng-scope">
	<div uib-carousel active="active" interval="myInterval" no-wrap="noWrapSlides">
		<div uib-slide ng-repeat="slide in slides track by slide.id" index="slide.id">
			<img ng-src="@{{slide.image}}" style="margin: auto; " class="img-fluid rounded">
			<div class="carousel-caption">
<!--  					<h4>Slide @{{slide.id}}</h4> -->
				<p>@{{slide.text}}</p>
			</div>
		</div>
	</div>
	<div class="row">
		<!-- just for testing css -->
		<div class="col-12 col-md-6">
			<div class="homely-img-card mb-4">
				<img src="resources\img\property\view1.png" alt="sample image">
			</div>
		</div>
		<div class="col-12 col-md-6">
			<div class="homely-img-card mb-4">
				<img src="resources\img\property\view2.png" alt="sample image">
			</div>
		</div>
		<div class="col-12 col-md-6">
			<div class="homely-img-card mb-4">
				<img src="resources\img\property\view3.png" alt="sample image">
			</div>
		</div>
		<div class="col-12 col-md-6">
			<div class="homely-img-card mb-4">
				<img src="resources\img\property\view4.png" alt="sample image">
			</div>
		</div>
		<!-- just for testing css -->

		<div class="col-12 col-md-6" ng-repeat="slide in slides track by slide.id">
			<div class="homely-img-card mb-4">
				<img ng-src="@{{slide.image}}" alt="@{{slide.text}}">
			</div>
		</div>
	</div>
</div>