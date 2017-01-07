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

            groupData.img = getImgOriginalExtension();
            if (!_.has(groupData,'active')) {
                groupData.active = false;
            }

            
            groupService.save(groupData)
                .then(function successCallback(response) {
                    var fd = new FormData();
                    angular.forEach($scope.files, function (file) {
                        fd.append('file', file);
                    });
                    fd.append('id',response.data.id);
                    fd.append('imageName',response.data.imageName);
                    groupService.uploadImg(fd)
                        .then(function successCallback(response) {
                            console.log('upload');
                            console.log(response.data);

                        }, function errorCallback() {
                            console.log('Error');
                        });

                }, function errorCallback() {
                console.log('Error');
            });

        };

        function getImgOriginalExtension() {
            var match = $scope.files[0].name.match(/[a-zA-Z]{3}$/);

            return match[0];
        }
        
        $scope.deleteGroup = function (id) {
            groupService.deleteGroup(id)
                .then(function successCallback(response) {
                    console.log(response.data);

                }, function errorCallback() {
                    console.log('Error');
                });
        }
    }
})();
