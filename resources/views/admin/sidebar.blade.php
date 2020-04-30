<!-- Main sidebar -->
<div id="sidebar-main" class="sidebar sidebar-default sidebar-separate sidebar-fixed">
	<div class="sidebar-content">
		<div class="sidebar-category sidebar-default">
			<div class="sidebar-user">
				<div class="category-content">
          <h6>Admin</h6>
				</div>
			</div>
		</div>
		<!-- /Sidebar Category -->
		<div class="sidebar-category sidebar-default">
			<div class="category-content">
				<ul class="nav flex-column">
					<li class="nav-item">
						<a href="{{ route('admin.manage-orders') }}" class="nav-link">
							<i class="fa fa-pencil" aria-hidden="true"></i>
							Quản lý đơn hàng
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.add-coupon') }}" class="nav-link">
							<i class="fa fa-pencil" aria-hidden="true"></i>
							Thêm mã giảm giá
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.manage-coupons') }}" class="nav-link">
							<i class="fa fa-pencil" aria-hidden="true"></i>
							Quản lý mã giảm giá
						</a>
					</li>
				</ul>
				<!-- /Nav -->
			</div>
			<!-- /Category Content -->
		</div>
		<!-- /Sidebar Category -->
	</div>
</div>
<!-- /main sidebar -->