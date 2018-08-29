@extends('layout.master')
@section('title', 'سامانه ' . $constant['name'])
@section('description', $constant['description'] )
@section('image', $constant['logo'])

@section('fluid-container')
    @if($constant['theme'] == 'batri')
        @include('user.index-batri')
    @elseif($constant['theme'] == 'holo')
        @include('user.index-holo')
    @else
        @include('user.index-batri')
    @endif
@endsection

@push('script')
<script>
$(document).ready(function(){
    $('#new-product-slider').owlCarousel({
        rtl:true,
        margin:0,
        autoWidth:true,
        lazyLoad:true,
        autoplay:true,
        autoplayTimeout:5000,
        autoplaySpeed:3000,
        autoplayHoverPause:true,
        loop:true,
    });
    $('#discount-product-slider').owlCarousel({
        rtl:true,
        margin:0,
        autoWidth:true,
        lazyLoad:true,
        autoplay:true,
        autoplayTimeout:6000,
        autoplaySpeed:1300,
        autoplayHoverPause:true,
        loop:true,
    });
    $('#right-slider').owlCarousel({
        rtl:true,
        items:1,
        // autoWidth:true,
        // margin:20,
        lazyLoad:true,
        autoplay:true,
        autoplayTimeout:5400,
        autoplaySpeed:1600,
        autoplayHoverPause:true,
        loop:true,
    });
    $('#left-slider').owlCarousel({
        rtl:true,
        items:1,
        // autoWidth:true,
        // margin:20,
        lazyLoad:true,
        autoplay:true,
        autoplayTimeout:6000,
        autoplaySpeed:1900,
        autoplayHoverPause:true,
        loop:true,
    });
    // $('#news-slider').owlCarousel({
    //     rtl:true,
    //     items:2,
    //     // autoWidth:true,
    //     // margin:20,
    //     lazyLoad:true,
    //     autoplay:true,
    //     autoplayTimeout:4000,
    //     autoplaySpeed:1900,
    //     autoplayHoverPause:true,
    //     loop:false,
    // });
    $('#brand-slider').owlCarousel({
        rtl:true,
        // items:4,
        margin:30,
        autoWidth:true,
        lazyLoad:true,
        autoplay:true,
        autoplayTimeout:4000,
        autoplaySpeed:1000,
        autoplayHoverPause:true,
        loop:true,
    });
});
</script>
@endpush

