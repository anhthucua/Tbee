@extends('base')

@section('title')
  {{ 'abc' }}
@endsection

@section('classname', 'page-search-product')

@section('content')

<!-- SECTION -->
<div class="section">
  <div class="container">
    <div class="row">
      <!-- ASIDE -->
      <div id="aside" class="col-md-3">

        <!-- Filter theo gia ban -->
        @if (count($products) > 0)
          <div class="aside">
            <h3 class="aside-title">Giá</h3>
            <div class="price-filter">
              <div id="price-slider"></div>
              <div class="input-number price-min">
                <input id="price-min" type="number" value="{{ $price_values[0]->min }}">
                <span class="qty-up">+</span>
                <span class="qty-down">-</span>
              </div>
              <span>-</span>
              <div class="input-number price-max">
                <input id="price-max" type="number" value="{{ $price_values[0]->max }}">
                <span class="qty-up">+</span>
                <span class="qty-down">-</span>
              </div>
              <input type="hidden" id="productMinPrice" value="{{ $price_values[0]->min }}" disabled>
              <input type="hidden" id="productMaxPrice" value="{{ $price_values[0]->max }}" disabled>
            </div>
          </div>
        @endif

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
                <option value="sale_price asc">Giá từ thấp lên cao</option>
                <option value="sale_price desc">Giá từ cao xuống thấp</option>
                <option value="created_at desc">Sản phẩm mới nhất</option>
                <option value="purchased_number desc">Sản phẩm bán chạy</option>
              </select>
            </label>
          </div>
        </div>
        <!-- /store top filter -->

        <!-- store products -->
        <h3>Kết quả tìm kiếm cho "<span class="name">{{ $name }}</span>":</h3>

        <div class="row">
          @if (count($products) > 0)
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
                    <h3 class="product-name">
                      <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                    </h3>
                    <h4 class="product-price">
                      <span>{{ $product->sale_price }}</span>
                      @if ($product->sale_price !== $product->price)
                        <del class="product-old-price">{{ $product->price }}</del>
                      @endif
                    </h4>
                  </div>
                </div>
              </div>
              <!-- /product -->
            @endforeach
          @else
            <p class="no-products">Không có sản phẩm nào.</p>
          @endif
        </div>
        <!-- /store products -->
      </div>
      <!-- /STORE -->
    </div>

  </div>
</div>
<!-- /SECTION -->

@endsection

<template id="product-div">
  <div class="col-lg-4 col-xs-6">
    <div class="product">
      <a class="product-link" href=""></a>
      <div class="product-img" style="">
        <div class="product-label">
          <span class="sale"></span>
        </div>
      </div>
      <div class="product-body">
        <p class="product-purchased"></p>
        <h3 class="product-name">
          <a href=""></a>
        </h3>
        <h4 class="product-price">
          <span></span>
          <del class="product-old-price"></del>
        </h4>
      </div>
    </div>
  </div>
</template>