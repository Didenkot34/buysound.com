(function () {
    'use strict';
    angular
        .module('app')
        .factory('songsService', songsService);

    songsService.$inject = ['$http'];

    function songsService($http) {

        return {

            // get all the groups
            getAll: function () {

                return $http({
                    method: 'GET',
                    url: '/songs',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            },

            // get one the groups

            getOne: function (id) {

                return $http.get('/api/groups/' + id);
            },

            // save a groups (pass in comment data)
            save: function (songData) {
                return $http({
                    method: 'POST',
                    url: '/songs',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: songData
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

            // update a groups (pass in comment data)
            update: function (groupData, id) {
                return $http({
                    method: 'PUT',
                    url: '/api/groups/' + id,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $.param(groupData)
                });
            },

            // deleted a group
            deleteSong: function (id) {
                return $http.delete('/songs/' + id);
            }
        }

    }
})();
