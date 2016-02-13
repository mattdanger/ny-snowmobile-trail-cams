var app = angular.module('nystc', []);

app.controller('nystc_list', function($scope, $http, $interval) {


  $scope.location = null;  

  load_locations();

  function load_locations(){

    $http.get('/api/locations').success(function(data) {

      $scope.locations = data;
      $scope.location = data[0];

    });

  };

});
