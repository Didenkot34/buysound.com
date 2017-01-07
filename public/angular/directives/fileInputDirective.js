(function () {
    'use strict';
    angular
        .module('app')
        .directive('fileInput', fileInput);
    fileInput.$inject = ['$parse'];

    function fileInput($parse) {

        return {
            restrict: 'A',
            link: function (scope, elm, attrs) {
                elm.bind('change', function () {
                    $parse(attrs.fileInput)
                        .assign(scope, elm[0].files);
                    scope.$apply();
                })
            }
        }

    }
})();