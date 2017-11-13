app.controller('EncuestaController', function($scope, $http, API_URL){

    $http.get(API_URL + "encuesta").success(function(response){
        $scope.encuestas = response;
    });
});
