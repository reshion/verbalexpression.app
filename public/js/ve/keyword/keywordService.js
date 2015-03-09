angular.module('veApp.keywordService', [])

    .factory('Keyword', function Keyword($http) {

        Keyword.keywords = [];

        Keyword.get = function () {
            return $http.get('/api/v1/keywords')
                .success(function (data) {
                    Keyword.keywords = angular.fromJson(data);
                })
                .error(function () {
                    //
                });
        };

        return Keyword;

    });
