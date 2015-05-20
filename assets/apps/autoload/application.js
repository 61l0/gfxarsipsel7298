/* global angular, i18n */
'use strict';

angular.module('arsipsel', ['arsipsel.filters', 'arsipsel.services', 'arsipsel.directives', 'arsipsel.controllers', 'ngRoute']).
config(['$routeProvider', '$httpProvider','$locationProvider', function($routeProvider, $httpProvider,$locationProvider) {

  
    
    $routeProvider.when('/', {
        controller: 'home',
        title : 'Beranda',
        templateUrl: 'assets/templates/generic/home.html'
    });

    // $routeProvider.otherwise({
    //     redirectTo: '/halaman-tidak-ditemukan'
    // });
    
    
    App.injectRoutes($routeProvider);

    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';

    var param = function(obj) {
        var query = '',
            name, value, fullSubName, subName, subValue, innerObj, i;

        for (name in obj) {
            value = obj[name];

            if (value instanceof Array) {
                for (i = 0; i < value.length; ++i) {
                    subValue = value[i];
                    fullSubName = name + '[' + i + ']';
                    innerObj = {};
                    innerObj[fullSubName] = subValue;
                    query += param(innerObj) + '&';
                }
            }
            else if (value instanceof Object) {
                for (subName in value) {
                    subValue = value[subName];
                    fullSubName = name + '[' + subName + ']';
                    innerObj = {};
                    innerObj[fullSubName] = subValue;
                    query += param(innerObj) + '&';
                }
            }
            else if (value !== undefined && value !== null) query += encodeURIComponent(name) + '=' + encodeURIComponent(value) + '&';
        }

        return query.length ? query.substr(0, query.length - 1) : query;
    };

    $httpProvider.defaults.transformRequest = [function(data) {
        return angular.isObject(data) && String(data) !== '[object File]' ? param(data) : data;
    }];
    
}])
.run(function($rootScope,$route,$location){
    $rootScope.$on("$routeChangeSuccess", function(currentRoute, previousRoute){
        //Change page title, based on Route information
        $rootScope.title = $route.current.title;


        $('svg').remove();
    });;
});

// Array.prototype.contains = function(obj) {
//     return this.indexOf(obj) > -1;
// };
