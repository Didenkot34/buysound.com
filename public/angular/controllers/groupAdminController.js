(function () {
    'use strict';
    angular
        .module('app')
        .controller('groupAdminCtrl', groupAdminCtrl);

    groupAdminCtrl.$inject = ['$scope', 'groupService'];

    function groupAdminCtrl($scope, groupService) {

        groupService.getAll()
            .then(function successCallback(response) {
                $scope.groups = 'Noting';
                if (response.data.groups.length) {
                    $scope.groups = response.data.groups;
                }

            }, function errorCallback() {
                console.log('Error');
            });

        $scope.createGroup = function (groupData) {
            console.log(groupData);
            groupService.save(groupData)
                .then(function successCallback(response) {
                    console.log(response.data);

                }, function errorCallback() {
                console.log('Error');
            });
        }
    }
})();
