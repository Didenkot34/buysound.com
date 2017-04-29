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
                sref: '.dashboard'
            },
            {
                name: 'Songs',
                icon: 'dashboard',
                sref: '.songs'
            },
            {
                name: 'Test',
                icon: 'person',
                sref: 'test.groups'
            },
            {
                name: 'Groups',
                icon: 'view_module',
                sref: '.table'
            }
        ];

        return {
            loadAllItems: function () {
                return $q.when(menuItems);
            }
        };
    }

})();
