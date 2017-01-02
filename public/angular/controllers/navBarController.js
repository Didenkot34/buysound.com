(function() {
    'use strict';

    angular
        .module('app')
        .controller('navBarCtrl', navBarController);

    navBarController.$inject = ['$scope'];

    function navBarController($scope) {
        $scope.title2 = 'nawBar';
    }
})();