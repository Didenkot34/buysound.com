(function () {
    'use strict';
    angular
        .module('app')
        .controller('HomeSongsCtrl', HomeSongsCtrl);

    HomeSongsCtrl.$inject = [
        '$scope',
        '$mdToast',
        '$mdDialog',
        '$sce',
        'APP',
        'CRUD'
    ];

    function HomeSongsCtrl($scope, $mdToast, $mdDialog, $sce, APP, CRUD) {

        $scope.filter = {};
        $scope.filter.sale = false;
        $scope.getAudioUrl = getAudioUrl;
        $scope.getAllSongs = getAllSongs;
        $scope.setFilterSale = setFilterSale;

        $scope.getAllSongs();

        function setFilterSale(sale) {
            $scope.search = null;
            $scope.filter.sale = sale;
        }

        function getAudioUrl(song) {
            var url = APP.PATH_FOLDER_AUDIO + song.id + '/' + song.audio;
            return $sce.trustAsResourceUrl(url);
        }

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
        }



    }
})();
