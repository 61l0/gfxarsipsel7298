controllers.controller('root', ['$scope', '$location', '$q', function($scope, $location, $q) {

    $scope.loaded = false;
    // $scope.user = user;
    $scope.permissions = {};
    $scope.waiting = false;
    $scope.ajax_state = 'PUSH';
    $scope.hide_ac_indicator = false;
    
    var incShowIndicator = 0;

    $scope.hideAcIndicator = function(timeout){
        
         setTimeout(function() {
            --incShowIndicator; 
            if(incShowIndicator == 0)
            {
                $scope.$apply(function(){
                    $scope.hide_ac_indicator = true;
                });
            }
        },timeout);
        
    };
    $scope.showAcIndicator = function(html){
        $scope.ajax_state = html;
        $scope.hide_ac_indicator = false;
        incShowIndicator += 1;

        $scope.hideAcIndicator(5000);
    };
    $scope.init = function() {
        // $scope.$on('$routeChangeStart', function() {
        //     ngProgress.start();
        // });
        $scope.showAcIndicator('OK');
        // $scope.$on('$routeChangeSuccess', function() {
        //     ngProgress.complete();
        // });

        // if (!user.loggedIn()) {
        //     $scope.loaded = true;
        //     return;
        // }

        // var promises = [];

        // promises.push(user.permissions('administrator')
        // .then(function(permissions) {
        //     $scope.permissions.administrator = permissions;
        // }));
    
        // promises.push(user.permissions('user')
        // .then(function(permissions) {
        //     $scope.permissions.users = permissions;
        // }));
    
        // promises.push(user.permissions('role')
        // .then(function(permissions) {
        //     $scope.permissions.roles = permissions;
        // }));

        // promises.push(user.permissions('bank')
        // .then(function(permissions) {
        //     $scope.permissions.banks = permissions;
        // }));
        
        // App.injectPermissions(promises,user,$scope);

        // $q.all(promises)
        // .then(function() {
        //     $scope.loaded = true;
        // }, function() {
        //     $scope.loaded = true;
        // });
    };

    $scope.active = function(path) {
        return $location.path().match(new RegExp(path + '.*', 'i')) != null;
    };
    $scope.clearForm = function(form)
    {
        $(form).find('input[type=text],textarea').val('');
    }
    // $scope.logout = function() {
    //     //window.location.reload();
    //    // $location.path('logout');
    //     //
    //     //console.log($location);
    //     setTimeout(function(){
    //        // $scope.user.clear();

    //         window.location.reload();

    //     },500);
    // };
    
}]);