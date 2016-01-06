angular.module('starter.controllers')
    .controller('LoginCtrl', ['$scope', 'OAuth', '$state', '$ionicPopup', function($scope, OAuth, $state, $ionicPopup){

        $scope.user = {
            username: '',
            password: ''
        };

        $scope.login = function(){
            OAuth.getAccessToken($scope.user)
                .then(function(data){
                    console.log(data);
                    $state.go('client.checkout');
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
    }])

    .controller('HomeCtrl', ['$scope', function($scope){


    }]);