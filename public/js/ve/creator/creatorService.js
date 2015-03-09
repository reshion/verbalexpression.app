angular.module('veApp.creatorService', [])

    .factory('Creator', function Creator($http) {

        Creator.expression = '';
        Creator.error = '';
        Creator.pairs = [];
        Creator.load = {type: 'info', message: 'Loading ...'};

        Creator.get = function () {

            return $http.post('api/v1/creator/create', {pairs: Creator.pairs})
                .success(function (data) {
                    Creator.expression = data;
                    Creator.error = '';
                })
                .error(function (data) {
                    Creator.expression = '';
                    Creator.error = data;
                });
        };

        Creator.add = function (keyword, value, index) {

            var obj = {keyword: keyword, value: value};
            Creator.pairs.splice(index, 0, obj);
            return Creator.pairs;
        };

        Creator.remove = function (index) {

            Creator.pairs.splice(index, 1);

        };

        Creator.reset = function () {

            Creator.expression = '';
            Creator.error = '';
            Creator.pairs = [];
            Creator.add('', '', 0);

        };

        return Creator;

    });
