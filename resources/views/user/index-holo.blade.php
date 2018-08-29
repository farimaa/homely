<div class="row">
    <div class="col-xs-10 col-xs-offset-1 text-center">         
        <h1 class="bold page-header hug-size">
            <img src="{{ asset('upload/images/header_holoo.png') }}" class="img-responsive">
        </h1>
    </div>
</div>
<div class="seperate"></div>
<div class="display-none">
    {{ $product = $new_products[0] }}
</div>
<div class="text-center">
    <a href="/product/{{$product->id}}">
    <div class="product-image-container">
        <img src="{{ asset($product->base_image() ) }}" class="product-image" 
            style="max-height: 400px;width: auto;color: red;">
    </div>
    <div class="seperate"></div>
    <p class="product-name" style="font-size: 22px;">
        {{ $product->title }}
    </p>
    <div class="one-third-seperate"></div>
    @if($product->discount_price)
        <p class="product-price">
        {{ number_format($product->discount_price) }} تومان
        </p>
        <!-- <p class="product-discount">
            <span >
                {{ number_format($product->price) }}
            </span>
        </p> -->
    @else
        <p class="product-price">
        {{ number_format($product->price) }} تومان
        </p>
    @endif
    </a>
</div>

<!-- end products slider -->
<div class="seperate"></div>
<div class="row">
    <div class="col-sm-6">
        <div class="owl-carousel" id="right-slider">
            @each('common.slider-box', $baners_right_slider, 'baner')
        </div>
    </div> 
    <div class="col-sm-6">
        <div class="owl-carousel" id="left-slider">
            @each('common.slider-box', $baners_left_slider, 'baner')
        </div>
    </div>
</div>
<div class="seperate"></div>
<!-- begin products slider -->

<div class="seperate"></div>
<div class="seperate"></div>
<!-- begin news slider -->
<div class="row">
    <div class="col-xs-12">
        <div class="row text-center background-gradiant-3">
            <div class="col-xs-12">
                <h4>اخبار </h4>
            </div>
        </div>
        <div class="seperate"></div>
        <div class="row">
            <div id="news-slider">
                @each('common.news-box', $newses, 'news')
            </div>
        </div>
    </div>
</div>
<!-- end news slider -->
<div class="seperate"></div>
<div class="seperate"></div>
<!-- begin news slider -->
<div class="row text-center">   
    <div class="col-sm-4">
        <img src="{{ asset('/images/why-3.png') }}" width="70px" alt="مرحله ۱">
        <div class="half-seperate"></div>
        <h5 class="bold">
        گارانتی زمان تحویل محصول
        <div class="half-seperate"></div>
        <small>هر سفارشی در زودترین زمان ممکن توسط این فروشگاه ارسال می شود.</small>
        </h5>
        <div class="half-seperate"></div>
    </div>
    <div class="col-sm-4">
        <img src="{{ asset('/images/why-1.png') }}" width="70px" alt="مرحله ۲">
        <div class="half-seperate"></div>
        <h5 class="bold">
        ضمانت اصل بودن کالا
        <div class="half-seperate"></div>
        <small>محصولات این فروشگاه تماما اصل می باشند و بهترین کیفیت را دارند</small>
        </h5>
    </div>
    <div class="col-sm-4">
        <img src="{{ asset('/images/why-2.png') }}" width="70px" alt="مرحله ۳">
        <div class="half-seperate"></div>
        <h5 class="bold">
            تضمین بهترین قیمت
            <div class="half-seperate"></div>
        <small>بهترین قیمت ها در بازار را می توانید در این فروشگاه بیابید</small>
        </h5>
    </div>
</div>

<div class="seperate"></div>
<div class="seperate"></div>
<div class="seperate"></div>