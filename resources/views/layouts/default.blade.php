<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <style>
        .logo {
            float: left;
            display: block;
            width:297px;
            height:60px;
        }
        .cart_png{
           width:50px;
        }
        
        .nemu {
         float: right;
         display: block;
         margin: 15px 0 0 10px;
         font-weight: bold;
         font-size: 16px;
         color:white;
        }
        
        .cart {
         float: right;
         display: block;
         width: 50px;
         height: 50px;
         background: url(cart.png) no-repeat;
         color:white;
     }
     
     header {
         height: 60px;
         background-color: #0D2851;
     }
        
        </style>

</head>
<body>
    <header>
        <div class="header-box">
          <a href="{{url('product_list')}}">
            <img class="logo" src="/img/codecamp_logo (1).png" alt="CodeSHOP">
          </a>
          <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                ログアウト
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        <a href="{{url('cart')}}" class="cart"><img class = "cart_png" src="/img/cart.png"></a>
          {{-- <p class="nemu">ユーザー名："{{$user->email}}"</p> --}}
        </div>
      </header>
    @yield('content')
</body>
</html>