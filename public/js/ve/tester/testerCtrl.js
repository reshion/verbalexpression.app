angular.module('veApp.testerCtrl', [])

    .controller('testerController', function ($scope, $http, Creator, Tester) {

        var vm = this;

        vm.matchValue = "";
        vm.matchMessage = Tester.matchresult;

        vm.testMatch = function () {

            vm.matchMessage = Tester.load;

            Tester.match(Creator.expression.combined, vm.matchValue)
                .then(function () {
                    vm.matchMessage = Tester.matchresult;
                });
        };

        $scope.$watch(angular.bind(this, function () {
            return Tester.matchresult;
        }), function (newVal, oldVal) {
            vm.matchMessage = newVal;
        });


    });
