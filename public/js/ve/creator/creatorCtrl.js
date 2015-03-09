angular.module('veApp.creatorCtrl', [])

    .controller('creatorController', function ($scope, $http, Creator, Keyword, Tester) {

        // Binding
        vm = this;

        // Vars
        vm.error = Creator.load;
        vm.pairs = Creator.pairs;
        vm.regex = Creator.expression;

        vm.addPair = function (key, value, index) {
            Creator.add(key, value, index);
        };

        vm.removePair = function (index) {
            Creator.remove(index);
        };

        vm.reset = function () {

            Creator.reset();
            Tester.resetResult();
            vm.pairs = Creator.pairs;
            vm.regex = Creator.expression;
            vm.error = false;
            $('.creator-splash').hide();
        };

        vm.getRegex = function () {

            vm.error = Creator.load;
            Tester.resetResult();

            Creator.get()
                .then(function () {
                    vm.regex = Creator.expression;
                    vm.error = Creator.error;
                })
        };

        Keyword.get().then(function () {

            vm.keywords = Keyword.keywords;
            vm.reset();
        });

        $scope.$watch(angular.bind(this, function () {
            return Creator.error;
        }), function (newVal, oldVal) {
            vm.error = newVal;
        });

    });
