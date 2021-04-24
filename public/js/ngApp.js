'use strict';


var url_s = "http://127.0.0.1:8000/", url_i = "http://127.0.0.1:8000/";

app.run(function ($rootScope, $location, $http, $window) {
    $rootScope.loadingPage = false;
    $rootScope.errorMessage = false;
    $rootScope.$on("$routeChangeStart", function (event, next, current) {
        $rootScope.errorMessage = false;

    });
    $rootScope.$on('nodata', function (event) {
        $rootScope.errorMessage = "Aucune donnée reçue";
    });
    $rootScope.$on('unauthorized', function (event) {
        $rootScope.errorMessage = "Veuillez vous connecter d'abord";
    });
    $rootScope.$on('forbidden', function (event) {
        $rootScope.errorMessage = "Clé de sécurité invalide, veuillez vous reconnecter";
    });
    $rootScope.$on('timeout', function (event) {
        $rootScope.errorMessage = "La requête a mis trop de temps, veuillez reessayer";
    });
    $rootScope.$on('unknown', function (event) {
        $rootScope.errorMessage = "Une erreur inconnue s'est produite";
    });
});

// app.service('APIInterceptor', function ($rootScope, c_sv) {
//     var service = this;
//     service.request = function (config) {
//         $rootScope.errorMessage = false;
//         // config.headers['X-CSRF-Token'] = c_sv.get('csrfToken');
//         // config.headers._csrfToken = c_sv.get('csrfToken');
//         // if (config.data) {
//         //     config.data._csrfToken = c_sv.get('csrfToken');
//         // }
//         // if (localStorage.token_g) { config.timeout = 60000; config.headers.authorization = 'Bearer ' + localStorage.token_g;}
//         return config;
//     };
//     service.responseError = function (response) {
//         switch (response.status) {
//             case 204:$rootScope.$broadcast('nodata');break;
//             case 401:$rootScope.$broadcast('unauthorized');break;
//             case 403:$rootScope.$broadcast('forbidden');break;
//             case 408:$rootScope.$broadcast('timeout');break;
//             case 500:$rootScope.$broadcast('nodata');break;
//             default:$rootScope.$broadcast('unknown');break;
//         }
//         return response;
//     };
// });

app.config(function ($routeProvider, $sceDelegateProvider, $httpProvider) {
    $sceDelegateProvider.resourceUrlWhitelist(['self', url_s + '**', url_i + '**']);
    // $httpProvider.interceptors.push('APIInterceptor');
    $httpProvider.defaults.useXDomain = true;

});


app.controller('cpController', function ($scope, $resource) {
    $scope.compte = null;
    $scope.searchClient = function () {
        $scope.loading = true;
        $resource('/api/client/search').
        save({},{key:$scope.key}).$promise
        .then(function(data) {
            $scope.compte = data;
            $scope.loading = false;
        });
        // $source.save($params, $data).then(function(data) {
        //     console.log(data);
        // });
        // a_sv.save(r_sv.t_, {param: 'abus'}, $scope.abus).then(function (response) {
        //     console.log(response);
        //     // $scope.abus.succes = true;
        // }, function(e) {}).finally(function() {  });
    }
});
