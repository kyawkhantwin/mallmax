@extends("admin.home.home")

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection


@section('content')
    <div class=" p-3">
        <a href="{{url("admin/product")}}" class="btn btn-info me-3 text-white "> All Product </a>
    </div>
    <form class="form  ms-0" action="{{url("admin/product")}}" method="POST" enctype="multipart/form-data">
        <div class="container-fluid my-0">
            <div class="row">
                <div class="col-5">
                    @csrf
                    <div class="card p-3">
                        <div class="mt-3">
                               <label for="">Name</label>
                               <input type="text" class="form-control mt-2" placeholder="Product Name" name="name">
                           </div>
                        <div class="mt-3">
                               <label for="">Image</label>
                               <input type="file" class="form-control mt-2" name="image">
                           </div>
                        <div class="mt-3">
                               <label for="">Description</label>
                               <textarea id="summernote" class="form-control mt-2"
                                         name="description" style="height: 200px">

                               </textarea>
                           </div>
                        <div class="mt-3">
                               <label for="">Total Quantity</label>
                               <input type="number" class="form-control mt-2" name="total_qty">
                           </div>
                        <div class="mt-3">
                               <label for="">Price</label>
                               <input type="number" class="form-control mt-2" name="sale_price">
                           </div>
                        <div class="mt-3">
                               <label for="">Discount</label>
                               <input type="number" class="form-control mt-2" name="discount_price">
                           </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card p-3">
                        <div class="mt-3">
                            <label for="">Supplier</label>
                            <select class="form-select mt-3"  name="supplier">
                                <option selected disabled>Choose the Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{$supplier->slug}}">{{$supplier ->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="">Category</label>
                            <select class="form-select mt-3" name="category">
                            <option selected disabled>Choose the Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->slug}}">{{$category ->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="" >Color</label>
                            <select class="form-select mt-3 p-3"  name="color[]" id="color" multiple>

                                @foreach($colors as $color)
                                    <option value="{{$color->slug}}">{{$color ->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="">Brand</label>
                            <select class="form-select mt-3" name="brand">
                                <option selected disabled>Choose Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{$brand->slug}}">{{$brand ->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-end mt-3">
                            <button class="btn btn-primary mt-3 text-white">Create</button>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    @if($errors->any())
                        <div class="card">
                            <h3 class="text-danger m-3">Error</h3>
                            <ol class="m-3">
                                @foreach($errors->all() as $err)
                                    <li class="text-danger ">{{$err}}</li>
                                @endforeach
                            </ol>
                        </div>
                    @endif
                </div>
            </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder:  'product description',
                focus: true,
                tooltip:null,
                minHeight:200,
            });


        });
        $('#color').select2({
            placeholder:'Choose the color',
            color:'black',
        });

    </script>
@endsection
