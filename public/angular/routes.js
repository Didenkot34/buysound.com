(function () {
    'use strict';

    angular
        .module('app')
        .config(routes);

    routes.$inject = [
        '$urlRouterProvider',
        '$stateProvider'
    ];

    function routes($urlRouterProvider, $stateProvider) {
        $urlRouterProvider
            .otherwise('/');
        $stateProvider
            .state('home', {
                url: '/',
                templateUrl: 'views/home/home.blade.php',
                 controller: 'groupAdminCtrl'
            });
        $stateProvider
            .state('about', {
                url: '/about',
                templateUrl: 'views/about/about.blade.php',
                controller: function ($scope) {
                    $scope.title = 'About2';
                }
            });
        $stateProvider
            .state('admin', {
                url: '/admin',
                templateUrl: 'template/admin/admin.html',
                controller: 'AdminGroupsCtrl'
            });
    }
})();
