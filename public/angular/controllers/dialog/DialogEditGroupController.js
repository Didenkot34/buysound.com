(function () {
    'use strict';

    angular
        .module('app')
        .controller('DialogEditGroupCtrl', DialogEditGroupController);

    DialogEditGroupController.$inject = ['$scope', 'groupService', '$mdDialog', 'items', '$mdToast'];

    function DialogEditGroupController($scope, groupService, $mdDialog, items, $mdToast) {
        $scope.group = items;

        $scope.title = items ? 'Редактировать "' + items.name +'"' : 'Добавить';
        $scope.edit = function (group) {

            var groupData = angular.copy(group);

            if (items === false) {
                $scope.createGroup(groupData);
            } else {
                if (_.has($scope, 'files.0')) {

                    var match = $scope.files[0].name.match(/[a-zA-Z]{3}$/);
                    groupData.imgNew = match[0];
                } else {
                    groupData.imgNew = 0;
                }

                groupService.update(groupData, groupData.id)
                    .then(function successCallback(response) {
                        if (response.data.imageName) {
                            updateImg(response);
                        }
                        $mdDialog.hide(groupData);
                    }, function errorCallback() {
                        console.log('Error Update');
                    });
            }
            // $mdDialog.hide(group);
        };
        $scope.cancel = function (group) {
            $mdDialog.hide(group);
        };

        function updateImg(response) {
            var fd = new FormData();
            angular.forEach($scope.files, function (file) {
                fd.append('file', file);
            });
            fd.append('id', response.data.id);
            fd.append('imageName', response.data.imageName);

            groupService.uploadImg(fd)
                .then(function successCallback(response) {
                }, function errorCallback() {
                    console.log('Error Upload');
                });
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
                   // $scope.getAllGroups();

                }, function errorCallback() {
                    console.log('Error Upload');
                });
        }

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
            if (!_.has(groupData, 'active')) {
                groupData.active = false;
            }


            groupService.save(groupData)
                .then(function successCallback(response) {
                    uploadImg(response);
                    $mdDialog.hide(groupData);
                }, function errorCallback() {
                    console.log('Error Save Group');
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
    }
})();