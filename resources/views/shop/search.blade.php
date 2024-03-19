@extends('shop.master')

@section('content')
<div class="container" >
    <div class="row  ">
        <div class="col-12 ">
            <div id="root"></div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{mix('js/search.js')}}"></script>
@endsection
