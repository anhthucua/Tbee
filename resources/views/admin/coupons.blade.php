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
        <option value="chuahieuluc">Chưa có hiệu lực</option>
        <option value="concohieuluc">Còn có hiệu lực</option>
        <option value="hethieuluc">Hết hiệu lực</option>
      </select>
      <select id="sort" class="dropdown">
        <option value="id desc">Sắp xếp theo</option>
        <option value="created_at desc">Ngày tạo mới nhất</option>
        <option value="updated_at desc">Ngày tạo xa nhất</option>
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
        @foreach ($coupons as $coupon)
          <tr>
            <td>{{ $coupon->id }}</td>
            <td>{{ $coupon->code }}</td>
            <td>{{ $coupon->sale_in_percent }}%</td>
            <td>{{ $coupon->sale_in_money ?? '' }}</td>
            <td>{{ $coupon->created_date }}</td>
            <td>{{ $coupon->start_at }}</td>
            <td>{{ $coupon->end_at }}</td>
            <td>{{ $coupon->status }}</td>
            <td>{{ $coupon->numbers ?? '' }}</td>
            <td>{{ $coupon->used }}</td>
            <td>
              <a class="secondary-btn btn--small" data-toggle="modal" data-target="#edit-coupon-modal">Sửa</a>
            </td>
            <td>
              <a href="#" class="primary-btn btn--small">Xoá</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

{{-- Modal login --}}
<div class="modal fade" id="edit-coupon-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Chỉnh sửa mã giảm giá code: TBEE01</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="" class="form add-coupon-form">
          @csrf
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
          <input type="submit" class="btn primary-btn primary-btn--square" value="Lưu thay đổi">
        </form>
      </div>
    </div>
  </div>
</div>