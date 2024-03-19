@extends("admin.home.home")

@section('content')

    <div class=" p-3">
        <a class="btn btn-info text-white" href="{{url('admin/category/create')}}">Create Category</a>
    </div>
    @if (!$categories)
    <div class="d-flex align-items-center justify-content-center" style="height: 70vh">
        <p class="text-muted ">No category to show
            <a class="btn btn-info text-white ms-3" href="{{url('admin/category/create')}}">Create Category</a>
        </p>
    </div>
    @else
    <table class="table table-striped table-bordered table-hover  mt-3 ">
        <thead>
            <tr>
                <th>No</th>
                <th>Image</th>
                <th>Name</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
           @foreach($categories as  $key => $category)
               <tr>
                   <td>{{$key + 1 }}</td>
                   <td>
                       <img src="{{$category -> image_url}}" class="img-thumbnail" width="70" alt="">
                   </td>
                   <td>{{$category -> name}}</td>
                   <td>
                       <form action="{{url('admin/category/'.$category->slug.'/edit')}}" method="GET" class="d-inline">
                           @csrf
                           <button class="btn btn-success">Edit</button>
                       </form>
                       <form action="{{url('admin/category/'.$category->slug)}}" method="POST" class="d-inline">
                           @csrf
                           @method('DELETE')
                           <button class="btn btn-danger">Delete</button>
                       </form>
                   </td>
               </tr>
           @endforeach
        </tbody>
    </table>
    {{$categories -> links()}}
    @endif
@endsection
