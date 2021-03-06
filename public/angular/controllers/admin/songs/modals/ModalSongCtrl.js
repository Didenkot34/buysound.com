(function () {
    'use strict';

    angular
        .module('angularMaterialAdmin')
        .controller('ModalSongCtrl', ModalSongCtrl);

    ModalSongCtrl.$inject = ['$scope', '$mdDialog', 'items', 'groups', '$mdToast', '$timeout', 'CRUD', 'APP'];

    function ModalSongCtrl($scope, $mdDialog, items, groups, $mdToast, $timeout, CRUD, APP) {

        $scope.song = items || {};

        $scope.title = items ? 'Редактировать "' + items.name + '"' : 'Добавить';

        $scope.ratingValue = [
            {'id': 1, 'name': 'Высокий'},
            {'id': 2, 'name': 'Средний'},
            {'id': 3, 'name': 'Низкий'}
        ];
        $scope.song.rating = items ? items.rating : '3';

        $scope.groups = angular.copy(groups);
        $scope.edit = edit;
        $scope.createSong = createSong;
        $scope.cancel = cancel;

        function edit(data) {

            if ($scope.songForm.$invalid) {
                return false
            }

            var songData = angular.copy(data);

            if (items === false) {
                $scope.createSong(songData);
            } else {

                songData.img = getFileOriginalExtension('img');
                songData.audio = getFileOriginalExtension('audio');

                CRUD.update(APP.SONG_MODEL, songData)
                    .then(function successCallback(response) {
                        if (response.data.imgName || response.data.audioName) {
                            uploadImg(response);
                        }
                        showMessageInToaster('Данные успешно измененны', 'success');
                        $mdDialog.hide(songData);
                    }, function errorCallback() {
                        console.log('Error Update');
                    });
            }
        };

        function cancel(song) {
            $mdDialog.hide(song);
        };

        function uploadImg(response) {
            var formData = new FormData();
            angular.forEach($scope.img, function (obj) {
                if (!obj.isRemote) {
                    formData.append('img', obj.lfFile);
                }
            });
            angular.forEach($scope.audio, function (obj) {
                if (!obj.isRemote) {
                    formData.append('audio', obj.lfFile);
                }
            });
            formData.append('id', response.data.id);
            formData.append('imgName', response.data.imgName);
            formData.append('audioName', response.data.audioName);
            CRUD.uploadFiles(APP.SONG_MODEL, formData)
                .then(function successCallback(response) {
                    console.log('Saved images');
                }, function errorCallback() {
                    console.log('Error Upload');
                });
        }

        function createSong(songData) {

            songData.img = getFileOriginalExtension('img');
            songData.audio = getFileOriginalExtension('audio');
            if (!songData.img) {
                showMessageInToaster('Вы забыли загрузить картинку', 'error');
                return false;
            }
            if (!songData.audio) {
                showMessageInToaster('Вы забыли загрузить аудио', 'error');
                return false;
            }
            if (!_.has(songData, 'active')) {
                songData.active = false;
            }


            CRUD.save(APP.SONG_MODEL, songData)
                .then(function successCallback(response) {
                    uploadImg(response);
                    showMessageInToaster('Сохраннено', 'success');
                    $mdDialog.hide(songData);
                }, function errorCallback(response) {
                    var message = _.get(response, 'data.name.0', 'Произошла системная ошибка, попробуйте позже');
                    console.log(response);
                    showMessageInToaster(message, 'error');
                });

        };

        function getFileOriginalExtension(type) {


            if (_.has($scope, type + '.0')) {

                var match = ($scope[type][0]).lfFileName.match(/[a-zA-Z0-9]{3}$/);
                return match[0];
            } else {
                return 0;
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