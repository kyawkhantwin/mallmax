<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&family=Roboto:wght@100;300;400;700&display=swap" rel="stylesheet">
{{--    Css--}}
    <link href="{{asset('dist/css/bootstrap.min.css')}}" rel="stylesheet" >  
{{--    font awesome--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    {{--    Toastify--}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    @yield('css')
    <style>
        *{
            font-family: 'Roboto Condensed', sans-serif;
            box-sizing: border-box;
        }

        .dash-hover:hover{
            background-color: #eeee;
        }



        .toastify {
            background: none;
        }

        .active{
           background-color:#0d6efd ;
           color: #fff ;
        }


    </style>
</head>
<body>
    


<div class="container-fluid" >
    <div class="row">
        <!-- NAVIGATION -->
        <div class="position-sticky z-100 top-0 left-0 bg-white col-12 col-md-2 border-end" >
            <div class="ps-3  " style="margin-left: -20px; ">
                <!-- logo -->
               <div class="d-flex justify-content-between  align-items-center">
                 <h1 class="text-primary d-inline p-4 ">MallMax</h1>
                <div class="d-md-none" id="hambuger" onclick=''>
                    <i class="fa-solid fa-bars fs-2"></i>
                </div></div>

                <!-- Elements -->
                <div class="d-none h-0 d-md-inline position-sticky z-100 top-0 left-0 text-center text-md-start" style=" font-size: 18px;padding-bottom:100px;" id="nav">
                    <p class="p-3 my-0 me-2 rounded dash-hover text-nowrap">
                        <a href="/admin/dashboard" class=" text-decoration-none text-dark link" >
                        <i class="fa fa-tv mx-2"></i>
                         Dashboard
                        </a>
                    </p>
                    <p class="p-3 my-0 me-2 rounded dash-hover">
                        <a href="/admin/category" class=" text-decoration-none text-dark link" >
                            <i class="fa fa-layer-group mx-2"></i>
                            Category
                        </a>
                    </p>
                    <p class="p-3 my-0 me-2 rounded dash-hover">
                        <a href="/admin/product" class=" text-decoration-none text-dark link" >
                            <i class="fa fa-boxes mx-2"></i>
                            Product
                        </a>
                    </p>
                    <p class="p-3 my-0 me-2 rounded dash-hover">
                        <a href="/admin/transaction" class=" text-decoration-none text-dark link">
                            <i class="fa fa-clipboard mx-2"></i>
                            Trasaction
                        </a>
                    </p>
                    <p class="p-3 my-0 me-2 rounded dash-hover  bg-danger mt-5">
                        <a href="/admin/logout" class=" text-decoration-none text-white  link">
                        <i class="fa fa-sign-out mx-2"></i>
                            LogOut
                        </a>
                    </p>
                </div>
            </div>
        </div>

        {{--    Category--}}
        <div class="col-12 col-md-10 p-0">
            <div class="">
               

                @yield('content')
            </div>
        </div>
    </div>
</div>


{{--Js script--}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-3i/mHpPbXQ2yVML2jwvuRU4ZRyY9Ukz7E52i5EQLhJEdZnSLaWoMp7EwMmulheGh" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{--Toastify--}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

{{--react --}}


{{--Custom script--}}
@yield('js')

<script>
    const hambuger = document.getElementById('hambuger');
    const nav = document.getElementById('nav');
   
    hambuger.addEventListener('click',function(){
        nav.classList.toggle('d-none')
    })

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
                className: 'bg-success',
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

   function setActive(element) {
        // Remove active class from all elements
        var elements = document.querySelectorAll('.link');
        elements.forEach(function (el) {
            el.classList.remove('active');
            element.parentElement.classList.add('dash-hover');

            element.classList.add('text-dark');
            element.classList.remove('text-white');
        });

        // Add active class to the clicked element
        element.parentElement.classList.add('active');
        element.parentElement.classList.remove('dash-hover');

        element.classList.add('text-white');
        element.classList.remove('text-dark');
    }

    document.addEventListener('DOMContentLoaded', function () {
  const currentUrl = window.location.href;
  const baseUrl = 'http://127.0.0.1:8000';
  const links = document.querySelectorAll('.link');

  links.forEach(function (link) {
    const constructedUrl = baseUrl + link.getAttribute('href');
    const constructedUrlSegments = constructedUrl.split('/');
    const currentUrlSegments = currentUrl.split('/');
    let urlsMatch = true;

    // Check if the arrays are equal or if the current URL is a subset of the constructed URL
    for (var i = 0; i < constructedUrlSegments.length; i++) {
      if (constructedUrlSegments[i] !== currentUrlSegments[i]) {
        urlsMatch = false;
        break;
      }
    }

    if (urlsMatch) {
      setActive(link);
    }
  });
});




</script>
</body>
</html>
