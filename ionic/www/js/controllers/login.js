angular.module('starter.controllers')
    .controller('LoginCtrl', ['$scope', 'OAuth', 'OAuthToken', '$state', '$ionicPopup', '$q',
        'UserData', 'User',
        function($scope, OAuth, OAuthToken, $state, $ionicPopup, $q, UserData, User){

        $scope.user = {
            username: '',
            password: ''
        };

        function adiarExecucao(){
            var deffered = $q.defer();
            setTimeout(function(){
                deffered.resolve({name: 'ionic'});
            });
            return deffered.promise;
        }

        var promise = adiarExecucao();

        $scope.login = function(){
            var promise = OAuth.getAccessToken($scope.user);
            promise
                .then(function(data){
                    return User.authenticated({include: 'client'}).$promise;
                })
                .then(function(data){
                    UserData.set(data.data);
                    $state.go('deliveryman.order');
                }, function(responseError){
                    UserData.set( null);
                    OAuthToken.removeToken();
                    $ionicPopup.alert({
                        title: 'Erro',
                        template: 'Login e/ou senha inválidos'
                    });
                    console.debug(responseError);
                });
        };
    }])

    .controller('HomeCtrl', ['$scope', function($scope){


    }]);