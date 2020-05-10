@extends('admin.base')

@section('title', 'Quản lý người dùng')

@section('classname', 'manage-users')

@section('content')
{{-- {{ dump($users) }} --}}
<div class="page-pads-container">
  <div class="heading">
    <h3 class="title">QUẢN LÝ NGƯỜI DÙNG</h3>
  </div>
  <div class="pad-filters">
    <input type="text" id="search" class="search" placeholder="Tìm kiếm theo username">
    <div class="filter">
      <select id="sort" class="dropdown">
        <option value="id asc">Sắp xếp theo</option>
        <option value="created_at desc">Ngày tạo mới nhất</option>
        <option value="created_at asc">Ngày tạo xa nhất</option>
      </select>
      <select id="filter-category" class="dropdown">
        <option value="all">Trạng thái</option>
        <option value="0">Active</option>
        <option value="1">Blocked</option>
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
        @foreach ($users as $user)
          <tr>
            <td class="text-left">{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_date }}</td>
            @if ($user->is_banned)
              <td class="text-danger">Blocked</td>
            @else
              <td class="text-success">Active</td>
            @endif
            <td>{{ $user->isShop ? 'Có' : 'Không' }}</td>
            <td>
              @if (Auth::user()->id !== $user->id)
                @if ($user->is_banned)
                  <a href="{{ route('admin.user.unblock', $user->id) }}" class="secondary-btn btn--small">Unblock</a>
                @else
                  <a href="{{ route('admin.user.block', $user->id) }}" class="primary-btn btn--small">Block</a>
                @endif
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

<div class="modal fade" id="block-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Bạn có chắc muốn block user này?</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="block-user" action="" method="POST">
          @csrf
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
        <h2 class="modal-title">Bạn có chắc muốn unblock user này?</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="unblock-user" action="" method="POST">
          @csrf
          <div class="d-flex">
            <button class="btn primary-btn btn-block" type="submit">Unblock</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<template id="admin-users-row">
  <tr>
    <td class="text-left"></td><!--username-->
    <td></td><!--email-->
    <td></td><!-- ngay tham gia -->
    <td class=""></td><!-- trang thai -->
    <td></td><!-- mo shop? -->
    <td>
      <a href="" class="btn--small"></a><!-- block/unblock -->
    </td>
  </tr>
</template>