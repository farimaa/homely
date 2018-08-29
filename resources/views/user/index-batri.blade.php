
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 text-center">         
        <h1 class="bold page-header hug-size">
            {{ $constant['name'] }}
        </h1>
        <h3>
            {{ $constant['description'] }}
        </h3>
    </div>
</div>
<div class="seperate"></div>
<div class="seperate"></div>
<div class="row text-center">   
    <div class="col-sm-4">
        <img src="{{ asset('/images/why-3.png') }}" width="70" alt="مرحله ۱">
        <div class="half-seperate"></div>
        <h5 class="bold">
            گارانتی زمان تحویل محصول
            <br>
            <small>هر سفارشی در زودترین زمان ممکن توسط این فروشگاه ارسال می شود.</small>
        </h5>
        <div class="half-seperate"></div>
    </div>
    <div class="col-sm-4">
        <img src="{{ asset('/images/why-1.png') }}" width="70" alt="مرحله ۲">
        <div class="half-seperate"></div>
        <h5 class="bold">
            ضمانت اصل بودن کالا
            <br>
            <small>محصولات این فروشگاه تماما اصل می باشند و بهترین کیفیت را دارند</small>
        </h5>
    </div>
    <div class="col-sm-4">
        <img src="{{ asset('/images/why-2.png') }}" width="70" alt="مرحله ۳">
        <div class="half-seperate"></div>
        <h5 class="bold">
            تضمین بهترین قیمت
            <br>
            <small>بهترین قیمت ها در بازار را می توانید در این فروشگاه بیابید</small>
        </h5>
    </div>
</div>
<div class="seperate"></div>
<div class="seperate"></div>
<!-- begin products slider -->
<div class="row text-center background-gradiant-1">
    <div class="col-xs-12">
        <h4>جدیدترین محصولات</h4>
    </div>
</div>
<div class="seperate"></div>
<div class="row">
    <!-- <div class="col-xs-12"> -->
    	<div class="owl-carousel" id="new-product-slider">
            @each('common.product-box', $new_products, 'product')
        </div>
	<!-- </div> -->
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
<div class="row text-center background-gradiant-2">
    <div class="col-xs-12">
        <h4>محصولات تخفیف دار</h4>
    </div>
</div>
<div class="seperate"></div>
<div class="row">
    <!-- <div class="col-xs-12"> -->
        <div class="owl-carousel" id="discount-product-slider">
            @each('common.product-box', $new_products, 'product')
        </div>
    <!-- </div> -->
</div>
<!-- end products slider -->
<hr>
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
<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="owl-carousel" id="brand-slider">
                @each('common.brand-box', $brands, 'brand')
            </div>
        </div>
    </div>
</div>
<!-- end news slider -->
<div class="seperate"></div>
