<header>
  <div id="top-header">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <ul class="header-links left">
          @auth
            <li><a href="{{ route('supplier.new') }}">Kênh người bán</a></li>
            @if (Auth::user()->is('admin'))
              <li><a href="{{ route('admin.manage-orders') }}">Quản lý</a></li>
            @endif
          @endauth
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
            {{-- Thong bao --}}
            <li class="noti-block dropdown">
              <a href="#" class="noti-icon dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell"></i>
                @if ($noti_count > 0)
                  <div class="qty">{{ $noti_count }}</div>
                @endif
              </a>
              @if ($noti_count > 0)
                <ul class="noti dropdown-menu">
                  <li class="mark-read">
                    <a href="#">Đánh dấu tất cả là đã đọc</a>
                  </li>
                  <li class="noti-list">
                    <ul>
                      @foreach ($notis as $noti)
                        <li class="noti-item {{ $noti->read ?: 'no-read' }}">
                          <a href="{{ $noti->url }}" class="noti-content" data-id="{{ $noti->id }}">
                            <span>{{ $noti->content }}</span>
                            <br>
                            <span class="hour">{{ $noti->hour }}</span>&nbsp;&nbsp;
                            <span class="date">{{ $noti->date }}</span>
                          </a>
                        </li>
                      @endforeach
                    </ul>
                  </li>
                  @if ($all_noti_count > 3)
                    <li class="see-more" data-all="{{ $all_noti_count }}" data-cur="{{ ($all_noti_count > 3) ? 3 : $all_noti_count }}">
                      <a href="#">Xem thêm thông báo</a>
                    </li>
                  @endif
                </ul>
              @else
                <ul class="noti dropdown-menu">
                  <li>Không có thông báo nào</li>
                </ul>
              @endif
            </li>

            {{-- Trang nguoi dung --}}
            <li>
              <a href="{{ route('user.orders') }}">
                <img src="{{ $avatar_img }}" class="avatar-img">
                <span class="name">{{ Auth::user()->username }}</span>
              </a>
            </li>

            {{-- Dang xuat --}}
            <li>
              <a class="primary-btn primary-btn--normal" href="#" data-toggle="modal" data-target="#logout-modal">
                Đăng xuất
              </a>
            </li>
          @endguest
        </ul>
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
            <input class="form-control lg-username" type="text" name="username" placeholder="Tên đăng nhập\Điện thoại\Email" required autofocus autocomplete="off">
            <input class="form-control lg-password" type="password" name="password" placeholder="Mật khẩu" required autocomplete="off">
            {{-- <input id="rememberMe" type="checkbox"> --}}
            {{-- <label class="checkbox" for="rememberMe">Lưu tài khoản</label> --}}
            <div class="error error-login"></div>
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
            <input class="form-control su-username" type="text" name="username" placeholder="Tên đăng nhập *" required autofocus autocomplete="off">
            <div class="error error-username"></div>
            <input class="form-control su-phone" type="tel" name="phone" placeholder="Số điện thoại *" required>
            <div class="error error-phone"></div>
            <input class="form-control su-email" type="text" name="email" placeholder="Email *" required autocomplete="off">
            <div class="error error-email"></div>
            <input class="form-control su-password" type="password" name="password" placeholder="Mật khẩu *" required autocomplete="off">
            <div class="error error-password"></div>
            <input class="form-control su-password_confirmation" type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu *" required  autocomplete="off">
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

<template id="noti-li">
  <li class="noti-item"> <!-- them class no-read neu unread -->
    <a href="" class="noti-content"> <!-- them data-id-->
      <span></span> <!-- them content-->
      <br>
      <span class="hour"></span>&nbsp;&nbsp;  <!-- them hour-->
      <span class="date"></span>   <!-- them date-->
    </a>
  </li>
</template>