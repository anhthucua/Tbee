<header>
  <div id="top-header">
    <div class="container">
      <div class="d-flex justify-content-between">
        <ul class="header-links left">
          <li><a href="#">Kênh người bán</a></li>
          <li><a href="#">Quản lý</a></li>
        </ul>
        <ul class="header-links right">
          @guest
            <li>
              <a class="primary-btn primary-btn--normal" href="#" data-toggle="modal" data-target="#login-modal">
                Đăng nhập
              </a>
            </li>
            <li>
              <a class="primary-btn primary-btn--normal" href="#" data-toggle="modal" data-target="#signup-modal">
                Đăng ký
              </a>
            </li>
          @else
            <li>
              <a class="primary-btn primary-btn--normal" href="#" data-toggle="modal" data-target="#logout-modal">
                Đăng xuất
              </a>
            </li>
            <li>
              <a href="myaccount.html">
                <i class="fa fa-user-o"></i>{{ Auth::user()->username }}
              </a>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </div>
  <div id="header">
    <div class="container">
      <div class="row">

        <!-- logo -->
        <div class="col-md-3">
          <div class="header-logo">
            <a class="logo" href="home.html"><img src="images/logo.svg" alt="logo"></a>
          </div>
        </div>
        <!-- /logo -->

        <!-- search bar -->
        <div class="col-md-6">
          <div class="header-search">
            <form action="POST" class="search-form">
              <input class="input" placeholder="Tìm kiếm">
              <button class="search-btn">Tìm kiếm</button>
            </form>
          </div>
        </div>
        <!-- /search bar -->

        <!-- Cart -->
        <div class="col-md-3">
          <div class="header-ctn">
            <div class="dropdown cart">
              <a class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-shopping-cart"></i><span>Giỏ hàng</span>
                <div class="qty">3</div>
              </a>
              <div class="cart-dropdown dropdown-menu">
                <div class="cart-list">
                  <div class="product-widget">
                    <div class="product-img">
                      <img src="../images/product01.png" alt="product01"></div>
                    <div class="product-body">
                      <h3 class="product-name">
                        <a href="#">product name goes here</a>
                      </h3>
                      <h4 class="product-price">
                        <span class="qty">1x</span>100000
                      </h4>
                    </div>
                    <button class="delete">
                      <i class="fa fa-close"></i>
                    </button>
                  </div>
                  <div class="product-widget">
                    <div class="product-img">
                      <img src="../images/product01.png" alt="product01"></div>
                    <div class="product-body">
                      <h3 class="product-name">
                        <a href="#">product name goes here</a>
                      </h3>
                      <h4 class="product-price">
                        <span class="qty">1x</span>100000
                      </h4>
                    </div>
                    <button class="delete">
                      <i class="fa fa-close"></i>
                    </button>
                  </div>
                </div>
                <div class="cart-btn">
                  <a href="#">Xem giỏ hàng</a>
                </div>
              </div>
            </div>
            {{-- <div class="menu-toggle">
              <a href="#">
                <i class="fa fa-bars"></i><span>Menu</span>
              </a>
            </div> --}}
          </div>
        </div>
        <!-- /cart -->

      </div>
    </div>
  </div>
</header>

@guest
  {{-- Modal login --}}
  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Đăng nhập</h2>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-signin" method="POST" action="{{ route('login') }}">
            <input class="form-control lg-username" type="text" name="username" placeholder="Tên đăng nhập" required autofocus autocomplete="username">
            <input class="form-control lg-password" type="password" name="password" placeholder="Mật khẩu" required autocomplete="current-password">
            <label class="checkbox">
              <input id="rememberMe" type="checkbox" value="remember-me" name="rememberMe">Lưu tài khoản
            </label>
            <div class="error-login"></div>
            <div class="d-flex">
              <button class="btn btn-lg primary-btn btn-block" type="submit">Đăng nhập</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal signup --}}
  <div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Đăng ký tài khoản</h2>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-signup" method="POST" action="{{ route('register') }}">
            @csrf
            <input class="form-control su-username" type="text" name="username" placeholder="Tên đăng nhập *" required autofocus autocomplete="username">
            <div class="error-username"></div>
            <input class="form-control su-phone" type="tel" name="phone" placeholder="Số điện thoại *" required>
            <div class="error-phone"></div>
            <input class="form-control su-email" type="text" name="email" placeholder="Email *" required>
            <div class="error-email"></div>
            <input class="form-control su-password" type="password" name="password" placeholder="Mật khẩu *" required autocomplete="new-password">
            <div class="error-password"></div>
            <input class="form-control su-password_confirmation" type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu *" required autocomplete="">
            <div class="d-flex">
              <button class="btn btn-signup primary-btn btn-block" type="submit">Đăng ký</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal sign up successfully --}}
  <div class="modal fade" id="signup-success-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Bạn đã đăng ký thành công!</h2>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="d-flex">
            <button class="btn btn-ok primary-btn btn-block" type="submit">Đồng ý</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@else
  {{-- Modal logout --}}
  <div class="modal fade" id="logout-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Bạn chắc chắn muốn đăng xuất?</h2>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-logout" action="{{ route('logout') }}" method="POST">
            @csrf
            <div class="d-flex">
              <button class="btn btn-logout primary-btn btn-block" type="submit">Đăng xuất</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endguest