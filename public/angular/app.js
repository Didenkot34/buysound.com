
(function() {
    'use strict';

   var module = angular
        .module('app',[
           // 'ui.router',
            //'ui.bootstrap',
            // 'ngAnimate',
            'ngMaterial',
            'ngMessages',
            'lfNgMdFileInput'
        ]);

        module.constant('APP', {
        SONG_MODEL        : 'songs',
        GROUP_MODEL       : 'groups',
        PATH_FOLDER_AUDIO : '/uploads/songs/audio/',
    });

    return module;
})();
