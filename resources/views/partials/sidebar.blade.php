<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link {{ request()->is('dashboard') ? 'active' : ''}}" href="/dashboard">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    @if(session('role') == 'admin')
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
       <i class="icon-head menu-icon"></i>

        <span class="menu-title">Data Users</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/adminusers">Admin</a></li>
          <li class="nav-item"> <a class="nav-link" href="/pembinausers">Pembina</a></li>
          <li class="nav-item"> <a class="nav-link" href="/anggotausers">Anggota</a></li>
          <li class="nav-item"> <a class="nav-link" href="/bendaharausers">Bendahara</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->is('rekaplaporanabsensi') ? 'active' : ''}}" href="/rekaplaporanabsensi">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Rekap  Absensi</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->is('rekaplaporankeuangan') ? 'active' : ''}}" href="/rekaplaporankeuangan">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Rekap Keuangan</span>
      </a>
    </li>

    @elseif(session('role') == 'pembina')
    
     <li class="nav-item">
      <a class="nav-link {{ request()->is('absenanggota') ? 'active' : ''}}" href="/absenanggota">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">Absen Anggota</span>
      </a>
    </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('jadwalteater') ? 'active' : ''}}" href="/jadwalteater">
        <i class="icon-columns menu-icon"></i>
        <span class="menu-title">Jadwal Teater</span>
      </a>
    </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('kasteater') ? 'active' : ''}}" href="/kasteater">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Kas Teater</span>
      </a>
    </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('punishment') ? 'active' : ''}}" href="/punishment">
        <i class="icon-ban menu-icon"></i>
        <span class="menu-title">Punishment</span>
      </a>
    </li>

    @elseif(session('role') == 'anggota')

    <li class="nav-item">
      <a class="nav-link {{ request()->is('jadwalteater') ? 'active' : ''}}" href="/jadwalteater">
        <i class="icon-columns menu-icon"></i>
        <span class="menu-title">Jadwal Teater</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->is('kasteater') ? 'active' : ''}}" href="/kasteater">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Kas Teater</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->is('kasteater') ? 'active' : ''}}" href="/kasteater">
        <i class="icon-bar-graph menu-icon"></i>
        <span class="menu-title">Absen Saya</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->is('punishment') ? 'active' : ''}}" href="/punishment">
        <i class="icon-ban menu-icon"></i>
        <span class="menu-title">Punishment</span>
      </a>
    </li>

    @elseif(session('role') == 'bendahara')
     <li class="nav-item">
      <a class="nav-link {{ request()->is('kelolakeuangan') ? 'active' : ''}}" href="/kelolakeuangan">
        <i class="icon-columns menu-icon"></i>
        <span class="menu-title">Kelola Keuangan</span>
      </a>
    </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('rekaplaporankeuangan') ? 'active' : ''}}" href="/rekaplaporankeuangan">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Rekap Keuangan</span>
      </a>
    </li>

    @endif
   
   
   
   
   
    
    
  </ul>
</nav>