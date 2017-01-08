(function() {
    'use strict';

    angular
        .module('app')
        .controller('DialogEditGroupCtrl', DialogEditGroupController);

    DialogEditGroupController.$inject = ['$scope','groupService', '$mdDialog', 'items'];

    function DialogEditGroupController($scope, groupService, $mdDialog, items) {
        $scope.group = items;

        $scope.edit = function (group) {

            var groupData = angular.copy(group);
            if (_.has($scope,'files.0')) {

                var match = $scope.files[0].name.match(/[a-zA-Z]{3}$/);
                groupData.imgNew = match[0];
            } else {
                groupData.imgNew = 0;
            }

            groupService.update(groupData, groupData.id)
                .then(function successCallback(response) {
                    if(response.data.imageName) {
                        updateImg(response);
                    }
                    $mdDialog.hide(groupData);
            }, function errorCallback() {
                console.log('Error Update');
            });
            // $mdDialog.hide(group);
        };
        $scope.cancel = function(group) {
            $mdDialog.hide(group);
        };

        function updateImg(response) {
            var fd = new FormData();
            angular.forEach($scope.files, function (file) {
                fd.append('file', file);
            });
            fd.append('id',response.data.id);
            fd.append('imageName',response.data.imageName);

            groupService.uploadImg(fd)
                .then(function successCallback(response) {
                }, function errorCallback() {
                    console.log('Error Upload');
                });
        }
    }
})();