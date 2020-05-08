@extends('admin.base')

@section('title', 'Quản lý đơn hàng')

@section('classname', 'manage-orders')

@section('content')

<div class="page-pads-container">
  <div class="heading">
    <h3 class="title">QUẢN LÝ ĐƠN HÀNG</h3>
  </div>
  <div class="pad-filters">
    <input type="text" id="search" class="search" placeholder="Tìm kiếm theo id đơn hàng">
    <div class="filter">
      <select id="filter-category" class="dropdown">
        <option value="all">Trạng thái đơn hàng</option>
        <option value="1">Đơn chờ xác nhận</option>
        <option value="2">Đơn đã huỷ</option>
        <option value="3">Đơn đã nhận</option>
      </select>
      <select id="sort" class="dropdown">
        <option value="id desc">Sắp xếp theo</option>
        <option value="wait-confirm_at desc">Đơn chờ xác nhận</option>
        <option value="cancel_at desc">Đơn đã huỷ</option>
        <option value="agree_at desc">Đơn đã nhận</option>
        <option value="created_at desc">Ngày tạo mới nhất</option>
        <option value="updated_at desc">Ngày tạo xa nhất</option>
      </select>
    </div>
  </div>
  <h5>Thông tin các đơn hàng:</h5>
  <div class="pads-container">
    <table class="table product-list">
      <thead>
        <tr>
          <th>Mã đơn</th>
          <th style="width: 40%;">Danh sách sản phẩm</th>
          <th>Người mua</th>
          <th>Người bán</th>
          <th>Thời gian đặt</th>
          <th style="width: 20%;">Trạng thái</th>
          <th style="width: 10%;"></th>
        </tr>
      </thead>
      <tbody>
        {{-- TH1: CHO XAC NHAN --}}
        <tr>
          <td>trananhthu</td>
          <td>
            <ol>
              <li><a href="#">ao nam chat cotton re nhat thi truong sieu dep sieu ben</a></li>
              <li><a href="#">ao nam chat cotton re nhat thi truong sieu dep sieu ben</a></li>
              <li><a href="#">ao nam chat cotton re nhat thi truong sieu dep sieu ben</a></li>
            </ol>
          </td>
          <td>Pham Minh Hieu</td>
          <td><a href="#">Nguoi ban</a></td>
          <td>15:45 28/12/2020</td>
          <td>
            <div class="order-status">Chờ xác nhận</div>
            <a href="#" class="secondary-btn btn--small">Huỷ đơn</a>
          </td>
          <td>
            <a href="#" class="primary-btn btn--small">Chi tiết</a>
          </td>
        </tr>
        {{-- TH2: DA NHAN DON --}}
        <tr>
          <td>trananhthu</td>
          <td>
            <ol>
              <li><a href="#">ao nam chat cotton re nhat thi truong sieu dep sieu ben</a></li>
              <li><a href="#">ao nam chat cotton re nhat thi truong sieu dep sieu ben</a></li>
              <li><a href="#">ao nam chat cotton re nhat thi truong sieu dep sieu ben</a></li>
            </ol>
          </td>
          <td>Pham Minh Hieu</td>
          <td><a href="#">Nguoi ban</a></td>
          <td>15:45 28/12/2020</td>
          <td>
            <div class="order-status order-status--agree">Đã nhận đơn!</div>
            <a href="#" class="secondary-btn btn--small">Huỷ đơn</a>
          </td>
          <td>
            <a href="#" class="primary-btn btn--small">Chi tiết</a>
          </td>
        </tr>
        {{-- TH3: DA HUY DON --}}
        <tr>
          <td>trananhthu</td>
          <td>
            <ol>
              <li><a href="#">ao nam chat cotton re nhat thi truong sieu dep sieu ben</a></li>
              <li><a href="#">ao nam chat cotton re nhat thi truong sieu dep sieu ben</a></li>
              <li><a href="#">ao nam chat cotton re nhat thi truong sieu dep sieu ben</a></li>
            </ol>
          </td>
          <td>Pham Minh Hieu</td>
          <td><a href="#">Nguoi ban</a></td>
          <td>15:45 28/12/2020</td>
          <td>
            <div class="order-status order-status--cancel">Đã huỷ đơn!</div>
          </td>
          <td>
            <a href="#" class="primary-btn btn--small">Chi tiết</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

@endsection