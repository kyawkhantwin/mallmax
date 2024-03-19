@extends('shop.master')

@section('content')
    <div id="root"  class="form-width mt-5 rounded bg-primary text-white container ">
        <div class="row" >
            <div class="mt-5 p-5">
                <h1 class='text-center '>MallMax</h1>
                <h3 class='text-center mt-3 mb-3'>Admin Register </h3>
                <form action="{{url('admin/register')}}" method='POST' enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12  col-xl-6">
                            <div class='mb-3'>
                                <label for="image" class='mb-2' >Profile image</label>
                                <input type="file" name="image" class="form-control"
                                       placeholder="Profile image"/>
                            </div>
                            <div class='mb-3'>
                                <label for="Email" class='mb-2' >Email</label>
                                <input type="email" name="email" class="form-control"
                                       placeholder="Email"/>
                            </div>
                            <div class='mb-3'>
                                <label for="name" class='mb-2' >Username</label>
                                <input type="text" name="name" class="form-control"
                                       placeholder="Admin name"/>
                            </div>
                            <div class='mb-3'>
                                <label for="password" class='mb-2' >Password</label>
                                <input type="password" name="password" class="form-control"
                                       placeholder="Password"/>
                            </div>
                        </div>
                        <div class="col-12  col-xl-6">
                            <div class='mb-3'>
                                <label for="address" class='mb-2' >Phone Number</label>
                                <input type="number" name="phone" class="form-control"
                                       placeholder="Phone Number"/>
                            </div>
                            <div class='mb-3'>
                                <label for="address" class='mb-2' >Address</label>
                                <textarea name="address" placeholder="House No,Township, City" class="form-control" id=""  rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <button class="btn btn-info text-white w-25 text-center">Register</button>
                    </div>
                </form>
                <hr class='mt-5'/>
                <p class='text-center mt-3'>Already Register The Admin Account? <a class="text-info" href="/admin/login">Login</a> </p>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
