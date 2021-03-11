<li class="nav-item">
  <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>
      Dashboard
    </p>
  </a>
</li>
<li class="nav-item">
  <a href="{{ route('admin.exam.list') }}" class="nav-link {{ Request::segment(2) == 'soal' ? 'active' : '' }}">
    <i class="nav-icon fas fa-edit"></i>
    <p>
      Soal
    </p>
  </a>
</li>
<li class="nav-header">DATA</li>
<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fa fa-graduation-cap"></i>
    <p>
      Kampus
    </p>
  </a>
</li>
<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fa fa-school"></i>
    <p>
      Sekolah
    </p>
  </a>
</li>
<li class="nav-header">AKUN</li>
<li class="nav-item">
  <a href="{{ route('admin.user.list') }}" class="nav-link {{ Request::segment(2) == 'users' ? 'active' : '' }}">
    <i class="nav-icon fa fa-users"></i>
    <p>
      Users
    </p>
  </a>
</li>
<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fa fa-user-shield"></i>
    <p>
      Admin
    </p>
  </a>
</li>
<li class="nav-header">PENCATATAN</li>
<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fa fa-cash-register"></i>
    <p>
      Cashflow
    </p>
  </a>
</li>
<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fa fa-clipboard-list"></i>
    <p>
      Log
    </p>
  </a>
</li>