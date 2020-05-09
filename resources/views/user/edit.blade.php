@extends('user.base')

@section('title', 'Thay đổi thông tin')

@section('classname', 'edit')

@section('content')
<section class="section">
  <div class="row justify-content-left">
    <div class="col-md-6">
      <h3>Thông tin cá nhân</h3>
      <br>
      <form class="form-signup" method="POST" action="{{ route('register') }}">
        @csrf
        {{-- username ko dc sua --}}
        <label>Tên đăng nhập:</label>
        <input class="form-control" type="text" disabled placeholder="tbee">
        <br>
        {{-- phone show du lieu trong db --}}
        <label>Số điện thoại:</label>
        <input class="form-control su-phone" type="tel" name="phone">
        <div class="error error-phone"></div>
        <br>
        {{-- email show du lieu trong db --}}
        <label>Email:</label>
        <input class="form-control su-email" type="text" name="email">
        <div class="error error-email"></div>
        <br>
        {{-- address, show du lieu trong db, không dien thi de trong  --}}
        <label>Địa chỉ (điền tối đa 3 địa chỉ nhận hàng)</label>
        <!-- <div class="primary-btn primary-btn--square btn--small">+ Thêm</div> -->
        <br>
        {{-- address-1  --}}
        <input class="form-control su-address" type="text" name="address">
        <br>
        {{-- address-2  --}}
        <div class="d-flex">
          <input class="form-control su-address" type="text" name="address">
          <div class="primary-btn primary-btn--square btn--small" data-toggle="modal" data-target="#delete-modal">Xoá</div>
        </div>
        <br>
        {{-- address-3  --}}
        <div class="d-flex">
          <input class="form-control su-address" type="text" name="address">
          <div class="primary-btn primary-btn--square btn--small" data-toggle="modal" data-target="#delete-modal">Xoá</div>
        </div>
        <div class="error"></div>
        <br>
        <div class="d-flex">
          <button class="primary-btn" type="submit">Lưu thông tin</button>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection

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