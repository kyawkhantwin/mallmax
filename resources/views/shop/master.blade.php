<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&family=Roboto:wght@100;300;400;700&display=swap" rel="stylesheet">
    <link href="{{asset('dist/css/bootstrap.min.css')}}" rel="stylesheet" >  
    <link href="{{asset('dist/photo')}}" rel="stylesheet" >

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    @yield('css')



    <style>
        *{
            font-family: 'Roboto Condensed', sans-serif;
        }

        .toastify {
            background: none;
        }
        .hover:hover{
            opacity: 60%;
            transition : ease-in 0.5 ;
        }

        .font-sm{
            font-size: 8px;
        }
        .font-md{
            font-size: 16px;
        }
        input:focus{
            outline: none;
        }
        body{
            background-color: #efefef;
        }
        .form-width{
            min-height: 68vh;
            width: 35vw;
        }
        @media screen and (max-width: 576px) {
            .form-width {
                width: 100vw;
                min-height: 68vh;
            }
        }
        @media screen and (max-width: 768px) {
            .form-width {
                width: 70vw;
                min-height: 68vh;
            }
        }
        @media screen and (max-width: 992px) {
            .form-width {
                width: 40vw;
                min-height: 68vh;
            }
        }
    </style>
</head>
<body>


    <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm position-sticky top-0 start-0 w-100 z-1">
        <div class="container">
            <a href="/" class="navbar-brand"><b class="text-black hover">MallMax</b></a>
            <a href="{{ url('/user/logout') }}" class="btn btn-danger text-white d-lg-none d-inline">Log out</a>
    
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav-toggle">
                <span class="navbar-toggler-icon"></span>
               
            </button>

    
            <div class="collapse navbar-collapse" id="nav-toggle">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex align-items-center justify-content-center">
                    @if(auth()->check())
                    <li class="nav-item ">
                        <a href="{{ url('/product/transaction')}}" class="nav-link me-4 hover text-dark text-decoration-none">
                            Transaction
                        </a>
                    </li>
                    <li class="nav-item d-none d-lg-inline">
                        <a href="{{ url('/user/logout') }}" class="btn btn-danger text-white">Log out</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ url('/user/logout') }}" class="btn btn-primary text-white">Log in</a>
                    </li>
                    @endif
                </ul>
    
                
    
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-center">
                    <form action="/product/search" class="d-flex align-items-center me-2 mb-2 mb-md-0">
                        <input name="query" type="search" class="form-control me-2" placeholder="Search anything you want">
                        <button class="btn btn-primary text-white">Search</button>
                    </form>
                
                    <a href="{{ url('/product/cart')}}" class="position-relative mx-auto ms-md-2 mt-3 mt-md-0">
                        <i class="fa-solid fa-cart-shopping hover text-primary fs-4"></i>
                        <span style="bottom: 75%" id='cart' class="position-absolute  left-0 badge bg-danger rounded-circle">{{ $cart_count ? $cart_count : 0 }}</span>
                    </a>
                    
                </div>
                
            </div>
        </div>
    </nav>
    
    
    

@yield('content')
<div class="fixed-bottom " style="bottom: 11%; left: 90%;">
    <a href="#" class="btn btn-info rounded-circle text-white d-flex justify-content-center align-items-center translate-middle" style="width: 50px;height: 50px;" role="button">
        <i class="fas fa-comment fs-4  fa-bounce" ></i>
    </a>
</div>

<!-- Footer Section -->
<footer class="bg-white text-dark text-center py-4">
    <div class="container">
        <p class="mb-0">© 2023 Kyaw Khant Win Project</p>
        <p class="mb-0">Crafted for portfolio</p>
        <p class="mb-0">Web Developer</p>
    </div>
</footer>


<!-- CON-->




{{--Js script--}}
<script type="text/javascript" src="{{asset('dist/js/bootstrap.min.js')}}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-3i/mHpPbXQ2yVML2jwvuRU4ZRyY9Ukz7E52i5EQLhJEdZnSLaWoMp7EwMmulheGh" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{--Toastify--}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>



<script>

    @if($errors ->any())
    @foreach($errors->all() as $error)
    Toastify({
        text: "{{$error}}",
        duration: 2500,
        className: 'bg-danger',
        gravity: "top", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
    }).showToast();
    @endforeach
    @endif

    @if(session()->has('success'))
    Toastify({
        text: "{{session('success')}}",
        duration: 2500,
        className: 'bg-primary',
        gravity: "top", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
    }).showToast();
    @endif
    @if(session()->has('error'))
    Toastify({
        text: "{{session('error')}}",
        duration: 2500,
        className: 'bg-danger',
        gravity: "top", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
    }).showToast();
    @endif

    window.cartCount = {{ $cart_count ? $cart_count : 0 }}
    window.auth = @json(auth()->user());

    window.updateCart = count => {
        const cart = document.getElementById('cart');
         cart.innerText = count;
    }

    const showToast = (message,type) => {
        Toastify({
        text: message,
        duration: 2500,
        className: type ==='success'? 'bg-primary': 'bg-danger',
        gravity: "top", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
    }).showToast();
    }


</script>

 @yield('script')

</body>
</html>
