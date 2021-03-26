<li class="nav-item">
  <a href="{{ route('dashboard') }}" class="nav-link {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>
      Dashboard
    </p>
  </a>
</li>
<li class="nav-item">
  <a href="{{ route('exam.list') }}" class="nav-link {{ Request::segment(1) == 'tryout' ? 'active' : '' }}">
    <i class="nav-icon fas fa-edit"></i>
    <p>
      Tryout
    </p>
  </a>
</li>