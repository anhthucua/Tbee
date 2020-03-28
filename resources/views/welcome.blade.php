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
      </div><!-- category -->
      <div class="section">
        <div class="container">
          <div class="row">
            <div class="col-md-3 col-xs-6"><a href="#">
                <div class="shop">
                  <div class="shop-img" style="background-image: url('../images/man-fashion.png');"></div>
                  <div class="shop-body">
                    <h3>Thời trang nam</h3><a class="cta-btn" href="#">Mua ngay&nbsp;<i
                        class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </a></div>
            <div class="col-md-3 col-xs-6"><a href="#">
                <div class="shop">
                  <div class="shop-img" style="background-image: url('../images/woman-fashion.png');"></div>
                  <div class="shop-body">
                    <h3>Thời trang nữ</h3><a class="cta-btn" href="#">Bộ sưu tập&nbsp;<i
                        class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </a></div>
            <div class="col-md-3 col-xs-6"><a href="#">
                <div class="shop">
                  <div class="shop-img" style="background-image: url('../images/laptop.png');"></div>
                  <div class="shop-body">
                    <h3>Laptop</h3><a class="cta-btn" href="#">Bộ sưu tập&nbsp;<i
                        class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </a></div>
            <div class="col-md-3 col-xs-6"><a href="#">
                <div class="shop">
                  <div class="shop-img" style="background-image: url('../images/headphone.png');"></div>
                  <div class="shop-body">
                    <h3>Tai nghe</h3><a class="cta-btn" href="#">Bộ sưu tập&nbsp;<i
                        class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </a></div>
            <div class="col-md-3 col-xs-6"><a href="#">
                <div class="shop">
                  <div class="shop-img" style="background-image: url('../images/smartphone.png');"></div>
                  <div class="shop-body">
                    <h3>Điện thoại</h3><a class="cta-btn" href="#">Bộ sưu tập&nbsp;<i
                        class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </a></div>
            <div class="col-md-3 col-xs-6"><a href="#">
                <div class="shop">
                  <div class="shop-img" style="background-image: url('../images/giay-dep.png');"></div>
                  <div class="shop-body">
                    <h3>Giày dép</h3><a class="cta-btn" href="#">Bộ sưu tập&nbsp;<i
                        class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </a></div>
            <div class="col-md-3 col-xs-6"><a href="#">
                <div class="shop">
                  <div class="shop-img" style="background-image: url('../images/tui-vi.png');"></div>
                  <div class="shop-body">
                    <h3>Túi ví</h3><a class="cta-btn" href="#">Bộ sưu tập&nbsp;<i
                        class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </a></div>
            <div class="col-md-3 col-xs-6"><a href="#">
                <div class="shop">
                  <div class="shop-img" style="background-image: url('../images/mypham.png');"></div>
                  <div class="shop-body">
                    <h3>Mỹ phẩm</h3><a class="cta-btn" href="#">Bộ sưu tập&nbsp;<i
                        class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </a></div>
          </div>
        </div>
      </div>
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