@extends('shop.master')

@section('content')
<div class="container" >
    <div class="row  ">
        <div class="col-12 ">
            <div data-order-id="{{$id}}" id="root"></div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{mix('js/transaction_detail.js')}}"></script>
@endsection
