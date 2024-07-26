<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titlepage')</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{asset('css/tiny-slider.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">


</head>

<body ng-app="tcApp" ng-controller="tcCtrl">
    <header>
        @include('header')
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        @include('footer')
    </footer>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/tiny-slider.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>

</body>
<script>
    var app = angular.module('tcApp', []);
    app.controller('tcCtrl', function($scope, $http){
        $scope.cart = {!! json_encode(session()->get('cart')) !!} || [];
        $scope.addToCart =function(product_id, quantity){
            $http.post('/api/cart',{
                product_id: product_id,
                quantity: quantity,
            }).then(function(res){
                $scope.cart = res.data.data;
            })
        }
        $scope.totalCartMoney =function(){
            var total = 0;
            $scope.cart.forEach(sp=> {
                total += sp.quantity * ((sp.sale_price!=null)?sp.sale_price:sp.price);
            });
            return total;
        }
        $scope.deleteFromCart =function($index){
            $http.delete('/api/cart/'+$index).then(function(res){
                $scope.cart = res.data.data;
            });

        }
    });
    var viewFunction =function($scope){};
  </script>
  @yield('viewFunction')
  <script>
    app.controller('viewCtrl', viewFunction);
  </script>
</html>
