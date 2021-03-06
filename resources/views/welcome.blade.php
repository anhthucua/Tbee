@extends('base')

@section('title', 'home')

@section('content')

<div class="wrapper" id="pjax-wrapper">
  <div class="pjax-container" data-border-state="" data-color="#DAD9D6">
    <main>
      <!-- HOT DEAL -->
      <div class="section" id="hot-deal">
        <!-- container-->
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="hot-deal-wrapper">
                @foreach ($coupons as $coupon)
                  <div class="hot-deal">
                    <h2 class="text-uppercase">Deal tốt dành cho bạn </h2>
                    <div class="code">
                      <h3>{{ $coupon->code }}</h3>
                    </div>
                    <p>Giảm <span class="sale-percent">{{ $coupon->sale_in_percent }}%</span> tất cả mặt hàng từ <span class="">{{ $coupon->start_at }}</span> đến <span class="">{{ $coupon->end_at }}</span></p>
                    @if ($coupon->sale_in_money != null)
                      <div>Giảm tối đa {{ $coupon->sale_in_money }} đồng</div>
                    @endif
                    {{-- <a class="primary-btn cta-btn" href="#">Copy mã</a> --}}
                    @if ($coupon->numbers != null)
                      <p class="note">* Số lượng có hạn</p>
                    @endif
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- category wrapper -->
      <div class="section">
        <div class="container">
          <div class="row">
            {{-- Each category --}}
            @foreach ($cat_lv1 as $category)
              <div class="col-md-3 col-xs-6">
                <a class="category-wrapper" href="{{ route('products-category', $category->id) }}"></a>
                <div class="category">
                  <div class="category-img" style="background-image: url('{{ asset("/images/categories/{$category->image}") }}');"></div>
                  <div class="category-body">
                    <h3>{{ $category->name }}</h3>
                    <div class="cta-btn">Mua ngay&nbsp;
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      {{-- End category --}}

      {{-- Section best sellers products --}}
      <div class="section">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="section-title">
                <h3 class="title">Sản phẩm bán chạy</h3>
              </div>
            </div>
            <!-- Products tab & slick-->
            <div class="col-md-12">
              <div class="row">
                <div class="products-tabs">
                  <div class="products-slick" data-nav="#slick-nav-1">
                    @foreach ($best_seller_products as $product)
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
                    @endforeach
                  </div>
                  <div class="products-slick-nav" id="slick-nav-1"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Section new products --}}
      <div class="section new-products">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="section-title">
                <h3 class="title">Sản phẩm mới</h3>
              </div>
            </div>
            <!-- Products tab & slick-->
            <div class="col-md-12">
              <div class="row">
                <div class="products-tabs">
                  <div class="products-slick" data-nav="#slick-nav-2">
                    @foreach ($new_products as $product)
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
                    @endforeach
                  </div>
                  <div class="products-slick-nav" id="slick-nav-2"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </main>
  </div>
</div>
@endsection