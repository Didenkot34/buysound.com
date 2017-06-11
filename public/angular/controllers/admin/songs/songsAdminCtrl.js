(function () {
    'use strict';
    angular
        .module('app')
        .controller('songsAdminCtrl', songsAdminCtrl);

    songsAdminCtrl.$inject = [
        '$scope',
        'groupService',
        '$mdToast',
        '$mdDialog',
        '$sce',
        'APP',
        'CRUD'
    ];

    function songsAdminCtrl($scope, groupService, $mdToast, $mdDialog, $sce, APP, CRUD) {

        $scope.getAudioUrl = getAudioUrl;
        $scope.getAllSongs = getAllSongs;
        $scope.getAllGroups = getAllGroups;
        $scope.addSong = addSong;
        $scope.deleteSong = deleteSong;
        $scope.editSong = editSong;


        $scope.getAllSongs();
        $scope.getAllGroups();

        function getAudioUrl(song) {
            var url = '/uploads/songs/audio/' + song.id + '/' + song.audio;
            return $sce.trustAsResourceUrl(url);
        };

        function getAllSongs() {
            CRUD.getAll(APP.SONG_MODEL)
                .then(function successCallback(response) {
                    $scope.songs = null;
                    if (_.get(response, 'data.songs.length', false)) {
                        $scope.songs = response.data.songs;
                    }

                }, function errorCallback() {
                    console.log('Error Get All');
                });
        };
        function getAllGroups() {
            groupService.getAll()
                .then(function successCallback(response) {
                    $scope.groups = null;
                    if (_.get(response, 'data.groups.length', false)) {
                        $scope.groups = response.data.groups;
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
                    items: false,
                    groups: $scope.groups,
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

                CRUD.delete(APP.SONG_MODEL, song.id)
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
                    items: song,
                    groups: $scope.groups,
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
