@extends('base')

@section('title')
  {{ $cat_lv1->name }}
@endsection

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
          <li class="active">{{ $cat_lv1->name }}</li>
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
      <!-- ASIDE -->
      <div id="aside" class="col-md-3">
        <!-- aside Widget -->
        <div class="aside">
          <h3 class="aside-title">Categories</h3>
          <div class="checkbox-filter">
            @foreach ($cat_lv2 as $cat)
              <div class="input-checkbox">
                <input type="checkbox" id="category-{{ $cat->id }}">
                <label for="category-{{ $cat->id }}">
                  {{ $cat->name }}
                  <small>({{ $cat->products_count }})</small>
                </label>
              </div>
            @endforeach
          </div>
        </div>
        <!-- /aside Widget -->

        <!-- aside Widget -->
        <div class="aside">
          <h3 class="aside-title">Giá</h3>
          <div class="price-filter">
            <div id="price-slider"></div>
            <div class="input-number price-min">
              <input id="price-min" type="number">
              <span class="qty-up">+</span>
              <span class="qty-down">-</span>
            </div>
            <span>-</span>
            <div class="input-number price-max">
              <input id="price-max" type="number">
              <span class="qty-up">+</span>
              <span class="qty-down">-</span>
            </div>
          </div>
        </div>
        <!-- /aside Widget -->

        <!-- aside Widget -->
        <div class="aside">
          <h3 class="aside-title">Sản phẩm bán chạy</h3>
          @foreach ($best_seller_products as $b_product)
            <div class="product-widget">
              <a href="{{ route('product.show', $b_product->id) }}" class="product-img" style="background-image: url('{{ asset($b_product->img_url) }}');">
              </a>
              <div class="product-body">
                <p class="product-purchased">Đã bán {{ $b_product->purchased_number }}</p>
                <h3 class="product-name">
                  <a href="{{ route('product.show', $b_product->id) }}">{{ $b_product->name }}</a>
                </h3>
                <h4 class="product-price">
                  {{ $b_product->price }}
                  @if ($b_product->sale_price !== $b_product->price)
                    <del class="product-old-price">{{ $b_product->price }}</del>
                  @endif
                </h4>
              </div>
            </div>
          @endforeach
        </div>
        <!-- /aside Widget -->
      </div>
      <!-- /ASIDE -->

      <!-- STORE -->
      <div id="store" class="col-md-9">
        <!-- store top filter -->
        <div class="store-filter clearfix">
          <div class="store-sort">
            <label>
              Sắp xếp theo:
              <select class="input-select">
                <option value="0">Giá từ thấp lên cao</option>
                <option value="1">Giá từ cao xuống thấp</option>
                <option value="2">Sản phẩm mới nhất</option>
                <option value="3">Sản phẩm bán chạy</option>
              </select>
            </label>
          </div>
        </div>
        <!-- /store top filter -->

        <!-- store products -->
        <div class="row">
          @foreach ($products as $product)
            <!-- product -->
            <div class="col-lg-4 col-xs-6">
              <div class="product">
                <a class="product-link" href="{{ route('product.show', $product->id) }}"></a>
                <div class="product-img" style="background-image: url('{{ asset($product->img_url) }}');">
                  <div class="product-label">
                    @isset($product->sale_percent)
                      <span class="sale">{{ $product->sale_percent }}%</span>
                    @endisset
                  </div>
                </div>
                <div class="product-body">
                  <p class="product-purchased">Đã bán {{ $product->purchased_number }}</p>
                  <h3 class="product-name"><a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a></h3>
                  <h4 class="product-price">{{ $product->price }}
                    @if ($product->sale_price !== $product->price)
                      <del class="product-old-price">990000</del>
                    @endif
                  </h4>
                </div>
              </div>
            </div>
            <!-- /product -->
          @endforeach
        </div>
        <!-- /store products -->
      </div>
      <!-- /STORE -->
    </div>

    <div class="row">
      <div class="col-12">
        <!-- store bottom filter -->
        <div class="store-filter float-right">
          <ul class="store-pagination">
            <li class="active">1</li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
          </ul>
        </div>
        <!-- /store bottom filter -->
      </div>
    </div>

  </div>
</div>
<!-- /SECTION -->

@endsection