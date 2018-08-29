<!-- layout.jsp -->
<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage" lang="en" dir="ltr">
	<head>
		@include('common.header')
	</head>
	<body>

	<body>

	<div ng-app="MainApp" ng-cloak class="ng-cloak">
		<div ng-controller="MainAppController" class="homely-welcome-top-background">
			@include('common.navbar')
			@yield('content')
			<div ng-view ></div>
			@include('common.footer')
		</div>
	</div>

	@include('common.script')
	@stack('script')

	</body>
</html>