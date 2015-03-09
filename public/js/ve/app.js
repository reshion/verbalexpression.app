var rmeApp = angular.module('veApp',
    [
        'ngRoute',
        'veApp.keywordService',
        'veApp.creatorService',
        'veApp.testerService',
        'veApp.creatorCtrl',
        'veApp.testerCtrl'
    ], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    })
    //.config(function ($routeProvider) {
    //    $routeProvider
    //        .when('/', {})
    //        .otherwise({
    //            redirectTo: '/'
    //        });
    //})
    ;