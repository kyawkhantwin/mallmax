@extends('shop.master')
@section('css')

@endsection
@section('content')
    <div id="root" style="" class="mt-5 form-width rounded bg-primary text-white container ">
        <div class="row" >
            <div class="mt-5 p-5">
                <h1 class='text-center '>MallMax</h1>
                <h3 class='text-center mt-3 mb-3'>Login</h3>
                <form action="{{url('user/login')}}" method='POST'>
                    @csrf
                    <div class='mb-3'>
                        <label for="Email" class='mb-2' >Email</label>
                        <input type="email" name="email" class="form-control"
                               placeholder="Enter Your Email"/>
                    </div>
                    <div class='mb-3'>
                        <label for="password" class='mb-2' >Password</label>
                        <input type="password" name="password" class="form-control"
                               placeholder="Enter Your Password"/>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <button class="btn btn-info text-white w-25 text-center">Login</button>
                    </div>
                </form>
                <hr class='mt-5'/>
                <p class='text-center mt-3'>Don't have account? <a class="text-info" href="/user/register">Register Now</a> </p>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
