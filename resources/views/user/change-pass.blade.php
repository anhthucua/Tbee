@extends('user.base')

@section('title', 'Đổi mật khẩu')

@section('classname', 'change-pass')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-md-6">
      <h3>Thay đổi mật khẩu</h3>
      <form class="form-change-pw" method="POST">
        @csrf
        <br>
        {{-- password hien tai --}}
        <label>Mật khẩu hiện tại:</label>
        <input class="form-control su-password" type="password" name="password" placeholder="Mật khẩu *" required autocomplete="off">
        <div class="error error-password"></div>
        <br>

        <div class="d-flex">
          <button class="primary-btn" type="submit">Lưu thông tin</button>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection