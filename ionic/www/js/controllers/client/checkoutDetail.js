angular.module('starter.controllers')
    .controller('ClientCheckoutDetailCtrl', ['$scope', 'OAuth', '$state', '$ionicPopup', function($scope, OAuth, $state, $ionicPopup){

        $scope.user = {
            username: '',
            password: ''
        };

        $scope.login = function(){
            OAuth.getAccessToken($scope.user)
                .then(function(data){
                    $state.go('home');
                    //console.log(data);
                    //token = $cookies.getObject('token');
                    //console.log(token);
                    //console.log(token.access_token);
                }, function(responseError){
                    $ionicPopup.alert({
                        title: 'Erro',
                        template: 'Login e/ou senha inválidos'
                    });
                });
        };
    }]);