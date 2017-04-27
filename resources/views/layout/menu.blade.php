<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            @if (Auth::user()->is_admin)
                <li>
                    <a href="{{ route('admin.user.index') }}">Tài khoản</a>
                </li>
            @endif
            <li>
                <a href="{{ route('category.index') }}">Chuyên mục</a>
            </li>
            <li>
                <a href="{{ route('expense.index') }}">Chi tiêu</a>
            </li>
            <li>
                <a href="{{ route('collect.index') }}">Thu nhập</a>
            </li>
        </ul>
    </div>
</div>
