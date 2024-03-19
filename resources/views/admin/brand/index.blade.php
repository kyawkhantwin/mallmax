@extends("admin.home.home")

@section('content')

    <div class=" p-3">
        <a class="btn btn-info text-white" href="{{url('admin/brand/create')}}">Add Brand</a>
    </div>
    @if (!$brands )
    <div class="d-flex align-items-center justify-content-center" style="height: 70vh">
        <p class="text-muted ">No brand to show
            <a class="btn btn-info text-white ms-3" href="{{url('admin/brand/create')}}">Add new product brand</a>
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
           @foreach($brands as  $key => $brand)
               <tr>

                   <td>{{$key + 1 }}</td>
                   <td>
                       <img src="{{$brand -> image_url}}" class="img-thumbnail" width="70" alt="">
                   </td>
                   <td>{{$brand -> name}}</td>
                   <td>
                       <form action="{{url('admin/brand/'.$brand->slug.'/edit')}}" method="GET" class="d-inline">
                           @csrf
                           <button class="btn btn-success">Edit</button>
                       </form>
                       <form action="{{url('admin/brand/'.$brand->slug)}}" method="POST" class="d-inline">
                           @csrf
                           @method('DELETE')
                           <button class="btn btn-danger">Delete</button>
                       </form>
                   </td>
               </tr>
           @endforeach
        </tbody>
    </table>
{{$brands -> links()}}
    @endif
@endsection
