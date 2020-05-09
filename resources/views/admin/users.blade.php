@extends('admin.base')

@section('title', 'Quản lý người dùng')

@section('classname', 'manage-users')

@section('content')
<div class="page-pads-container">
  <div class="heading">
    <h3 class="title">QUẢN LÝ NGƯỜI DÙNG</h3>
  </div>
  <div class="pad-filters">
    <input type="text" id="search" class="search" placeholder="Tìm kiếm theo username">
    <div class="filter">
      <select id="sort" class="dropdown">
        <option value="id desc">Sắp xếp theo</option>
        <option value="created_at desc">Ngày tạo mới nhất</option>
        <option value="updated_at desc">Ngày tạo xa nhất</option>
      </select>
      <select id="filter-category" class="dropdown">
        <option value="all">Trạng thái</option>
        <option value="1">Hoạt động</option>
        <option value="2">Bị block</option>
        <option value="2">Mở shop</option>
      </select>
    </div>
  </div>
  <h5>Thông tin người dùng:</h5>
  <div class="pads-container">
    <table class="table product-list">
      <thead>
        <tr>
          <th class="text-left">Username</th>
          <th class="text-left">Email</th>
          <th>Ngày tham gia</th>
          <th>Trạng thái</th>
          <th>Mở shop</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        {{-- TH1: active --}}
        <tr>
          <td class="text-left">trananhthu</td>
          <td>anhthu.3@gmail.com</td>
          <td>28/12/2020</td>
          <td class="text-success">
            Active
          </td>
          <td>Có</td>
          <td>
            <a href="#" class="primary-btn btn--small" data-toggle="modal" data-target="#block-modal">Block</a>
          </td>
        </tr>
        {{-- TH2: tk bi block --}}
        <tr>
          <td class="text-left">trananhthu1</td>
          <td>anhthu.3@gmail.com</td>
          <td>28/12/2020</td>
          <td class="text-danger">
            Blocked
          </td>
          <td>Không</td>
          <td>
            <a href="#" class="secondary-btn btn--small" data-toggle="modal" data-target="#unblock-modal">Unblock</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection

<div class="modal fade" id="block-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Bạn có chắc muốn Block user này?</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="block-user" action="" method="POST">
          {{-- @csrf
          @method('DELETE') --}}
          <div class="d-flex">
            <button class="btn primary-btn btn-block" type="submit">Block</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="unblock-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Bạn có chắc muốn UnBlock user này?</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="block-user" action="" method="POST">
          {{-- @csrf
          @method('DELETE') --}}
          <div class="d-flex">
            <button class="btn primary-btn btn-block" type="submit">UnBlock</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>