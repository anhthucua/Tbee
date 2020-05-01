@extends('admin.base')

@section('title', 'Thêm mã giảm giá')

@section('classname', 'add-coupon')

@section('content')
<form action="{{ route('admin.add-coupon') }}" method="POST" id="addCouponForm" class="form add-coupon-form">
  @csrf

  {{-- Input mã --}}
  <br>
  mã<input type="text" name="coupon-code" id="coupon-code">

  {{-- Input phần trăm --}}
  <br>
  phần trăm<input type="number" name="percent" id="percent">

  {{-- Input giảm tối đa bao nhiêu tiền --}}
  <br>
  giảm tối đa bao nhiêu tiền<input type="text" name="coupon-money" id="coupon-money" value="50000">

  {{-- Ngày bắt đầu --}}
  <br>
  Ngày bắt đầu<input type="date" name="start" id="start">


  {{-- Ngày kết thúc --}}
  <br>
  Ngày kết thúc<input type="date" name="end" id="end">

  {{-- Số lượng mã tối đa --}}
  <br>
  Số lượng mã tối đa<input type="number" name="number" id="number">


  <br>

  {{-- Submit form --}}
  <br>
  <input type="submit" class="btn primary-btn primary-btn--square" value="Tạo mã giảm giá">
</form>
@endsection