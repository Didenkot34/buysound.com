(function () {
    'use strict';
    angular
        .module('app')
        .controller('groupAdminCtrl', groupAdminCtrl);

    groupAdminCtrl.$inject = ['$scope', '$mdToast', '$mdDialog', 'APP', 'CRUD'];

    function groupAdminCtrl($scope, $mdToast, $mdDialog, APP, CRUD) {

        $scope.getAllGroups = getAllGroups;
        $scope.deleteGroup = deleteGroup;
        $scope.editGroup = editGroup;
        $scope.addGroup = addGroup;

        $scope.getAllGroups();

        function getAllGroups() {
            CRUD.getAll(APP.GROUP_MODEL)
                .then(function successCallback(response) {
                    $scope.groups = null;
                    if (_.get(response, 'data.groups.length', false)) {
                        $scope.groups = response.data.groups;
                    }

                }, function errorCallback() {
                    console.log('Error Get All');
                });
        };

        function deleteGroup(ev, group) {

            var confirm = $mdDialog.confirm()
                .title('Would you like to delete ' + group.name + '?')
                .textContent('All of the banks have agreed to forgive you your debts.')
                .targetEvent(ev)
                .ok('Yes!')
                .cancel('No');

            $mdDialog.show(confirm).then(function () {

                CRUD.delete(APP.GROUP_MODEL, group.id)
                    .then(function successCallback(response) {
                        $scope.getAllGroups();
                    }, function errorCallback() {
                        console.log('Error');
                    });
            }, function () {
                console.log('Did\'t delete this group')
            });

        };

        function editGroup(ev, group) {

            $mdDialog.show({
                controller: 'ModalGroupCtrl',
                templateUrl: '/views/dialogEdit.blade.php',
                parent: angular.element(document.body),
                targetEvent: ev,
                locals: {
                    items: group
                },
                clickOutsideToClose: true,
                fullscreen: true
            }).then(function (answer) {
                $scope.getAllGroups();
            }, function () {
            });
        };

        function addGroup(ev) {

            $mdDialog.show({
                controller: 'ModalGroupCtrl',
                templateUrl: '/views/dialogEdit.blade.php',
                parent: angular.element(document.body),
                targetEvent: ev,
                locals: {
                    items: false
                },
                clickOutsideToClose: true,
                fullscreen: true
            }).then(function (answer) {
                $scope.getAllGroups();
            }, function () {
            });
        };
    }
})();
