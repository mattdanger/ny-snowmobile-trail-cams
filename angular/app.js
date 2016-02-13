var app = angular.module('nystc', []);

app.controller('nystc_control', function($scope, $http, $interval) {

  load_locations();

  function load_locations(){

    $http.get('/api/locations').success(function(data) {

      $scope.locations = data;
      $scope.loc  = data[0];

    });

  };

  $scope.setLocation = function(location) {
    $scope.loc = location;
  };
    
});
