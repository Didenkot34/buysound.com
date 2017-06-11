(function () {
    'use strict';
    angular
        .module('app')
        .factory('CRUD', CRUD);

    CRUD.$inject = ['$http'];

    function CRUD($http) {

        var headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        };
        
        return {

            // get all the groups
            getAll: function (modelName) {

                return $http({
                    method: 'GET',
                    url: '/' + modelName,
                    headers: headers
                });
            },

            // get one the groups

            getOne: function (modelName, id) {

                return $http.get('/' + modelName + '/' + id);
            },

            // save a modelName (pass in comment data)
            save: function (modelName, data) {
                return $http({
                    method: 'POST',
                    url: '/' + modelName,
                    headers: headers,
                    data: data
                });
            },

            uploadFiles: function (files) {
                return $http({
                    method: 'POST',
                    url: '/upload-files',
                    transformRequest: angular.identity,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Content-Type': undefined
                    },
                    data: files
                });
            },

            // update a modelName (pass in comment data)
            update: function (modelName,data) {
                return $http({
                    method: 'PUT',
                    url: '/' + modelName + '/' + data.id,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(data)
                });
            },

            // deleted a group
            delete: function (modelName, id) {
                return $http.delete('/' + modelName + '/' + id);
            }
        }

    }
})();
