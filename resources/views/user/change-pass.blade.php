@extends('user.base')

@section('title', 'Đổi mật khẩu')

@section('classname', 'change-pass')

@section('content')
<section class="section">

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  <div class="row">
    <div class="col-md-6">
      <h3 class="title">THAY ĐỔI MẬT KHẨU</h3>
      <form class="form-change-pw" method="POST" action="{{ route('user.change-pass-submit') }}">
        @csrf
        <br>
        {{-- password hien tai --}}
        <label>Mật khẩu hiện tại:*</label>
        <input class="form-control" type="password" name="password" required autocomplete="off">
        @if (session('err-pass'))
          <div class="error error-old-password">{{ session('err-pass') }}</div>
        @endif
        <br>
        <label>Mật khẩu mới:*</label>
        <input class="form-control" type="password" name="new_password" required autocomplete="off">
        @if (session('err-new-pass'))
          <div class="error error-password">{{ session('err-new-pass') }}</div>
        @endif
        <br>
        <label>Xác nhận mật khẩu:*</label>
        <input class="form-control" type="password" name="new_pass_cf" required autocomplete="off">
        @if (session('err-pass-cf'))
          <div class="error error-password">{{ session('err-pass-cf') }}</div>
        @endif
        <br>
        <div class="d-flex">
          <button class="primary-btn" type="submit">Lưu</button>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection