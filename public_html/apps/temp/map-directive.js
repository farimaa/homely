angular.module("myApp")
    .service('loadGoogleMapAPI', ['$window', '$q',
        function ($window, $q) {

            var deferred = $q.defer();

            // Load Google map API script
            function loadScript() {
                // Use global document since Angular's $document is weak
                var script = document.createElement('script');
                script.src = '//maps.googleapis.com/maps/api/js?sensor=false&language=en&callback=initMap';

                document.body.appendChild(script);
            }

            // Script loaded callback, send resolve
            $window.initMap = function () {
                deferred.resolve();
            }

            loadScript();

            return deferred.promise;
        }]);

// Google Map
angular.module("myApp")
    .directive('singleMap', ['$rootScope', 'loadGoogleMapAPI',
        function ($rootScope, loadGoogleMapAPI) {

            return {
                restrict: 'E',
                link: function ($scope, elem, attrs) {
                    var map;
                    var infowindow;
                    $scope.initialize = function () {
                        map = new google.maps.Map(document.getElementById('map_cv_single'), {
                            center: new google.maps.LatLng(36.2, 50.3),
                            zoom: 10,
                            draggable: false
                            , zoomControl: false
                            , scrollwheel: false
                            , disableDoubleClickZoom: true
                            , panControl: false
                            , disableDefaultUI: true,
                            mapTypeId: google.maps.MapTypeId.SATELLITE
                        });
                    }


                    function loadGeoJsonStr($data) {
                        var geojson = JSON.parse($data.area_json);
                        map.data.addGeoJson(geojson);

                        zoom(map);
                    }

                    function zoom(map) {
                        var bounds = new google.maps.LatLngBounds();
                        map.data.forEach(function (feature) {
                            processPoints(feature.getGeometry(), bounds.extend, bounds);
                        });
                        map.fitBounds(bounds);

                        map.data.setStyle(function () {
                            return /** @type {google.maps.Data.StyleOptions} */({
                                fillColor: '#3322cc',
                                strokeColor: '#FF3322',
                                strokeWeight: 1
                            });
                        });

                    }

                    function processPoints(geometry, callback, thisArg) {
                        if (geometry instanceof google.maps.LatLng) {
                            callback.call(thisArg, geometry);
                        } else if (geometry instanceof google.maps.Data.Point) {
                            callback.call(thisArg, geometry.get());
                        } else {
                            geometry.getArray().forEach(function (g) {
                                processPoints(g, callback, thisArg);
                            });
                        }
                    }

                    // Loads google map script
                    loadGoogleMapAPI.then(function () {
                        $scope.$watch('[detailsLoaded]', function () {
                            $scope.initialize();
                            if ($scope.detailsLoaded) {
                                loadGeoJsonStr($scope.details);
                            }
                        });
                    }, function () {
                        // Promise rejected
                    });
                }
            };
        }])
    .directive('maps', ['$rootScope', 'loadGoogleMapAPI', '$http',
        function ($rootScope, loadGoogleMapAPI, $http) {
            return {
                restrict: 'E',
                scope: {
                    myindex: '='
                },
                link: function ($scope, elem, attrs) {


                    $scope.$parent.add_feature = function ($idElement) {
                        if ($('#' + $idElement).prop('checked') == true) {

                            $('#' + $idElement).parents('maps').first().addClass('loading')

                            var i = 0;
                            $(tmpData).each(function (data) {
                                var $data = this;
                                if ($data.area_json) {
                                    loadGeoJsonStr($data);
                                    i++;
                                }
                            });
                            //zoom(map);

                            $('#' + $idElement).parents('maps').first().removeClass('loading')

                        } else {
                            $scope.$parent.remove_feature('ok');
                            var obj = $('#' + $idElement).parents('div._parent').find('input._area:checked');

                            obj.each(function () {

                                var elm = $(this);
                                if (elm.attr('id') == "add_feature_office") {
                                    $scope.$parent.add_feature_office('add_feature_office');
                                }
                                if (elm.attr('id') == "add_feature_chanel_water") {
                                    $scope.$parent.add_feature_chanel_water('add_feature_chanel_water');
                                }
                                if (elm.attr('id') == "add_feature_L1L2") {
                                    $scope.$parent.add_feature_L1L2('add_feature_L1L2');
                                }

                            });


                        }

                    }

                    $scope.$parent.add_feature_L1L2 = function ($idElement) {

                        if ($('#' + $idElement).prop('checked') == true) {
                            $('#' + $idElement).parents('maps').first().addClass('loading')

                            var i = 0;
                            $(tmpDataChanel).each(function (data) {
                                var $data = this;
                                if ($data.area_json) {
                                    loadGeoJsonStr($data);
                                    i++;
                                }
                            });
                            //zoom(map);
                            $('#' + $idElement).parents('maps').first().removeClass('loading')

                        } else {
                            $scope.$parent.remove_feature('ok');
                            var obj = $('#' + $idElement).parents('div._parent').find('input._area:checked');

                            obj.each(function () {

                                var elm = $(this);
                                if (elm.attr('id') == "add_feature_office") {
                                    $scope.$parent.add_feature_office('add_feature_office');
                                }
                                if (elm.attr('id') == "add_feature_chanel_water") {
                                    $scope.$parent.add_feature_chanel_water('add_feature_chanel_water');
                                }
                                if (elm.attr('id') == "add_feature") {
                                    $scope.$parent.add_feature('add_feature');
                                }

                            });


                        }

                    }
                    $scope.$parent.add_feature_office = function ($idElement) {

                        if ($('#' + $idElement).prop('checked') == true) {
                            $('#' + $idElement).parents('maps').first().addClass('loading')

                            var i = 0;
                            $(tmpDataOffice).each(function (data) {
                                var $data = this;
                                if ($data.area_json) {
                                    loadGeoJsonStr($data);
                                    i++;
                                }
                            });
                            //zoom(map);
                            $('#' + $idElement).parents('maps').first().removeClass('loading')

                        } else {
                            $scope.$parent.remove_feature('ok');
                            var obj = $('#' + $idElement).parents('div._parent').find('input._area:checked');
                            obj.each(function () {

                                var elm = $(this);
                                if (elm.attr('id') == "add_feature_L1L2") {
                                    $scope.$parent.add_feature_L1L2('add_feature_L1L2');
                                }
                                if (elm.attr('id') == "add_feature_chanel_water") {
                                    $scope.$parent.add_feature_chanel_water('add_feature_chanel_water');
                                }
                                if (elm.attr('id') == "add_feature") {
                                    $scope.$parent.add_feature('add_feature');
                                }

                            });


                        }

                    }

                    $scope.$parent.add_feature_chanel_water = function ($idElement) {
                        if ($('#' + $idElement).prop('checked') == true) {
                            $('#' + $idElement).parents('maps').first().addClass('loading')

                            loadGeoJsonUrl('/map_json/chanel-water.json');
                            //zoom(map);
                            $('#' + $idElement).parents('maps').first().removeClass('loading')

                        } else {
                            $scope.$parent.remove_feature('ok');
                            var obj = $('#' + $idElement).parents('div._parent').find('input._area:checked');
                            obj.each(function () {
                                var elm = $(this);
                                if (elm.attr('id') == "add_feature_L1L2") {
                                    $scope.$parent.add_feature_L1L2('add_feature_L1L2');
                                }
                                if (elm.attr('id') == "add_feature_office") {
                                    $scope.$parent.add_feature_office('add_feature_office');
                                }
                                if (elm.attr('id') == "add_feature") {
                                    $scope.$parent.add_feature('add_feature');
                                }

                            });

                        }

                    }

                    $scope.$parent.remove_feature = function ($isClick) {
                        if (!$isClick) {
                            $('body').find('input._area').prop('checked', false);
                        }
                        map.data.forEach(function (feature) {
                            //If you want, check here for some constraints.
                            map.data.remove(feature);

                        });
                    }
                    $scope.$parent.remove_all_marker = function ($isClick) {
                        if (!$isClick) {
                            $('body').find('input._marker').prop('checked', false);
                        }

                        deleteMarkers();
                    }

                    $scope.$parent.add_marker = function ($loc) {

                        if ($loc == 'gates') {
                            console.log(tmpDataMarkerGate);
                            if ($('#' + $loc).prop('checked') == true) {
                                addMarker(tmpDataMarkerGate, 'gates');
                            } else {
                                $scope.$parent.remove_all_marker('ok');
                                var obj = $('#' + $loc).parents('div._parent').find('input._marker:checked');
                                obj.each(function () {
                                    var elm = $(this);
                                    if (elm.attr('id') == "office") {
                                        addMarker(tmpDataMarkerOffice, '');
                                    }
                                    if (elm.attr('id') == "wells") {
                                        addMarker(tmpDataMarkerWell, 'wells');
                                    }

                                });

                            }
                        } else if ($loc == 'office') {

                            if ($('#' + $loc).prop('checked') == true) {
                                addMarker(tmpDataMarkerOffice, '');
                            } else {
                                $scope.$parent.remove_all_marker('ok');
                                var obj = $('#' + $loc).parents('div._parent').find('input._marker:checked');
                                obj.each(function () {
                                    var elm = $(this);
                                    if (elm.attr('id') == "gates") {
                                        addMarker(tmpDataMarkerGate, 'gates');
                                    }
                                    if (elm.attr('id') == "wells") {
                                        addMarker(tmpDataMarkerWell, 'wells');
                                    }

                                });

                            }

                        } else {
                            if ($('#' + $loc).prop('checked') == true) {
                                addMarker(tmpDataMarkerWell, 'wells');
                            } else {
                                $scope.$parent.remove_all_marker('ok');
                                var obj = $('#' + $loc).parents('div._parent').find('input._marker:checked');
                                obj.each(function () {
                                    var elm = $(this);
                                    if (elm.attr('id') == "office") {
                                        addMarker(tmpDataMarkerOffice, '');
                                    }
                                    if (elm.attr('id') == "gates") {
                                        addMarker(tmpDataMarkerGate, 'gates');
                                    }

                                });

                            }
                        }

                    }

                    // Sets the map on all markers in the array.
                    function setMapOnAll(map) {
                        for (var i = 0; i < markers.length; i++) {
                            markers[i].setMap(map);
                        }
                    }

                    // Removes the markers from the map, but keeps them in the array.
                    function clearMarkers() {
                        setMapOnAll(null);
                    }

                    // Deletes all markers in the array by removing references to them.
                    function deleteMarkers() {
                        clearMarkers();
                        markers = [];
                    }

                    // Check if latitude and longitude are specified

                    // Initialize the map
                    $scope.initialize = function () {
                        map = new google.maps.Map(document.getElementById('map_cv'), {
                            center: new google.maps.LatLng(36.0, 50.0),
                            zoom: 10,
                            disableDefaultUI: true,
                            mapTypeId: google.maps.MapTypeId.SATELLITE
                        });
                        bounds = new google.maps.LatLngBounds();

                        infowindow = new google.maps.InfoWindow({
                            size: new google.maps.Size(300, 150)
                        });
                        map.addListener('click', function (event) {
                            infowindow.open(null);
                            map.data.revertStyle();
                            $('body').find('a.farmer-plan').removeClass('active');
                        });

                        map.data.addListener('mouseover', function (event) {
                            $('body').find('a.farmer-plan').removeClass('active');
                            $('body').find('a.farmer-plan[data-id="' + event.feature.getProperty('Id') + '"]').addClass('active');
                            infowindow.setContent($mapDataInfo[event.feature.getProperty('Id')]);
                            if (event) {
                                point = event.latLng;
                            }
                            if (event.feature.getProperty('Id')) {
                                infowindow.setPosition(point);
                                infowindow.open(map);
                            }

                        });

                        map.data.addListener('mouseover', function (event) {
                            map.data.revertStyle();
                            map.data.overrideStyle(event.feature, {fillColor: '#999999'});
                        });

                        map.data.addListener('mouseout', function (event) {
                            infowindow.close(map);
                        });

                    }

                    var $mapDataInfo = [];
                    var $mapData = [];
                    var tmpDataChanel = [], tmpData = [], tmpDataOffice = [], tmpDataMarkerOffice = [], tmpDataMarkerWell = [], tmpDataMarkerGate = [];
                    var markers = [];

                    function loadGeoJsonStr($data) {

                        var countMD = $mapData.length;
                        var geojson = JSON.parse($data.area_json);
                        map.data.addGeoJson(geojson);

                        map.data.setStyle(function (feature) {
                            return /** @type {google.maps.Data.StyleOptions} */({
                                gamma: 0.2,
                                saturation: 50,
                                lightness: -10,
                                hue: '#ff0000',
                                fillColor: feature.getProperty('Fill_Color'),
                                strokeColor: feature.getProperty('Stroke_Color'),
                                strokeWeight: feature.getProperty('Stroke_Weight')
                            });
                        });

                        var $nameInfo = '';
                        var $listPlan = '';
                        var info_well = '';

                        if ($data.total_area || $data.area) {
                            info_well = 'تلفیقی، ' + $data.info_well;
                            if ($data.info_well == 'دارد') {
                                info_well = 'شخصی ' + $data.info_well;
                            }
                            $nameInfo = 'نمایندگان: ';
                            $listPlan += '<div style="margin: 10px">';
                            $listPlan += '<span style="border-radius: 3px;margin:5px;padding: 5px;width:30px;height:20px;background-color:red;color:white;padding: 5px;">';
                            $listPlan += '<a href="/planning/planting-plans#/single/' + $data.id + '">برنامه ریزی</a>';
                            $listPlan += '</span>';
                            $listPlan += '<span style="border-radius: 3px;margin:5px;padding: 5px;width:30px;height:20px;background-color:blue;color:white;padding: 5px;">';
                            $listPlan += '<a href="/selling/planting-plans#/single/' + $data.id + '">فروش</a>';
                            $listPlan += '</span>';
                            $listPlan += '<span style="border-radius: 3px;margin:5px;padding: 5px;width:30px;height:20px;background-color:yellow;color:black;padding: 5px;">';
                            $listPlan += '<a href="/management/planting-plans/' + $data.id + '/edit">مدیریت اطلاعات</a>';
                            $listPlan += '</span>';
                            //$listPlan += '<span style="width:30px;height:20px;background-color:red;color:white;padding: 5px;"><a>برنامه ریزی</a></span>';
                            $listPlan += '</div>';
                            $listPlan += '<div>کانال: ' + $data.cname + '</div>';
                            $listPlan += '<div>دریچه: ' + $data.gname + '</div>';
                            $listPlan += '<div>سهمیه کانال: ' + $data.total_channel_water + '</div>';
                            $listPlan += '<div>چاه: ' + info_well + '</div>';
                            $listPlan += '<div>سهمیه چاه: ' + $data.total_water_well + ' مترمکعب در سال </div>';
                            $listPlan += '<div>مساحت: ' + $data.area + ' هکتار</div>';

                        }

                        $mapDataInfo[$data.id] = "<div style='font-family:yekan;padding: 5px; margin: 10px; text-align: center'> " +
                            "کد: " + $data.code +
                            " <div>" + $nameInfo + $data.info + "</div> " +
                            $listPlan +
                            "</div>";

                        map.setCenter(new google.maps.LatLng(36.0, 50.0));
                        map.setZoom(10);
                    }

                    function loadGeoJsonUrl($url) {
                        map.data.loadGeoJson($url);
                        //map.data.setStyle(function (feature) {
                        //    return /** @type {google.maps.Data.StyleOptions} */({
                        //        gamma: 0.2,
                        //        saturation: 50,
                        //        lightness: -10,
                        //        hue: '#993333',
                        //        fillColor:  '#009900',
                        //        strokeColor: '#0000ff',
                        //        strokeWeight:  '#000099'
                        //    });
                        //});

                        //zoom(map);

                        map.setCenter(new google.maps.LatLng(36.0, 50.0));
                        map.setZoom(10);

                    }

                    /** getProperty . forEachProperty
                     * Update a map's viewport to fit each geometry in a dataset
                     * @param {google.maps.Map} map The map to adjust
                     */
                    function zoom(map) {
                        map.data.forEach(function (feature) {
                            processPoints(feature.getGeometry(), bounds.extend, bounds);

                        });
                        map.fitBounds(bounds);


                    }

                    /**
                     * Process each point in a Geometry, regardless of how deep the points may lie.
                     * @param {google.maps.Data.Geometry} geometry The structure to process
                     * @param {function(google.maps.LatLng)} callback A function to call on each
                     *     LatLng point encountered (e.g. Array.push)
                     * @param {Object} thisArg The value of 'this' as provided to 'callback' (e.g.
                     *     myArray)
                     */
                    function processPoints(geometry, callback, thisArg) {
                        if (geometry instanceof google.maps.LatLng) {
                            callback.call(thisArg, geometry);
                        } else if (geometry instanceof google.maps.Data.Point) {
                            callback.call(thisArg, geometry.get());
                        } else {
                            geometry.getArray().forEach(function (g) {
                                processPoints(g, callback, thisArg);
                            });
                        }
                    }

                    function addMarker($dataMarker, $type) {

                        var marker, i = 0;
                        //var shape = {
                        //    coords: [1, 1, 1, 20, 18, 20, 18, 1],
                        //    type: 'poly'
                        //};
                        var image;
                        if ($type) {
                            image = {
                                url: '/assets/img/' + $type + '.png',
                                size: new google.maps.Size(32, 37),
                                origin: new google.maps.Point(0, 0),
                                anchor: new google.maps.Point(0, 32)
                            };
                        }

                        $($dataMarker).each(function (data) {
                            var $data = this;
                            if ($data.lat && $data.lng) {

                                marker = new google.maps.Marker({
                                    position: new google.maps.LatLng($data.lat, $data.lng),
                                    icon: image,
                                    //shape: shape,
                                    title: $data.name,
                                    zIndex: $data.id,
                                    map: map,
                                });
                                markers.push(marker);
                                //
                                //if($type==''){
                                //    bounds.extend(marker.position);
                                //}
                                google.maps.event.addListener(marker, 'mouseover', (function (marker, i) {
                                    return function () {
                                        var $listPlan = '';
                                        if ($data.well_capacity) {
                                            $listPlan += '<div>ظرفیت چاه: ' + $data.well_capacity + '</div>';
                                        }

                                        infowindow.setContent("<div style='padding: 2px; margin:5px; text-align: center'> <p>" + $data.code + "</p>   " + $data.name + " </div>" + $listPlan);
                                        infowindow.open(map, marker);
                                    }
                                })(marker, i));
                                google.maps.event.addListener(marker, 'mouseout', (function (marker, i) {
                                    return function () {
                                        infowindow.open(null);
                                    }
                                })(marker, i));

                            }
                            i++;
                        });

                        map.fitBounds(bounds);

                        map.setCenter(new google.maps.LatLng(36.0, 50.0));
                        map.setZoom(10);
//
//        for (i = 0; i < $dataMarker.length; i++) {
//            marker = new google.maps.Marker({
//                position: new google.maps.LatLng($dataMarker[i][1], $dataMarker[i][2]),
//                map: map
//            });
//            bounds.extend(marker.position);
//            google.maps.event.addListener(marker, 'click', (function(marker, i) {
//                return function() {
//                    infowindow.setContent($dataMarker[i][0]);
//                    infowindow.open(map, marker);
//                }
//            })(marker, i));
//        }
//        map.fitBounds(bounds);

                    }

                    var $type_data;
                    if ($scope.myindex) {
                        $type_data = $scope.myindex;
                    } else {
                        $type_data = 'all';
                    }

                    function ajax($geo, $wells, $gate) {

                        $scope.$parent.myPromise = $http.get('/planning/get-geo-json?type_data=' + $type_data, {ignoreLoadingBar: true}).success(function (data) {

                            var dataPlantingPlanAjax = data;
                            if ($type_data == 'all') {
                                var c = 0;
                                $(dataPlantingPlanAjax.dataL1L2).each(function (data) {
                                    var $data = this;
                                    if ($data.area_json) {
                                        tmpDataChanel[c] = $data;
                                        loadGeoJsonStr($data);
                                        c++;
                                    }
                                });

                            }

                            if ($type_data == 'all') {
                                if (dataPlantingPlanAjax.dataOffice) {
                                    tmpDataMarkerOffice = dataPlantingPlanAjax.dataOffice;
                                    addMarker(dataPlantingPlanAjax.dataOffice, '');
                                }
                                var s = 0;
                                $(dataPlantingPlanAjax.dataOffice).each(function (data) {
                                    var $data = this;
                                    if ($data.area_json) {
                                        tmpDataOffice[s] = $data;
                                        loadGeoJsonStr($data);
                                        s++;
                                    }
                                });

                            }

                            if (dataPlantingPlanAjax.dataPlans) {
                                var i = 0;
                                $(dataPlantingPlanAjax.dataPlans).each(function (data) {
                                    var $data = this;
                                    if ($data.area_json) {
                                        tmpData[i] = $data;
                                        loadGeoJsonStr($data);
                                        i++;
                                    }
                                });
                            }


                            if (typeof map != 'undefined') {

                                if (($type_data == 'all' || $type_data == 'wells')) {
                                    tmpDataMarkerWell = dataPlantingPlanAjax.dataWells;
                                    if ($wells) {
                                        addMarker(dataPlantingPlanAjax.dataWells, 'wells');
                                    }
                                }
                                if ($type_data == 'all' || $type_data == 'gates_1' || $type_data == 'gates_2') {

                                    tmpDataMarkerGate = dataPlantingPlanAjax.dataGates;
                                    if ($gate) {
                                        addMarker(dataPlantingPlanAjax.dataGates, 'gates');
                                    }
                                }

                                if ($geo && $type_data == 'all') {
                                    //zoom(map);
                                    map.setCenter(new google.maps.LatLng(36.0, 50.0));
                                    map.setZoom(10);
                                }
                            }

                        });

                        //$.ajax({
                        //
                        //    url: '/planning/get-geo-json',
                        //    type: 'GET',
                        //    data:{type_data:$type_data},
                        //    dataType: 'json',
                        //    success: function (data) {
                        //
                        //
                        //    },
                        //    error: function (request, error) {
                        //        alert("برقراری ارتباط با سرور انجام نشد!");
                        //    }
                        //});

                    };


                    // Loads google map script
                    loadGoogleMapAPI.then(function () {
                        $scope.initialize();
                        ajax(true, false, false);
                    }, function () {
                        // Promise rejected
                    });
                }
            };
        }])
