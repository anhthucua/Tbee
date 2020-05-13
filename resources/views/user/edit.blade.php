@extends('user.base')

@section('title', 'Thay đổi thông tin')

@section('classname', 'edit')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-md-10">
      <h3 class="title">THÔNG TIN CÁ NHÂN</h3>
      <br>

      <label>Avatar:</label>

      <input type="file" name="avatar" id="avatar" class="d-none" accept="image/*">

      <div class="input-file">
        <button class="btn primary-btn primary-btn--square btn-image" type="button">Chọn ảnh</button>
        <p class="image-name">{{ $user->avatar ? basename($user->avatar_img) : '' }}</p>
      </div>

      <br>

      <div class="upload-avt-wrapper">
        <div class="upload-avt">
          <img class="avt-img img-responsive" src="{{ $user->avatar_img }}" alt="avatar">
        </div>
      </div>

      <br>
      {{-- username ko dc sua --}}
      <label>Tên đăng nhập:</label>
      <input class="form-control" type="text" disabled placeholder="{{ $user->username }}">
      <br>
      {{-- email show du lieu trong db --}}
      <label>Email:</label>
      <input class="form-control su-email" type="text" name="email" value="{{ $user->email }}">
      <div class="error error-email"></div>
      <br>
      <br>
      <div class="row">
        <div class="col-6">
          <h3>Địa chỉ của tôi (tối đa 3 địa chỉ)</h3>
        </div>
        <div class="col-6 text-right">
          <div class="primary-btn primary-btn--square" data-toggle="modal" data-target="#add-address-modal">+ Thêm địa chỉ mới</div>
        </div>
      </div>
      {{-- address  --}}
      @foreach ($user->address_infos as $item)
        <hr>
        <div class="address-card mg-bottom-50">
          <div class="row justify-content-between">
            {{-- infor  --}}
            <div class="col-md-8">
              {{-- name  --}}
              <div class="row">
                <div class="col-4 text-secondary">Họ và tên</div>
                <div class="col-8 text-dark">
                  <span class="name">{{ $item->name }}</span>
                  @if ($item->is_main_address)
                    <span class="default">Mặc định</span>
                  @endif
                </div>
              </div>
              {{-- phone  --}}
              <div class="row">
                <div class="col-4 text-secondary">Số điện thoại</div>
                <div class="col-8 text-dark">{{ $item->phone }}</div>
              </div>
              {{-- address  --}}
              <div class="row">
                <div class="col-4 text-secondary">Địa chỉ</div>
                <div class="col-8 text-dark">{{ $item->address }}</div>
              </div>
            </div>
            {{-- thao tac  --}}
            <div class="col-md-4 text-right">
              <div class="secondary-btn btn--small" data-toggle="modal" data-target="#address-modal">Sửa</div>
              <div class="primary-btn btn--small" data-toggle="modal" data-target="#delete-modal">Xoá</div>
              <br>
              <br>
              @unless ($item->is_main_address)
                <div class="primary-btn primary-btn--square btn--small">Thiết lập mặc định</div>
              @endunless
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
{{-- modal delete  --}}
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Bạn có chắc muốn xoá địa chỉ?</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="del-address" action="" method="POST">
          {{-- @csrf
          @method('DELETE') --}}
          <div class="d-flex">
            <button class="btn primary-btn btn-block" type="submit">Xoá</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Modal add address --}}
<div class="modal fade" id="add-address-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Thêm 1 địa chỉ mới</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-adress" method="POST">
          {{-- name  --}}
          <input class="form-control su-name" type="tel" name="name" placeholder="Họ và tên">
          <div class="error error-name"></div>
            {{-- phone show du lieu trong db --}}
          <input class="form-control su-phone" type="tel" name="phone" placeholder="Số điện thoại">
          <div class="error error-phone"></div>
          {{-- address --}}
          <input class="form-control su-address" type="text" name="address" placeholder="Địa chỉ">
          <div class="error"></div>
          <br>
          <br>
          <div class="d-flex text-center justify-content-center">
            <button class="primary-btn" type="submit">Lưu thông tin</button>
          </div>
          </form>
      </div>
    </div>
  </div>
</div>

{{-- Modal edit address --}}
<div class="modal fade" id="address-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Chỉnh sửa địa chỉ</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-adress" method="POST">
        {{-- name  --}}
        <input class="form-control su-name" type="tel" name="name" value="Trần Anh Thư">
        <div class="error error-name"></div>
          {{-- phone show du lieu trong db --}}
        <input class="form-control su-phone" type="tel" name="phone" value="0923843847">
        <div class="error error-phone"></div>
        {{-- address --}}
        <input class="form-control su-address" type="text" name="address" value="Số 10 ngõ 168 Thuỵ Khuê, Tây Hồ, Hà Nội">
        <div class="error"></div>
        <br>
        <br>
        <div class="d-flex text-center justify-content-center">
          <button class="primary-btn" type="submit">Lưu thông tin</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>