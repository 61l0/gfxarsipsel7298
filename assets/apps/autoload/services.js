/* global _ angular store moment */
'use strict';
(function(){

var $S = angular.module('arsipsel.services', []).

factory('alerts', function($interval) {
    var alerts = undefined;
    if (!window.alertsInterval) {
        window.alertsInterval = $interval(function() {
            var alive = [];
            _.forEach(alerts, function(alert) {
                if (!moment().isAfter(moment(alert.timestamp).add(10, 'seconds'))) {
                    alive.push(alert);
                }
            });
            alerts = alive;
            store.set('alerts', alerts);
        }, 1000);
    }
    return {
        clear: function() {
            store.set('alerts', []);
        },
        get: function() {
            if (_.isUndefined(alerts)) {
                alerts = store.get('alerts');
            }
            if (_.isEmpty(alerts)) {
                alerts = [];
            }
            return alerts;
        },
        set: function(val) {
            alerts = val;
            store.set('alerts', alerts);
        },
        success: function(msg) {
            alerts.push({id: Math.random().toString(16), success: msg, timestamp: new Date().getTime()});
            store.set('alerts', alerts);
        },
        fail: function(msg) {
            alerts.push({id: Math.random().toString(16), danger: msg, timestamp: new Date().getTime()});
            store.set('alerts', alerts);
        }
    };
})

.factory("Breadcrumbs", function($state, $translate, $interpolate) {
    var list = [], title;

    function getProperty(object, path) {
        function index(obj, i) {
            return obj[i];
        }

        return path.split('.').reduce(index, object);
    }

    function addBreadcrumb(title, state) {
        list.push({
            title: title,
            state: state
        });
    }

    function generateBreadcrumbs(state) {
        if(angular.isDefined(state.parent)) {
            generateBreadcrumbs(state.parent);
        }

        if(angular.isDefined(state.breadcrumb)) {
            if(angular.isDefined(state.breadcrumb.title)) {
                addBreadcrumb($interpolate(state.breadcrumb.title)(state.locals.globals), state.name);
            }
        }
    }

    function appendTitle(translation, index) {
        var title = translation;

        if(index < list.length - 1) {
            title += ' > ';
        }

        return title;
    }

    function generateTitle() {
        title = '';

        angular.forEach(list, function(breadcrumb, index) {
            $translate(breadcrumb.title).then(
                function(translation) {
                    title += appendTitle(translation, index);
                }, function(translation) {
                    title += appendTitle(translation, index);
                }
            );
        });
    }

    return {
        generate: function() {
            list = [];

            generateBreadcrumbs($state.$current);
            generateTitle();
        },

        title: function() {
            return title;
        },

        list: function() {
            return list;
        }
    };
});
App.injectServices($S.factory);
})();
