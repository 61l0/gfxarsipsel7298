controllers.controller('activity_indicator', ['$scope', '$location', function($scope, $location, user) {

    // $scope.user = user;
    //console.log(user)
    $scope.activity_indicator = function() {
        return  $base +'generic/activity-indicator.html';
    };
    
}]);