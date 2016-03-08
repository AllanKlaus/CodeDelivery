angular.module('starter.controllers')
    .controller('ClientCheckoutCtrl', [
        '$scope', '$state', '$cart', 'ClientOrder', '$ionicLoading', '$ionicPopup', 'Cupom', '$cordovaBarcodeScanner', 'User',
        function($scope, $state, $cart, ClientOrder, $ionicLoading, $ionicPopup, Cupom, $cordovaBarcodeScanner, User){
            User.authenticated({}, function(data){
                console.log(data.data);
            }, function(error){
                console.log(error);
            });

            var cart = $cart.get();
            $scope.cupom = cart.cupom;
            $scope.items = cart.items;
            $scope.total = $cart.getTotalFinal();
            //$scope.showDelete = true;

            $scope.removeItem = function(i){
                $cart.removeItem(i);
                $scope.items.splice(i, 1);
                $scope.total = $cart.getTotalFinal();
            };

            $scope.openProductDetail = function(i){
                $state.go('client.checkout_item_detail', {index : i});
            };

            $scope.openListProducts = function(){
                $state.go('client.view_products');
            };

            $scope.save = function(){
                var o = {items: angular.copy($scope.items)};
                angular.forEach(o.items, function(item){
                    item.product_id = item.id;
                });

                $ionicLoading.show({
                    template: 'Carregando...'
                });

                if($scope.cupom.value){
                    o.cupom_code = $scope.cupom.code;
                }

                ClientOrder.save({id:null}, o, function(data){
                    $ionicLoading.hide();
                    $state.go('client.checkout_successful');
                }, function(responseError){
                    $ionicLoading.hide();
                    $ionicPopup.alert({
                        title: 'Erro',
                        template: 'Pedido não realizado'
                    });
                });
            };

            $scope.readBarCode = function(){
                //getValueCupom(5959);
                $cordovaBarcodeScanner
                    .scan()
                    .then(function(barcodeData) {
                        getValueCupom(barcodeData.text);
                    }, function(error) {
                        console.log(error)
                        $ionicPopup.alert({
                            title: 'Erro',
                            template: 'Não foi possivel ler o QR Code'
                        });
                    });
            };

            $scope.removeCupom = function(){
                $cart.removeCupom();
                $scope.cupom = $cart.get().cupom;
                $scope.total = $cart.getTotalFinal();
            };

            function getValueCupom(code){
                $ionicLoading.show({
                    template: 'Carregando...'
                });

                Cupom.get({code:code}, function(data){
                    $ionicLoading.hide();
                    $cart.setCupom(data.data.code, data.data.value);
                    $scope.cupom = $cart.get().cupom;
                    $scope.total = $cart.getTotalFinal();
                }, function(responseError){
                    $ionicLoading.hide();
                    console.log(code, responseError);
                    $ionicPopup.alert({
                        title: 'Erro',
                        template: 'Cupom não encontrado'
                    });
                });
            }
    }]);