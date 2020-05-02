@extends('admin.base')

@section('title', 'Thêm mã giảm giá')

@section('classname', 'add-coupon')

@section('content')
<section class="section">
  <h3>Tạo mã giảm giá</h3>
  <form action="{{ route('admin.add-coupon') }}" method="POST" id="addCouponForm" class="form add-coupon-form">
    @csrf

    {{-- Input mã --}}
    <br>
    <label for="coupon-code">
      <strong>Code giảm giá:</strong>
    </label>
    <input type="text" name="coupon-code" id="coupon-code">

    {{-- Input phần trăm --}}
    <br>
    <label for="percent">
      <strong>Phần trăm giảm:</strong>
    </label>
    <input type="number" name="percent" id="percent">

    {{-- Input giảm tối đa bao nhiêu tiền --}}
    <br>
    <label for="coupon-money">
      <strong>Giảm tối đa số tiền:</strong>
    </label>
    <input type="text" name="coupon-money" id="coupon-money" value="50000">

    {{-- Ngày bắt đầu --}}
    <br>
    <label for="start">
      <strong>Ngày bắt đầu có hiệu lực:</strong>
    </label>
    <input type="date" name="start" id="start">


    {{-- Ngày kết thúc --}}
    <br>
    <label for="end">
      <strong>Ngày kết thúc:</strong>
    </label>
    <input type="date" name="end" id="end">

    {{-- Số lượng mã tối đa --}}
    <br>
    <label for="end">
      <strong>Số lượng mã tối đa:</strong>
    </label>
    <input type="number" name="number" id="number">

    <br>

    {{-- Submit form --}}
    <br>
    <input type="submit" class="btn primary-btn primary-btn--square" value="Tạo mã giảm giá">
  </form>
</section>

@endsection