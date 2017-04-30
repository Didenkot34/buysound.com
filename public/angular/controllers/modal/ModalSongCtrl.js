(function () {
    'use strict';

    angular
        .module('app')
        .controller('ModalSongCtrl', ModalSongCtrl);

    ModalSongCtrl.$inject = ['$scope', 'songsService', '$mdDialog', 'items', '$mdToast', '$timeout'];

    function ModalSongCtrl($scope, songsService, $mdDialog, items, $mdToast, $timeout) {

        $scope.song = items || {};

        $scope.title = items ? 'Редактировать "' + items.name + '"' : 'Добавить';

        $scope.ratingValue = [
            {'id': 1, 'name': 'Высокий'},
            {'id': 2, 'name': 'Средний'},
            {'id': 3, 'name': 'Низкий'}
        ];
        $scope.song.rating = items ? items.rating : '3';


        $scope.edit = edit;
        $scope.createSong = createSong;
        $scope.cancel = cancel;

        function edit(group) {

            if ($scope.songForm.$invalid) {
                return false
            }

            var songData = angular.copy(group);

            if (items === false) {
                $scope.createSong(songData);
            } else {
                
                songData.img = getFileOriginalExtension('img');
                songData.audio = getFileOriginalExtension('audio');

                songsService.update(songData, songData.id)
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
            songsService.uploadFiles(formData)
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


            songsService.save(songData)
                .then(function successCallback(response) {
                    uploadImg(response);
                    showMessageInToaster('Сохраннено', 'success');
                    $mdDialog.hide(songData);
                }, function errorCallback(response) {
                    var message = _.get(response, 'data.name.0', 'Произошла системная ошибка, попробуйте позже');
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