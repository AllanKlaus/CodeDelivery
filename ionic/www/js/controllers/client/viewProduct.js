angular.module('starter.controllers')
.controller('ClientCheckoutProductCtrl',
    ['$scope', 'OAuth', '$state', '$ionicPopup', 'Product', '$ionicLoading',
        function($scope, OAuth, $state, $ionicPopup, Product, $ionicLoading){
            $scope.products = [];
            $ionicLoading.show({
                template: 'Carregando...'
            });
            Product.query({}, function(data){
                $scope.products = data.data;
                $ionicLoading.hide();
            }, function(dataError){
                $ionicLoading.hide();
            });
    }]
);