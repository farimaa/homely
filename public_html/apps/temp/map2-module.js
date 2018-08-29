MainApp.service('Map', function($q, $http) {
    this.map = null;
    this.loadListDelayTime = 500; // ms
    this.mapBounds = {leftBottom: {lat: 0, lng: 0}, rightTop: {lat: 0, lng: 0}};
    this.sampleServerMarkers =
        [{"id":1,"title":"Homely house","lat":55.6669028,"lng":12.5333439},{"id":2,"title":"Homely house","lat":55,"lng":12},{"id":3,"title":"Homely house","lat":55,"lng":12},{"id":4,"title":"Homely house","lat":55,"lng":12},{"id":5,"title":"Homely house","lat":55,"lng":12},{"id":6,"title":"Homely house","lat":55,"lng":12},{"id":7,"title":"Homely house","lat":55,"lng":12},{"id":8,"title":"Homely house","lat":55,"lng":12},{"id":9,"title":"Homely house","lat":55,"lng":12},{"id":10,"title":"Homely house","lat":55,"lng":12},{"id":11,"title":"Homely house","lat":55,"lng":12},{"id":12,"title":"Homely house","lat":55,"lng":12},{"id":13,"title":"Homely house","lat":55,"lng":12},{"id":14,"title":"Homely house","lat":55,"lng":12},{"id":15,"title":"Homely house","lat":55,"lng":12},{"id":16,"title":"Homely house","lat":55,"lng":12},{"id":17,"title":"Homely house","lat":55,"lng":12},{"id":18,"title":"Homely house","lat":55,"lng":12},{"id":19,"title":"Homely house","lat":55,"lng":12},{"id":20,"title":"Homely house","lat":55,"lng":12},{"id":21,"title":"Homely house","lat":55,"lng":12},{"id":22,"title":"Homely house","lat":55.678904,"lng":12.536054},{"id":23,"title":"Homely house","lat":55.679462,"lng":12.515458},{"id":24,"title":"Homely house","lat":55.670759,"lng":12.52406},{"id":25,"title":"Homely house","lat":55.659772,"lng":12.530535},{"id":26,"title":"Homely house","lat":55.694368,"lng":12.507575},{"id":27,"title":"Homely house","lat":55.695862,"lng":12.538862},{"id":28,"title":"Homely house","lat":55.65785,"lng":12.523982},{"id":29,"title":"Homely house","lat":55.63891,"lng":12.539548},{"id":30,"title":"Homely house","lat":55.656461,"lng":12.510026},{"id":31,"title":"Homely house","lat":55.680481,"lng":12.550552},{"id":32,"title":"Homely house","lat":55.691497,"lng":12.509369},{"id":33,"title":"Homely house","lat":55.679164,"lng":12.545874},{"id":34,"title":"Homely house","lat":55.682835,"lng":12.560468},{"id":35,"title":"Homely house","lat":55.638687,"lng":12.528067},{"id":36,"title":"Homely house","lat":55.64986,"lng":12.511158},{"id":37,"title":"Homely house","lat":55.639081,"lng":12.527659},{"id":38,"title":"Homely house","lat":55.648415,"lng":12.544331},{"id":39,"title":"Homely house","lat":55.639455,"lng":12.511828},{"id":40,"title":"Homely house","lat":55.674431,"lng":12.557886},{"id":41,"title":"Homely house","lat":55.676319,"lng":12.546053}];  
    this.markerClusterOptions = {
        gridSize: 50,
        maxZoom: 18,
        zoomOnClick: true,
        ignoreHidden: true,
    };
    this.mapOptions = {
        center: new google.maps.LatLng(55.6669028, 12.5333439),
        zoom: 11,
        disableDefaultUI: true,
        mapTypeControl: false,
        navigationControl: false,
        mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    };
    this.markers = [];

    this.init = function() {
        this.map = new google.maps.Map(
            document.getElementById("map"), this.mapOptions
        );
    }

    this.initCheckBounds = function () {
        globalthis = this;
        this.map.addListener('bounds_changed', function () {
            globalthis.loadListTrigger();
        });
    }
    
    this.loadListTrigger = function() {
    	// we should be sure to dont send ajax alot at any changes
        clearTimeout(this.loadListDelay);
        globalthis = this;
        this.loadListDelay = setTimeout(function () {
            globalthis.loadList();
        }, this.loadListDelayTime);
    }

    this.loadList = function() {
        this.updateMapBoundries();
        console.log('map boundries changed and sent to server to get new items for show in house listing sidebar!');
        $http({
			method: 'POST',
			url: '/api/v1/property/boundries',
			data: this.mapBounds,
		}).then(function successCallback(response) {

		}, function errorCallback(error) {

		});
    }

	this.updateMapBoundries = function () {
        var bounds = this.map.getBounds();
        this.mapBounds.leftBottom = {lat: bounds.f.b, lng: bounds.b.b};
        this.mapBounds.rightTop = {lat: bounds.f.f, lng: bounds.b.f};
    }

    this.addMarker = function(property) {
        var marker = new google.maps.Marker({
            map: this.map,
            position: property,
            icon: "/images/marker" + ( property.id % 2 ) + ".png",
            id: property.id,
            title: property.title,
            animation: google.maps.Animation.DROP
        });
        this.map.setCenter(property);
        var infowindow = new google.maps.InfoWindow({
          content:"<h4> " + marker.id + " - " + marker.title + " </h4> <h5> price: 400,000 USD </h5> "
        });
        globalThis = this;
        google.maps.event.addListener(marker,'click',function() {
            marker.setIcon({
                url: "/images/marker2.png",
            });

            this.map.setZoom(15);
            this.map.setCenter(marker.getPosition());
            infowindow.open(globalThis.map, marker);

            $http({
                method: 'GET',
                url: '/api/v1/property/information/' + marker.id,
            }).then(function successCallback(response) {
                console.log('get information about property with id: ' + marker.id);
                console.log(response.data);
            }, function errorCallback(error) {
                console.log('get information about property with id: ' + marker.id);
                console.log(error);
            });
        });

        return marker;
    }

    this.createMarkerCluster = function () {
        globalthis = this;
        this.globalMarkers = this.properties.map(function (item, i) {
            marker = globalthis.addMarker(item);
            return marker;
        });

        this.globalMarkerCluster = new MarkerClusterer(this.map, this.globalMarkers,
            this.markerClusterOptions);
    }

    this.searchPlace = function () {
        globalthis = this;
        var searchInput = document.getElementById('search-input');
        this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(searchInput);
        var searchBoxItems = new google.maps.places.SearchBox(searchInput);
        google.maps.event.addListener(searchBoxItems, 'places_changed', function () {
            var places = searchBoxItems.getPlaces();
            if (places.length == 0) {
                return;
            }
            var bounds = new google.maps.LatLngBounds();
            for (var i = 0, place; place = places[i]; i++) {
                bounds.extend(place.geometry.location);
            }
            // fit map bound with search resaults
            globalthis.map.fitBounds(bounds);
            // zoom back
            globalthis.map.setZoom(13);
        });
    }

    this.findMyLocation = function () {
        if (navigator.geolocation) {
            globalThis = this;
            navigator.geolocation.getCurrentPosition(function (position) {
                geolocate = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                var marker = new google.maps.Marker({
                    position: geolocate,
                    title: 'Your position',
                    icon: '/images/mylocation.png'
                });
                location_marker = marker;
                location_marker.setMap(globalThis.map);
                globalThis.globalMap.setCenter(geolocate);
                globalThis.globalMap.setZoom(16);
            });
        }
        else {
            console.log('error occured!');
        }
    }

    this.getMarkers = function () {
        globalThis = this;
        $http({
            method: 'GET',
            url: '/api/v1/property/list'
        }).then(function successCallback(response) {
            globalThis.properties = response.data.properties;            
            globalThis.createMarkerCluster();
        }, function errorCallback(error) {
            globalThis.properties = globalThis.sampleServerMarkers;
            globalThis.createMarkerCluster();
        });
    }
});

