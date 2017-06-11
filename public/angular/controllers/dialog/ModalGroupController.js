(function () {
    'use strict';

    angular
        .module('app')
        .controller('ModalGroupCtrl', ModalGroupController);

    ModalGroupController.$inject = ['$scope', '$mdDialog', 'items', '$mdToast', '$timeout', 'APP', 'CRUD'];

    function ModalGroupController($scope, $mdDialog, items, $mdToast, $timeout, APP, CRUD) {

        $scope.group = items || {};

        $scope.title = items ? 'Редактировать "' + items.name + '"' : 'Добавить';

        $scope.ratingValue = [
            {'id': 1, 'name': 'Высокий'},
            {'id': 2, 'name': 'Средний'},
            {'id': 3, 'name': 'Низкий'}
        ];
        $scope.group.rating = items ? items.rating : '3';


        $scope.edit = edit;
        $scope.createGroup = createGroup;
        $scope.cancel = cancel;

        function edit(group) {

            if ($scope.groupForm.$invalid) {
                return false
            }

            var groupData = angular.copy(group);

            if (items === false) {
                $scope.createGroup(groupData);
            } else {
                if (_.has($scope, 'img.0')) {

                    var match = $scope.img[0].lfFileName.match(/[a-zA-Z]{3}$/);
                    groupData.img = match[0];
                } else {
                    groupData.img = 0;
                }

                CRUD.update(APP.GROUP_MODEL, groupData)
                    .then(function successCallback(response) {
                        if (response.data.imgName) {
                            uploadImg(response);
                        }
                        showMessageInToaster('Данные успешно измененны', 'success');
                        $mdDialog.hide(groupData);
                    }, function errorCallback() {
                        console.log('Error Update');
                    });
            }
        };
        function cancel(group) {
            $mdDialog.hide(group);
        };

        function uploadImg(response) {
            var formData = new FormData();
            angular.forEach($scope.img, function (obj) {
                if (!obj.isRemote) {
                    formData.append('img', obj.lfFile);
                }
            });
            formData.append('id', response.data.id);
            formData.append('imgName', response.data.imgName);
            CRUD.uploadFiles(APP.GROUP_MODEL, formData)
                .then(function successCallback(response) {
                    console.log('Saved images');
                }, function errorCallback() {
                    console.log('Error Upload');
                });
        }

        function createGroup(groupData) {

            groupData.img = getImgOriginalExtension();
            if (!groupData.img) {
                showMessageInToaster('Вы забыли загрузить картинку', 'error');
                return false;
            }
            if (!_.has(groupData, 'active')) {
                groupData.active = false;
            }


            CRUD.save(APP.GROUP_MODEL, groupData)
                .then(function successCallback(response) {
                    uploadImg(response);
                    showMessageInToaster('Сохраннено', 'success');
                    $mdDialog.hide(groupData);
                }, function errorCallback(response) {
                    var message = _.get(response, 'data.name.0', 'Произошла системная ошибка, попробуйте позже');
                    showMessageInToaster(message, 'error');
                });

        };

        function getImgOriginalExtension() {

            if (_.has($scope, 'img.0')) {

                var match = $scope.img[0].lfFileName.match(/[a-zA-Z]{3}$/);

                return match[0];
            } else {

                return false;
            }
        }

        function showMessageInToaster(message, type) {
            $mdToast.show(
                {
                    template: '<md-toast  class="md-toast ">'
                    + '<div class="md-toast-content">'
                    + message +
                    '</div>' +
                    '</md-toast>',
                    hideDelay: 3000,
                    position: 'bottom right',
                    toastClass: 'md-toast-' + type
                }
            );
        }
    }
})();