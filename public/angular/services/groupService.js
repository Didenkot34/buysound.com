(function () {
    'use strict';
    angular
        .module('app')
        .factory('groupService', groupService);

    groupService.$inject = ['$http'];

    function groupService($http) {

        return {

            // get all the groups
            getAll : function() {
                // return $http.get('/api/groups');
                return $http({
                    method: 'GET',
                    url: '/api/groups',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            },

            // get one the groups
            
            getOne : function(id) {

                return $http.get('/api/groups/' + id);
            },

            // save a groups (pass in comment data)
            save : function(groupData) {
                return $http({
                    method: 'POST',
                    url: '/api/groups',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: groupData
                });
            },
            
            // update a groups (pass in comment data)
            update : function(groupData, id) {
                return $http({
                    method: 'PUT',
                    url: '/api/groups/' + id,
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(groupData)
                });
            },

            // deleted a group
            delete : function(id) {
                return $http.delete('/api/groups/' + id);
            }
        }

    }
})();
