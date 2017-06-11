(function () {
    'use strict';
    angular
        .module('app')
        .filter('sale', sale);
    sale.$inject = ['$parse'];

    function sale() {

        return function (input, sale) {
            //
            // input = input || '';
            var out = input;
            // conditional based on optional argument
            if (sale) {
                out = _.filter(input, function (song) {
                    return song.sale;
                })
            }
            
            return out;
        }

    }
})();