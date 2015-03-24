angular.module('veApp.creatorService', [])

    .factory('Creator', function Creator($http) {

        Creator.expression = '';
        Creator.error = '';
        Creator.pairs = [];
        Creator.load = {type: 'info', message: 'Loading ...'};

        Creator.get = function () {

            return $http.post('api/v1/creator/create', {pairs: Creator.preparePairs()})
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
            return Creator.pairs;
        };

        Creator.reset = function () {

            Creator.expression = '';
            Creator.error = '';
            Creator.pairs = [];
            Creator.add('', '', 0);

        };

        Creator.preparePairs = function () {
            var pairs = [];

            for (var i = 0; i < Creator.pairs.length; i++) {
                var entry = Creator.pairs[i];
                pairs.push({keyword: entry.keyword.key, value: entry.value});
            }

            return pairs;
        };

        return Creator;

    });
