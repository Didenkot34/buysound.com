(function () {
    'use strict';

    angular
        .module('app')
        .controller('DialogEditGroupCtrl', DialogEditGroupController);

    DialogEditGroupController.$inject = ['$scope', 'groupService', '$mdDialog', 'items', '$mdToast', '$timeout'];

    function DialogEditGroupController($scope, groupService, $mdDialog, items, $mdToast, $timeout) {

        $scope.group = items || {};

        $scope.title = items ? 'Редактировать "' + items.name +'"' : 'Добавить';

        $scope.ratingValue = [
            { 'id' : 1, 'name': 'Высокий' },
            { 'id' : 2, 'name': 'Средний' },
            { 'id' : 3, 'name': 'Низкий'  }
        ];
        $scope.group.rating = items ? items.rating : '3';
        $scope.edit = function (group) {

            if($scope.groupForm.$invalid){
                return false
            }

            var groupData = angular.copy(group);

            if (items === false) {
                $scope.createGroup(groupData);
            } else {
                if (_.has($scope, 'files.0')) {

                    var match = $scope.files[0].lfFileName.match(/[a-zA-Z]{3}$/);
                    groupData.imgNew = match[0];
                } else {
                    groupData.imgNew = 0;
                }

                groupService.update(groupData, groupData.id)
                    .then(function successCallback(response) {
                        if (response.data.imageName) {
                            uploadImg(response);
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

        function uploadImg(response) {


            var formData = new FormData();
            angular.forEach($scope.files,function(obj){
                if(!obj.isRemote){
                    formData.append('file', obj.lfFile);
                }
            });
                formData.append('id',response.data.id);
                formData.append('imageName',response.data.imageName);
            groupService.uploadImg(formData)
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
                }, function errorCallback(response) {
                   var message = _.get(response, 'data.name.0', 'Произошла системная ошибка, попробуйте позже');
                    $mdToast.show(
                        {
                            template: '<md-toast class="md-toast">' + message + '</md-toast>',
                            hideDelay: 2000,
                            position: 'bottom right'
                        }
                        );
                });

        };

        function getImgOriginalExtension() {

            if (_.has($scope,'files.0')) {

                var match = $scope.files[0].lfFileName.match(/[a-zA-Z]{3}$/);

                return match[0];
            } else {

                return false;
            }
        }
    }
})();