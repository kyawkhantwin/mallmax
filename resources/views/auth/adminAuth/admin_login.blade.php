@extends('shop.master')

@section('content')
    <div id="root"  class="form-width mt-5 rounded bg-primary text-white container ">
        <div class="row" >
            <div class="mt-5 p-5">
                <h1 class='text-center '>MallMax</h1>
                <h3 class='text-center mt-3 mb-3'>Admin Login</h3>
                <form action="{{url('admin/login')}}" method='POST'>
                    @csrf
                    <div class='mb-3'>
                        <label for="Email" class='mb-2' >Admin Email</label>
                        <input type="email" name="email" class="form-control"
                               placeholder="Enter Your Admin Email"/>
                    </div>
                    <div class='mb-3'>
                        <label for="password" class='mb-2' >Admin Password</label>
                        <input type="password" name="password" class="form-control"
                               placeholder="Enter Your Admin Password"/>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <button class="btn btn-info text-white w-25 text-center">Login</button>
                    </div>
                </form>
                <hr class='mt-5'/>
                <p class='text-center mt-3'>Don't have account? <a class="text-info" href="/admin/register">Register Now</a> </p>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
