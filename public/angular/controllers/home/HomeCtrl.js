(function () {
    'use strict';
    angular
        .module('app')
        .controller('HomeCtrl', HomeCtrl);

    HomeCtrl.$inject = [
        '$scope',
        'songsService',
        '$mdToast',
        '$mdDialog',
        '$sce'
    ];

    function HomeCtrl($scope, songsService, $mdToast, $mdDialog, $sce) {

        $scope.getAudioUrl = getAudioUrl;
        $scope.getAllSongs = getAllSongs;
        $scope.addSong = addSong;
        $scope.deleteSong = deleteSong;
        $scope.editSong = editSong;
        $scope.data = {
            cb1: true,
            cb4: true,
            cb5: false
        };

        $scope.getAllSongs();

        function getAudioUrl(song) {
            var url = '/uploads/songs/audio/' + song.id + '/' + song.audio;
            return $sce.trustAsResourceUrl(url);
        };

        function getAllSongs() {
            songsService.getAll()
                .then(function successCallback(response) {
                    $scope.songs = null;
                    if (_.get(response, 'data.songs.length', false)) {
                        $scope.songs = response.data.songs;
                    }

                }, function errorCallback() {
                    console.log('Error Get All');
                });
        };
        function addSong(ev) {

            $mdDialog.show({
                controller: 'ModalSongCtrl',
                templateUrl: '/views/app/admin/songs/modal/form.html',
                parent: angular.element(document.body),
                targetEvent: ev,
                locals: {
                    items: false
                },
                clickOutsideToClose: true,
                fullscreen: true
            }).then(function (answer) {
                $scope.getAllSongs();
            }, function () {
            });
        };
        function deleteSong(ev, song) {

            var confirm = $mdDialog.confirm()
                .title('Would you like to delete ' + song.name + '?')
                .textContent('All of the banks have agreed to forgive you your debts.')
                .targetEvent(ev)
                .ok('Yes!')
                .cancel('No');

            $mdDialog.show(confirm).then(function () {

                songsService.deleteSong(song.id)
                    .then(function successCallback(response) {
                        $scope.getAllSongs();
                    }, function errorCallback() {
                        console.log('Error');
                    });
            }, function () {
                console.log('Did\'t delete this song')
            });

        };

        function editSong(ev, song) {

            $mdDialog.show({
                controller: 'ModalSongCtrl',
                templateUrl: '/views/app/admin/songs/modal/form.html',
                parent: angular.element(document.body),
                targetEvent: ev,
                locals: {
                    items: song
                },
                clickOutsideToClose: true,
                fullscreen: true
            }).then(function (answer) {
                $scope.getAllSongs();
            }, function () {
            });
        };


    }
})();
