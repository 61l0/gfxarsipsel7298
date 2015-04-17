/* global _, angular, i18n, Ladda, Odometer */
'use strict';
(function(){

var $D = angular.module('arsipsel.directives', [])
.directive('menu', [function() {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var $this = jQuery(element);
            $this.find('li').has('ul').children('ul').addClass('collapse');
            $this.find('li').has('ul').children('a').on('click', function(e) {
                e.preventDefault();
                $(this).parent('li').toggleClass('active').children('ul').collapse('toggle');
                $(this).parent('li').siblings().removeClass('active').children('ul.in').collapse('hide');
            });
        }
    };
}])
.directive('i18n', [function() {
    return {
        restrict: 'A',
        priority: -1000,
        link: function(scope, element, attrs) {
            scope.$watch(function() {
                return attrs.i18n;
            }, function(newValue) {
                element.html(i18n.t(attrs.i18n));
            });
        }
    };
}])
.directive('i18nPlaceholder', [function() {
    return {
        restrict: 'A',
        priority: -1000,
        link: function(scope, element, attrs) {
            scope.$watch(function() {
                return attrs.i18nPlaceholder;
            }, function(newValue) {
                element.attr('placeholder', i18n.t(newValue));
            });
        }
    };
}])
.directive('loading', [function() {
    return {
        restrict: 'A',
        link: function(scope, element, attrs, ngModel) {
            var loaders = ['loaded'].concat(scope.$eval(attrs.loading));
            var watch = function(newValue) {
                if (_.every(loaders, function(loader) {
                    return ((loader == '') || (_.isUndefined(loader))) ? true : scope.$eval(loader);
                })) {
                    jQuery(element).removeClass('loading');
                    jQuery(element).css('opacity', 1);
                } else {
                    jQuery(element).css('opacity', 0.4);
                    jQuery(element).addClass('loading');
                }
            };
            _.forEach(loaders, function(loader) {
                scope.$watch(loader, watch);
            });
        }
    };
}])
.directive('selectpicker', [function() {
    return {
        require: 'ngModel',
        restrict: 'A',
        priority: 10,
        link: function(scope, element, attrs, ngModel) {
            jQuery(element).selectpicker();
            scope.$watch(function() {
                return ngModel.$modelValue;
            }, function(newValue) {
                jQuery(element).selectpicker('refresh');
            });
            scope.$watch(function() {
                return scope.$eval(attrs.options);
            }, function(newVal) {
                jQuery(element).selectpicker('refresh');
            });
        }
    };
}])
// .directive('ladda', [function() {
//     return {
//         restrict: 'A',
//         priority: -1,
//         link: function(scope, element, attrs) {
//             if (!_.isEmpty(attrs.i18nLadda)) {
//                 element.html(i18n.t(attrs.i18nLadda));
//             }
//             var ladda = Ladda.create(element[0]);
//             element.addClass('ladda-button');
//             element.attr('data-style', 'expand-right');
//             element.attr('data-size', 1);
//             scope.$watch(function() {
//                 return scope.$eval(attrs.ladda);
//             }, function(newValue) {
//                 if (newValue) {
//                     ladda.start();
//                 } else {
//                     ladda.stop();                    
//                 }
//             });
//         }
//     };
// }])
.directive('confirm', [function() {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            element.bind('click', function(event) {
                if (window.confirm(i18n.t('msg.sure'))) {
                    scope.$eval(attrs.confirm);
                }
            });
        }
    };
}])
// .directive('odometer', [function() {
//     return {
//         restrict: 'A',
//         priority: -1,
//         link: function(scope, element, attrs) {
//             var odometer = new Odometer({el: element[0]});
//             scope.$watch(attrs.odometer, function(newVal) {
//               odometer.update(newVal);
//             });
//         }
//     };
// }])
// .directive("cbInline", function($timeout) {
//     t = "<span class=\"InlineEditWidget\">\n  <span ng:show=\"editing\" class=\"InlineEditing\">\n     <span class=\"transclude-root\" ng:transclude></span>\n  </span>\n\n  <span class=\"InlineEditable\" ng:hide=\"editing\"  ng:dblclick=\"enter()\">{{altModel || model}}&nbsp;</span>\n\n</span>";

//     return {
//       transclude: "element",
//       priority: 2,
//       scope: {
//         model: "=ngModel",
//         altModel: "=cbInline"
//       },
//       template: t,
//       replace: true,
//       link: function(scope, elm, attr) {
//         var originalValue, transcluded;
//         originalValue = scope.model;
//         transcluded = elm.find(".transclude-root").children().first();
//         transcluded.bind("keydown", function(e) {
//           if (e.keyCode === 27) {
//             return scope.$apply(scope.cancel);
//           }
//         });
//         transcluded.bind("blur", function() {
//           return scope.$apply(scope.leave);
//         });
//         scope.enter = function() {
//           scope.editing = true;
//           originalValue = scope.model;
//           return $timeout((function() {
//             var input;
//             input = elm.find("input");
//             if (input.size() > 0) {
//               input[0].focus();
//               return input[0].select();
//             }
//           }), 0, false);
//         };
//         scope.leave = function() {
//           return scope.editing = false;
//         };
//         return scope.cancel = function() {
//           scope.editing = false;
//           return scope.model = originalValue;
//         };
//       }
//     };
// })
// .directive('formAutofillFix', function() {
//   return function(scope, elem, attrs) {
//     // Fixes Chrome bug: https://groups.google.com/forum/#!topic/angular/6NlucSskQjY
//     elem.prop('method', 'POST');

//     // Fix autofill issues where Angular doesn't know about autofilled inputs
//     if(attrs.ngSubmit) {
//       setTimeout(function() {
//         elem.unbind('submit').submit(function(e) {
//           e.preventDefault();
//           elem.find('input, textarea, select').trigger('input').trigger('change').trigger('keydown');
//           scope.$apply(attrs.ngSubmit);
//         });
//       }, 0);
//     }
//   };
// })
// .directive("breadcrumbs", function() {
//     return {
//         restrict: 'E',
//         replace: true,
//         priority: 100,
//         templateUrl: 'assets/templates/directives/breadcrumbs.html'
//     };
// });

App.injectDirectives($D);
})();
