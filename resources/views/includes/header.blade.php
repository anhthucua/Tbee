<div id="header">
  <div class="container">
    <div class="row align-items-center">

      <!-- logo -->
      <div class="col-md-3">
        <div class="header-logo">
          <a class="logo" href="{{ route('home') }}"><img src="{{ asset('/images/logo.svg') }}" alt="logo"></a>
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
          <div class="cart">
            @auth
              <a href="#" data-toggle="modal" data-target="#rqlg-modal">
                <i class="fa fa-shopping-cart"></i>
                <span>Giỏ hàng</span>
                <div class="qty">{{ $cart_count }}</div>
              </a>
            @else
              <a href="{{ route('cart') }}">
                <i class="fa fa-shopping-cart"></i>
                <span>Giỏ hàng</span>
                <div class="qty">0</div>
              </a>
            @endauth
          </div>
        </div>
      </div>
      <!-- /cart -->

    </div>
  </div>
</div>

{{-- Modal require login --}}
<div class="modal fade" id="rqlg-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Vui lòng đăng nhập trước khi sử dụng tính năng này</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="d-flex">
          <button class="btn btn-logout primary-btn btn-block" type="button" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
  </div>
</div>