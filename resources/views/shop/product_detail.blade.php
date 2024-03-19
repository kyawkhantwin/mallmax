
@extends('shop.master')

@section('css')
    <style>
        body{
            background-color: #efefef;
        }
        .spilt{
            margin: -24px 0 !important;
            width: 5.333333% !important;
        }
        @media  screen and (max-width: 765px) {
            .spilt{
                margin:15px 0 !important;
                width: 8.333333% !important;
            }

        }
    </style>
@endsection

@section('content')
    <div data-slug="{{$slug}}" id="root"></div>
@endsection

@section('script')
    <script src="{{mix('js/product_detail.js')}}"></script>

    <script>
        window.slug = '{{$slug}}';
    </script>
@endsection
