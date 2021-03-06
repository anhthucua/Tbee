<header>
  <div id="top-header">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <ul class="header-links left">
          <li><a href="{{ route('home') }}">Trang chủ</a></li>
          <li><a href="{{ route('supplier.new') }}">Kênh người bán</a></li>
          @if (Auth::user()->is('admin'))
            <li><a href="{{ route('admin.manage-orders') }}">Quản lý</a></li>
          @endif
        </ul>
        <ul class="header-links right">
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
        </ul>
      </div>
    </div>
  </div>
</header>


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