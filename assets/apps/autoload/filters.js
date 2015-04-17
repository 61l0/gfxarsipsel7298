'use strict';

angular.module('arsipsel.filters', [])
.filter('ucfirst', function() {
	return function(input,arg) {
		return input.replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); });
	};
})
.filter('linebreak', function() {
    return function(input,arg) {
        return input.replace(/\n/g, '<br>');
    }
})
.filter('to_trusted', ['$sce', function($sce){
    return function(input,arg) {
        return $sce.trustAsHtml(input);
    };
}])
.filter('idr_currency', function(){
    return function (amount ){
	    return Helper.IDR_Currency(amount,'.',',',0);
	}
});;