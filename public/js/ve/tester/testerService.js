angular.module('veApp.testerService', [])

    .service('Tester', function Tester($http) {

        Tester.matchresult = '';
        Tester.load = {type: 'info', message: 'Loading...'};

        Tester.match = function (regex, input) {

            return $http.post('api/v1/tester/match', {expression: regex, value: input})
                .success(function (data) {
                    var result = angular.fromJson(data);
                    var type = result ? 'success' : 'warning';
                    Tester.matchresult = {type: type, message: result};
                })
                .error(function (data) {
                    Tester.matchresult = angular.fromJson(data);
                });
        };

        Tester.resetResult = function () {

            Tester.matchresult = '';

        };

        return Tester;

    });
