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
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Đăng nhập</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form class="form-signin" action="post">
          <input class="form-control" type="text" name="username" placeholder="Tên đăng nhập" required="" autofocus="">
          <input class="form-control" type="password" name="password" placeholder="Mật khẩu" required="">
          <label class="checkbox">
            <input id="rememberMe" type="checkbox" value="remember-me" name="rememberMe">Lưu tài khoản
          </label>
          <div class="d-flex">
            <button class="btn btn-lg primary-btn btn-block" type="submit">Đăng nhập</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="logout-modal" tabindex="-1" role="dialog" aria-labelledby="login-modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Bạn chắc chắn muốn đăng xuất?</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form class="form-signin" action="post">
          <div class="d-flex">
            <button class="btn btn-lg primary-btn btn-block" type="submit">Đăng xuất</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="login-modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Đăng ký tài khoản</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form class="form-signin" action="post">
          <input class="form-control" type="text" name="username" placeholder="Tên đăng nhập" required="" autofocus="">
          <input class="form-control" type="tel" name="phone" placeholder="Số điện thoại" required="" autofocus="">
          <input class="form-control" type="text" name="email" placeholder="Email" required="" autofocus="">
          <input class="form-control" type="text" name="confirm-email" placeholder="Xác nhận email" required=""
            autofocus="">
          <input class="form-control" type="password" name="password" placeholder="Mật khẩu" required="">
          <input class="form-control" type="password" name="confirm-password" placeholder="Xác nhận mật khẩu"
            required="">
          <label class="checkbox">
            <input id="rememberMe" type="checkbox" value="remember-me" name="rememberMe">Lưu tài khoản
          </label>
          <div class="d-flex">
            <button class="btn btn-lg primary-btn btn-block" type="submit">Đăng ký</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <div class="d-flex">
          <button class="btn btn-lg secondary-btn btn-block" href="#" data-toggle="modal"
            data-target="#login-modal">Đăng nhập</button>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection