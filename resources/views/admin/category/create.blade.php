@extends("admin.home.home")

@section('content')
    <div class=" p-3">
        <a href="{{url("admin/category")}}" class="btn btn-info me-3 text-white "> All Category </a>
    </div>

    <div class="w-50 m-3">
        <form class="form border p-3" action="{{url("admin/category")}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mt-3">
                <label for="">Name</label>
                <input type="text" class="form-control mt-2" placeholder="Category Name" name="name">
            </div>

            @if($errors->has('name'))
                <ul class="list-unstyled">
                    @foreach($errors->get('name') as $err_message)
                        <li class="text-danger mt-2">
                            {{$err_message}}
                        </li>
                    @endforeach
                </ul>
            @endif

            <div class="mt-3">
                <label for="">Image</label>
                <input type="file" class="form-control mt-2" name="image">
            </div>
            @if($errors->has('image'))
                <ul class="list-unstyled">
                    @foreach($errors->get('image') as $err_message)
                        <li class="text-danger mt-2">
                            {{$err_message}}
                        </li>
                    @endforeach
                </ul>
            @endif

            <button class="btn btn-info mt-3 text-white">Create</button>
        </form>
    </div>
@endsection

