@extends('base')

@section('title')
{{ $product->name }}
@endsection

@section('classname', 'page-product-detail')

@section('content')
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb-tree">
          <li>
            <div class="header-logo">
              <a class="logo" href="{{ route('home') }}">
                <img src="{{ asset('/images/logo.svg') }}" alt="logo">
              </a>
            </div>
          </li>
          <li>
            <a href="{{ route('products-category', $cat_lv1->id) }}">{{ $cat_lv1->name }}</a>
          </li>
          <li>
            <a href="{{ route('products-category2', $cat_lv2->id) }}">{{ $cat_lv2->name }}</a>
          </li>
          <li class="active">{{ $product->name }}</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
  <div class="container">
    <div class="row">
      <!-- Product main img -->
      <div class="col-md-5 col-md-push-2">
        <div id="product-main-img">
          <div class="product-preview" style="background-image: url('{{ $product->main_img }}');">
          </div>
          @foreach ($images as $img)
            <div class="product-preview" style="background-image: url('{{ $img }}');">
            </div>
          @endforeach
        </div>
      </div>
      <!-- /Product main img -->

      <!-- Product thumb imgs -->
      <div class="col-md-2  col-md-pull-5">
        <div id="product-imgs">
          <div class="product-preview" style="background-image: url('{{ $product->main_img }}');">
          </div>
          @foreach ($images as $img)
            <div class="product-preview" style="background-image: url('{{ $img }}');">
            </div>
          @endforeach
        </div>
      </div>
      <!-- /Product thumb imgs -->

      <!-- Product details -->
      <div class="col-md-5">
        <div class="product-details">
          <h2 class="product-name">{{ $product->name }}</h2>
          <div>{{ $product->purchased_number }} sản phẩm đã bán
          </div>
          <div>
            <h3 class="product-price">
              <span>{{ $product->sale_price }}</span>
              @if ($product->sale_price !== $product->price)
                <del class="product-old-price">{{ $product->price }}</del>
              @endif
            </h3>
            <span class="product-available">Còn {{ $product->stock }} sản phẩm</span>
          </div>

          @if (!$product->is_banned)
            @guest
              <div class="add-to-cart">
                <button class="add-to-cart-btn" data-toggle="modal" data-target="#rqlg-modal">
                  <i class="fa fa-shopping-cart"></i>
                  Thêm vào giỏ hàng
                </button>
                <div style="height: 30px;"></div>
                <button class="secondary-btn" data-toggle="modal" data-target="#rqlg-modal">
                  Mua ngay
                </button>
              </div>
            @else
              @if (Auth::user()->id !== $shop['uid'])
                <div class="add-to-cart">
                  <button class="add-to-cart-btn logged-in">
                    <i class="fa fa-shopping-cart"></i>
                    Thêm vào giỏ hàng
                  </button>
                <div style="height: 30px;"></div>
                  <button class="secondary-btn" data-toggle="modal" data-target="#rqlg-modal">
                    Mua ngay
                  </button>
                </div>
              @endif
            @endguest
          @endif
        </div>
      </div>
      <!-- /Product details -->
    </div>
  </div>
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
  <div class="container">
    @if (!$product->is_banned)
      <!-- shop infor -->
      <div class="product-shop">
        <div class="d-flex">
          <a href="{{ route('products-shop', $shop['id']) }}" class="shop-image"
            style="background-image: url('{{ $shop['avatar'] }}');"></a>
          <div class="shop-info">
            <a href="{{ route('products-shop', $shop['id']) }}">{{ $shop['name'] }}</a>
            <div class="shop-link">
              <a href="{{ route('products-shop', $shop['id']) }}" class="primary-btn primary-btn--normal">Xem shop</a>
              <a href="#" class="secondary-btn btn-chat">Chat ngay</a>
            </div>
          </div>
        </div>
      </div>
      <!-- /shop infor -->
    @endif
    <!-- description -->
    <div class="product-desc">
      <h5 class="product-desc-title">Mô tả</h5>
      <div class="product-desc-content">
        {{ $product->description }}
      </div>
    </div>
    <!-- /description -->
  </div>
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section">
  <div class="container">
    <div class="row">

      <div class="col-md-12">
        <div class="section-title text-center">
          <h3 class="title">Sản phẩm bán chạy</h3>
        </div>
      </div>

      <!-- product -->
      @foreach ($best_seller_products as $item)
        <div class="col-md-3 col-xs-6">
          <div class="product">
            <a class="product-link" href="{{ route('product.show', $item->id) }}"></a>
            <div class="product-img" style="background-image: url('{{ asset($item->img_url) }}');" alt="">
              <div class="product-label">
                @isset($item->sale_percent)
                  <span class="sale">{{ $item->sale_percent }}%</span>
                @endisset
              </div>
            </div>
            <div class="product-body">
              <p class="product-purchased">Đã bán {{ $item->purchased_number }}</p>
              <h3 class="product-name">
                <a href="{{ route('product.show', $item->id) }}">{{ $item->name }}</a>
              </h3>
              <h4 class="product-price">
                <span>{{ $item->sale_price }}</span>
                @if ($item->sale_price !== $item->price)
                  <del class="product-old-price">{{ $item->price }}</del>
                @endif
              </h4>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
<!-- /Section -->

{{-- Modal require login --}}
<div class="modal fade" id="error-cart-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Thông báo</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="info text-center"></p>
        <div class="d-flex">
          <button class="btn btn-logout primary-btn btn-block" type="button" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection