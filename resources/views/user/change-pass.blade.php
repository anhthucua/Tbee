@extends('user.base')

@section('title', 'Đổi mật khẩu')

@section('classname', 'change-pass')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-md-6">
      <h3 class="title">THAY ĐỔI MẬT KHẨU</h3>
      <form class="form-change-pw" method="POST">
        @csrf
        <br>
        {{-- password hien tai --}}
        <label>Mật khẩu hiện tại:*</label>
        <input class="form-control su-old-password" type="password" name="password" required autocomplete="off">
        <div class="error error-old-password"></div>
        <br>
        <label>Mật khẩu mới:*</label>
        <input class="form-control su-password" type="password" name="new-password" required autocomplete="off">
        <div class="error error-password"></div>
        <br>
        <label>Xác nhận mật khẩu:*</label>
        <input class="form-control su-password_confirmation" type="password" name="password_confirmation" required  autocomplete="off">
        <br>
        <div class="d-flex">
          <button class="primary-btn" type="submit">Lưu</button>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection