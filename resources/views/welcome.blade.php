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
                <div class="hot-deal">
                  <h2 class="text-uppercase">Deal tốt dành cho bạn </h2>
                  <div class="code">
                    <h3>TBEE50</h3>
                  </div>
                  <p>Giảm <span class="sale-percent">50%</span> tất cả mặt hàng từ 2/3/2020 đến 3/3/2020</p><a
                    class="primary-btn cta-btn" href="#">Mua ngay kẻo lỡ</a>
                  <p class="note">* Số lượng có hạn</p>
                </div>
                <div class="hot-deal">
                  <h2 class="text-uppercase">Deal tốt dành cho bạn </h2>
                  <div class="code">
                    <h3>TBEE50</h3>
                  </div>
                  <p>Giảm <span class="sale-percent">50%</span> tất cả mặt hàng từ 2/3/2020 đến 3/3/2020</p><a
                    class="primary-btn cta-btn" href="#">Mua ngay kẻo lỡ</a>
                  <p class="note">* Số lượng có hạn</p>
                </div>
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

      {{-- Section new products --}}
      <div class="section">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="section-title">
                <h3 class="title">New Products</h3>
              </div>
            </div>
            <!-- Products tab & slick-->
            <div class="col-md-12">
              <div class="row">
                <div class="products-tabs">
                  <div class="tab-pane active" id="tab1">
                    <div class="products-slick" data-nav="#slick-nav-1">
                      <!-- PRODUCT -->
                      <div class="product"><a class="product-link" href="#"></a>
                        <div class="product-img" style="background-image: url('../images/man-fashion.png');">
                          <div class="product-label"><span class="sale">-30%</span></div>
                        </div>
                        <div class="product-body">
                          <p class="product-category">Name Category</p>
                          <h3 class="product-name"><a href="#">product name goes here</a></h3>
                          <h4 class="product-price">980000
                            <del class="product-old-price">990000</del>
                          </h4>
                        </div>
                      </div>
                      <div class="product"><a class="product-link" href="#"></a>
                        <div class="product-img" style="background-image: url('../images/man-fashion.png');">
                          <div class="product-label"><span class="sale">-30%</span></div>
                        </div>
                        <div class="product-body">
                          <p class="product-category">Name Category</p>
                          <h3 class="product-name"><a href="#">product name goes here</a></h3>
                          <h4 class="product-price">980000
                            <del class="product-old-price">990000</del>
                          </h4>
                        </div>
                      </div>
                      <div class="product"><a class="product-link" href="#"></a>
                        <div class="product-img" style="background-image: url('../images/man-fashion.png');">
                          <div class="product-label"><span class="sale">-30%</span></div>
                        </div>
                        <div class="product-body">
                          <p class="product-category">Name Category</p>
                          <h3 class="product-name"><a href="#">product name goes here</a></h3>
                          <h4 class="product-price">980000
                            <del class="product-old-price">990000</del>
                          </h4>
                        </div>
                      </div>
                      <div class="product"><a class="product-link" href="#"></a>
                        <div class="product-img" style="background-image: url('../images/man-fashion.png');">
                          <div class="product-label"><span class="sale">-30%</span></div>
                        </div>
                        <div class="product-body">
                          <p class="product-category">Name Category</p>
                          <h3 class="product-name"><a href="#">product name goes here</a></h3>
                          <h4 class="product-price">980000
                            <del class="product-old-price">990000</del>
                          </h4>
                        </div>
                      </div>
                      <!-- /PRODUCT -->
                    </div>
                    <div class="products-slick-nav" id="slick-nav-1"></div>
                  </div>
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