@extends("admin.home.home")

@section('content')
    <div class=" p-3">
        <a href="{{url("admin/product")}}" class="btn btn-info me-3 text-white "> All Product </a>
        <a class="btn btn-outline-primary " href="{{url('admin/product/create')}}">Create Product</a>
    </div>

    <div class="w-50 m-3">
        <form class="form border p-3" action="{{url("admin/product/".$product->slug)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="mt-3">
                <label for="">Name</label>
                <input type="text" class="form-control mt-2"  value="{{$product->name}}" placeholder="Category Name" name="name">
            </div>

{{--            Eroor name--}}
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
                <input type="file" class="form-control mt-2" id="imageInput"  name="image">

                <img src="{{$product -> image_url}}" class="mt-3" width="100" id="image" alt="">
            </div>

{{--            error image--}}
            @if($errors->has('image'))
                <ul class="list-unstyled">
                    @foreach($errors->get('image') as $err_message)
                        <li class="text-danger mt-2">
                            {{$err_message}}
                        </li>
                    @endforeach
                </ul>
            @endif

            <button class="btn btn-info mt-3 text-white">Edit</button>
        </form>
    </div>

    <script>
        const image = document.querySelector('#image');
        const fileInput = document.getElementById('imageInput');



        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            const fileUrl = URL.createObjectURL(file);
            image.src = fileUrl;
        });
    </script>
@endsection
