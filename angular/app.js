var app = angular.module('nystc', ['uiGmapgoogle-maps']);

app.config(function(uiGmapGoogleMapApiProvider) {
  uiGmapGoogleMapApiProvider.configure({
    key: 'AIzaSyAk6s13rRTmNGeLGHuPxr7nTa2uPYAb5c4',
    v: '3.20', //defaults to latest 3.X anyhow
    libraries: 'weather,geometry,visualization'
  });
})

app.controller('nystc_list', function($scope, $http, $interval, uiGmapGoogleMapApi) {

  load_locations();


  /**
   * Load camera locations
   */
  function load_locations(){

    $http.get('/api/locations').success(function(data) {

      $scope.locations = data;
      $scope.location = data[0];

      // Map things
      uiGmapGoogleMapApi.then(function(maps) {

        // Init map    
        $scope.map = { center: { latitude: 43.270908, longitude: -76.988348 }, zoom: 7 };

        $scope.locMarkers = [];

        $scope.onClick = function(marker, eventName, model) {

          $scope.location = model;

          model.show = !model.show;

        };

        $scope.$watch(function() {

          return $scope.map.bounds;

        }, function(nv, ov) {

          var locMarkers = [];
          for (var i = 0; i < $scope.locations.length; i++) {

            var l = $scope.locations[i];      

            var marker = {
              id: i,
              latitude: l.lat,
              longitude: l.long,
              options: { draggable: true },
              title: l.name,
              name: l.name,
              url: l.url,
              cameras: l.cameras
            };

            locMarkers.push(marker);

          }

          $scope.locMarkers = locMarkers;

        }, true);

        $scope.markersEvents = {
          click: function(marker, eventName, model, arguments) {
            $scope.map.window.model = model;
            $scope.map.window.show = true;
          }
        };

      });


    });

  };

});

