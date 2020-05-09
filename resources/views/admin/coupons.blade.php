@extends('admin.base')

@section('title', 'Quản lý mã giảm giá')

@section('classname', 'manage-coupons')

@section('content')
<div class="page-pads-container">
  <div class="heading">
    <h3 class="title">QUẢN LÝ MÃ GIẢM GIÁ</h3>
  </div>
  <div class="pad-filters">
    <input type="text" id="search" class="search" placeholder="Tìm kiếm theo mã code giảm giá">
    <div class="filter">
      <select id="filter-category" class="dropdown">
        <option value="all">Trạng thái mã giảm giá</option>
        <option value="chua_hieuluc">Chưa có hiệu lực</option>
        <option value="con_hieuluc">Còn hiệu lực</option>
        <option value="het_hieuluc">Hết hiệu lực</option>
      </select>
      <select id="sort" class="dropdown">
        <option value="id desc">Sắp xếp theo</option>
        <option value="created_at desc">Ngày tạo mới nhất</option>
        <option value="created_at asc">Ngày tạo xa nhất</option>
      </select>
    </div>
  </div>
  <h5>Thông tin các mã giảm giá:</h5>
  <div class="pads-container">
    <table class="table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Mã code giảm giá</th>
          <th>Phần trăm giảm</th>
          <th>Giảm tối đa</th>
          <th>Ngày tạo</th>
          <th>Ngày có hiệu lực</th>
          <th>Ngày kết thúc</th>
          <th>Trạng thái</th>
          <th>Số lượng mã</th>
          <th>Đã sử dụng (mã)</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @if (count($coupons) != 0)
          @foreach ($coupons as $coupon)
            <tr>
              <td class="id">{{ $coupon->id }}</td>
              <td class="code">{{ $coupon->code }}</td>
              <td class="percent">{{ $coupon->sale_in_percent }}%</td>
              <td class="money">{{ $coupon->sale_in_money ?? '' }}</td>
              <td>{{ $coupon->created_date }}</td>
              <td class="start">{{ $coupon->start_at }}</td>
              <td class="end">{{ $coupon->end_at }}</td>
              <td>{{ $coupon->status }}</td>
              <td class="numbers">{{ $coupon->numbers ?? '' }}</td>
              <td>{{ $coupon->used }}</td>
              <td>
                <a href="#" class="secondary-btn btn--small btn-edit">Sửa</a>
              </td>
              <td>
                <a href="#" class="primary-btn btn--small btn-delete">Xoá</a>
              </td>
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="12">Không có mã giảm giá nào</td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>

@endsection

{{-- Modal edit coupon --}}
<div class="modal fade" id="edit-coupon-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Chỉnh sửa mã giảm giá code: <span class="counpon-code">TBEE01<span></h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" class="form edit-coupon-form">
          @csrf
          @method('PUT')
          {{-- Input phần trăm --}}
          <br>
          <label for="percent">
            <strong>Phần trăm giảm:</strong>
          </label>
          <input type="number" name="sale_in_percent" id="percent">

          {{-- Input giảm tối đa bao nhiêu tiền --}}
          <br>
          <label for="coupon-money">
            <strong>Giảm tối đa số tiền:</strong>
          </label>
          <input type="text" name="sale_in_money" id="coupon-money" value="50000">

          {{-- Ngày bắt đầu --}}
          <br>
          <label for="start">
            <strong>Ngày bắt đầu có hiệu lực:</strong>
          </label>
          <input type="date" name="start_at" id="start">


          {{-- Ngày kết thúc --}}
          <br>
          <label for="end">
            <strong>Ngày kết thúc:</strong>
          </label>
          <input type="date" name="end_at" id="end">

          {{-- Số lượng mã tối đa --}}
          <br>
          <label for="end">
            <strong>Số lượng mã tối đa:</strong>
          </label>
          <input type="number" name="numbers" id="number">

          <br>

          {{-- Submit form --}}
          <br>
          <input type="submit" class="btn primary-btn primary-btn--square" value="Lưu thay đổi">
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Modal Delete --}}
<div class="modal fade" id="delete-coupon-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Xóa mã giảm giá</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Bạn chắc chắn muốn xóa?</p>
        <form class="form-delete" action="" method="POST">
          @csrf
          @method('DELETE')
          <div class="d-flex">
            <button class="btn btn-logout primary-btn btn-block" type="submit">Xóa</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<template id="coupon-row">
  <tr>
    <td class="id"></td>  <!-- id -->
    <td class="code"></td>  <!-- code -->
    <td class="percent"></td> <!-- percent -->
    <td class="money"></td>  <!-- money -->
    <td></td>  <!-- create -->
    <td class="start"></td>  <!-- start -->
    <td class="end"></td> <!-- end -->
    <td></td> <!-- status -->
    <td class="numbers"></td> <!-- numbers -->
    <td></td>  <!-- used -->
    <td>
      <a href="#" class="secondary-btn btn--small btn-edit">Sửa</a>
    </td>
    <td>
      <a href="#" class="primary-btn btn--small btn-delete">Xoá</a>
    </td>
  </tr>
</template>