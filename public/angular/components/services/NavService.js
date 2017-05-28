(function () {
    'use strict';

    angular.module('app')
        .service('navService', [
            '$q',
            navService
        ]);

    function navService($q) {
        var menuItems = [
            {
                name: 'Dashboard',
                icon: 'dashboard',
                sref: 'admin.dashboard'
            },
            {
                name: 'Songs',
                icon: 'dashboard',
                sref: 'admin.songs'
            },
            {
                name: 'Test',
                icon: 'person',
                sref: 'test.groups'
            },
            {
                name: 'Groups',
                icon: 'view_module',
                sref: 'admin.table'
            },
            {
                name: 'Home',
                icon: 'view_module',
                sref: 'home.home'
            }
        ];

        return {
            loadAllItems: function () {
                return $q.when(menuItems);
            }
        };
    }

})();
