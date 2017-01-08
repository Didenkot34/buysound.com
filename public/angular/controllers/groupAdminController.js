(function () {
    'use strict';
    angular
        .module('app')
        .controller('groupAdminCtrl', groupAdminCtrl);

    groupAdminCtrl.$inject = ['$scope', 'groupService', '$mdToast'];

    function groupAdminCtrl($scope, groupService, $mdToast) {

        $scope.getAllGroups();

        $scope.getAllGroups = function () {
            groupService.getAll()
                .then(function successCallback(response) {
                    $scope.groups = 'Noting';
                    if (response.data.groups.length) {
                        $scope.groups = response.data.groups;
                    }

                }, function errorCallback() {
                    console.log('Error Get All');
                });
        };
        $scope.createGroup = function (groupData) {

            groupData.img = getImgOriginalExtension();
            if (!groupData.img) {
                $mdToast.show(
                    $mdToast.simple()
                        .textContent('Вы забыли загрузить картинку')
                        .position('bottom right')
                        .hideDelay(3000)
                );
                return false;
            }
            if (!_.has(groupData,'active')) {
                groupData.active = false;
            }

            
            groupService.save(groupData)
                .then(function successCallback(response) {
                   uploadImg(response);
                }, function errorCallback() {
                console.log('Error Save Group');
            });

        };
        
        $scope.deleteGroup = function (id) {
            groupService.deleteGroup(id)
                .then(function successCallback(response) {
                    $scope.getAllGroups();
                }, function errorCallback() {
                    console.log('Error');
                });
        };

        function getImgOriginalExtension() {

            if (_.has($scope,'files.0')) {

                var match = $scope.files[0].name.match(/[a-zA-Z]{3}$/);

                return match[0];
            } else {

                return false;
            }
        }

        function uploadImg(response) {
            var fd = new FormData();
            angular.forEach($scope.files, function (file) {
                fd.append('file', file);
            });
            fd.append('id',response.data.id);
            fd.append('imageName',response.data.imageName);
            groupService.uploadImg(fd)
                .then(function successCallback(response) {
                    $scope.getAllGroups();

                }, function errorCallback() {
                    console.log('Error Upload');
                });
        }
    }
})();
